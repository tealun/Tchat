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
class PatternLogic{
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
   * 查找当前安装板块,获取各板块需要验证的条目然后生成需匹配项目缓存
   * 实效性为1小时
   * 注意：在设计添加有需要进行验证的模型时,模型统一使用字段"check_info"并在自动完成配置中配置运行一次本公共方法,以便实时更新
   */
  public function renewPatternArr(){
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
        $field = array('id','ex_keyword','check_info','checked_reply');
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
    //如果存在$parrerArr
   	IF($patternArr)S(patternArr,$patternArr?$patternArr:'',600);
   	return S(patternArr);
   	unset($i,$map,$field,$segs,$seg,$patternArr);
  }

  /**
   * 对有需要验证提取客户信息的板块进行信息提取
   * @param $openId 微信openid
   * @param $keyword 客户发送的信息
   */
  public function findPreg($openId,$keyword){
  $pregs = $this->pregs;
    $patternArr = S(patternArr)?S(patternArr):$this->renewPatternArr();
    if(empty($patternArr)){
      //没有需要的验证项，则回复FALSE
      return FALSE;
    }else{
      foreach ($patternArr as $pattern){
        //获取检测项
        $preg = $this->getPreg($pattern['check_info']);
        //建立需要检测项名称数组
        $pattern['needs'] = str2arr($preg['need']);
        //建立针对该条项目的验证规则
        $pattern['rule']= "/^(?:".$pattern['ex_keyword'].")".$preg['rule']."/";
        //将$pattern数组传递到开始验证方法中进行正则匹配
		$reply = $this->startPreg($openId, $pattern, $keyword, $matches);
		unset($pattern,$preg);
		if($reply){
		 return $reply;
		}
      }
      
    }
  }
  
  /**
   * 匹配需要提取客户信息内容的条目关键字
   * @param string $openId 客户openID
   * @param array $pattern 匹配项目内容数组
   * $pattern的内容为renewPatternArr方法获取到的数组中
   * @param string $keyword 客户发送的关键字
   */
  public function startPreg($openId,$pattern,$keyword){
            if(S($openId) && preg_match('/^(qx)$/',$keyword)){
            S($openId,NULL);
            return $reply = get_text_arr('您已取消参与，谢谢您的合作。');
            exit;
          }
          //进行正则表达式验证
         if(preg_match($pattern['rule'], $keyword,$matches)){
         	$arr =  S($openId);
         	if($arr['matches']){
         	 $matches = array_merge($matches,$arr['matches']);
         	 //清理正则表达式匹配时产生的数字键名垃圾,只留下字符串键名的键值
              foreach ($matches as $k => $v){
	              if(is_numeric($k))  unset($matches[$k]);
              }
         	}
         	//删除不再使用的变量及缓存
         	unset($arr,$k,$v);
         	S($openId,NULL);
      		return $reply = $this->checkInfo($openId,$pattern, $matches);
         }else{
			return false;
         }
  }
  
  	/**
  	 * 检测验证条目的必要信息
  	 *@param string $openId 客户openID
     * @param array $pattern 匹配项目内容数组
     * $pattern的内容为renewPatternArr方法获取到的数组中
     * @param string $keyword 客户发送的关键字
  	 */
    private function checkInfo($openId,$pattern,$matches){ 

    	//遍历所需验证项目
          foreach ($pattern['needs'] as $v){
	          if(empty($matches[$v])){
	          	$tips .= $tips?"、".$this->tip[$v]:$this->tip[$v];
	          	$num = $num?$num+$this->getPregKey($v):$this->getPregKey($v);
	          }
          }
	      //如果存在未提取到的所需信息，则回复提示并缓存
          if ($tips){
          	  $preg = $this->getPreg($num);
          	  $pattern['rule']= "/^".$preg['rule']."/";
          	  $content = "您的".$tips."输入有误，请重新回复您的".$tips.",取消请回复'qx'\n（2分钟内有效）";
                  //缓存需要检测项目
                  S($openId,array(
                      'action'=>array(
                        'c'=>"Pattern,Logic", //需要后续处理的控制器及命名空间
                        'a'=>'startPreg', //需要后续处理的公共方法
                        ),
                      'p'=>array( //需要传递到上述公共发放的变量及赋值
                         'openId'=>$openId, 
	                     'pattern'=>$pattern
                        ),
                      'matches'=>$matches //缓存现有匹配到的数据,在上述公共方法中会读取该缓存数组
                      ),
                      120);
          $reply = get_text_arr($content);
          }else{
            //匹配客户信息完整后存储客户资料
            $this->saveClientInfo($openId, $matches);
            //获取针对性的回复内容
            if(!empty($pattern['checked_reply'])){
            	//TODO 如果是不需要设定但是又要回复客户不同于关键字触发的回复内容，比如优惠券活动，待解决。
            	$replyConfig = str2arr($pattern['checked_reply'],':');
            	$rs['segment']=$pattern['segment'];
            	$rs['reply_type']= $replyConfig[0];
            	$rs['reply_id']= $replyConfig[1];
            	//根据设定的获取客户信息后的回复内容回复客户
            	$reply = A('Reply','Event')->wechatReply($rs);
            	unset($replyConfig,$rs);
            }else{
           		A($pattern['segment'],'Logic');
         		$reply = get_text_arr('信息已经完整');
            }

          }
          return $reply;
    }
    /**
     * 检测条目需要验证的内容，将检测到的内容名称及检测正则表达式字符串组成数组返回
     * @param int $num
     * @return array
     */
    private function getPreg($num){
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
     * 根据匹配属性的名称查找到匹配项目值
     * @param unknown_type $name
     */
    private function getPregKey($name){
      $pregs = $this->pregs;
      foreach ($pregs as $key => $val){
      	if($name == $val['name']){
      	  return $key;
      	}
      }
    }
    /**
     * 存储客户资料
     * @param string $openId
     * @param array $matches
     */
    private function saveClientInfo($openId,$matches){
      $data = $matches;
        $data['id']=D('Tchat_client')->getClientId($openId);
        D('Tchat_client')->update($data);
    }
    
    /**
     * 位与运算筛选
     * @param num $pos
     * @param num $contain
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