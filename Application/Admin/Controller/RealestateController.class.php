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
 * 房产板块后台管理控制器
 * 
 */
class RealestateController extends AdminController {

	public function index(){
		
		$hostname = $_SERVER["HTTP_HOST"].C('WECHAT_APP_ID');
		$this->assign('hostname',$hostname);
		$this->display();
	}
	
	public function developerBrief(){
		$brief = F("Realestate/Brief")?F("Realestate/Brief"):NULL;
		if(is_null($brief)){
		var_dump("There is nothing about developer brief.");
		}else{
		var_dump($brief);
		$this->assign("brief",$brief);
		}
		$this->display();
	}
	
	/**
	 * 生成开发商简介内容
	 * @param array $data 需要生成的内容数组
	 */
	private function setDeveloperBrief($data){
	
	}


}