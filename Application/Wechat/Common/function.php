<?php

/**
 * Wechat 处理函数库
 */

/**
 * 处理回复消息类型模板
 * TODO 增加image和url类型回复模板
 * @param string $type 消息类型
 * @return string
 */
function get_wechat_tpl($type){
  switch ($type){
    
    case 'text':
      $tpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        <FuncFlag>![CDATA[%s]]</FuncFlag>
        </xml>";
      break;
    case 'news':
      $tpl = "<xml>
             <ToUserName><![CDATA[%s]]></ToUserName>
             <FromUserName><![CDATA[%s]]></FromUserName>
             <CreateTime>%s</CreateTime>
             <MsgType><![CDATA[%s]]></MsgType>
             <ArticleCount>%s</ArticleCount>
             <Articles>%s</Articles>
             <FuncFlag>![CDATA[%s]]</FuncFlag>
             </xml> ";
      break;
    case'music':
      $tpl = "<xml>
               <ToUserName><![CDATA[%s]]></ToUserName>
               <FromUserName><![CDATA[%s]]></FromUserName>
               <CreateTime>%s</CreateTime>
               <MsgType><![CDATA[%s]]></MsgType>
               <Music>
               <Title><![CDATA[%s]]></Title>
               <Description><![CDATA[%s]]></Description>
               <MusicUrl><![CDATA[%s]]></MusicUrl>
               <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
               </Music>
               <FuncFlag>![CDATA[%s]]</FuncFlag>
               </xml>";
      break;
  }
  return $tpl;
}

/**
 * 文本回复类型消息整合返回数组 
 * @param  $content 文本内容
 */
function get_text_arr($content){
  $arr = array($content,'text',0);
  return $arr;
}

/**
 * 图文回复类型消息整合返回数组 
 * @param  $content 文本内容
 */
function get_news_arr($news){
  $arr = array($news,'news',0);
  return $arr;
}

/**
 * 音乐回复类型消息整合返回数组 
 * @param  $content 文本内容
 */
function get_music_arr($content){
  $arr = array($content,'music',0);
  return $arr;
}

/**
 * URL回复类型消息整合返回数组 
 * @param  $content 文本内容
 */
function get_url_arr($content){
  $arr = array($content,'url',0);
  return $arr;
}

/**
 * 客户发送消息后由于系统问题无法正常查询数据库等情况下回复客户出错
 * 一般情况下，如果出现此错误，并非Wechat模块问题，可参考是否正确连接数据库，配置文件是否正确，实例化对象是否正常
 * @param string $action  出现故障的操作方法
 * @param string $openId Content 客户发送的内容
 * @param string $mailMessge 发送给客服的信息内容，后期再写一个客服邮件发送函数
 * @return array $Arr ['client']用于回复客户，['SUPPORT']用于报告客服
 */
function get_wchat_error($action,$openId,$clientContent) {
  $time = Date('Y-m-d H:i:s',TIME());
  $client = get_client_info($openId);
  $messge = "亲爱的\"".$client['nickname']."\":\n非常抱歉，貌似系统感冒了…\n此次故障我们已经记录，我们期待您通过网站或致电的方式将问题详情反馈给我们，以便我们尽快处理！\n网址：www.tealun.com \n电话：010-00000000";
  $mailMessge= $time.$client['province'].$client['city']." 客户“".$client['nickname']."”在发送消息“".$clientContent."”时发生故障，事件环节为“".$action."”请尽快处理，如果您无法处理该问题，请致电开发人员解决。";
  
  //将系统错误信息发送给客户，前提是Wechat模块运行正常
  return $Arr = array(
    'client'=>$messge,
    'SUPPORT' =>$mailMessge,
  );
}

/**
 * 获取用户详细信息
 * 通过微信接口获取详细用户信息
 * @param string $openId 发送消息用户的openid
 * @param string $appId 公众帐号APPID，当前为测试赋值，可在系统完成后台设置后调用赋值
 * @param string $appsecret 公众帐号APPSECRET，当前为测试赋值，可在系统完成后台设置后调用赋值
 * @return Array
 */
function get_client_info($openId){

  $accessToken = get_access_token();
  
  $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$accessToken.'&openid='.$openId.'&lang=zh_CN';

  $str = file_get_contents($url);
  return $client = json_decode($str, true);

}

/**
 * 查询数据库中客户详情
 * TODO 与Tchat_client模型做比较，看是否整合到该模型类中
 * @param string $openId 客户openId
 * @param array $field  想要查询的字段数组
 */
function get_client_detail($openId,$field=array()){
  if(!empty($field)){
    $rs = M('Tchat_client')->where(array('openid'=>$openId))->field($field)->find();
  }else{
    $rs = M('Tchat_client')->where(array('openid'=>$openId))->find();
  }
  return $rs;
}

/**
 * 获取公众账号的accessToken
 * 
 */
function get_access_token(){
  $appId = get_ot_config('WECHAT_APP_ID');
  $appSecret = get_ot_config('WECHAT_APP_SECRET');
  $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appId.'&secret='.$appSecret;

  $str = file_get_contents($url);
  $arr = json_decode($str, true);
  $accessToken = S('accessToken')?S('accessToken'):save_access_token();
  return $accessToken;
}

/**
 * 缓存公众帐号accessToken
 *
 */
function save_access_token(){
  $appId = get_ot_config('WECHAT_APP_ID');
  $appSecret = get_ot_config('WECHAT_APP_SECRET');
  $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appId.'&secret='.$appSecret;

  $str = file_get_contents($url);
  $arr = json_decode($str, true);
  S('accessToken',$arr['access_token'],120);
  return $accessToken = S('accessToken');
}

function check_wechat_rz(){
  $value = get_ot_config('WECHAT_ACCOUNT_RZ');
	  if($value === '2'){
	  	return $value;
	  }else{
	  	return $value === '1'?TRUE:FALSE;
  }
}

function check_wechat_type(){
  $value = get_ot_config('WECHAT_ACCOUNT_TYPE');
  return $value === '1'?TRUE:FALSE;
}

/**
 * 为解决不能C到OT配置写的函数
 * 
 * @param $string $name 配置的name标识
 */ 
function get_ot_config($name){
  $res = M('Config')->where(array('name'=>$name))->getField('value');
  return $res;
}