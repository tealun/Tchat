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
 * 带参数二维码模型
 */
class TchatPlanModel extends Model {

    /* 自动验证规则 */
    protected $_validate = array(
        array('name', '', '名称已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('name', '1,4', '标题长度不能超过4个汉字', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
        array('deadline', '/^\d{4,4}-\d{1,2}-\d{1,2}(\s\d{1,2}:\d{1,2}(:\d{1,2})?)?$/', '日期格式不合法,请使用"年-月-日 时:分"格式,全部为数字', self::VALUE_VALIDATE  , 'regex', self::MODEL_BOTH),
   );

    /* 自动完成规则 */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('name', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        array('create_time', 'getCreateTime', self::MODEL_INSERT,'callback'),
        array('update_time', 'getCreateTime', self::MODEL_BOTH,'callback'),
        array('deadline', 'strtotime', self::MODEL_BOTH, 'function'),
    );

    /**
     * 获取菜单详细信息
	 * 源自分类模型
     * @param  milit   $id 菜单ID或标识
     * @param  boolean $field 查询字段
     * @return array     菜单信息
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function info($id, $field = true){
        /* 获取菜单信息 */
        $map = array();
        if(is_numeric($id)){ //通过ID查询
            $map['id'] = $id;
        } else { //通过标识查询
            $map['name'] = $id;
        }
        return $this->field($field)->where($map)->find();
    }

    /**
     * 更新菜单信息
     * @return boolean 更新状态
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function update(){
        $data = $this->create();
        if(!$data){ //数据对象创建错误
            return false;
        }

        /* 添加或更新数据 */
        if(empty($data['id'])){
            $res = $this->add();
        }else{
            $res = $this->save();
        }

        //更新菜单缓存
        S('tchat_menu_list', null);

        //记录行为
       // action_log('update_tchat_menu', 'tchat_menu', $data['id'] ? $data['id'] : $res, UID);

        return $res;
    }

    /**
     * 删除状态为-1的数据
     * @return true 删除成功， false 删除失败
     */
    public function remove($ids=NULL){
        //查询假删除数据
        $map = array('status'=>-1);
		if(is_null($ids)){
			$ids =$this->where($map)->field('id')->select();
		}

        if(!empty($ids)){
        	$res = $this->where( array( 'id'=>array( 'IN',$ids ) ) )->delete();
        }

        return $res;
    }

	/**
	 * 创建时间不写则取当前时间
	 * @return int 时间戳
	 * @author huajie <banhuajie@163.com>
	 */
	protected function getCreateTime() {
		$create_time = I('post.create_time');
		return $create_time ? strtotime($create_time) : NOW_TIME;
	}
}
