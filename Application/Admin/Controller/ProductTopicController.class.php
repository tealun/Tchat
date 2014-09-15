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
 * 后台产品专题控制器
 * @author huajie <banhuajie@163.com>
 */
class ProductTopicController extends AdminController {

    /**
     * 产品专题列表
     * @author huajie <banhuajie@163.com>
     */
    public function index($status = null, $title = null){

        $this->display();
    }
	
	    /**
     * 新增产品专题
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
	 * 编辑产品专题
	 */
	public function edit(){
		
		$this->display();
	}
	
	/**
	 * 设置产品专题状态
	 */
	public function setStatus(){
		
	}
	
	/**
	 * 删除产品专题
	 */
	public function remove(){

	}
}