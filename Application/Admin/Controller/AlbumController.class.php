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
class AlbumController extends AdminController {
	
	/**
	 * 相册列表
	 */
	public function index(){
		
		$this->display();
	}

	/**
	 * 相册详情
	 */
	public function detail(){
		
		$this->display();
	}

	/**
	 * 创建相册
	 */
	public function create(){
		
		$this->display();
	}
	
	/**
	 * 编辑相册
	 */
	public function edit(){
		
		$this->display();
	}

	/**
	 * 更新相册
	 */
	public function update(){

	}

}