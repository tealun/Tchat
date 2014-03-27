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
		);
		foreach ($patternArr as $key => $pattern){
			if(preg_match($pattern, $keyword,$matches)){
				switch ($key){
					case 'hongbao':
						S($openId,NULL); //如果匹配，先清除客户的缓存
						$name = $matches[1];
						$phone = $matches[2];
						if(!$name){$tip[name]='姓名';}
						if(!$phone){$tip[phone]='联系电话';}

						if(!$name || !$phone){
							$content = "请回复您的".implode('、',$tip)."\n（2分钟内有效）";
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
							$map['segment'] = 'activity';
							$map['name'] = '抢红包';
							$rs = M('Tchat_keyword_group')->where($map)->find();
							//判断是否过期，过期则回复过期回复文字，有效则进入相应模型查找回应内容。
							return $reply = $rs['deadline']<time()
												?get_text_arr(M('Tchat_text')->where('`id`="'.$rs['dead_text'].'"')->getField('content'))
												:A('Reply','Event')->wechatReply($rs);
						}
						break;

				}
				return $reply;
			}
		}
	}
}