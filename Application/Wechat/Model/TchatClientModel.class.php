<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
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
            $id = $this->getClientId($data['openId']); 
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
     * @param string $openId
     */
    public function getClientId($openId){
      $id = $this->where(array('openid'=>$openId))->getField('id');
      if(!$id){
      	$data = array(
          'openid'=>$openId,
        );
        if(check_wechat_rz()) $data = array_merge($data,get_client_info($openId));
        $this->create($data);
        $id = $this->add();
      }
      return $id;
    }
}