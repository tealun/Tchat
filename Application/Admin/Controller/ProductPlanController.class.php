<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台产品套餐控制器
 * @author huajie <banhuajie@163.com>
 */
class ProductPlanController extends AdminController {

    /**
     * 产品套餐列表
     * @author huajie <banhuajie@163.com>
     */
    public function index($status = null, $title = null){
		$map=array(
			'status'=> '',
			'deadline' => array('not between',array(1,time()))
		);

	    $this->getLists($map);
	    $this->meta_title = '产品套餐列表';
	    $this->display(); // 输出模板

    }
	
	    /**
     * 新增产品套餐
     * @author huajie <banhuajie@163.com>
     */
    public function add(){
		$info['model_id'] = '54';

		/* 新增产品套餐变量赋值 */
		//获取菜单模型
		$model = M('Model') -> where(array('id' => $info['model_id'])) -> find();

		//获取套餐表单字段排序
		$fields = get_model_attribute($model['id']);
		$this -> assign('info', $info);
		$this -> assign('fields', $fields);
		$this -> assign('model', $model);
		/* 获取套餐信息 */
		$this -> meta_title = '新增产品套餐';
		$this -> display();
    }
	
	/**
	 * 编辑产品套餐
	 */
	public function edit(){
		
		$this->display();
	}
	
	/**
	 * 新增或更新数据
	 */
	public function update() {
			$TchatPlan = M('Tchat_plan');
			if (IS_POST) {
				$data=$_POST;
				$TchatPlan -> create($data);//创建数据
				
				/* 新增数据 */
				if (empty($id)) {
					$status = $TchatPlan -> add();
					if (FALSE == $status) {
						$this -> error(empty($error) ? '未知错误！' : $error);
					} else {
						$this -> success('新增成功！', U('index'));
					}
					
				/* 更新数据 */
				} else {
					$status = $TchatPlan -> save();
					if (FALSE == $status) {
						$this -> error(empty($error) ? '未知错误！' : $error);
					} else {
						$this -> success('更新成功！', U('index'));
					}
				}
			}
	}
	
	/**
	 * 设置产品套餐状态
	 */
	public function setStatus(){
		
	}
	
	/**
	 * 删除产品套餐
	 */
	public function remove(){

	}
	
	 /**
	 * 获取数据列表
	 * 
	 * @param array $map
	 */
    private function getLists($map){
      $list   = $this->lists('Tchat_plan',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }
}