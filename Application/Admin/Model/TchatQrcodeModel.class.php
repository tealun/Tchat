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
class TchatQrcodeModel extends Model {

	/* 自动验证规则 */
	protected $_validate = array( array('scene', 'checkScene', '该场景已经存在', self::VALUE_VALIDATE, 'callback', self::MODEL_BOTH), array('scene', 'require', '场景名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH), );

	/* 自动完成规则 */
	protected $_auto = array( 
	array('action_name', 'getActionName', self::MODEL_BOTH, 'callback'), 
	array('scene', 'htmlspecialchars', self::MODEL_BOTH, 'function'), 
	array('create_time', 'getCreateTime', self::MODEL_INSERT, 'callback'), 
	);

	/**
	 * 设置二维码类型，如果不填写过期时间则为永久二维码，如果填写时间则为临时二维码
	 */
	protected function getActionName() {
		$action = I('post.expire');
		if (is_null($action)) {
			return "QR_LIMIT_SCENE";
		} else {
			return "QR_SCENE";
		}
	}

	/**
	 * 设置二维码场景值，根据已有最大二维码场景值返回+1后的值
	 */
	public function newSceneId() {

		$maxSceneId = $this->max('id');
		 //判断是否达到了100000的极限，如果达到则返回假
		 if($maxSceneId >= 100000){
		 return false;
		 }else {
		 return $maxSceneId+1;
		 }
	}

	/**
	 * 计算列表总数
	 * @param  number  $category 分类ID
	 * @param  integer $status   状态
	 * @return integer           总数
	 */
	public function listCount($category, $status = 1, $map = array()) {
		$map = array_merge($this -> listMap($category, $status), $map);
		return $this -> where($map) -> count('id');
	}

	/**
	 * 新增二维码
	 * @param array  $data 手动传入的数据
	 * @return boolean fasle 失败 ， int  成功 返回新增数据ID
	 * @author huajie <banhuajie@163.com>
	 */
	public function update($data = null) {
        /* 获取数据对象 */
        $data = $this->create($data);
        if(empty($data)){
            return false;
        }

        /* 添加或新增基础内容 */
        if(empty($data['id'])){ //新增数据
            $id = $this->add(); //添加关键词分组条目
            if(!$id){
                $this->error = '新增关键词分组出错！';
                return false;
            }
        } else { //更新数据
            $status = $this->save(); //更新基础内容
            if(false === $status){
                $this->error = '更新关键词分组出错！';
                return false;
            }
        }
		
		return $data;

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
	 * 检查标识是否已存在
	 * @param string $name
	 * @return true无重复，false已存在
	 */
	protected function checkScene() {
		$name = I('post.scene');

		$map = array('scene' => $name);
		$res = $this -> where($map) -> getField('id');
		if ($res) {
			return false;
		}
		return true;
	}

}
