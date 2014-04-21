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
 * 板块逻辑类
 * @author Tealun Du
 *
 */
class SegmentLogic{
  //对验证方式进行位赋值 0为验证条件组合连接符验证 1为姓名验证 2为电话号码验证 4为QQ号码验证 5为邮箱验证
  private $pregs = array(
            0 => array(
              'preg'=>'[ \-\+]?',
              'name'=>'间隔符号'
              ),
            1 => array(
              'preg'=>'(?<name>[^ \+\f\n\r\t\v0-9]+)?',
              'name'=>'name'
              ),
            2 => array(
              'preg'=>'(?<phone>1[34578]\d{9}$|(0\d{2,3})?-?(\d{7,8})$)?',
              'name'=>'phone'
              ),
            4 => array(
              'preg'=>'(?<QQ>\d{5,11}$)?',
              'name'=>'QQ'
              ),
            8 =>  array(
              'preg'=>'(?<email>^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$)?',
              'name'=>'email'
              )
          );
  
    private $tip = array(
              'name' => '姓名',
              'phone' => '联系电话',
              'cellPhone'=>'手机号',
              'tel' => '固定电话',
              'QQ' => 'QQ号',
              'email' => '电子邮件'
            );
  
  /**
   * 查找当前安装板块,获取各板块需要验证的条目
   * TODO 待完善
   */
  private function segmentPreg(){
    //加载现有板块
    $segs = M('Tchat_segment')->field('name')->select();
    $i = 0;
      foreach ($segs as $seg){
        //查找各板块需要匹配前置关键词+验证匹配的条目
        $map = array(
          'startup'=>array('lt',time()),
          'deadline'=>array('gt',time()),
          'status'=>array('eq','1'),
          'check_info'=>array('gt','0')
        );
        $field = array('id','ex_keyword','check_info','cheked_reply');
        $rs = M('Tchat_'.$seg['name'])->where($map)->field($field)->select();
        //查找到符合条目则整合到需要匹配的项的二维数组中
        if(!is_null($rs)){
          foreach ($rs as $v){
            $patternArr[$i] = $v;
            $patternArr[$i]['segment'] = $seg['name'];
            $i++;
          }
          unset($rs);
        }
      }
    unset($i,$map,$field,$segs,$seg);
    return $patternArr?$patternArr:NULL;
  }
  
  
  /**
   * 对有需要验证提取客户信息的板块进行信息提取
   * TODO 未完善
   * @param $openId 微信openid
   * @param $keyword 客户发送的信息
   */
  public function findPreg($openId,$keyword){
  $pregs = $this->pregs;
    $patternArr = $this->segmentPreg();
    if(is_null($patternArr)){
      //没有需要的验证项，则回复FALSE
      return FALSE;
    }else{
      foreach ($patternArr as $pattern){
        //获取检测项
        $check = $this->checkInfo($pattern['check_info']);
        //建立需要检测项名称数组
        $pattern['needs'] = str2arr($check['need']);
        //建立针对该条项目的验证规则
        $pattern['rule']= "/^(?:".$pattern['ex_keyword'].")".$check['rule']."/";
        //进行验证
         if(preg_match($pattern['rule'], $keyword,$matches)){
          //清除缓存 
           S($openId,NULL);
            //遍历所需验证项目
           foreach ($pattern['needs'] as $v){
            if(empty($matches[$v])){
            $tips .= $tips?"、".$this->tip[$v]:$this->tip[$v];
            $needs[$v] = '';//没有提取到则设置为空
          }else{
            $needs[$v] = $matches[$v];
          }
          //如果存在未提取到的所需信息，则回复提示并缓存
          if ($tips){
                  $content = "您的".$tips."输入有误，请重新回复您的".$tips."\n（2分钟内有效）";
                  //缓存需要检测项目
                  S($openId,array('segment'=>$pattern['segment'],
                      'needs'=>$needs),120);
                  var_dump(S($openId));
          $reply = get_text_arr($content);
          }else{
            //匹配客户信息完整后存储客户资料
            $this->saveClientInfo($openId, $matches);
            //获取针对性的回复内容
            if(!empty($pattern['cheked_reply'])){
            	//TODO 如果是不需要客户设定但是又要回复客户不同于关键字触发的回复内容，比如优惠券活动，待解决。
            	$replyConfig = implode(':', $pattern['cheked_reply']);
            	var_dump($replyConfig);
            	$rs['segment']=$pattern['segment'];
            	$rs['reply_type']= $replyConfig['type'];
            	$rs['reply_id']= $replyConfig['ids'];
            	//根据设定的获取客户信息后的回复内容回复客户
            	$reply = A('Reply','Event')->wechatReply($rs);
            	unset($replyConfig,$rs);
            }else{
           		A($pattern['segment'],'Logic');
         		$reply = get_text_arr('信息已经完整');
            }

          }
           }
       
         }else{
         unset($pattern,$check);
         }
        
      }
      return $reply;
    }

    /*
    $patternArr = array( // 建立特定板块关键词匹配规则
      'hongbao'=>"/^(?:抢红包)[ \-\+]?([^ \+\f\n\r\t\v0-9]+)?[ \-\+]?((1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$)?/",
      'suggest'=>"/^(?:建议|提建议)[ \-\+\:]?(.*)/"
    );
    //对客户发送的消息进行关键词匹配
    foreach ($patternArr as $key => $pattern){
      if(preg_match($pattern, $keyword,$matches)){
        switch ($key){
          //匹配到红包活动
          case 'hongbao':
            //先查看活动是否已经截止或者禁用及删除
            $map['segment'] = 'activity';
            $map['name'] = '抢红包';
            $map['status'] = array('eq','1');
            $map['deadline'] = array('NOT BETWEEN',array('1',time()));
            $id = M('Tchat_keyword_group')->where($map)->getField('id');
            
            //没有结果时，回复结束时的回复内容
            if(!$id){
              $where['segment'] = 'activity';
              $where['name'] = '抢红包';
              $rs = M('Tchat_keyword_group')->where($where)->find();
              return $reply = get_text_arr(M('Tchat_text')->where('`id`="'.$rs['dead_text'].'"')->getField('content'));
              exit;
            }
            
            //如果匹配且有结果，先清除客户的缓存
            S($openId,NULL); 
            $name = $matches[1]; //提取客户姓名
            $phone = $matches[2]; //提取客户电话
            if(!$name){$tip[name]='姓名';}
            if(!$phone){$tip[phone]='联系电话';}
            
            //提取不到姓名或者电话时新增客户缓存，并提示需要回复哪些内容
            if(!$name || !$phone){
              $tips = implode('、',$tip);
              $content = "您的".$tips."输入有误，请重新回复您的".$tips."\n（2分钟内有效）";
              S($openId,array('activity'=>'hongbao',
                      'name'=>$name?$name:'',
                      'phone'=>$phone?$phone:''),120);
              
              $reply = get_text_arr($content);
            }else{
              //获取客户数据完整后更新客户资料
              $data['id']=M('Tchat_client')->where(array('openid'=>$openId))->getField('id');
              $data['openid']=$openId;
              $data['name']=$name;
              $data['phone']=$phone;
              D('Tchat_client')->update($data);
              //回复客户
              $map['id'] = $id;
              $rs = M('Tchat_keyword_group')->where($map)->find();

              return $reply = A('Reply','Event')->wechatReply($rs);
            }
            break;
          //匹配到客户建议
          case 'suggest':
            //获取客户ID并存储客户建议内容
            $data['client_id']=D('Tchat_client')->getClintId($openId);
            $data['content'] = $matches[1];
            $data['create_time'] = time();
            M('Tchat_suggestion')->data($data)->add();
            //提示客户回复姓名和电话，并建立客户缓存
            $reply = get_text_arr("您的建议我们已经收到，希望您能回复您的姓名和联系方式，如有必要我们会联系您。谢谢！\n (2分钟后过期)");
            S($openId,array('activity'=>'suggest'),120);
        }
    
        return $reply;
      }
    }*/
  }
  
    /**
     * 检测条目需要验证的内容，将检测到的内容名称及检测正则表达式字符串组成数组返回
     * @param int $num
     * @return array
     */
    private function checkInfo($num){
      $pregs = $this->pregs;
      foreach ($pregs as $key =>$val){
        if($this->check($num,$key)){
          $preg['need'] .= $preg['need']?",".$val['name']:$val['name'];
          $preg['rule'] .= $pregs[0]['preg'].$val['preg'];
        }
      }
      return $preg;
    }
    
    /**
     * 存储客户资料
     * @param string $openId
     * @param array $matches
     */
    private function saveClientInfo($openId,$matches){
      $data = $matches;
        $data['openid']=$openId;
        D('Tchat_client')->update($data);
    }
    
    /**
     * 位与运算筛选
     * @param unknown_type $pos
     * @param unknown_type $contain
     */
  private function check($pos = 0, $contain = 0){
      if(empty($pos) || empty($contain)){
          return false;
      }
      //将两个参数进行按位与运算，不为0则表示$contain属于$pos
      $res = $pos & $contain;
      if($res !== 0){
          return true;
      }else{
          return false;
      }
  }
}