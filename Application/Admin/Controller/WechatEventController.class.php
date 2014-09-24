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
 * 自定义菜单管理控制器
 *
 */
class WechatEventController extends WechatController {


	/**
	 * 事件列表
	 * 查看事件的设置情况
	 */
	public function index() {

		$status = M('Tchat_events')->getField('event_type,status');
		if ($status !== FALSE) {
			$this->assign('status',$status);
		}
		$this->assign('meta_title','事件设置');
		$this->display();
	}
	
	/**
	 * 设置指定事件
	 * 对指定的事件设置回复信息
	 * @param int $id 事件ID
	 */
	public function edit($id){
		$data = M('Tchat_events')->find($id);
		if(is_null($data)) $this->error('非法操作',U('index'));
	
		$this->assign('data',$data);
		$this->assign('meta_title','编辑['.$data['event_name'].']事件');		
		$this->display();
	}
	
	/**
	 * 更新事件
	 * 根据客户提交的数据更新事件的回复设置
	 */
	public function update(){
        if(IS_POST || IS_AJAX){
			$data = I('param');
			$id = $data['id'];
			$Event = M('Tchat_events');
			if(empty($id)){
				$this-> ajaxReturn('非法操作，您的参数有误。','json');
			}else{
				$status = $Event -> data($data)->create()->save();
				$status?$this-> ajaxReturn('更新成功','json'):$this-> ajaxReturn('更新失败','json');
			}
		}else{
			$this->error('非法操作，您无权进行此操作',U('index'));
		}
		$this->display();
	}
	
	public function setStatus(){
		
	}

}
