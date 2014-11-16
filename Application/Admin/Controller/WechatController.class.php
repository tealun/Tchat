<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 微信后台管理控制器
 * 
 */
class WechatController extends AdminController {

	public function index(){
		$this ->assign('meta_title','微信管理');
		$this->display();
	}
	
	/**
	 * 内容导航
	 * 为添加分类及文章时查找分类和文章的ID及链接提供导航
	 */
	public function contentGuide($segment=''){
		$map = array(
			'status' => 1
		);

		switch ($segment) {
			case 'category':
				$guideList = D('Category')->where($map)->select();
				break;
			case 'article':
				$Document   =   D('Document');
				        //只查询pid为0的文章
		        $map['pid'] = 0;
		        $guideList  = $this->lists($Document,$map,'update_time desc');
		        int_to_string($guideList );
				
				break;
			default:
				return FALSE;
				break;
		}
		$this->assign('segment',$segment);
		$this->assign('guideList',$guideList);
		$this->display('contentguide');
	}
}