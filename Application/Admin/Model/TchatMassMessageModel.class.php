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
 * 自定义菜单模型
 */
class TchatMassMessageModel extends Model {

    /* 自动验证规则 */
    protected $_validate = array(
   );

    /* 自动完成规则 */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('media_id', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        array('create_time', 'getCreateTime', self::MODEL_INSERT,'callback'),
        array('update_time', 'getUpdateTime', self::MODEL_BOTH,'callback'),
    );


	/**
	 * 计算列表总数
	 * @param  number  $category 菜单ID
	 * @param  integer $status   状态
	 * @return integer           总数
	 */
	public function listCount($pid, $status = 1, $map = array()) {
		$map = array_merge($this -> listMap($pid, $status), $map);
		return $this -> where($map) -> count('id');
	}

     /**
     * 更新群发信息
     * @return boolean 更新状态
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

        //记录行为
       // action_log('update_tchat_mass_message', 'tchat_mass_message', $data['id'] ? $data['id'] : $res, UID);
        return $res;
    }

    /**
     * 设置where查询条件
     * @param  number  $category 分类ID
     * @param  integer $status   状态
     * @return array             查询条件
     */
    private function listMap($menu, $status = 1){
        /* 设置状态 */
        $map = array('status' => $status);

        /* 设置分类 */
        if(!is_null($menu)){
            if(is_numeric($menu)){
                $map['id'] = $menu;
            } else {
                $map['id'] = array('in', str2arr($menu));
            }
        }

        return $map;
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

	/**
	 * 创建时间不写则取当前时间
	 * @return int 时间戳
	 * @author huajie <banhuajie@163.com>
	 */
	protected function getUpdateTime() {
		return NOW_TIME;
	}
}
