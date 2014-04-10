<?php

namespace Addons\TchatIcon;
use Common\Controller\Addon;

/**
 * TchatIcon插件
 * @author Tealun Du
 */

    class TchatIconAddon extends Addon{

        public $info = array(
            'name'=>'TchatIcon',
            'title'=>'后台首页微信功能快捷方式',
            'description'=>'用于提供后台首页微信快捷入口，管理员可见，主要用于配置网站和微信',
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

        //实现的AdminIndex钩子方法
        public function AdminIndex($param){
                $this->display('widget');
        }

    }