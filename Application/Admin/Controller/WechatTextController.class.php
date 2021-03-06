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
 * 文本素材管理控制器
 *
 */
class WechatTextController extends WechatController {


	/**
	 * 文本列表
	 * 查看已经建立的文本素材内容列表
	 */
	public function index() {

		$this->getLists();
		$this->meta_title = '文本素材列表';
		$this->display();
		
	}


	/**
	 * 编辑文本内容
	 */
	public function edit($id = null) {

		if (IS_GET) {
			$id = I('get.id', '');
			if (empty($id)) {
				$this -> error('参数不能为空！');
			}

			/*获取一条记录的详细数据*/
			$Text = M('Tchat_text');
			
			$data = $Text->where(array('id'=>$id))->find();

			if (!$data) {
				$this -> error($Text -> getError());
			}
			//赋值data变量，将作为字段的已有数据值对应设置为字段值
			$this -> assign('data', $data);

		}

		$this -> meta_title = '编辑文本素材';
		$this -> display();

	}

	/**
	 * 新增自定义菜单
	 */
	public function create() {
		
		if(IS_POST){
			$data= $_POST;
			$id = $data['id'];
			$Text = M('Tchat_text');
			$Text-> create($data);
			if(empty($id)){
				$status = $Text -> add();
				if($status == FALSE){
					$this -> error('新增失败',U('index'));
				}else{
					$this -> success('新增成功',U('index'));
				}
			}else{
				$status = $Text -> save();
			    if($status == FALSE){
					$this -> error('更新失败',U('index'));
				}else{
					$this -> success('更新成功',U('index'));
				}
			}
		}

		/* 获取菜单信息 */
		$this -> meta_title = '新增文本素材';
		$this -> display();
	}

	/**
	 * 删除一个文本
	 * 
	 */
	public function remove() {
		
		$ids = I('ids');
		if (empty($ids)) {
			$this -> error('参数错误!');
		}
		
		if(is_numeric($ids)){
			
		//删除一条信息
		$res = M('Tchat_text') -> delete($ids);
		
		}else{
			foreach ($ids as $id) {
				$res = M('Tchat_text') -> delete($id);
				if($res == FALSE) {
					$this -> error('删除编号'.$id.'文本信息失败！');
					break;
				}
			}
		}

		if ($res !== false) {
			//记录行为
			action_log('delete_tchat_text', 'tchatText', $ids, UID);
			$this -> success('删除文本信息成功！');
		} else {
			$this -> error('删除文本信息失败！');
		}
	}


	/**
	 * 获取数据列表
	 */
    private function getLists($map=''){
      $list   = $this->lists('Tchat_text',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }
	
}
