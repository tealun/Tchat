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
		$map['status'] = array('gt',-1);
		$this -> getLists($map);

		$this->assign('meta_title','事件设置');
		$this->display();
	}
	
	/**
	 * 设置指定事件
	 * 对指定的事件设置回复信息
	 * @param int $id 事件ID
	 */
	public function edit($id){
		$data = D('Tchat_events')->info($id);
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
			$data = I('param.');
			$Event = D('Tchat_events');
			if(!empty($data['id'])){
					/* 判断是更新还是新增 */
					if (false !== $Event -> update()) {
						$this -> success('更新成功！', U('index'));
					} else {
						$this -> error('更新失败！', U('index'));
					}
			}else{//没有指定ID的情况下
				$this -> error('参数设置错误！', U('index'));
			}

		}else{//非POST或AJAX方式的访问情况下
			$this->error('非法操作，您无权进行此操作',U('index'));
		}
		$this->display();
	}
	
	public function setStatus(){
		
	}
	
		/**
	 * 获取数据列表
	 */
    private function getLists($map){
      $list   = $this->lists('Tchat_events',$map,'id');
      col_to_string($list);
      $this->assign('_list', $list);
    }

}
