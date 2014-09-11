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
	$keywords = $data['needs']['keyword'];
	
	/* 判断是否是数组，是就不变动，不是就将字符串转换为数组 */
	$keywords = is_array($keywords)?$keywords:str2arr($keywords);
				
   	 if(in_array($keyword,$keywords)){//判断客户发送的关键词是否与缓存继续处理指令相同
   	 
		$action = str2arr($data['action']['controller']); //读取缓存中需要的处理控制器和类名
	    $methed = $data['action']['methed'];//读取缓存中需要的处理方法名
	    
	    if(!empty($data['needs']['params'])){//判断有无需要传入的参数
		   	 $action = A($action[0],$action[1]);
			 //如果在缓存中指定了传入变量，则通过指定控制器方法传入指定变量获取回复
		     $reply = call_user_func_array(array($action,$methed), array($openId,$keyword,$data['needs']['params']));
	    }else{
	    	//如果缓存中没有指定传入变量，则将客户发送的关键字传入到指定控制器的方法
		    $reply = A($action[0],$action[1])->$methed($openId,$keyword);
		    }
		
		return $reply;
	  }else{
		return FALSE;
		 }
  }
  
  /**
   * 回复缓存的关键词组列表
   * @param string $openId 客户openId
   * @param int $id 客户发送的关键词组ID 
   */
  public function listCache($openId,$keyword){
  	$data = S($openId);//获取客户缓存
	/* 查询对应的回复信息 */
    $map['id']  = $data['listCache'][$keyword];
	$rs = M('Tchat_keyword_group')->where($map)->find();
	/* 回复内容 */
    $reply = A('Reply','Event')->wechatReply($rs);

	return $reply;
  }
  
  
  /**
   * 回复缓存的图文数据
   * @param array $news 缓存的图文信息数据
   */
  public function newsCache($openId,$keyword=''){
	$cache = S($openId);
	$news = $cache['news'];
  	return $reply = get_news_arr($news);
  }
  
}