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
class TchatMenuModel extends Model {

    /* 自动验证规则 */
    protected $_validate = array(
        array('name', '', '名称已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('name', '1,4', '标题长度不能超过4个汉字', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
		array('pid','checkPid','一级菜单数目不能超过3个,同一级别二级菜单数目不能超过5个', self::MUST_VALIDATE, 'callback', self::MODEL_BOTH),
   );

    /* 自动完成规则 */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('name', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        array('create_time', 'getCreateTime', self::MODEL_INSERT,'callback'),
        array('update_time', 'getCreateTime', self::MODEL_BOTH,'callback'),
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
     * 获取菜单树，指定菜单则返回指定菜单及其子菜单，不指定则返回所有菜单树
	 * 源自分类模型
     * @param  integer $id    菜单D
     * @param  boolean $field 查询字段
     * @return array          菜单树
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function getTree($id = 0, $field = true){
        /* 获取当前菜单信息 */
        if($id){
            $info = $this->info($id);
            $id   = $info['id'];
        }

        /* 获取所有菜单 */
        $map  = array('status' => array('eq', 1));
        $list = $this->field($field)->where($map)->order('sort')->select();
        $list = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_', $root = $id);

        /* 获取返回数据 */
        if(isset($info)){ //指定菜单则返回当前菜单及其子菜单
            $info['_'] = $list;
        } else { //否则返回所有菜单
            $info = $list;
        }

        return $info;
    }

    /**
     * 获取指定菜单的同级菜单
	 * 源自分类模型
     * @param  integer $id    菜单ID
     * @param  boolean $field 查询字段
     * @return array
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function getSameLevel($id, $field = true){
        $info = $this->info($id, 'pid');
        $map = array('pid' => $info['pid'], 'status' => 1);
        return $this->field($field)->where($map)->order('sort')->select();
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
     * 查询后解析扩展信息
     * @param  array $data 菜单数据
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    protected function _after_find(&$data, $options){
        /* 分割模型 */
        if(!empty($data['model'])){
            $data['model'] = explode(',', $data['model']);
        }

        /* 分割文档类型 */
        if(!empty($data['type'])){
            $data['type'] = explode(',', $data['type']);
        }

        /* 分割模型 */
        if(!empty($data['reply_model'])){
            $data['reply_model'] = explode(',', $data['reply_model']);
        }

        /* 分割文档类型 */
        if(!empty($data['reply_type'])){
            $data['reply_type'] = explode(',', $data['reply_type']);
        }

        /* 还原扩展数据 */
        if(!empty($data['extend'])){
            $data['extend'] = json_decode($data['extend'], true);
        }
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
	 * 检查是否超过首级菜单数目限制
	 * @param string $name
	 * @return true无重复，false已存在
	 */
	protected function checkPid($pid) {
		$pid = I('POST.pid');
		$num = $this -> listCount($pid);
		if ($pid == 0 && $num > 3) {
			return FALSE;
		}elseif($pid > 0 && $num >5){
			return FALSE;
		}
		
		return true;
	}

}
