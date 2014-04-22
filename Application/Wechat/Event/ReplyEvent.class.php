<?php
namespace Wechat\Event;

class ReplyEvent {
  private $rs = array();
  
  /**
   * 对传入数组根据所对应模型不同，派发不同处理流程
   * 
   * @param array $rs 关键词组最终获取到的条目数组
   */
  public function wechatReply($rs){
    $this->rs = $rs;
    switch ($this->rs['segment']){
      //模型为activity时处理流程
      case 'activity':
        return $reply=$this->reply();
        break;
      //默认处理流程,针对无特殊业务流程
      default :
        return $reply=$this->reply();
        break;
    }

  }
  
  /**
   * 回复内容
   * 对传入数组根据回复类型进行判断，并获取不同类型回复资源，整合后返回
   */
  private function reply(){
    $rs = $this->rs;
    switch ($rs['reply_type']){
      //text为文本类型的回复，reply_id为文本资源库中的id，只能有一个
      case 'text' :
        $content = M('Tchat_text')->where('`id` = "'.$rs['reply_id'].'"')->getField('content');
        $reply = get_text_arr($content);
        break;
      //news类型的回复为图文回复，为了整合方便，这里news类型的回复只与项目新闻分类绑定，reply_id值只能有一个
      //TODO 对分类进行多层子分类查询，并对含多个子目录的分类从子分类中平均提取新闻条目
      case 'news' :
        $catIdarr = M('Category')->where(array('id'=>$rs['reply_id'],'pid'=>$rs['reply_id'],'_logic'=>'OR'))->getField('id',true);
        $news = M('Document')->where(array('category_id'=>array('in',$catIdarr)))->order('id')->getField('id,title,description,cover_id,link_id',8);
        $reply = !empty($news)?get_news_arr($news):get_text_arr("哎呀，仓库里空空如也，啥也没找到！>_<|||\n你有哆啦A梦的口袋么？");
        unset($catIdarr,$news);
        break;
      //document类型回复其实也是图文类型的方式，它是一篇或多篇图文的集合，reply_id的值可以多个,以英文半角逗号分隔。
      case 'document' :
        $news= M('Document')->field('id,title,description,cover_id,link_id')->order('id')->select($rs['reply_id']);
        $reply = get_news_arr($news);
        unset($news);
        break;
      //TODO 其他类型暂时统一回复一份文本，后期加上image、voice、video、music类型，这四种类型需先上传文件到服务器获得media_id
      default:
        $reply = array('this is default checkReplyType reply','text','0');
        break;
    }
    return $reply;
    unset($reply,$rs);
  }
}