<?php
// +----------------------------------------------------------------------
// | Tchat
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------
namespace Wechat\Event;

/**
 * 客户文本类型消息处理类
 */
class TextEvent {

	private $openId = "";

	/**
	 * 对文本类型消息进行处理
	 * @param string $openId 客户微信ID唯一识别码
	 * @param string $keyword 客户发送的文本信息
	 */
	public function textHandle($openId, $keyword) {
		$this -> openId = $openId;

		/* 对是否需要验证客户信息的项目进行关键字匹配 */
		if ($reply = A('Pattern', 'Logic') -> findPreg($openId, $keyword)) {
			return $reply;
		}

		/* 查看是否有客户缓存 */
		if (S($openId)) {
			if ($reply = A('Cache', 'Logic') -> cacheReply($openId, $keyword)) {
				return $reply;
			};
		}
		
		/* 开始通过自定义关键字查询回复 */
		if (!$New = M('Tchat_keyword')) {//当M实例化关键字模型出错时
			$content = get_wchat_error(U('textHadle', '', ''), $openId, $keyword); ;
			$reply = array($content['client'], 'text', 0);
			return $reply;
		} else {
			/* 对关键字进行匹配查询,找到所有对应的关键词组ID */
			$findGroup = $New -> where(array('keyword' => $keyword)) -> distinct(true) -> field('group_id')-> select();
			if ($findGroup) {
				if ($reply = $this -> keywordMatch($findGroup)) {
					return $reply;
				} else {
					$reply = $this -> keywordLike($keyword);
					return $reply ? $reply : get_text_arr("/::< 抱歉，没有为您找到想要的结果。");
				}
			} elseif (is_null($findGroup)) {
				//没有全匹配查询结果，返回数据为空时进行一次模糊查询
				$reply = $this -> keywordLike($keyword);
				return $reply ? $reply : get_text_arr("/::< 抱歉，没有为您找到想要的结果。");
			}
		}

	}

	private function keywordMatch($findGroup) {
		//有多个匹配结果
		if (!empty($findGroup[1])) {
			return $reply = $this -> findGroup($findGroup);
		} else {
			//只一条匹配结果
			$map['id'] = $findGroup[0]['group_id'];
			$rs = M('Tchat_keyword_group') -> where($map) -> find();

			if ($rs['status'] == '0' || $rs['status'] == '-1') {
				return false;
			} else {
				//判断是否过期，0为长期有效，过期则回复过期回复文字，有效则进入相应模型查找回应内容。
				return $reply = 0 < $rs['deadline'] && $rs['deadline'] < time() ? get_text_arr( M('Tchat_text') -> where('`id`="' . $rs['dead_text'] . '"') -> getField('content')) : A('Reply', 'Event') -> wechatReply($rs);
			}
		}
	}

	/**
	 * 关键词模糊查询
	 * @param string $keyword 关键词
	 */
	private function keywordLike($keyword) {
		$New = M('Tchat_keyword');
		$map['keyword'] = array('like', '%' . $keyword . '%');
		$findGroup = $New -> where($map) -> distinct(true) -> field('group_id') -> limit(10) -> select();
		return $reply = $this -> findGroup($findGroup);

	}

	/**
	 * 查找关键词所属分组
	 * 关键词与关键词组为多对多关系，当一个关键词有多个j，返回给客户对应有几个关键词组名并缓存
	 * 客户可通过该缓存回复相应数字回复不同的关键词组对应内容
	 * @param array $findGroup
	 */
	private function findGroup($findGroup) {

		foreach ($findGroup as $key => $var) {
			$ids[$key] = $var['group_id'];
		}

		$Group = M('Tchat_keyword_group');
		$map['id'] = array('in', $ids);
		$map['status'] = array('eq', '1');
		$map['deadline'] = array('NOT BETWEEN', array('1', time()));
		$name = $Group -> where($map) -> getField('id,name');

		if (!empty($name)) {
			$i = 1;
			foreach ($name as $k => $v) {
				$contentlist .= $i . ")." . $v . "\n";
				$listCache[$i] = $k;
				$i++;
			}
			$i--;
			if ($i == 1) {//当只找到一条记录符合时，直接回复该关键词组对应的回复
				$map['id'] = $k;
				$rs = M('Tchat_keyword_group') -> where($map) -> find();
				return $reply = A('Reply', 'Event') -> wechatReply($rs);
				unset($listCache);
				//清除缓存变量
			} else {//找到多个符合的记录是，提供选择并缓存
				$content = "[愉快]为您找到" . $i . "个结果：\n" . $contentlist . "您可以回复以上序号查看相关信息。\n (一分钟内有效)\r(づ￣ ³￣)づ";
				unset($i);

				$openId = $this -> openId;

				S($openId, array('action' => array('controller' => "Cache,Logic", //需要后续处理的控制器及命名空间
				'methed' => 'listCache', //需要后续处理的公共方法
				), 'needs' => array('keyword' => array_keys($listCache), //取缓存数组的键名作为关键字数组
				'params' => '' //传入到上述方法的公共参数
				), 'listCache' => $listCache //缓存查询后的数组
				), 60);
				//缓存group_id字段值，对应列表序号
				return get_text_arr($content);
			}
		} else {
			return false;
		}

		exit ;
	}

}
