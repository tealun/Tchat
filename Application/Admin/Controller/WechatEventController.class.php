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
 * 自定义菜单管理控制器
 *
 */
class WechatEventController extends WechatController {


	/**
	 * 查看菜单
	 * 查看现有服务器上的目录
	 */
	public function index() {

		$status = M('Tchat_events')->getField('name,status');
		if ($status !== FALSE) {
			$this->assign('status',$status);
		}

		$this->display();
	}
	
	public function edit(){
		$this->display();
	}
	
	public function update(){
		$this->display();
	}
	
	public function setStatus(){
		
	}

}
