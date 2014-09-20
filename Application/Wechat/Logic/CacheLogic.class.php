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
	 * 存储所需的数据格式：
	 * array(
	*		'action' => array(
	 * 			'controller' => "Cache,Logic", //需要后续处理的控制器及命名空间
	* 				 'methed' => 'listCache', //需要调用的公共方法
	* 			 ), 
	 * 	'needs' => array(
	 * 			'keyword' => array(
	 * 										'keyword' => array_keys($listCache), //判断客户发送的文本是否为继续处理本缓存的指令 string or array
	 * 																										//array有两种方式，一种为array()函数数组，或以“,”分割关键字的字符串
	*  			'params' => '' //需要传递到上述公共方法的变量及赋值 string or array 依上述处理方法所需为准
	*			),
	* 		 'listCache' => $listCache，//缓存现有匹配到的数据,键名和键值自己定，可以在上述公共方法中读取该键名内的数据
	 *		  '...' => ... //可自增加键名键值，根据处理方法自行定制
	*	)
	 * 
   * @param string $openId
   * @param string $keyword
   * @author Tealun Du
   */
  public function cacheReply($openId,$keyword){
  	$data =  S($openId);
	$keywords = $data['needs']['keyword'];
	
	/* 判断是否是数组，是就不变动，不是就将字符串转换为数组 */
	$keywords = is_array($keywords)?$keywords:str2arr($keywords);
	$action = str2arr($data['action']['controller']); //读取缓存中需要的处理控制器和类名
	$methed = $data['action']['methed'];//读取缓存中需要的处理方法名
	
   	 if(in_array($keyword,$keywords) || $methed == 'startPreg' ){//判断客户发送的关键词是否与缓存继续处理指令相同或者是否属于客户信息验证

   	 	    if(!empty($data['needs']['params'])){//判断有无需要传入的参数
		   	 $action = A($action[0],$action[1]);
			 //如果在缓存中指定了传入变量，则通过指定控制器方法传入指定变量获取回复
		     $reply = call_user_func_array(array($action,$methed), array($openId,$keyword,$data['needs']['params']));
	    }else{
	    	//如果缓存中没有指定传入变量，则将默认客户发送的关键字传入到指定控制器的方法
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
  
  /**
   * 转接客服
   * 客户确认后转接到客服
   */
  public function serviceCache($openId,$keyword=''){
  		S($openId,NULL);
  		return $reply = get_service_arr($news);
  }
  
}