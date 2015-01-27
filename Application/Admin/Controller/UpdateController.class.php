<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;
use Think\Db;
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
		$lastVersion=$this->getLastVersion();

		/* 版本对比 */
		if($localVersion && $lastVersion[0] > $localVersion){
			$this->assign("localVersion",$localVersion);
			$this->assign("update",$lastVersion);
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
	 * 分为手动更新和自动在线更新两种情况
	 */
	public function update(){
		if(IS_POST || IS_AJAX){
			if(I('post.method') !== 'online'){//手动更新
				$returnMessage = $this->updateDataBase();
			}//TODO 增加自动在线更新功能
			
			$lastVersion = $this->getLastVersion();
			file_put_contents('./Application/Install/Data/local.version', $lastVersion[0]);
			$this->ajaxReturn($returnMessage);
		}
	}
	/**
	 * 更新数据库
	 */
	private function updateDataBase($prefix=''){
		/*读取更新数据*/
		$sql = file_get_contents('./Application/Install/Data/update.sql');
		$sql = str_replace("\r", "\n", $sql);
		$sql = explode(";\n", $sql);//将字符串整理为数组

		/*替换表前缀*/
		$orginal = C('ORIGINAL_TABLE_PREFIX');//获取表前缀
		$sql = str_replace(" `{$orginal}", " `{$prefix}", $sql);
		
		$Model = M(); //建立空模型
		
		/*遍历整理后的sql数组*/
		foreach ($sql as $value) {
			$value = trim($value);
			if(empty($value)){
				continue;
			}else{
			  $Model->query($value);
			}
	}
		return '更新完成';
	}
	
	/**
	 * 获取服务器最新版本数据
	 */
	private function getLastVersion(){
		if(S('Tchat_Last_Version')){
			$url = "http://www.idutou.com/Tchat/last.version";//定义远程版本URL
			$lastVersion = file_get_contents($url);//提取最新版本的版本号及升级内容组成数组
			preg_match_all('/^.+?$/m', $lastVersion, $update);//将获取到的远程最新版本号及更新内容存储为数组
			$update=$update[0];//结果的二维数组整理成一维数组
			S('Tchat_Last_Version',$update,3600);
		}
		return S('Tchat_Last_Version');
	}
}