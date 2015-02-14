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

		/* 查看是否有客户缓存 */
		if (S($openId)) {
			if ($reply = A('Cache', 'Logic') -> cacheReply($openId, $keyword)) {
				return $reply;
			};
		}

		/* 对是否需要验证客户信息的项目进行关键字匹配 */
		if ($reply = A('Pattern', 'Logic') -> findPreg($openId, $keyword)) {
			return $reply;
		}
		
		/* 对关键字进行匹配查询,找到所有对应的关键词组ID */
		if ($reply = $this -> keywordMatch($keyword)){
				return $reply;
			}else{//查询没有结果时，回复信息
					$content = M('Tchat_text')->where('`id` = "4"')->getField('content'); //查找指定文本内容
					if(get_ot_config('WECHAT_CUSTOM_SERVICE')) //检测是否开启多客服，开启则提示可联系客服
					  $content .= "\n--------------------\n是否转接到在线客服咨询?\n回复“1”或“是”立刻转接\n(1分钟内有效)";
							
							/*转接客服缓存*/
							S($openId, array(
							'action' => array(
								'controller' => "Cache,Logic", //需要后续处理的控制器及命名空间
								'methed' => 'serviceCache', //需要后续处理的公共方法
								), 
							'needs' => array(
								'keyword' => "1,是", //取缓存数组的键名作为关键字数组
								'params' => '' //传入到上述方法的公共参数
								)
							), 60);
					
					return $reply = get_text_arr($content);
				}
	}

	/**
	 * 关键词匹配查询
	 * */
	private function keywordMatch($keyword) {
		$New = M('Tchat_keyword');
		$map['keyword'] = $keyword;
		$groupIds = $New -> where($map) -> distinct(true) -> getField('id,group_id');
		//有完全匹配结果时
		if (!empty($groupIds)) {
			return $reply = $this -> getGroup($groupIds);
		} else {
			//没有完全匹配结果时模糊查询
			$map['keyword'] = array('like', '%'.$keyword.'%' );
			$groupIds = $New -> where($map) -> distinct(true) -> getField('id,group_id');
			return $reply = $this -> getGroup($groupIds);
				//有模糊查询结果时
				if (!empty($groupIds)) {
					return $reply = $this -> getGroup($groupIds);
				}else{//否则返回FALSE
					return FALSE;
				}
		}
	}

	/**
	 * 获取关键词所属分组
	 * 关键词与关键词组为多对多关系，当一个关键词有多个关键词组对应时，返回给客户对应有几个关键词组名并缓存
	 * 客户可通过该缓存回复相应数字回复不同的关键词组对应内容
	 * @param array $groupIds 找到的关键词组ID数组
	 */
	private function getGroup($groupIds) {

		$Group = M('Tchat_keyword_group');
		$map['id'] = array('in', $groupIds);
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
			/* 当只找到一条记录符合时，直接回复该关键词组对应的回复 */
			if ($i == 1) {
				$map['id'] = $k;
				$rs = M('Tchat_keyword_group') -> where($map) -> find();
				//判断是否过期，0为长期有效，过期则回复过期回复文字，有效则进入相应模型查找回应内容。
				return $reply = 0 < $rs['deadline'] && $rs['deadline'] < time() ? 
								get_text_arr( M('Tchat_text') -> where('`id`="' . $rs['dead_text'] . '"') -> getField('content'))
							: A('Reply', 'Event') -> wechatReply($rs);
							
				unset($listCache);//清除缓存变量
				
			/*找到多个符合的记录是，提供选择并缓存*/
			} else {
				$content = "[愉快]为您找到" . $i . "个结果：\n--------------------\n" . $contentlist . "\n--------------------\n回复相应序号查看详情。\n (1分钟内有效)\r(づ￣ ³￣)づ";
				unset($i);

				$openId = $this -> openId;

				S($openId, array(
					'action' => array(
						'controller' => "Cache,Logic", //需要后续处理的控制器及命名空间
						'methed' => 'listCache', //需要后续处理的公共方法
					),
					 'needs' => array(
					 	'keyword' => array_keys($listCache), //取缓存数组的键名作为关键字数组
						'params' => '' //传入到上述方法的公共参数
					), 
					'listCache' => $listCache //缓存查询后的数组内容
				), 60);
				//缓存group_id字段值，对应列表序号
				return get_text_arr($content);
			}
		} else {
			return false;
		}
	}

}
