<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace Wechat\Controller;
use Think\Controller;

/**
 * 微信接口处理类
 */
class WechatController extends Controller {
  /*
   * 定义所需变量 
   * $token 公众帐号接口TOKEN设置
   * $data 与微信后台进行交换数据的数组
   */
  private $token = '';
  private $data = array();

  /*
   * 消息回应方法
   */
  //微信后台RUL设置CONTROLLER方法，检测是否是验证，非验证则进行消息回应
  public function index(){

    if(IS_GET){//接入验证
      $this -> token = get_ot_config('WECHAT_TOKEN');
      $this->valid(); 
    }else {
      //如果不是接入验证，则进入客户消息响应流程
      $this->responseMsg();
    }
  }

  /**
   * 响应用户消息
   * 
   */
  private function responseMsg(){
    /*获取微信消息资源*/
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    if (!empty($postStr)){
	  /* 整理客户消息数据 */
      $data = $this->request($postStr);
      
      /* 获取回复给客户的格式化信息 */
      // 用list方法将reply方法返回的数组变量(内容,回复类型,星标)进行赋值
      list($content, $type, $flag) = $this->getReply($data);
	  
      /* 响应给当前客户 */
      $this->response($content, $type, $flag);

    }else {
      echo "";
      exit;
    }

  }

  /**
   * 获取微信推送的数据
   * @param object 微信推送过来的对象
   * @return array 转换为数组后的数据
   */
  private function request($postStr){
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      /* 将客户消息转换为数据数组 */
      foreach ($postObj as $key => $value) {
            $this->data[$key] = strval($value);
      }
           return $this->data;
    }

  /**
   * 判断客户消息类型方法
   * 根据用户发送内容生成的数组判断其消息类型并分别获取不同回复数据
   * @param array $data 经解析后的用户数据
   * @return array 最终生成的回复内容数组
   */
  private function getReply($data){
    $openId= $data['FromUserName'];
	
    if('text' == $data['MsgType']){ //客户文本消息类型的处理流程
      $TextRe = A('Text','Event');
      $keyword = $data['Content'];
      $reply = $TextRe->textHandle($openId,$keyword);
	  
    } elseif('event' == $data['MsgType']){ //客户事件消息类型处理流程
      $EventRe = A('Event','Event');
      $event = $data['Event'];
      $eventKey = $data['EventKey'];
      $ticket = $data['Ticket'];
      $reply = $EventRe -> eventHandle($openId,$event,$eventKey,$ticket);
	  
    } elseif('image' == $data['MsgType']){ //客户图片消息类型处理流程
      $ImageRe = A('Image','Event');
      $mediaId = $data['MediaId'];
      $reply = $ImageRe->imageHandle($openId,$mediaId);
	  
    }else {
      $reply = get_text_arr('您的消息已成功发送过来，我们暂时还未能识别您的消息类型，我们后期会对此进行处理，感谢您的支持。');
    }
	
    return $reply;
  }

  

  /**
   * 接收回复信息内容数组并整理后回复给用户

   * @param  array  $content 回复信息的内容，文本、音乐信息为字符串、图文信息为数组
   * @param  string $type    消息类型，text news music
   * @param  string $flag    是否星标用户发送的信息
   * @author 麦当苗儿 <zuojiazi@vip.qq.com>（有改动）
   * @return string          XML字符串
   */
  private function response($content, $type = 'text', $flag = 0){
    /* 基础数据 */
    $this->data = array(
      'ToUserName'   => $this->data['FromUserName'],
      'FromUserName' => $this->data['ToUserName'],
      'CreateTime'   => NOW_TIME,
      'MsgType'      => $type
    );
    
    /* 根据回复信息类型添加相应数据到回复数据中 */
    $this->$type($content);
      
    /* 添加星标状态 */
    $this->data['FuncFlag'] = $flag;

    /*设置回复信息类型的模板 */
    $tpl= get_wechat_tpl($type);
    $data=$this->data;
    //转换数据为XML 
    $this->data2xml($type,$tpl, $data);
  }

  
  /**
   * 回复的字符串信息写入变量data
   * @author 麦当苗儿 <zuojiazi@vip.qq.com>
   * @param  string $content 要回复的信息
   */
  private function text($content){

    $this->data['ContentStr'] = $content;
    }

  /**
   * 回复的音乐信息写入变量data
   * @param  string $content 要回复的音乐
   */
  private function music($music){
    
    list(
      $music['Title'], 
      $music['Description'], 
      $music['MusicUrl'], 
      $music['HQMusicUrl']
    ) = $music;
    $this->data['Music'] = $music;
  }

