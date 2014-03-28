<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------
namespace Wechat\Event;

class ActivityEvent{

	//TODO 对特定活动的关键词进行过滤匹配
	public function activPreg($openId,$keyword){
		$patternArr = array(
			'hongbao'=>"/^(?:抢红包)[ \-\+]?([^ \+\f\n\r\t\v0-9]+)?[ \-\+]?((1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$)?/",
			'suggest'=>"/^(?:建议)[ \-\+\:]?(.*)/"
		);
		foreach ($patternArr as $key => $pattern){
			if(preg_match($pattern, $keyword,$matches)){
				switch ($key){
					//红包活动
					case 'hongbao':
						//先查看活动是否已经截止或者禁用及删除
						$map['segment'] = 'activity';
						$map['name'] = '抢红包';
						$map['status'] = array('eq','1');
						$map['deadline'] = array('NOT BETWEEN',array('1',time()));
						$id = M('Tchat_keyword_group')->where($map)->getField('id');
						
						if(!$id){
							$where['segment'] = 'activity';
							$where['name'] = '抢红包';
							$rs = M('Tchat_keyword_group')->where($where)->find();
							return $reply = get_text_arr(M('Tchat_text')->where('`id`="'.$rs['dead_text'].'"')->getField('content'));
							exit;
						}
						
						S($openId,NULL); //如果匹配，先清除客户的缓存
						$name = $matches[1];
						$phone = $matches[2];
						if(!$name){$tip[name]='姓名';}
						if(!$phone){$tip[phone]='联系电话';}

						if(!$name || !$phone){
							$tips = implode('、',$tip);
							$content = "您的".$tips."输入有误，请重新回复您的".$tips."\n（2分钟内有效）";
							S($openId,array('activity'=>'hongbao',
											'name'=>$name?$name:'',
											'phone'=>$phone?$phone:''),120);
							
							$reply = get_text_arr($content);
						}else{
							//获取客户数据完整后更新客户资料
							$data['id']=M('Tchat_client')->where(array('openid'=>$openId))->getField('id');
							$data['openid']=$openId;
							$data['name']=$name;
							$data['phone']=$phone;
							D('Tchat_client')->update($data);
							//回复客户
							$map['id'] = $id;
							$rs = M('Tchat_keyword_group')->where($map)->find();

							return $reply = A('Reply','Event')->wechatReply($rs);
						}
						break;
					//客户建议
					case 'suggest':
						
						$data['client_id']=D('Tchat_client')->getClintId($openId);
						$data['content'] = $matches[1];
						$data['create_time'] = time();
						M('Tchat_suggestion')->data($data)->add();

						$reply = get_text_arr("您的建议我们已经收到，希望您能回复您的姓名和联系方式，如有必要我们会联系您。谢谢！\n (2分钟后过期)");
						S($openId,array('activity'=>'suggest'),120);
				}
				return $reply;
			}
		}
	}
}