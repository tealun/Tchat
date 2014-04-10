<?php

namespace Addons\DevProgress;
use Common\Controller\Addon;

/**
 * DevProgress插件
 * @author Tealun Du
 */

    class DevProgressAddon extends Addon{

        public $info = array(
            'name'=>'DevProgress',
            'title'=>'项目开发进度',
            'description'=>'用于进行项目开发进度统计',
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
        public function AdminIndex(){
                $this->display('widget');
        }

    }