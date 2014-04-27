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
										'reply_type'=>array('text'=>'文本','news'=>'分类','document'=>'文章','music'=>'音乐','special','专属'),
										'segment'=>array('events'=>'事件','costom'=>'自定义','activity'=>'活动','activity_ticket'=>'优惠券')
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