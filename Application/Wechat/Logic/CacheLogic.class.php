<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------
namespace Wechat\Logic;

class CacheLogic{
	public function index($num){
	
	}
	
  public function cacheReply($openId,$keyword){
  	$data =  S($openId);
	$action = str2arr($data['action']['c']);
    $methed = $data['action']['a'];

    if(!empty($data['p'])){
   	 $data['p']['keyword']=$keyword;
     $action = A($action[0],$action[1]);
     $reply = call_user_func_array(array($action,$methed), $data['p']);
    }
    return $reply;
  }
	  
  private function judgeNamePhone($data,$openId,$keyword,$segment,$keyWordGropName,$second='120'){

    
          if(preg_match('/^([^ \+\f\n\r\t\v0-9]+)$/',$keyword)){
          $data['name']= $keyword;
          S($openId,$data,$second);
          if(empty($data['phone'])){
            $reply = get_text_arr("请回复您的联系电话\n取消请回复'qx'");
          };
        }elseif (preg_match('/^\d+$/',$keyword)){
          if(preg_match('/^(1[34578]\d{9})$|^((0\d{2,3})?-?(\d{7,8}))$/', $keyword)){
            $data['phone']= $keyword;
            S($openId,$data,$second);
            if(empty($data['name'])){
              $reply = get_text_arr("请回复您的姓名\n取消请回复'qx'");
            }
          }else{
            $reply = get_text_arr('电话号码有误，请确认后重新回复');
          }

        //TODO 此处匹配可参考有无两个匹配顺序上不做要求，也就是客户先写名字或号码都能匹配到
        }elseif (preg_match('/([^ \+\f\n\r\t\v0-9]+)[ \+\-]?((1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$)/', $keyword,$matches)){
          $data['name']= $matches[1];
          $data['phone'] = $matches[2];
        }else{
          $reply = get_text_arr('内容有误，请确认后重新回复，可能您输入的不是有效的电话号码。');
        }

        if($data['name'] && $data['phone']){
          //获取客户数据完整后更新客户资料
          $data['id']=M('Tchat_client')->where(array('openid'=>$openId))->getField('id');
          $data['openid']=$openId;
          D('Tchat_client')->update($data);
            $map['segment'] = $segment;
            $map['name'] = $keyWordGropName;
            $rs = M('Tchat_keyword_group')->where($map)->find();
          $reply = $this->wechatReply($rs);
          S($openId,NULL);
        }
        return $reply;
  }
  
}
