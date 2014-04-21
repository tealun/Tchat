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
  
  
  public function cacheReply($openId,$keyword){
    $data =  S($openId);
    if($data['activity']){
      switch ($data['activity']){
      //红包活动所需客户信息收集判断，含客户姓名及客户联系电话
      case 'hongbao':
        $reply = $this->judgeNamePhone($data,$openId, $keyword, 'activity', '抢红包');
        break;
      case 'suggest':
        $reply = $this->judgeNamePhone($data,$openId, $keyword, 'costom', '建议');
        break;
      }
    }
    
    return $reply;
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
        return $reply = get_text_arr($content);
        break;
      //news类型的回复为图文回复，为了整合方便，这里news类型的回复只与项目新闻分类绑定，reply_id值只能有一个
      //TODO 对分类进行多层子分类查询，并对含多个子目录的分类从子分类中平均提取新闻条目
      case 'news' :
          $catIdarr = M('Category')->where(array('id'=>$rs['reply_id'],'pid'=>$rs['reply_id'],'_logic'=>'OR'))->getField('id',true);
          $news = M('Document')->where(array('category_id'=>array('in',$catIdarr)))->order('id')->getField('id,title,description,cover_id,link_id',8);
        return $reply = !empty($news)?get_news_arr($news):get_text_arr("哎呀，仓库里空空如也，啥也没找到！>_<|||\n你有哆啦A梦的口袋么？");
        break;
      //document类型回复其实也是图文类型的方式，它是一篇或多篇图文的集合，reply_id的值可以多个,以英文半角逗号分隔。
      case 'document' :
        $news= M('Document')->field('id,title,description,cover_id,link_id')->order('id')->select($rs['reply_id']);
        return $reply = get_news_arr($news);
        break;
      //TODO 其他类型暂时统一回复一份文本，后期加上image、voice、video、music类型，这四种类型需先上传文件到服务器获得media_id
      default:
        $reply = array('this is default checkReplyType reply','text','0');
        return $reply;
        break;
    }
  }
  
  private function judgeNamePhone($data,$openId,$keyword,$segment,$keyWordGropName,$second='120'){
          if(preg_match('/^(qx)$/',$keyword)){
            S($openId,NULL);
            return $reply = get_text_arr('您已取消参与，谢谢您的合作。');
            exit;
          }
    
          if(preg_match('/^([^ \+\f\n\r\t\v0-9]+)$/',$keyword)){
          $data['name']= $keyword;
          S($openId,$data,$second);
          if(empty($data['phone'])){
            $reply = get_text_arr("请回复您的联系电话\n取消请回复'qx'");
          };
        }elseif (preg_match('/^\d+$/',$keyword)){
          if(preg_match('/^(1[34578]\d{9})$|^((0\d{2,3})?-?(\d{7,8}))$/', $keyword)){
            $data['phone']= $keyword;
            S($openId,$data,$second);
            if(empty($data['name'])){
              $reply = get_text_arr("请回复您的姓名\n取消请回复'qx'");
            }
          }else{
            $reply = get_text_arr('电话号码有误，请确认后重新回复');
          }

        //TODO 此处匹配可参考有无两个匹配顺序上不做要求，也就是客户先写名字或号码都能匹配到
        }elseif (preg_match('/([^ \+\f\n\r\t\v0-9]+)[ \+\-]?((1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$)/', $keyword,$matches)){
          $data['name']= $matches[1];
          $data['phone'] = $matches[2];
        }else{
          $reply = get_text_arr('内容有误，请确认后重新回复，可能您输入的不是有效的电话号码。');
        }

        if($data['name'] && $data['phone']){
          //获取客户数据完整后更新客户资料
          $data['id']=M('Tchat_client')->where(array('openid'=>$openId))->getField('id');
          $data['openid']=$openId;
          D('Tchat_client')->update($data);
            $map['segment'] = $segment;
            $map['name'] = $keyWordGropName;
            $rs = M('Tchat_keyword_group')->where($map)->find();
          $reply = $this->wechatReply($rs);
          S($openId,NULL);
        }
        return $reply;
  }
  
}