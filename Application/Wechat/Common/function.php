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
	  
	  case 'service':
      $tpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        </xml>";
      break;
      
case'setService':
	$tpl="<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[%s]]></MsgType>
    <TransInfo>
        <KfAccount>%s</KfAccount>
    </TransInfo>
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
 * 转接客服消息类型整合返回数组
 * 不需要实际内容
 */
function get_service_arr(){
  $arr = array('','service',0); //这里使用service类型标识,返回后续流程中注意要将<MegType>设置为"transfer_customer_service"
  return $arr;
}

/**
 * 客户发送消息后由于系统问题无法正常查询数据库等情况下回复客户出错
 * 一般情况下，如果出现此错误，并非Wechat模块问题，可参考是否正确连接数据库，配置文件是否正确，实例化对象是否正常
 * @param string $action  出现故障的检测点操作方法
 * @param string $openId Content 客户发送的内容
 * @param string $mailMessge 发送给客服的信息内容，TODO: 后期再写一个客服邮件发送函数
 * @return array $Arr ['client']用于回复客户，['SUPPORT']用于报告客服
 */
function get_wechat_error($action,$openId,$clientContent) {
  $time = Date('Y-m-d H:i:s',TIME());
  $client = get_client_info($openId);
  $messge = "亲爱的\"".$client['nickname']?$client['nickname']:'朋友：'."\":\n非常抱歉，貌似系统感冒了…\n此次故障我们已经记录，我们会尽快处理，感谢您的支持。\n<a href='http://".$_SERVER["HTTP_HOST"].$filePath.$fileName."' >点击进入官网</a>";
  $mailMessge= $time.$client['province'].$client['city']." 客户“".$client['nickname']."”在发送消息“".$clientContent."”时发生故障，事件环节为“".$action."”请尽快处理，如果您无法处理该问题，请致电开发人员解决。";
  
  //返回错误信息，前提是Wechat模块运行正常
  return $Arr = array(
    'client'=>$messge, //发送给客户的
    'SUPPORT' =>$mailMessge, //发送给客服的
  );
}

/**
 * 从微信服务器端获取用户详细信息
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


/**
 * 查看是否获得认证
 */
function check_wechat_rz(){
  $value = C('WECHAT_ACCOUNT_RZ');
	  if($value === '2'){
	  	return $value;
	  }else{
	  	return $value === '1'?TRUE:FALSE;
  }
}

/**
 * 查看账户类型
 */
function check_wechat_type(){
  $value = C('WECHAT_ACCOUNT_TYPE');
  switch ($value) {
      case '1':
          $type = "服务号";
          break;
	  case '2':
		  $type = "企业号";
      default:
          $type = "订阅号";
          break;
  }
  return $type;
}

/**
 * 为解决不能C到OT配置写的函数
 * 
 * @param $string $name 配置的name标识
 */ 
function get_ot_config($name){
  $val = M('Config')->where(array('name'=>$name))->getField('value');
  return $val;
}

/**
 * 模拟登录获取Cookie函数
 * TODO 有关Cookie的部分需要重新写
 * 
 */
function vlogin($url, $data) { 
    $curl = curl_init (); // 启动一个CURL会话
    curl_setopt ( $curl,CURLOPT_HTTPHEADER,$this_header); // 设置页头
    curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // 对认证证书来源的检查
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 1 ); // 从证书中检查SSL加密算法是否存在
    curl_setopt ( $curl, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // 模拟用户使用的浏览器
    @curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
    curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
    curl_setopt ( $curl, CURLOPT_POST, 1 ); // 发送一个常规的Post请求
    curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data ); // Post提交的数据包
  //curl_setopt ( $curl, CURLOPT_COOKIEJAR, $GLOBALS ['cookie_file'] ); // 存放Cookie信息的文件名称
  //curl_setopt ( $curl, CURLOPT_COOKIEFILE, $GLOBALS ['cookie_file'] ); // 读取上面所储存的Cookie信息
    curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
    curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // 显示返回的Header区域内容
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec ( $curl ); // 执行操作
    if (curl_errno ( $curl )) {
        echo 'Errno' . curl_error ( $curl );
    }
    curl_close ( $curl ); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}
 
function vget($url) { // 模拟获取内容函数
    $curl = curl_init (); // 启动一个CURL会话
    curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
    curl_setopt ( $curl,CURLOPT_HTTPHEADER,$this_header); // 设置页头
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // 对认证证书来源的检查
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 1 ); // 从证书中检查SSL加密算法是否存在
    curl_setopt ( $curl, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // 模拟用户使用的浏览器
    @curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
    curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
    curl_setopt ( $curl, CURLOPT_HTTPGET, 1 ); // 发送一个常规的Get请求
  //curl_setopt ( $curl, CURLOPT_COOKIEFILE, $GLOBALS ['cookie_file'] ); // 读取上面所储存的Cookie信息
    curl_setopt ( $curl, CURLOPT_TIMEOUT, 120 ); // 设置超时限制防止死循环
    curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // 显示返回的Header区域内容
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec ( $curl ); // 执行操作
    if (curl_errno ( $curl )) {
        echo 'Errno' . curl_error ( $curl );
    }
    curl_close ( $curl ); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}
 
function vpost($url, $data) { // 模拟提交数据函数
    $curl = curl_init (); // 启动一个CURL会话
    curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
    curl_setopt ( $curl,CURLOPT_HTTPHEADER,$this_header); // 设置页头
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // 对认证证书来源的检查
    curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 1 ); // 从证书中检查SSL加密算法是否存在
    curl_setopt ( $curl, CURLOPT_USERAGENT, $GLOBALS ['user_agent'] ); // 模拟用户使用的浏览器
    @curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
    curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
    curl_setopt ( $curl, CURLOPT_POST, 1 ); // 发送一个常规的Post请求
    curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data ); // Post提交的数据包
  //curl_setopt ( $curl, CURLOPT_COOKIEFILE, $GLOBALS ['cookie_file'] ); // 读取上面所储存的Cookie信息
    curl_setopt ( $curl, CURLOPT_TIMEOUT, 120 ); // 设置超时限制防止死循环
    curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // 显示返回的Header区域内容
    curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec ( $curl ); // 执行操作
    if (curl_errno ( $curl )) {
        echo 'Errno' . curl_error ( $curl );
    }
    curl_close ( $curl ); // 关键CURL会话
    return $tmpInfo; // 返回数据
}