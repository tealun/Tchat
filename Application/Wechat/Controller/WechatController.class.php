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

class WechatController extends Controller {
  /*
   * 定义所需变量 
   * $token 公众帐号接口TOKEN设置
   * $data 与微信后台进行交换数据的数组
   */
  public $token = 'Tchat';
  private $data = array();

  /*
   * 消息回应方法
   */
  //微信后台RUL设置CONTROLLER方法，检测是否是验证，非验证则进行消息回应
  public function index(){
    if(IS_GET){
     //TODO 如果是接入认证的话，就读取系统配置的TOKEN，然后转入认证流程

      $this->valid();
    }else {
      //如果不是接入验证，则进入正常的客户消息响应流程
      $this->responseMsg();
    }
  }

/**
 * 本方法用于测试本版块内的功能所用
 */
public function test(){

	
}

  /**
   * 响应用户消息
   * 
   */
  private function responseMsg(){
    /*获取微信消息资源*/
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    if (!empty($postStr)){

      $data = $this->request($postStr);
      
      /* 获取回复信息 */
      // 用list方法将reply方法返回的数组变量(内容,回复类型,星标)进行赋值
      list($content, $type, $flag) = $this->reply($data);
      /* 响应当前客户消息 */
      $this->response($content, $type, $flag);

    }else {
      echo "";
      exit;
    }

  }

  /**
   * 获取微信推送的数据
   * @return array 转换为数组后的数据
   * 
   */
  private function request($postStr){
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      /* 获取客户消息 */
      foreach ($postObj as $key => $value) {
            $this->data[$key] = strval($value);
      }
           return $this->data;
    }
  
  /**
   * 根据用户发送内容生成的数组判断其消息类型并分别获取不同回复数据
   * 
   * @param array $data 经解析后的用户数据
   * @return array 最终生成的回复内容数组
   */
  private function reply($data){
    $openId= $data['FromUserName'];
    if('text' == $data['MsgType']){ //客户文本消息类型回复
      $TextRe = A('Text','Event');
      $keyword = $data['Content'];
      $reply = $TextRe->textHandle($openId,$keyword);
    } elseif('event' == $data['MsgType']){ //客户事件消息类型回复
      $EventRe = A('Event','Event');
      $event = $data['Event'];
      $eventKey = $data['EventKey'];
      $ticket = $data['Ticket'];
      $reply = $EventRe -> eventHandle($openId,$event,$eventKey,$ticket);
    } elseif('image' == $data['MsgType']){ //客户图片消息类型回复
      $ImageRe = A('Image','Event');
      $mediaId = $data['MediaId'];
      $reply = $ImageRe->imageHandle($openId,$mediaId);
    }else {
      exit;
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
    
    /* 添加类型数据 */
    $this->$type($content);
      
    /* 添加状态 */
    $this->data['FuncFlag'] = $flag;

    /*添加回复类型模板 */
    $tpl= get_wechat_tpl($type);
    $data=$this->data;
    //转换数据为XML 
    $this->data2xml($type,$tpl, $data);
    exit();
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
   * @param  string $news 要回复的图文内容
   * TODO 对于多于10条记录的，进行缓存分页，并设定查看下一页的回复关键字，可参考青龙老贼的教程
   */
  private function news($news){
    $i=0;
    foreach ($news as $var) {
        $articles[$i]['Title'] = $var['title'];
        $articles[$i]['Description']= $var['description'];
          if($i==0){
            $defaultPicUrl = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Public/Home/images/intro/'.rand(1,9).'.jpg';
            $articles[$i]['PicUrl'] = $var['cover_id'] == 0?$defaultPicUrl
            :'http://'.$_SERVER['HTTP_HOST'].__ROOT__.M('Picture')->where(array('id'=>$var['cover_id']))->getField('path');
          }else{
            $articles[$i]['PicUrl'] = $var['cover_id'] == 0?''
            :'http://'.$_SERVER['HTTP_HOST'].__ROOT__.M('Picture')->where(array('id'=>$var['cover_id']))->getField('path');
          }
        $articles[$i]['Url'] = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/Home/Article/detail/id/'.$var['id'].'.html';
        $i++;
        if($i >= 9) { break; } //最多只允许10条新闻
        }
    $this->data['ArticleCount'] = $i;
    $this->data['Articles'] = $articles;
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
    
    }
    echo $resultStr;
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