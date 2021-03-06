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
	 * 查看并设置前台主题模板
	 * TODO 还没编辑完成
	 */
	public function theme(){
		
		/*接收和更改模板*/
		if(IS_POST || IS_AJAX){
			
			if(!I('post.theme')){
				$this->error("非法操作！");
			}else{
				$theme = I('post.theme');
				$filename = './Application/Home/Conf/config.php';
				$homeConfig = file_get_contents($filename);
				preg_match("/'DEFAULT_THEME'\s*=>\s*'.*'/m",$homeConfig,$match);
				
				$replace = "'DEFAULT_THEME' =>  '".$theme."'";
				$homeConfig = str_replace($match[0], $replace, $homeConfig);

				if(file_put_contents($filename, $homeConfig)){
					unset($homeConfig);
					$this->ajaxReturn('1');
				}else{
					unset($homeConfig);
					$this->ajaxReturn('0');
				}	
			}
			
		}
		
		/*获取当前主题模板*/ 
		$homeConfig = file_get_contents('./Application/Home/Conf/config.php');
		preg_match("/'DEFAULT_THEME'\s*=>\s*'(.*)'/m",$homeConfig,$match);
		$presentTheme = $match[1];
		unset($homeConfig);
		
		/*获取当前已经安装的模板*/
	    $themePath="./Application/Home/View";
        $dir=opendir($themePath);
	        while(false!==($file=readdir($dir))){
	            if($file!="."&& $file!=".."){
	                if(is_dir($themePath."/".$file)){
	                    $themes[$file] =$this->findThemeInfo($file);
	                }else{
	                    continue;
	                }
	            }
	        }
		
		/*赋值变量并调用后台模板文件*/
		$this->assign('present_theme',$presentTheme);
		$this->assign('themes',$themes);
		$this->meta_title = "设置前台主题模板";
		$this->display();
	}
	
	/**
	 * 查找指定主题的相关信息
	 * @param string $theme 指定的主题模板标识符(文件夹名)
	 */
	private function findThemeInfo($theme){
		$themePath="./Application/Home/View/".$theme; //路径
		$themeString = file_get_contents($themePath."/about.txt"); //主题信息
		preg_match_all('/^.+?$/m', $themeString, $info);
		$info = $info[0]; // 将info二维数组的0键位数组提取为一维数组。
		foreach ($info as $value) {
			if(empty($value)){
				continue;
			}
			preg_match('/^(.+):(.+)/', $value, $match);
			$arr[$match[1]] = $match[2];
		}
		$arr['name']=$theme; //主题标识符
		$arr['image'] = $themePath."/".$theme.".png";// 预览图
		return $arr;
	}

	/**
	 *首页 LOGO设置
	 */
	public function logo(){
		$logo=F('Tchat/homeLogo')?F('Tchat/homeLogo'):'';
		
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
				F('Tchat/homeLogo',$logo);
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
		$list = F('Tchat/homeSlide'); //获取幻灯片设置的内容
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
					$slides[] = $this->findItemInfo($value['segment'], $value['id']);
				}

				F('Tchat/homeSlide',NULL);//删除旧的幻灯片数据
				
				F('Tchat/homeSlide',$slides);//更新新的幻灯片数据
				
				$status = array(
						'info'=>'幻灯片更新成功',
						'status'=>1
					);
				
		}
				$this->ajaxReturn($status,'json');
	}
	
	/**
	 * 文章页面配置
	 * 可根据需要在文章页面配置的多个钩子来实现文章挂载内容的配置
	 * @param string $part 需要配置的选项
	 */
	public function article($part){
		$value = F('Tchat/home'.$part);
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
			F('Tchat/home'.$part,NULL);
			F('Tchat/home'.$part,$value);
			$status = array('info' => '更新成功','status'=>1 );
		    $this -> ajaxReturn($status,'json');
		}
	}
	
	/**
	 * 设置首页特色内容展示
	 * 本方法设置特色内容的数据，排版请在前台模板中进行排版
	 * 返回数据为数组
	 */
	public function feature(){

		//读取缓存中的特色内容
		$feature = F('Tchat/homeFeature');
		
		//赋值特色内容条目
		if(empty($feature['items'])){
			$itemsCount = 0;
		}else{
			$itemsCount = count($feature['items']);
			foreach ($feature['items'] as $key => $value) {
				$feature['items'][$key]=$this->findItemInfo($value['type'],$value['id']);
			}
			$itemsCount = count($feature['items']);
			$this->assign('featureItems',$feature['items']);
			$this->assign('featureItemsCount',$itemsCount);
		}
		
		//赋值特色内容板块标题
		if($feature['title']){
			$this->assign('featureTitle',$feature['title']);
		}
		
		//赋值查看更多转向URL
		if($feature['moreLinkUrl']){
			$this->assign('featureMoreLinkUrl',$feature['moreLinkUrl']);
		}
		
		$this->meta_title = '首页特色内容配置';
		$this->display();
	}
	
	public function saveFeature(){
		if(IS_POST || IS_AJAX){
			$feature = I('post.');
			
			//读取缓存中的特色内容
			$status = F('Tchat/homeFeature',$feature);

		}
	}

	/**
	 * AJAX获取条目信息
	 */
	public function itemAjax(){
		if(IS_POST||IS_AJAX){
				$data = I('post.');
				/* 对POST过来的数据进行过滤分配变量*/
				if(is_numeric($data[0])){
					$segment = $data[1];
					$id = $data[0];
				}else{
					$segment = $data[0];
					$id = $data[1];
				}
			$info = $this->findItemInfo($segment,$id);
			$this->ajaxReturn($info,'json');
			}else{
				$this->error('非法操作！');
			}
	}
	
	/**
	 * 获取一条展示条目的详细信息
	 * 根据不同类型的条目内容设置，获取对应ID的数据
	 * @param string   $segment  条目所属的内容类型
	 * @param int      $id       幻灯片所属内容的ID
	 * TODO 稍后完善不同内容类型的赋值
	 */ 
	private function findItemInfo($segment=' ',$id=' '){
		
		switch ($segment) {
				case 'category': //内容分类类型
					$category = M('category')->find($id);
				
					$info['segment'] = $segment;
					$info['id']=$id;
					$info['url'] = U('Home/Article/lists',array('category'=>$id));
					$info['image'] = get_cover($category['icon'],'path');
					$info['title']=$category['title'];
					$info['alt']=$category['title'];
					$info['caption']=$category['description'];
					
					unset($category);
					break;
					
				case 'article'||'product'://文章及产品类型
					
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
					$activity = D('Tchat_activity')->detail($id); //获取条目内容详情
					
					$info['segment'] = $segment;
					$info['id']=$id;
					$info['url'] = "/Home/activity/detail?id=".$id;
					$info['image'] = get_cover($activity['cover_id'],'path');
					$info['alt']=$activity['title'];
					$info['caption']=$activity['title'];
					
					unset($activity); //删除article的变量
					break;
					
 				case 'plan'://套餐类型
					$plan = D('Tchat_plan')->info($id); //获取条目内容详情
					
					$info['segment'] = $segment;
					$info['id']=$id;
					$info['url'] = "/Home/activity/detail?id=".$id;
					$info['image'] = get_cover($plan['cover_id'],'path');
					$info['alt']=$plan['title'];
					$info['caption']=$plan['title'];
					
					unset($plan);
					break;
										
				case 'topic'://专题类型
					$topic = D('Tchat_topic')->info($id); //获取条目内容详情
					
					$info['segment'] = $segment;
					$info['id']=$id;
					$info['url'] = "/Home/topic/detail?id=".$id;
					$info['image'] = get_cover($topic['cover_id'],'path');
					$info['alt']=$topic['title'];
					$info['caption']=$topic['title'];
					
					unset($topic);
					break;
					
				default:
					
					break;
			}


					return $info;//返回整合后的幻灯片数据内容

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
			F('Tchat/home'.$part,NULL);
			
			$status = array(
					'info'=>$partname.'清除成功',
					'status'=>'1'
				);
			$this->ajaxReturn($status,'json');
		}
	}
	
}