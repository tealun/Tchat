<?php
namespace Wechat\Event;

class ReplyEvent {
  private $rs = array();
  
  /**
   * 回复客户
   * 对传入数组根据所对应模型不同，派发不同处理流程
   * @param array $rs 关键词组最终获取到的条目数组
   */
  public function wechatReply($rs){
    $this->rs = $rs;

    switch ($this->rs['segment']){
    	
      //模块为活动时的处理流程，内容获取模型为Tchat_activity
      case 'Activity':
		  $segmentModel = 'Tchat_activity';
        return $this->reply($segmentModel);
        break;

      //默认处理流程,内容获取模型默认为Document
      default :
        return $this->reply();
       break;
    }

  }
  
  /**
   * 回复内容
   * 对传入数组根据回复类型进行判断，并从不同的内容模型中获取回复资源，整合后返回
   */
  private function reply($segmentModel="Document"){
    $rs = $this->rs;
    switch ($rs['reply_type']){
    
      //text为文本类型的回复，reply_id为文本资源库中的id，只能有一个
      case 'text' :
        $content = M('Tchat_text')->where('`id` = "'.$rs['reply_id'].'"')->getField('content');
        $reply = get_text_arr($content);
        break;
      //news类型的回复为图文回复，segment设置的如果是文档分类，reply_id则对应分类ID，如果是活动，reply_id则对应模型ID
      //TODO 对分类进行多层子分类查询，并对含多个子目录的分类从子分类中平均提取新闻条目
      case 'news' :

		$news = $this -> getNews($segmentModel);
		$content = M('Tchat_text')->where('`id` = "5"')->getField('content');//分类下无文章时回复的文本信息内容
        $reply = !empty($news)?get_news_arr($news):get_text_arr($content);
        unset($news);
        break;
      //document类型回复其实也是图文类型的方式，它是一篇或多篇图文的集合，reply_id的值可以多个,以英文半角逗号分隔。
      case 'document' :
		$map = array('status'=>array('eq',1));
		$field = 'id,title,description,cover_id,index_pic,link_id,level,model_id';
		$order = array('level'=>'desc','id'=>'desc');
        $news= M($segmentModel)->where($map)->field($field)->order($order)->select($rs['reply_id']);
        $reply = get_news_arr($news);
        unset($map,$field,$order,$news);
        break;
      //TODO 其他类型暂时统一回复一份文本，后期加上image、voice、video、music类型，这四种类型需先上传文件到服务器获得media_id
      default:
        $reply = array('this is default checkReplyType reply','text','0');
        break;
    }
    return $reply;
    unset($reply,$rs);
  }
	
	/**
	 * 获取指定图文类型回复文章
	 */
	private	function getNews($segmentModel){
		if($segmentModel == "Tchat_activity"){//活动板块根据所属模型不同查找
			$map['model_id']= $this->rs['reply_id'];
		}else{  //其他板块则根据分类不同查找
			$catIdarr = M('Category')->where(array('id'=>$this->rs['reply_id'],'pid'=>$this->rs['reply_id'],'_logic'=>'OR'))->getField('id',true);
			$map['category_id'] = array('in',$catIdarr);//在指定目录及其子目录下的文档
		}
		$map['status']= array('eq',1); //状态为启用
		$map['deadline']=array(	'NOT BETWEEN ',array(1,time())); //截止日期为0或大于现在时间的

		$order =array('level'=>'desc','create_time'=>'desc');
		
		/*根据条件取出相应记录，限制80条，即10页内容*/
	    return M($segmentModel)->where($map)->order($order)->getField('id,title,description,cover_id,index_pic,link_id,level,model_id',80);
	}
}