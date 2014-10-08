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
		
		var_dump($list);
		$this -> assign('count',$count);
		$this -> assign('list',$list);		
		$this->meta_title = '幻灯片配置';
		$this->display();
	}
	
	public function slideInfo($segment,$id){
			switch ($segment) {
				case 'article':
					
					$info = D('Document')->detail($id);
					$info['url'] = "/Home/article/detail?id=".$id;
					break;
					
				case 'activity':
					
					break;
					
				case 'product':
					
					break;
										
				case 'plan':
					
					break;
										
				case 'topic':
					
					break;
					
				default:
					
					break;
			}

				return $info;


	}
	
	public function saveSlide(){
		if(IS_POST||IS_AJAX){
			
			$newSlides=I('post.');
				/*
				foreach ($newSlides as $key => $value) {
					$info=$this->slideInfo($value['segment'], $value['id']);
					$newSlides[$key] = array_merge($value,$info);
				}
				*/
				$slides = F('homeSlide')?array_merge(F('homeSlide'),$newSlides):$newSlides;

				F('homeSlide',$slides);
				
				$status = array(
						'info'=>'幻灯片更新成功',
						'status'=>1
					);
		}
		$this->ajaxReturn($status,'json');
	}
	
	/**
	 * 清除某项设置
	 * @param string $part 要清除数据的模块标识
	 * 注意首字母大写
	 */
	public function clear($part){
		if(IS_POST || IS_AJAX){

			switch ($part) {
				case 'Logo':
					$partname = 'LOGO';
					break;
				case 'Slide':
					$partname = '幻灯片';
					break;
				default:
					$status = array(
						'info'=>'没有该指令，请确认您的指令正确',
						'status'=>'0'
					);
					$this->ajaxReturn($status,'json');
					exit();
					break;
			}
			
			/* 清除数据缓存 */
			F('home'.$part,null);
			
			$status = array(
					'info'=>$partname.'清除成功',
					'status'=>'1'
				);
			$this->ajaxReturn($status,'json');
		}
	}
	
}