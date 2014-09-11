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
 * 客户事件类型消息处理类
 */
class EventEvent {

	/**
	 * 客户发送事件消息处理
	 *
	 * @param $openId
	 * @param $event
	 * @param $eventKey
	 * @param $ticket
	 */
	public function eventHandle($openId, $event, $eventKey = '', $ticket = '') {
		switch ($event) {
			//TODO 无法获取系统配置，采用自定义配置文件方式配置认证状态 再寻问题及解决方法
			
			/* 关注事件 */
			case 'subscribe' :

				//实例化客户模型
				$Client = D('Tchat_client');
				if (check_wechat_rz() === TRUE) {
					//如果是认证服务号，更新一次客户的详细信息
					$data = get_client_info($openId);

					$clientId = $Client -> where('`openid` = "' . $openId . '"') -> getField('id');
					if ($clientId) {//如果有存储，则设置ID值
						$data['id'] = $clientId;
					}

					if (!empty($ticket)) {//检测tiket是否为空
						$this -> qrcodePlusOne($ticket);
					}

					//获取客户信息
					$data['event_key'] = $eventKey;

				} else {//公众号未认证且未存储过客户信息的情况下只存储openid
					$data['openid'] = $openId;
				}

				$data['subscribe'] = '1';
				$data['subscribe_time'] = time();

				$Client -> update($data);
				break;
				
			/* 取消关注事件 */
			case 'unsubscribe' :
				$Client = M('Tchat_client');
				$Client -> getByOpenid($openId);
				$Client -> subscribe = "0";
				//更改关注状态
				$Client -> save($data);
				break;
			
			/* 扫描事件 */
			case 'SCAN' :
				$this -> qrcodePlusOne($ticket);
				break;
			
			/* 自定义菜单点击事件 */
			case 'CLICK' :
				
				$rs = M('Tchat_menu') -> where('`event_key` = "'.$eventKey.'"') -> find();
				//对点击事件的动作执行类型进行过滤
				switch ($rs['action_type']) {
					case 'keyword' : //执行某关键词回复
						$TextRe = A('Text', 'Event');
						$keyword = $rs['action_code'];
						return $reply = $TextRe -> textHandle($openId, $keyword);

						break;

					//当自定义菜单点击的回复类型为分类时
					case 'category' : //执行某分类文章回复
						$re = array('reply_type' => 'news', 'reply_id' => $rs['action_code'], );

						//直接回复图文列表
						return $reply = A('Reply', 'Event') -> wechatReply($re);
						break;
                   //当自定义菜单点击的回复类型为文档列表时
					case 'document' : //执行文章合集回复
						$re = array('reply_type' => 'document', 'reply_id' => $rs['action_code'], );

						//直接回复图文列表
						return $reply = A('Reply', 'Event') -> wechatReply($re);
						break;

				}
			break;
		}

		//根据EVENT值找到EVENT表中相应的回复类型
		$re = M('Tchat_events') -> where(array('event_type'=>$event)) ->find();
		return $reply = A('Reply', 'Event') -> wechatReply($re);

 	}
 
	/**
	 * 二维码扫描数+1
	 * @param $ticket 二维码TICKET
	 */
	protected function qrcodePlusOne($ticket) {

		$QRcode = M('Tchat_qrcode');
		$QRcode -> getByTicket($ticket);
		$QRcode -> scan_num++;
		$QRcode -> save();
	}

}