  /**
   * 回复的图文信息写入变量data
   * 对于多于10条记录的，进行缓存分页，并设定查看下一页的回复关键字
   * @param  string $news 要回复的图文内容
   */
  private function news($news){
  	$openid = $this->data['ToUserName'];
  	S($openid,NULL);
	/* 定义不同模型模块 */
	$activityModelArr = array(6,7,8);
    $i=0;
    foreach ($news as $key => $var) {
        $articles[$i]['Title'] = $var['title'];
          if($i==0){//如果是第一条，在没有指定封面的情况下使用默认图片，并加上描述
          
          	$articles[$i]['Description']= $var['description'];//描述会在单图文时显示，多条时不会显示所以只在第一条中设置。
          	
            $defaultPicUrl = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Public/Home/images/intro/'.rand(1,9).'.jpg';
            $articles[$i]['PicUrl'] = $var['cover_id'] == 0?$defaultPicUrl
            :'http://'.$_SERVER['HTTP_HOST'].__ROOT__.M('Picture')->where(array('id'=>$var['cover_id']))->getField('path');
          
		  }else{//其他条目如果没有指定封面，则设置为空
            $articles[$i]['PicUrl'] = $var['index_pic'] == 0?''
            :'http://'.$_SERVER['HTTP_HOST'].__ROOT__.M('Picture')->where(array('id'=>$var['index_pic']))->getField('path');
          }
		
		/* 根据文档所属模型ID不同生成不同的链接路径所用模块 */
		if(in_array($var['model_id'], $activityModelArr)){
			$modelName = 'Activity';
		}elseif($var['model_id'] == 51){
			$modelName = 'Album';
		}else{
			$modelName = 'Article';
		}
		
        $articles[$i]['Url'] = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/index.php?s=/Home/'.$modelName.'/detail/id/'.$var['id'].'.html';
        $i++;
		unset($news[$key]);
		
        if($i >= 8) { //最多只允许10条新闻，此处保险起见，打8条，9条明杠了，用来做提示
        	$count = count($news);
        	$articles[$i]['Title']='还有'.$count.'条没有展示，请回复"mm"获取查看，5分钟内有效';

			      //缓存过滤掉已回复后的数组内容,缓存标识为客户openId
                  S($openid,array(
                      'action'=>array(
	                        'controller'=>"Cache,Logic", //需要后续处理的控制器及命名空间
	                        'methed'=>'newsCache', //需要后续处理的公共方法
	                        ),
                      'needs'=>array(
	                      	'keyword'=>'mm,mM,MM,Mm',
	                      	'params' =>''//需要传递到上述公共方法的变量及赋值
						  ),
					  'news'=>$news
                  ),
                  300); 
			$i++;//标识要比条数多加1
			break;
		 } else{
        	S($openid,NULL);
         }

        }
    $this->data['ArticleCount'] = $i;
    $this->data['Articles'] = $articles;
	unset($i);
  }

private function service(){
	$this->data['MsgType'] = "transfer_customer_service";
}

  /**
     * 数据XML编码
     * @param  object $tpl  采用的XML模板
     * @param  mixed  $data 数据
     * @return string
     */
  private function data2xml ($type,$tpl,$data){
    switch ($type){
      case 'text':
        $resultStr = sprintf($tpl, $data['ToUserName'], $data['FromUserName'], $data['CreateTime'], $data['MsgType'], $data['ContentStr'],$data['FuncFlag']);
        break;
      case 'news':

        foreach ($data['Articles'] as $item){
        $articlesStr .= "<item>
               <Title><![CDATA[".$item['Title']."]]></Title> 
               <Description><![CDATA[".$item['Description']."]]></Description>
               <PicUrl><![CDATA[".$item['PicUrl']."]]></PicUrl>
               <Url><![CDATA[".$item['Url']."]]></Url>
               </item>";  
        }
        $resultStr = sprintf($tpl, $data['ToUserName'], $data['FromUserName'], $data['CreateTime'], $data['MsgType'],$data['ArticleCount'],$articlesStr,$data['FuncFlag']);
        break;
		
      case 'music':
        $resultStr = sprintf();
        break;
		
	case 'service':
		/* 查看是否为指定客服 */
		if($name = S($data['ToUserName'].'service')){
			$tpl = get_wechat_tpl('setService'); //获取带指定客服账号的模板
			$servicer=$name.'@'.get_ot_config('WECHAT_NAME'); //赋值客户账号
			S($data['ToUserName'].'service',NULL); //清除客户联系客服时的缓存
			$resultStr = sprintf($tpl, $data['ToUserName'], $data['FromUserName'], $data['CreateTime'], $data['MsgType'],$servicer);
		}else{ // 没有指定客服的情况下自动转接到有空的客服
			$resultStr = sprintf($tpl, $data['ToUserName'], $data['FromUserName'], $data['CreateTime'], $data['MsgType']);
		}

        break;
    }
    echo $resultStr; //最终的回复结果不能用return，只能用echo ，否则没响应。
  }


  /**
   * 验证方法
   * 
   */
  private function valid()
  {
    $echoStr = $_GET["echostr"];

    //valid signature , option
    if($this->checkSignature()){
      echo $echoStr;
      exit;
    }
  }

  /**
   * 验证签名方法
   */
  private function checkSignature()
  {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];  
            
    $token = $this->token;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }

}