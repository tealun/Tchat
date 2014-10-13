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
 * 前台管理控制器
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
					'info'=>'啊哦，请上传新LOGO。',
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
			if(!$list){
				$count = 0;
			}else{
				$count = count($list); //读取幻灯片的数量
			}

		$this -> assign('count',$count);
		$this -> assign('list',$list);		
		$this->meta_title = '幻灯片配置';
		$this->display();
	}
	
	/**
	 * 存储幻灯片设置
	 */
	public function saveSlide(){
		if(IS_POST||IS_AJAX){
			
			$postSlides=I('post.');//获取提交数据
				
				/* 获取每条幻灯片的详细信息 */
				foreach ($postSlides as $value) {
					$slides[] = $this->slideInfo($value['segment'], $value['id']);
				}
				
				F('homeSlide',NULL);//删除旧的幻灯片数据
				
				F('homeSlide',$slides);//更新新的幻灯片数据
				
				$status = array(
						'info'=>'幻灯片更新成功',
						'status'=>1
					);
		}
		$this->ajaxReturn($status,'json');
	}
	
	/**
	 * 获取一条幻灯片的详细信息
	 * 根据不同类型的幻灯内容设置，获取对应ID的数据
	 * @param string   $segment     幻灯片所属的内容类型
	 * @param int         $id                幻灯片所属内容的ID
	 * TODO 稍后完善不同内容类型的赋值
	 */ 
	public function slideInfo($segment='',$id=''){
		
			if(IS_POST || IS_AJAX){
				$data = I('post.');
				if(is_numeric($data[0])){
					$segment = $data[1];
					$id = $data[0];
				}else{
					$segment = $data[0];
					$id = $data[1];
				}
			}
			
			switch ($segment) {
				case 'category': //内容分类类型
					
					break;
					
				case 'article'://文章类型
					
					$article = D('Document')->detail($id); //获取条目内容详情
					
					$info['segment'] = $segment;
					$info['id']=$id;
					$info['url'] = "/Home/article/detail?id=".$id;
					$info['image'] = get_cover($article['cover_id'],'path');
					$info['alt']=$article['title'];
					$info['caption']=$article['title'];
					
					unset($article); //删除article的变量
					break;
					
				case 'activity'://活动类型
					
					break;
					
				case 'product'://产品类型
					
					break;
										
				case 'plan'://套餐类型
					
					break;
										
				case 'topic'://专题类型
					
					break;
					
				default:
					
					break;
			}

				if(IS_POST || IS_AJAX){
					$this->ajaxReturn($info,'json');
				}else{
					return $info;//返回整合后的幻灯片数据内容
				}

	}

	/**
	 * 文章页面配置
	 * @param string $part 需要配置的选项
	 */
	public function article($part){
		$value = F('home'.$part);
		if($value){
			$this -> assign($part,$value);
		}
		switch ($part) {
			case 'BeforeArticle':
				$partName = "文前";
				break;
			case 'AfterArticle':
				$partName = "文尾";
				break;
			default:
				
				break;
		}
		
		$this->meta_title = $partName.'配置';
		$this->display($part);
	}
	
	/**
	 * 存储文章相关设置内容
	 * @param string $part 存储的位置 befor和after
	 */
	public function saveArticle(){
		if(IS_POST || IS_AJAX){
			$part = I('post.part');
			$value = I('post.'.$part);
			F('home'.$part,NULL);
			F('home'.$part,$value);
		}
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
				case 'BeforeArticle':
					$partname = '文前引用';
					break;
				case 'AfterArticle':
					$partname = "文尾引用";
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
			F('home'.$part,NULL);
			
			$status = array(
					'info'=>$partname.'清除成功',
					'status'=>'1'
				);
			$this->ajaxReturn($status,'json');
		}
	}
	
}