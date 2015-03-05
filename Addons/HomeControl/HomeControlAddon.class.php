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
			$logo = F('homeLogo')?F('homeLogo'):$defaultLogo;
			$this->assign('logo',$logo);
			$this->display('logo');
		}
		
		 //实现的homeSlideShow钩子方法
		public function homeSlide(){
			$slideList = F('homeSlide'); //获取幻灯片设置的内容
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
			$feature = F('homeFeature');
			
			//赋值特色内容条目
			if(is_null($feature['items'])){
				$itemsCount = 0;
			}else{
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
			
			$this->assign('featureStyle',$feature['style']);
			
			$this->display('feature');
		}
		
		//实现的documentDetailAfter钩子方法
		public function documentDetailBefore(){
			$beforeArticle = F('homeBeforeArticle');
			$this->assign('addons_beforeArticle',$beforeArticle);
			$this->display('beforeArticle');	
		}
		
		//实现的documentDetailAfter钩子方法
		public function documentDetailAfter(){
			$afterArticle = F('homeAfterArticle');
			$this->assign('addons_afterArticle',$afterArticle);
			$this->display('afterArticle');	
		}

    }