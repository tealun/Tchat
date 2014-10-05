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


}