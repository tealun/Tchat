<?php

namespace Addons\TchatIndex;
use Common\Controller\Addon;

/**
 * TchatIndex插件
 * @author Tealun Du
 */

    class TchatIndexAddon extends Addon{

        public $info = array(
            'name'=>'TchatIndex',
            'title'=>'内容信息概览',
            'description'=>'用于显示统计微信后台信息概览',
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

        //实现的weixinIndex钩子方法
        public function weixinIndex($param){

        }

    }