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
	    $this->meta_title = '活动列表';
	    $this->display(); // 输出模板
        $this->display();
    }
	
	    /**
     * 新增产品套餐
     * @author huajie <banhuajie@163.com>
     */
    public function add(){
		
		//获取表单字段排序
        $fields = get_model_attribute($model['id']);
        $this->assign('info',       $info);
        $this->assign('fields',     $fields);
        $this->assign('type_list',  get_type_bycate($cate_id));
        $this->assign('model',      $model);
		$this->meta_title = '新增'.$model['title'];

        $this->display();
    }
	
	/**
	 * 编辑产品套餐
	 */
	public function edit(){
		
		$this->display();
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