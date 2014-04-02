<?php

namespace Wechat\Event;

class ConfigEvent{
  
  public function  getWechatAppId(){
    return $appId = C('WECHAT_APP_ID');
  }
  
  public function  getWechatAppSecret(){
    return $appSecret = C('WECHAT_APP_SECRET');
  }
  
}