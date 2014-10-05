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
class HomeControlController extends AdminController {

	/**
	 *首页 LOGO设置
	 */
	public function logo(){
		$logo=F('homeLogo')?F('homeLogo'):'';
		
		$this -> assign('logo',$logo);		
		$this->meta_title = 'LOGO配置';
		$this->display();
	}
	
	/**
	 * 缓存LOGO图片ID
	 * 缓存后的图片ID将会被HomeControl插件读取
	 * TODO 将此功能转移到插件中
	 */
	public function saveLogo(){
		if(IS_POST || IS_AJAX){
			$logo = I('post.logo');
			if(!empty($logo)){
				F('homeLogo',$logo);
				$status = array(
					'info'=>'LOGO更新成功',
					'status'=>'1'
				);
			}else{
				$status = array(
					'info'=>'LOGO没有更新，请上传新LOGO。',
					'status'=>'0'
				);
			}
				$this->ajaxReturn($status ,'json');
				
		}else{
			$this->error('禁止访问');
		}
	}
	
	/**
	 * 首页幻灯片设置
	 */
	public function slide(){
		$list = F('homeSlide'); //获取幻灯片设置的内容
		$count = count($list); //读取幻灯片的数量
		
		$this -> assign('list',$list);		
		$this->meta_title = '幻灯片配置';
		$this->display();
	}
	
}