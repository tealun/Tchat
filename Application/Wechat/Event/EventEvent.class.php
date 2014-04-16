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
        //TODO 无法获取系统配置，采用自定义配置文件方式配置认证状态 再寻问题 及解决方法
        case 'subscribe':
          if (check_wechat_rz()===TRUE){
            $data = get_client_info($openId);
            $data['event_key']=$evnetKey;
            $data['ticket']=$ticket;
          }else{
            $data['openid']=$openId;
            $data['subscribe']='1';
            $data['subscribe_time']=time();
          }
            $Client = D('Tchat_client'); // 实例化Tchat_client对象
            $Client->update($data);
        case 'unsubscribe':
          $data['openid']=$openId;
          $data['subscribe']='0';
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