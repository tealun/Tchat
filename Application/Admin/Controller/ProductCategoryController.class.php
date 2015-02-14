<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 后台分类管理控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class ProductCategoryController extends CategoryController {

    /**
     * 分类管理列表
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $tree = D('Category')->getTree(80,'id,name,title,sort,pid,allow_publish,status');
		if(isset($tree['_'])){//原语句指定分类编号获取目录树会出问题，因此添加了此IF判断代码筛选出指定目录的子目录树
			$tree = $tree['_'];
		}else{
			$this->error( '还没有产品分类，请先新增分类');
		}
        $this->assign('tree', $tree);
        C('_SYS_GET_CATEGORY_TREE_', true); //标记系统获取分类树模板
        $this->meta_title = '分类管理';
        $this->display();
    }

    /* 编辑分类 */
    public function edit($id = null, $pid = 80){
		if($pid != 80) {
			$this->error('非法操作！');
		}
		parent::edit($id,$pid);
    }

}
