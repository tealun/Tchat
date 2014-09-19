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
 * 关键字管理控制器
 * 
 */
class WechatKeywordController extends WechatController {
  
  public function index(){
    $map=$this->indexOfKeyword();
    $map['deadline'] = array('not between',array(1,time()));
	//$map['segment'] = array('in',array('0'));
    $this->getLists($map);
    $this->meta_title = '关键词组列表';
    $this->display(); // 输出模板
  }
  
  /**
   * create new keyword group
   */
  public function create(){
        //获取关键词分组模型
    $model = M('Model')->where(array('id'=>5))->find();
    $info['model_id']= '5';
            //获取表单字段排序
        $fields = get_model_attribute($model['id']);
    $this->assign('info',$info);
    $this->assign('fields',     $fields);
        $this->assign('model', $model);
        $this->meta_title = '新增关键词分组';
        $this->display();

  }
  
    /**
     * update one record
     * @author huajie <banhuajie@163.com>
     */
    public function update(){
        if(IS_POST || IS_AJAX){
          $res = D('Tchat_keyword_group')->update($_POST);
          if(!$res){
              $this->error(D('Tchat_keyword_group')->getError());
          }else{
              $this->success($res['id']?'更新成功':'新增成功', U('index'),1);
          }
        }else{
          $this->error('访问错误',U('index'),3);
        }
    }
  
  /**
   * edit one keyword group
   */
  public function edit(){
    $id     =   I('get.id','');
        if(empty($id)){
            $this->error('参数不能为空！');
        }
    
        $info['model_id']= '5';
      
      /*获取一条记录的详细数据*/
        $KeywordGroup =D('Tchat_keyword_group');
        $data = $KeywordGroup->detail($id);
        if(!$data){
            $this->error($KeywordGroup->getError());
        }
        $this->assign('data',$data);
      
        //获取关键词分组模型
        $model = M('Model')->where(array('id'=>$info['model_id']))->find();
    
            //获取表单字段排序
        $fields = get_model_attribute($model['id']);
        $this->assign('info',$info);
        $this->assign('fields',     $fields);
        $this->assign('model', $model);
        $this->meta_title = '编辑关键词分组';
        $this->display();

  }
  
  /**
   * Analytical of keywords
   */
  public function analytical(){
    $topics = array('接收','热门','建议');
    $this->assign('topics',$topics);
    $this->display();
  }
  
  /**
   * List of keyword group that allready dead.
   * Enter description here ...
   */
  public function deadList(){
    $map['status'] = array('egt',0);
    $map['deadline'] = array('between',array(1,time()));
    $this->getLists($map);
    $this->meta_title = '已过期关键词';
    $this->display(); // 输出模板
  }
  
  /**
   * List of keyword group that be disabled.
   * Enter description here ...
   */
  public function disabled(){
    $map['status'] = array('eq',0);
    $map['deadline'] = array('not between',array(1,time()));
    $this->getLists($map);
    $this->meta_title = '已禁用关键词';
    $this->display(); // 输出模板
  }
  
  /**
   * List of keyword group that were deleted
   */
  public function recycle(){
    $map['status'] = array('eq',-1);
    $this->getLists($map);
    $this->meta_title = '关键词回收站';
    $this->display(); // 输出模板
  }
  
  /**
   * (non-PHPdoc) restore a keyword group which was deleted.
   * @see Application/Admin/Controller/AdminController::restore()
   */
  public function restore($Model='Tchat_keyword_group'){
      $ids    =   I('request.ids');
        if(empty($ids)){
            $this->error('请选择要操作的数据');
        }
        $map['id'] = array('in',$ids);
         return parent::restore('Tchat_keyword_group',$map);
  }
  
    /**
     * clear the recycle box
     * @author huajie <banhuajie@163.com>
     */
    public function clear(){
        $res = D('Document')->remove();
        if($res !== false){
            $this->success('清空回收站成功！');
        }else{
            $this->error('清空回收站失败！');
        }
    }
  
  /**
   * List categoris
   * TODO 此方法未生成目录及规则
   */
  public function catlist(){
    if(IS_POST || IS_AJAX){
      $this->display();
    }else{
      $this->error('访问错误','index.php',2);
    }
  }

  
  /**
   * 初始化查询条件
   */
  protected function indexOfKeyword(){
        /* 查询条件初始化 */
        $map = array();
        if(isset($_GET['segment'])){
            $map['segment']  = (string)$_GET['segment'];
            $this->assign('segment', $map['segment']);
        }
        if(isset($_GET['keyword'])){
            $map['name']  = array('like', '%'.(string)I('keyword').'%');
            $this->assign('keyword', $_GET['keyword']);
        }
        if(isset($_GET['status'])){
            $map['status'] = I('status');
            $status = $map['status'];
        }else{
            $status = null;
      $map['status'] = array('egt',0);
        }

        if ( isset($_GET['time-start']) ) {
            $map['update_time'][] = array('egt',strtotime(I('time-start')));
        }
        if ( isset($_GET['time-end']) ) {
            $map['update_time'][] = array('elt',24*60*60 + strtotime(I('time-end')));
        }
        if ( isset($_GET['nickname']) ) {
            $map['uid'] = M('Member')->where(array('nickname'=>I('nickname')))->getField('uid');
        }
    return $map;
    }
  
  
    /**
     * 设置一条或者多条数据的状态
     * @author huajie <banhuajie@163.com>
     */
    public function setStatus($model='Tchat_keyword_group'){
        return parent::setStatus('Tchat_keyword_group');
    }
    
	/**
	 * 获取数据列表
	 */
    private function getLists($map){
      $list   = $this->lists('Tchat_keyword_group',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }


}