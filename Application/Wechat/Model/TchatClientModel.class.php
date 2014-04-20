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
   * 根据ID或者OPENID更新现有客户资料
   * Enter description here ...
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