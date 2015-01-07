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
class UpdateController extends AdminController {
	
	/**
	 * 系统升级
	 * 在此方法中检测现有系统版本，并从服务器获取最新版本号
	 * 通过对比后提醒是否更新系统
	 */
	public function index(){
		$this->meta_title = "系统升级";
		
		$localVersion = F('Update/local');
		$url = "http://www.idutou.com/Tchat/last.version";
		$lastVersion = file_get_contents($url);
		
		if($lastVersion > $localVersion){
			$update = TRUE;
		}else{
			$update = FALSE;
		}
		
		$this->display();
	}

	/**
	 * 更新历史记录
	 */
	public function detail(){
		$this->meta_title = "更新历史";
		$this->display();
	}

	/**
	 * 更新系统
	 */
	public function update(){

	}

}