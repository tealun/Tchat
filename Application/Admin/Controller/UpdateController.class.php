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

		$localVersion = file_get_contents('./Application/Install/Data/local.version');//获取本地版本号
		$url = "http://www.idutou.com/Tchat/last.version";//定义远程版本URL
		$lastVersion = file_get_contents($url);//提取最新版本的版本号及升级内容组成数组
		preg_match_all('/^.+?$/m', $lastVersion, $update);//将获取到的远程最新版本号及更新内容存储为数组
		$update=$update[0];//结果的二维数组整理成一维数组
		
		/* 版本对比 */
		if($localVersion && $update[0] > $localVersion){
			$this->assign("localVersion",$localVersion);
			$this->assign("update",$update);
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