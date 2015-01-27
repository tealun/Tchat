<?php
	/**
	 * select返回的数组进行整数映射转换
	 *
	 * @param array $map  映射关系二维数组  array(
	 *                                          '字段名1'=>array(映射关系数组),
	 *                                          '字段名2'=>array(映射关系数组),
	 *                                           ......
	 *                                       )
	 * @author 朱亚杰 <zhuyajie@topthink.net>
	 * @return array
	 *
	 *  array(
	 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
	 *      ....
	 *  )
	 *
	 */
function col_to_string(&$data,$map=array(
										'status'=>array(1=>'正常',-1=>'已删',0=>'禁用'),
										'reply_type'=>array('text'=>'文本','news'=>'分类','document'=>'文章','music'=>'音乐','special'=>'专属'),
										'segment'=>array('0'=>'自定义','6'=>'活动','7'=>'折扣','8'=>'优惠券')
										)) {
	    if($data === false || $data === null ){
	        return $data;
	    }
	    $data = (array)$data;
	    foreach ($data as $key => $row){
	        foreach ($map as $col=>$pair){
	            if(isset($row[$col]) && isset($pair[$row[$col]])){
	                $data[$key][$col.'_text'] = $pair[$row[$col]];
	            }
	        }
	    }
	    return $data;
	}
	
	/**
	 * 去除数组中空值键位函数
	 */
	function arr_no_empty($arr) {
	    if (is_array($arr)) {
	        foreach ( $arr as $k => $v ) {
	            if (empty($v)) unset($arr[$k]);
	            elseif (is_array($v)) {
	                $arr[$k] = arr_no_empty($v);
	            }
	        }
	    }
	    return $arr;
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
  $appId = C('WECHAT_APP_ID');
  $appSecret = C('WECHAT_APP_SECRET');
  $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appId.'&secret='.$appSecret;

  $str = file_get_contents($url);
  $arr = json_decode($str, true);

  return S('accessToken')?S('accessToken'):save_access_token();
}

/**
 * 缓存公众帐号accessToken
 *
 */
function save_access_token(){
  $appId = C('WECHAT_APP_ID');
  $appSecret = C('WECHAT_APP_SECRET');
  $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appId.'&secret='.$appSecret;

  $str = file_get_contents($url);
  $arr = json_decode($str, true);
  /* 存储获取到的access_token，有限期为获取到的有限期，正常情况下为 7200 */
  S('accessToken',$arr['access_token'],$arr['expires_in']);
  return S('accessToken');
}

/**
 * 查看是否获得认证
 * 
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
 * 
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
 * 获取活动模型信息
 * @param  integer $id    模型ID
 * @param  string  $field 模型字段
 * @return array
 * 
 */
function get_activity_model($id = null, $field = null){
    static $list;

    /* 非法模型ID */
    if(!(is_numeric($id) || is_null($id))){
        return '';
    }

    /* 读取缓存数据 */
    if(empty($list)){
        $list = S('ACTIVITY_MODEL_LIST');
    }

    /* 获取模型名称 */
    if(empty($list)){
        $map   = array('status' => 1, 'extend' => 6);
        $model = M('Model')->where($map)->field(true)->select();
        foreach ($model as $value) {
            $list[$value['id']] = $value;
        }
        S('ACTIVITY_MODEL_LIST', $list); //更新缓存
    }

    /* 根据条件返回数据 */
    if(is_null($id)){
        return $list;
    } elseif(is_null($field)){
        return $list[$id];
    } else {
        return $list[$id][$field];
    }
}

/**
 * 获取指定关键词分组的关键词列表
 * 
 * @param $groupId
 */
function get_keyword($groupId){
    	$arr = M('Tchat_keyword')->where(array('group_id'=>$groupId))->getField('id,keyword');
    	return $keywords = arr2str($arr);
}

/**
 * 获取指定ID的文本内容
 */
function get_tchat_text($id){
		$text = M('Tchat_text')->where(array('id'=>$id))->getField('content');
		return $text;
}
/**
 * 获取二维码扫描关注人数
 */
function get_scan_sub_count($id){
	$sum = M('Tchat_client')->where('`event_key` = "qrscene_'.$id.'"')->count();
	return $sum;
}

/* Curl所需参数 */
//$cookie_file = dirname ( __FILE__ ) . "/cookie_" . md5 ( basename ( __FILE__ ) ) . ".txt"; // 设置Cookie文件保存路径及文件名
$user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; .NET CLR 1.1.4322)";//模拟客户浏览器
$this_header = array(
"content-type: application/x-www-form-urlencoded; 
charset=UTF-8"
);
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

