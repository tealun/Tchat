<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------
namespace Wechat\Event;

class TextEvent{
	
	/**
	 * 文本类型数据处理 
	 * @param  string $keyword    文本类型
	 * 
	 */
	public function index() {
	
	}
	
	/**
	 * 对文本类型消息进行处理
	 * @param string $openId 客户微信唯一识别码
	 * @param string $keyword 客户发送的文本信息
	 */
	public function textHandle($openId,$keyword){
		//先对发送的关键字进行缓存查询
		if($id=S($keyword)){
				$rs = M('Tchat_keyword_group')->where('id="'.$id.'"')->find();
				return $reply = A('Reply','Event')->wechatReply($rs);
			}else{
				
				$New = M('Tchat_keyword');
				//对关键字进行匹配查询
				if($findGroup = $New ->where('keyword="'.$keyword.'"')->distinct(true)->field('group_id')->limit(10)-> select()){
						//有多个匹配结果
						if(!empty($findGroup[1])){
							return $reply = $this->findGroup($findGroup);
						}else{
							//只一条匹配结果
							$map['id'] = $findGroup[0]['group_id'];
							$rs = M('Tchat_keyword_group')->where($map)->find();
							//判断是否过期，0为长期有效，过期则回复过期回复文字，有效则进入相应模型查找回应内容。
							return $reply = 0<$rs['deadline']&& $rs['deadline']<time()
												?get_text_arr(M('Tchat_text')->where('`id`="'.$rs['dead_text'].'"')->getField('content'))
												:A('Reply','Event')->wechatReply($rs);
						}
	
				}elseif(is_null($findGroup)){
						//没有全匹配查询结果，返回数据为空时进行一次模糊查询
						return $reply = $this-> keywordLike($keyword);

				}else{
				//当$rs在数据库查询出错时回复信息
				$content = get_wchat_error(U('textHadle','',''),$openId,$keyword);;
				$reply = array($content['client'],'text',0);
				return $reply;
				}
			}
		}	
	/**
	 * 关键词模糊查询
	 * @param string $keyword 关键词
	 */
	private function keywordLike($keyword){
				$New = M('Tchat_keyword');
				$map['keyword'] = array('like','%'.$keyword.'%');
				$findGroup = $New ->where($map)->distinct(true)->field('group_id')->limit(10)-> select();
				return $reply = $this->findGroup($findGroup);

	}
	
	/**
	 * 查找关键词所属分组
	 * 关键词与关键词组为多对多关系，当一个关键词有多个j，返回给客户对应有几个关键词组名并缓存
	 * 客户可通过该缓存回复相应数字回复不同的关键词组对应内容
	 * @param array $findGroup
	 */
	private function findGroup($findGroup){
				
				foreach ($findGroup as $key=>$var){
					$ids[$key] = $var['group_id'];
				}

				$Group = M('Tchat_keyword_group');
				$map['id'] = array('in',$ids);
				$map['deadline'] = array('NOT BETWEEN',array('1',time()));
				$name = $Group->where($map)->getField('id,name');

				 if(!empty($name)){
					$i=1;
					foreach ($name as $k => $v){
					$contentlist .= $i.").".$v."\n";
					S($i,$k,60);//缓存group_id字段值，对应列表序号
					$i++;
					}
					$i--;
					$content = "[愉快]为您找到".$i."个结果：\n"
							.$contentlist.
							"您可以回复以上序号查看相关信息。\n (一分钟内有效)\r(づ￣ ³￣)づ";
					unset($i);
				}else {
					$content = "/::< 抱歉，没有为您找到想要的结果。";
				}
				return get_text_arr($content);
				exit;
	}
}