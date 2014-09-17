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
 * 后台产品套餐控制器
 * @author huajie <banhuajie@163.com>
 */
class ProductPlanController extends AdminController {

    /**
     * 产品套餐列表
     * @author huajie <banhuajie@163.com>
     */
    public function index($status = null, $title = null){
    	
		if(!is_null($status)){
			$map['status'] = $status; 
		}
		
		if(!is_null($title)){
			$map['title'] = $title;
		}
		
		$map['deadline']=array('not between',array(1000000000,time()));

	    $this->getLists($map);
	    $this->meta_title = '产品套餐列表';
	    $this->display(); // 输出模板

    }
	
	    /**
     * 新增产品套餐
     * @author huajie <banhuajie@163.com>
     */
    public function create(){
		$info['model_id'] = '54';

		/* 新增产品套餐变量赋值 */
		//获取菜单模型
		$model = M('Model') -> where(array('id' => $info['model_id'])) -> find();

		//获取套餐表单字段排序
		$fields = get_model_attribute($model['id']);
		$this -> assign('info', $info);
		$this -> assign('fields', $fields);
		$this -> assign('model', $model);
		/* 获取套餐信息 */
		$this -> meta_title = '新增产品套餐';
		$this -> display();
    }
	
	/**
	 * 编辑产品套餐
	 */
	public function edit(){
		
		if (IS_GET) {
			$id = I('get.id', '');
			if (empty($id)) {
				$this -> error('参数不能为空！');
			}

			$info['model_id'] = '54';
			$info['id'] = $id;

			/*获取一条记录的详细数据*/
			$TchatPlan = D('Tchat_plan');
			$map = array(
				'id' => $id
			);
			$data = $TchatPlan -> where($map)->find();
			if (!$data) {
				$this -> error($TchatPlan -> getError());
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
		$this -> meta_title = '编辑套餐';
		$this -> display();
	}
	
	/**
	 * 新增或更新数据
	 */
	public function update() {
			$TchatPlan = D('Tchat_plan');
			if (IS_POST) {
				$id = I('post.id');
				if (false !== $TchatPlan -> update()) {
					if (!empty($id)) {
						$this -> success('更新成功！', U('index'));
					} else {
						$this -> success('新增成功！', U('index'));
					}
	
				} else {
					$error = $TchatPlan -> getError();
					$this -> error(empty($error) ? '未知错误！' : $error);
				}
			}
	}
	
    /**
     * 设置一条或者多条数据的状态
     * @author huajie <banhuajie@163.com>
     */
    public function setStatus($model='Tchat_plan'){
        return parent::setStatus('Tchat_plan');
    }

	//TODO 增加回收站功能

	/**
     * TODO 彻底删除一条或多条数据
     * @author huajie <banhuajie@163.com>
     */
    public function delete($ids=''){
    	if(!empty($ids)){
    		$res = D('Tchat_plan')->remove($ids);
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
        $res = D('Tchat_plan')->remove();
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
      $list   = $this->lists('Tchat_plan',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }
}