<?php
namespace Wechat\Event;

class EventEvent {



	/**
	 * 客户发送事件消息处理
	 * 
	 * @param unknown_type $openId
	 * @param unknown_type $event
	 * @param unknown_type $evnetKey
	 * @param unknown_type $ticket
	 */
	public function eventHandle($openId,$event,$evnetKey='',$ticket=''){

			switch ($event){
				//如果是关注事件，拉取客户资料进行存储
				//TODO 此功能为认证帐号才有，这可考虑添加帐号认证判断
				case 'subscribe':
/*					if ($info = get_client_info($openId)){
						$data = $info;
						$data['event_key']=$evnetKey;
						$data['ticket']=$ticket;
					}*/
						$data['openid']=$openId;
						$data['subscribe']='1';
						$data['subscribe_time']=time();

					var_dump($data);
					    $Client = D('Tchat_client'); // 实例化Tchat_client对象
						$Client->update($data);
			}
			
			$id = M('Tchat_events')->where('`event_type` = "'.$event.'"')->getField('id');
				$map['segment'] = 'events';
				$map['segment_id'] = $id;
			$rs = M('Tchat_keyword_group')->where($map)->find();
			
			return $reply = A('Reply','Event')->wechatReply($rs);
	}
}