<?php
namespace Wechat\Event;

class EventEvent {

	/**
	 * 客户发送事件消息处理
	 *
	 * @param $openId
	 * @param $event
	 * @param $evnetKey
	 * @param $ticket
	 */
	public function eventHandle($openId, $event, $evnetKey = '', $ticket = '') {

		switch ($event) {
			//如果是关注事件，拉取客户资料进行存储
			//TODO 无法获取系统配置，采用自定义配置文件方式配置认证状态 再寻问题 及解决方法
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
					$data['event_key'] = $evnetKey;

				} else {//公众号未认证且未存储过客户信息的情况下只存储openid
					$data['openid'] = $openId;
				}

				$data['subscribe'] = '1';
				$data['subscribe_time'] = time();

				$Client -> update($data);

			//取消关注事件
			case 'unsubscribe' :
				$Client = M('Tchat_client');
				$Client -> getByOpenid($openId);
				$Client -> subscribe = "0";
				//更改关注状态
				$Client -> save($data);
			case 'SCAN' :
				$this -> qrcodePlusOne($ticket);
			case 'CLICK' :
				$rs = M('Tchat_menu') -> where(array('key' => $evnetKey)) -> find();
				switch ($rs['action_type']) {
					case 'keyword' :
						$TextRe = A('Text', 'Event');
						$keyword = $rs['action'];
						return $reply = $TextRe -> textHandle($openId, $keyword);
						break;
					
					//当自定义菜单点击的回复类型为分类时
					case 'category':
						$re = array(
							'reply_type' => 'news',
							'reply_id' => $rs['action'],
						);
						
						//直接回复图文列表
						return $reply = A('Reply', 'Event') -> wechatReply($re);
						break;
						
					case 'document':
						$re = array(
							'reply_type' => 'document',
							'reply_id' => $rs['action'],
						);
						
						//直接回复图文列表
						return $reply = A('Reply', 'Event') -> wechatReply($re);
						break;
						
					default :
						return $reply = get_text_arr('功能尚在完善，请稍后尝试');
						break;
				}
				exit ;
		}

		$id = M('Tchat_events') -> where('`event_type` = "' . $event . '"') -> getField('id');
		$map['segment'] = 'events';
		$map['segment_id'] = $id;
		$rs = M('Tchat_keyword_group') -> where($map) -> find();

		return $reply = A('Reply', 'Event') -> wechatReply($rs);
	}

	/**
	 * 扫描带参数的二维码事件
	 * @param $ticket 二维码TICKET
	 */
	protected function qrcodePlusOne($ticket) {

		$QRcode = M('Tchat_qrcode');
		$QRcode -> getByTicket($ticket);
		$QRcode -> scan_num++;
		$QRcode -> save();
	}

}
