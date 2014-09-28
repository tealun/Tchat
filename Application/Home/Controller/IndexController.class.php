<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController {

	//系统首页
    public function index(){

        $category = D('Category')->getTree();
        $lists    = D('Document')->lists(null);
		
		/* 首页推荐产品数据 */
		$productCate = D('Category')->getChildrenId(80);
		
		$productNews = D('Document')->lists(arr2str($productCate),'`id` DESC',1,'id,cover_id,title');
		$productPos =  D('Document')->position(4,$productCate,5,'id,cover_id,title');//获取产品目录首页推荐产品，限制5条

		if(!empty($productNews)){
			$this->assign('productNews',$productNews);//首页最新产品
		}
		if(!empty($productPos)){
			$this->assign('productPos',$productPos);//首页推荐产品
		}
		
		
        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',D('Document')->page);//分页

                 
        $this->display();
    }

}