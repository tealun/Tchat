<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------
namespace Wechat\Logic;

/**
 * 缓存回复类
 * 针对有缓存回复需求的板块进行缓存的进一步处理
 * 比如活动的报名、建议的回复
 * @author Administrator
 *
 */
class CacheLogic{

	/**
   * 检查openId的缓存，并根据缓存中指定的模块控制器及方法传入缓存中存储的参数
   * @param string $openId
   * @param string $keyword
   * @author Tealun Du
   */
  public function cacheReply($openId,$keyword){
  	$data =  S($openId);
	$action = str2arr($data['action']['c']);
    $methed = $data['action']['a'];

    if(!empty($data['p'])){
	   	 $data['p']['keyword']=$keyword;
	     $action = A($action[0],$action[1]);
	     $reply = call_user_func_array(array($action,$methed), $data['p']);
    }else{
	    $reply = A($action[0],$action[1])->$methed($keyword);
	    }
    return $reply;
  }
  
}