<?php
// +----------------------------------------------------------------------
// | Tchat
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.dutous.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: TalunDu <tealun@tealun.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 产品套餐模型
 */
class TchatEventsModel extends Model {

    /* 自动验证规则 */
    protected $_validate = array();

    /* 自动完成规则 */
    protected $_auto = array();

    /**
     * 获取时间设置的详细信息
	 * 源自分类模型
     * @param  milit         $id       套餐ID或标识
     * @param  boolean   $field  查询字段
     * @return  array                    设置信息
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function info($id, $field = true){
        /* 获取设置信息 */
        $map = array();
        if(is_numeric($id)){ //通过ID查询
            $map['id'] = $id;
        } else { //通过标识查询
            $map['name'] = $id;
        }
        return $this->field($field)->where($map)->find();
    }

    /**
     * 更新设置信息
     * @return boolean 更新状态
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function update(){
        $data = $this->create();
        if(!$data){ //数据对象创建错误
            return false;
        }

        /* 更新数据 */
        $res = $this->save();

        //记录行为
       // action_log('update_tchat_events', 'tchat_events', $data['id'] ? $data['id'] : $res, UID);

        return $res;
    }

}
