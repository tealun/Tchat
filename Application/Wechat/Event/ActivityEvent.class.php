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

  /**
   * 对特定活动板块进行检测
   * 
   * @param $openId 微信openid
   * @param $keyword 客户发送的信息
   */
  public function activPreg($openId,$keyword){
    $patternArr = array( // 建立特定板块关键词匹配规则
      'hongbao'=>"/^(?:抢红包)[ \-\+]?([^ \+\f\n\r\t\v0-9]+)?[ \-\+]?((1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$)?/",
      'suggest'=>"/^(?:建议|提建议)[ \-\+\:]?(.*)/"
    );
    //对客户发送的消息进行关键词匹配
    foreach ($patternArr as $key => $pattern){
      if(preg_match($pattern, $keyword,$matches)){
        switch ($key){
          //匹配到红包活动
          case 'hongbao':
            //先查看活动是否已经截止或者禁用及删除
            $map['segment'] = 'activity';
            $map['name'] = '抢红包';
            $map['status'] = array('eq','1');
            $map['deadline'] = array('NOT BETWEEN',array('1',time()));
            $id = M('Tchat_keyword_group')->where($map)->getField('id');
            
            //没有结果时，回复结束时的回复内容
            if(!$id){
              $where['segment'] = 'activity';
              $where['name'] = '抢红包';
              $rs = M('Tchat_keyword_group')->where($where)->find();
              return $reply = get_text_arr(M('Tchat_text')->where('`id`="'.$rs['dead_text'].'"')->getField('content'));
              exit;
            }
            
            //如果匹配且有结果，先清除客户的缓存
            S($openId,NULL); 
            $name = $matches[1]; //提取客户姓名
            $phone = $matches[2]; //提取客户电话
            if(!$name){$tip[name]='姓名';}
            if(!$phone){$tip[phone]='联系电话';}
            
            //提取不到姓名或者电话时新增客户缓存，并提示需要回复哪些内容
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
          //匹配到客户建议
          case 'suggest':
            //获取客户ID并存储客户建议内容
            $data['client_id']=D('Tchat_client')->getClintId($openId);
            $data['content'] = $matches[1];
            $data['create_time'] = time();
            M('Tchat_suggestion')->data($data)->add();
            //提示客户回复姓名和电话，并建立客户缓存
            $reply = get_text_arr("您的建议我们已经收到，希望您能回复您的姓名和联系方式，如有必要我们会联系您。谢谢！\n (2分钟后过期)");
            S($openId,array('activity'=>'suggest'),120);
        }
        return $reply;
      }
    }
  }
}