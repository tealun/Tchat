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
	 * @param  $openId    客户唯一openid
	 * @param  $event     事件类型
	 * @param  $eventKey  事件KEY值
	 * @param  $ticket    二维码的ticket，可用来换取二维码图片
	 * @author Tealun Du
	 */
	public function eventHandle($openId, $event, $eventKey = '', $ticket = '') {
		switch ($event) {
			//TODO 无法获取系统配置，采用自定义配置文件方式配置认证状态 再寻问题及解决方法
			
			/* 关注事件 */
			case 'subscribe' :
				$this -> updateClientInfo($openId,$eventKey,$ticket);
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
				$this -> replyClickEvent($rs);
			break;
			
			default:
					return get_text_arr("系统正在开发本接口，敬请关注。");
			break;
		}
			    //根据EVENT值找到EVENT表中相应的回复类型
			$re = M('Tchat_events') -> where(array('event_type'=>$event)) ->find();
			return A('Reply', 'Event') -> wechatReply($re);
 	}
   
   /**
    * 更新客户信息
    * @param string $openId   客户唯一openid
    * @param string $eventKey 事件KEY值
    * @param string $ticket   二维码的ticket，可用来换取二维码图片
    * @author Tealun Du 
    */
   protected function updateClientInfo($openId,$eventKey="",$ticket=""){
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
	
	/**
	 *点击自定义菜单事件回应
	 * 对点击事件的动作执行类型进行过滤
	 * @param array $rs 点击事件的配置数据资源
	 */
	protected function replyClickEvent($rs){
		
		/* TODO 点击自定义菜单中增加回复类型为图片、音乐、URL等类型  */
		switch ($rs['action_type']) {
			
			//执行某关键词回复
			case 'keyword' : 
				$TextRe = A('Text', 'Event');
				$keyword = $rs['action_code'];
				return $TextRe -> textHandle($openId, $keyword);
				break;

			 //当自定义菜单点击的回复类型为功能时
			case 'segment' : 
				if($rs['action_code'] == 'service'){//如果是客服模块直接转到客服
					return get_service_arr();
				}else{//TODO 其他模块待加入
					return get_text_arr('功能尚在完善，敬请关注');
				}
				break;

			//其他默认情况下的回复
			default: 
				$re = array('reply_type' => $rs['action_type'], 'reply_id' => $rs['action_code'], );
				//直接回复对应的内容
				return A('Reply', 'Event') -> wechatReply($re);
				break;
		}
	}

}
