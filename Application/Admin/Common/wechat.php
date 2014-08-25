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
 * 查询本地数据库中客户详情
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
  $appId = C('WECHAT_APP_ID');
  $appSecret = C('WECHAT_APP_SECRET');
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
  $appId = C('WECHAT_APP_ID');
  $appSecret = C('WECHAT_APP_SECRET');
  $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appId.'&secret='.$appSecret;

  $str = file_get_contents($url);
  $arr = json_decode($str, true);
  S('accessToken',$arr['access_token'],120);
  return $accessToken = S('accessToken');
}

function check_wechat_rz(){
  $value = C('WECHAT_ACCOUNT_RZ');
	  if($value === '2'){
	  	return $value;
	  }else{
	  	return $value === '1'?TRUE:FALSE;
  }
}

function check_wechat_type(){
  $value = C('WECHAT_ACCOUNT_TYPE');
  return $value === '1'?TRUE:FALSE;
}
	
	/**
 * 获取关键字模型信息
 * @param  integer $id    模型ID
 * @param  string  $field 模型字段
 * @return array
 */
function get_keyword_model($id = null, $field = null){
    static $list;

    /* 非法分类ID */
    if(!(is_numeric($id) || is_null($id))){
        return '';
    }

    /* 读取缓存数据 */
    if(empty($list)){
        $list = S('KEYWORD_MODEL_LIST');
    }

    /* 获取模型名称 */
    if(empty($list)){
        $map   = array('status' => 1, 'extend' => 4);
        $model = M('Tchat_keyword_group')->where($map)->field(true)->select();
        foreach ($model as $value) {
            $list[$value['id']] = $value;
        }
        S('KEYWORD_MODEL_LIST', $list); //更新缓存
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