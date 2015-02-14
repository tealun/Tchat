<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 客户资料模型
 */
class TchatClientModel extends Model{
  
  /**
   * 获取客户详细信息
   * @param string $openId 客户openId
   * @param array $field  想要查询的字段数组
   */
  public function detail($id,$field = True){
  	if(is_numeric($id)){
  		$map['id'] = $id;
  	}else{
  		$map['openid'] = $id;
  	}
	
	$info = $this->where($map)->field($field)->find();
	return $info;
  }
  
  /**
   * 根据ID更新现有客户资料
   * @param $id
   * @param $data
   */
    public function update($data = null){
        /* 获取数据对象 */
        $data = $this->create($data);
        if(empty($data)){
            return false;
        }

        /* 添加或新增基础内容 */
        if(empty($data['id'])){ //新增数据
            $id = $this->add(); 
            if(!$id){
                $this->error = '新增客户出错！';
                return false;
            }
        } else { //更新数据
            $status = $this->save(); //更新基础内容
            if(false === $status){
                $this->error = '更新客户出错！';
                return false;
            }else{
              return $status;
            }
        }
    }
    
    /**
     * 获取客户ID
     * 如果不存在，则根据openId新建客户资料
     * 如果公众帐号通过了微信认证则提取客户在微信服务器上的资料存储到本地
     * 没有认证的帐号则忽略提取，直接存储openId
     * 因此开发时如果涉及到存储客户信息或者查看客户信息，最好是先通过openId调用本方法查找对应的客户ID，然后再进行查看或存储
     * 这样会自动从微信服务器上下载更新客户资料并返回ID值
     * @param string $openId
     */
    public function getClientId($openId){
      /* 查看客户是否已存在 */
      $id = $this->where(array('openid'=>$openId))->getField('id');
	  
	  /* 客户不存在时 */
      if(!$id){ //未认证情况下，仅存储客户openid
      	$data = array(
          'openid'=>$openId,
        ); 
		
		/* 查看认证情况 */
        if(check_wechat_rz()) $data = get_client_info($openId);//已认证则从服务器获取该客户资料
        $this->create($data);//创建客户数据
        $id = $this->add();//新增数据
      }
      return $id;
    }
}