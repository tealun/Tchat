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
 * 微信客户管理控制器
 * 
 */
class WechatClientController extends WechatController {
	
	/**
	*客户列表
	*/
	public function index(){

	        $map = array();
	        
	    if(isset($_GET['keyword'])){
	    	if($_GET['col']){
	    	$map[$_GET['col']]  = array('like', '%'.(string)I('keyword').'%');
	    	}else{
            $map['name']  = array('like', '%'.(string)I('keyword').'%');
	    	}
            $this->assign('keyword', $_GET['keyword']);
        }
        
        if ( isset($_GET['time-start']) ) {
            $map['subscribe_time'][] = array('egt',strtotime(I('time-start')));
        }
        if ( isset($_GET['time-end']) ) {
            $map['subscribe_time'][] = array('elt',24*60*60 + strtotime(I('time-end')));
        }
        
		$map['subscribe'] = array('eq','1');
		$this->getLists($map);
		$this->meta_title = '正在关注客户列表';
		$this->display(); // 输出模板
	}

	/**
	*已取消客户列表
	*
	*/
	public function unsubscribe(){
		$map['subscribe'] = array('eq','-1');
		$this->getLists($map);
		$this->meta_title = '已取消关注客户';
		$this->display(); // 输出模板
	}
	
 
    private function getLists($map){
    	$list   = $this->lists('Tchat_client',$map,'subscribe_time');
		$this->assign('_list', $list);
    }
    

}