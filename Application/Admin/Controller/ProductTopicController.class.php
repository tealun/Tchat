<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台产品专题控制器
 * @author huajie <banhuajie@163.com>
 */
class ProductTopicController extends AdminController {

    /**
     * 产品专题列表
     * @author huajie <banhuajie@163.com>
     */
    public function index($status = null, $title = null){
    	
		if(!is_null($status)){
			$map['status'] = $status; 
		}
		
		if(!is_null($title)){
			$map['title'] = $title;
		}
		
		$map['deadline']=array('not between',array(1,time()));

	    $this->getLists($map);
	    $this->meta_title = '产品专题列表';
	    $this->display(); // 输出模板

    }
	
	    /**
     * 新增产品专题
     * @author huajie <banhuajie@163.com>
     */
    public function create(){
		$info['model_id'] = '55';

		/* 新增产品专题变量赋值 */
		//获取菜单模型
		$model = M('Model') -> where(array('id' => $info['model_id'])) -> find();

		//获取专题表单字段排序
		$fields = get_model_attribute($model['id']);
		$this -> assign('info', $info);
		$this -> assign('fields', $fields);
		$this -> assign('model', $model);
		/* 获取专题信息 */
		$this -> meta_title = '新增产品专题';
		$this -> display();
    }
	
	/**
	 * 编辑产品专题
	 */
	public function edit(){
		
		if (IS_GET) {
			$id = I('get.id', '');
			if (empty($id)) {
				$this -> error('参数不能为空！');
			}

			$info['model_id'] = '55';
			$info['id'] = $id;

			/*获取一条记录的详细数据*/
			$TchatTopic = D('Tchat_topic');
			$map = array(
				'id' => $id
			);
			$data = $TchatTopic -> where($map)->find();
			if (!$data) {
				$this -> error($TchatTopic -> getError());
			}
			//赋值data变量，将作为字段的已有数据值对应设置为字段值
			$this -> assign('data', $data);

			//获取菜单模型
			$model = M('Model') -> where(array('id' => $info['model_id'])) -> find();

			//获取表单字段排序
			$fields = get_model_attribute($model['id']);
			
			$this -> assign('info', $info);
			$this -> assign('fields', $fields);
			$this -> assign('model', $model);

		}
		$this -> meta_title = '编辑专题';
		$this -> display();
	}
	
	/**
	 * 新增或更新数据
	 */
	public function update() {
			$TchatTopic = D('Tchat_topic');
			if (IS_POST) {
				$id = I('post.id');
				if (false !== $TchatTopic -> update()) {
					if (!empty($id)) {
						$this -> success('更新成功！', U('index'));
					} else {
						$this -> success('新增成功！', U('index'));
					}
	
				} else {
					$error = $TchatTopic -> getError();
					$this -> error(empty($error) ? '未知错误！' : $error);
				}
			}
	}
	
    /**
     * 设置一条或者多条数据的状态
     * @author huajie <banhuajie@163.com>
     */
    public function setStatus($model='Tchat_topic'){
        return parent::setStatus('Tchat_topic');
    }

	//TODO 增加回收站功能

	/**
     * TODO 彻底删除一条或多条数据
     * @author huajie <banhuajie@163.com>
     */
    public function delete($ids=''){
    	if(!empty($ids)){
    		$res = D('Tchat_topic')->remove($ids);
	        if($res !== false){
	            $this->success('彻底删除成功！');
	        }else{
	            $this->error('彻底删除失败！');
	        }
    	}else{
    		$this->error('请选择要删除的数据。');
    	}
    }
	
    /**
     * 清空回收站
     * @author huajie <banhuajie@163.com>
     */
    public function clear(){
        $res = D('Tchat_topic')->remove();
        if($res !== false){
            $this->success('清空回收站成功！');
        }else{
            $this->error('清空回收站失败！');
        }
    }
	
	 /**
	 * 获取数据列表
	 * 
	 * @param array $map
	 */
    private function getLists($map){
      $list   = $this->lists('Tchat_topic',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }
}