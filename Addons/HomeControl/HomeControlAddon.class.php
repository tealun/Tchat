<?php

namespace Addons\HomeControl;
use Common\Controller\Addon;

/**
 * 前台首页内容控制插件
 * @author Tealun
 */

    class HomeControlAddon extends Addon{

        public $info = array(
            'name'=>'HomeControl',
            'title'=>'前台内容控制插件',
            'description'=>'基于bootstrap 3.2.0实现的前台首页内容控制插件，需要Admin板块控制器和视图配合，及创建菜单和权限',
            'status'=>1,
            'author'=>'Tealun Du',
            'version'=>'0.2'
        );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

	
		//实现的homeLogo钩子方法
		public function homeLogo(){
			$defaultLogo = 'Public/Home/images/logo.png';
			$logo = F('Tchat/homeLogo')?F('Tchat/homeLogo'):$defaultLogo;
			$this->assign('logo',$logo);
			$this->display('logo');
		}
		
		 //实现的homeSlideShow钩子方法
		public function homeSlide(){
			$slideList = F('Tchat/homeSlide'); //获取幻灯片设置的内容
			$slideCount = count($slideList); //读取幻灯片的数量
			
			$this->assign('addons_slideList',$slideList);
			$this->assign('addons_slideCount',$slideCount);
			$this->display('slide');
        }
		
		/**
		 * 实现的homeFeature钩子方法
		 * 此前台控制首页中特色栏目导航
		 */
		public function homeFeature(){
	
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
			
			$this->display('feature');
		}
		
		//实现的documentDetailAfter钩子方法
		public function documentDetailBefore(){
			$beforeArticle = F('Tchat/homeBeforeArticle');
			$this->assign('addons_beforeArticle',$beforeArticle);
			$this->display('beforeArticle');	
		}
		
		//实现的documentDetailAfter钩子方法
		public function documentDetailAfter(){
			$afterArticle = F('Tchat/homeAfterArticle');
			$this->assign('addons_afterArticle',$afterArticle);
			$this->display('afterArticle');	
		}

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


					return $info;//返回整合后的条目内容
		}

    }