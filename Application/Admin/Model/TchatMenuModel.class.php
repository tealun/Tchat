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
        array('name', 'checkName', '名称已经存在', self::VALUE_VALIDATE, 'callback', self::MODEL_BOTH),
        array('name', 'require', '名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', 'checkLength', '标题长度不能超过4个字符', self::MUST_VALIDATE, 'callback', self::MODEL_BOTH),
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
	 * @param  number  $category 分类ID
	 * @param  integer $status   状态
	 * @return integer           总数
	 */
	public function listCount($pid, $status = 1, $map = array()) {
		$map = array_merge($this -> listMap($pid, $status), $map);
		return $this -> where($map) -> count('id');
	}

	/**
	 * 新增目录
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
                $this->error = '新增菜单出错！';
                return false;
            }
        } else { //更新数据
            $status = $this->save(); //更新基础内容
            if(false === $status){
                $this->error = '更新菜单出错！';
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