/**
 * 用于解决系统因为json_encode()方法转换中文为UNICODE编码的问题
 * 将Unicode编码的汉字转换回去
 * 
 * @param $str string 传入的解码前JSON数据格式字符串
 * @author 贵贵的博客  http://blog.linuxphp.org/archives/1498/
 */
function decodeUnicode($str)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}

/**
 * 返回微信回复的错误信息
 * @param $errcode string 出错的代码编号
 */
function get_wechat_response($errcode){
	$statusArr = array(
	'40001' => '获取access_token时AppSecret错误，或者access_token无效',
	'40002' => '不合法的凭证类型',
	'40003' => '不合法的OpenID',
	'40004' => '不合法的媒体文件类型',
	'40005' => '不合法的文件类型',
	'40006' => '不合法的文件大小',
	'40007' => '不合法的媒体文件id',
	'40008' => '不合法的消息类型',
	'40009' => '不合法的图片文件大小',
	'40010' => '不合法的语音文件大小',
	'40011' => '不合法的视频文件大小',
	'40012' => '不合法的缩略图文件大小',
	'40013' => '不合法的APPID',
	'40014' => '不合法的access_token',
	'40015' => '不合法的菜单类型',
	'40016' => '不合法的按钮个数',
	'40017' => '不合法的按钮个数',
	'40018' => '不合法的按钮名字长度',
	'40019' => '不合法的按钮KEY长度',
	'40020' => '不合法的按钮URL长度',
	'40021' => '不合法的菜单版本号',
	'40022' => '不合法的子菜单级数',
	'40023' => '不合法的子菜单按钮个数',
	'40024' => '不合法的子菜单按钮类型',
	'40025' => '不合法的子菜单按钮名字长度',
	'40026' => '不合法的子菜单按钮KEY长度',
	'40027' => '不合法的子菜单按钮URL长度',
	'40028' => '不合法的自定义菜单使用用户',
	'40029' => '不合法的oauth_code',
	'40030' => '不合法的refresh_token',
	'40031' => '不合法的openid列表',
	'40032' => '不合法的openid列表长度',
	'40033' => '不合法的请求字符，不能包含\uxxxx格式的字符',
	'40035' => '不合法的参数',
	'40038' => '不合法的请求格式',
	'40039' => '不合法的URL长度',
	'40050' => '不合法的分组id',
	'40051' => '分组名字不合法',
	'41001' => '缺少access_token参数',
	'41002' => '缺少appid参数',
	'41003' => '缺少refresh_token参数',
	'41004' => '缺少secret参数',
	'41005' => '缺少多媒体文件数据',
	'41006' => '缺少media_id参数',
	'41007' => '缺少子菜单数据',
	'41008' => '缺少oauthcode',
	'41009' => '缺少openid',
	'42001' => 'access_token超时',
	'42002' => 'refresh_token超时',
	'42003' => 'oauth_code超时',
	'43001' => '需要GET请求',
	'43002' => '需要POST请求',
	'43003' => '需要HTTPS请求',
	'43004' => '需要接收者关注',
	'43005' => '需要好友关系',
	'44001' => '多媒体文件为空',
	'44002' => 'POST的数据包为空',
	'44003' => '图文消息内容为空',
	'44004' => '文本消息内容为空',
	'45001' => '多媒体文件大小超过限制',
	'45002' => '消息内容超过限制',
	'45003' => '标题字段超过限制',
	'45004' => '描述字段超过限制',
	'45005' => '链接字段超过限制',
	'45006' => '图片链接字段超过限制',
	'45007' => '语音播放时间超过限制',
	'45008' => '图文消息超过限制',
	'45009' => '接口调用超过限制',
	'45010' => '创建菜单个数超过限制',
	'45015' => '回复时间超过限制',
	'45016' => '系统分组，不允许修改',
	'45017' => '分组名字过长',
	'45018' => '分组数量超过上限',
	'46001' => '不存在媒体数据',
	'46002' => '不存在的菜单版本',
	'46003' => '不存在的菜单数据',
	'46004' => '不存在的用户',
	'47001' => '解析JSON/XML内容错误',
	'48001' => 'api功能未授权',
	'50001' => '用户未授权该api'
	);
	
	if($errcode == -1){
		return '系统繁忙';
	}else{
		return $statusArr[$errcode];
	}
}
