<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace Wechat\Model;
use Think\Model;

/**
 * 客户资料模型
 */
class TchatClientModel extends Model{
  
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
     * 因此开发时如果涉及到存储客户信息或者查看客户信息，最好是先通过openId查找对应的客户ID，然后再进行查看或存储
     * 这样会自动从微信服务器上下载更新客户资料并返回ID值
     * @param string $openId
     */
    public function getClientId($openId){
      $id = $this->where(array('openid'=>$openId))->getField('id');
      if(!$id){
      	$data = array(
          'openid'=>$openId,
        );
        if(check_wechat_rz()) $data = get_client_info($openId);
        $this->create($data);
        $id = $this->add();
      }
      return $id;
    }
}