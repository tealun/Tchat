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
            'title'=>'前台首页展示控制插件',
            'description'=>'基于bootstrap 3.2.0实现的前台首页内容控制插件 \r需要Admin板块控制器和视图配合，及创建菜单和权限',
            'status'=>1,
            'author'=>'Tealun Du',
            'version'=>'0.1'
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
			$list = F('homeSlide'); //获取幻灯片设置的内容
			$count = count($list); //读取幻灯片的数量
			
			$this->assign('list',$list);
			$this->assign('count',$count);
			$this->display('slide');				
        }
		
		//实现的documentDetailAfter钩子方法
		public function documentDetailBefore(){
			$this->display('beforeArticle');	
		}
		
		//实现的documentDetailAfter钩子方法
		public function documentDetailAfter(){
			$this->display('afterArticle');	
		}

    }