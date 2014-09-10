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

   	 if(in_array($keyword, $data['needs']['keyword'])){//判断客户发送的关键词是否与缓存继续处理指令相同
	   	 		var_dump($data);
	   	 	//return FALSE;
	   	 }else{
			$action = str2arr($data['action']['controller']); //读取缓存中需要的处理控制器和类名
		    $methed = $data['action']['methed'];//读取缓存中需要的处理方法名
		    if(!empty($data['needs']['params'])){//判断有无需要传入的参数
			   	 $action = A($action[0],$action[1]);
				 //如果在缓存中指定了传入变量，则通过指定控制器方法传入指定变量获取回复
			     $reply = call_user_func_array(array($action,$methed), array($data['needs']['params'],$keyword));
		    }else{
		    	//如果缓存中没有指定传入变量，则将客户发送的关键字传入到指定控制器的方法
			    $reply = A($action[0],$action[1])->$methed($keyword);
			    }
		 }
    return $reply;
  }
  
  /**
   * 回复缓存的图文数据
   * @param array $news 缓存的图文信息数据
   */
  public function newsCache($news){
  		var_dump($news);
  	return get_news_arr($news);
  }
  
}