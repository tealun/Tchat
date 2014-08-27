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
 *相册板块后台管理控制器
 * 
 */
class ProductController extends AdminController {

	public function index(){
		
		$hostname = $_SERVER["HTTP_HOST"].C('WECHAT_APP_ID');
		$this->assign('hostname',$hostname);
		$this->display();
	}




}