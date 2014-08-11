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
 * 微信活动板块控制器
 * 
 */
class WechatActivityController extends WechatController {

	/**
	 * 正常活动列表
	 * @see Application/Admin/Controller/WechatController::index()
	 */
	public function index(){
    $map=$this->indexOfMap();
    $map['deadline'] = array('not between',array(1,time()));
    $this->getLists($map);
    $this->meta_title = '活动列表';
    $this->display(); // 输出模板
	}

      /**
     * 查询条件初始化
     *
     */
    protected function indexOfMap(){
        /* 查询条件初始化 */
        $map = array();
        if(isset($_GET['actType'])){
            $map['act_type']  = (string)$_GET['actType'];
            $this->assign('actType', $map['act_type']);
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
   * 创建新活动
   */
  public function create(){
        //获取活动模型
    if(isset($_GET['model_id'])){
        $info['model_id']= $_GET['model_id'];
	    $model = M('Model')->where(array('id'=>$info['model_id']))->find();
            //获取表单字段排序
        $fields = get_model_attribute($model['id']);
	    $this->assign('info',$info);
 		$this->assign('fields',$fields);
        $this->assign('model', $model);
        $this->meta_title = '新增活动';
        $this->display();
     }else{
     	$this->display('modellist');
     }
  }
  
    /**
     * update one record
     * @author huajie <banhuajie@163.com>
     */
    public function update(){
        if(IS_POST || IS_AJAX){
          $res = D('Tchat_activity')->update($_POST);
          if(!$res){
              $this->error(D('Tchat_activity')->getError());
          }else{
              $this->success($res['id']?'更新成功':'新增成功', U('index'),1);
          }
        }else{
          $this->error('访问错误',U('index'),3);
        }
    }
    
    /**
     * 保存草稿
     * TODO 将活动详情保存草稿
     */
    public function autoSave(){
    echo ('This page is under construction');
    }
  /**
   * edit one Activity
   */
  public function edit(){
    $id     =   I('get.id','');
        if(empty($id)){
            $this->error('参数不能为空！');
        }
      
      /*获取一条记录的详细数据*/
        $Activity =D('Tchat_activity');
        $data = $Activity->detail($id);
        if(!$data){
            $this->error( $Activity->getError());
        }
        //读取该条目模型ID
        $info['model_id']= $data['model_id'];
        //获取所属模型属性列表
        $model = M('Model')->where(array('id'=>$info['model_id']))->find();
    
            //获取表单字段排序
        $fields = get_model_attribute($model['id']);
		$this->assign('data',$data);
        $this->assign('info',$info);
        $this->assign('fields',     $fields);
        $this->assign('model', $model);
        $this->meta_title = '编辑活动';
        $this->display();

  }
  
    /**
     * 设置一条或者多条数据的状态
     * @author huajie <banhuajie@163.com>
     */
    public function setStatus($model='Tchat_activity'){
        return parent::setStatus('Tchat_activity');
    }
    
    /**
     * 草稿箱
     * @author huajie <banhuajie@163.com>
     */
    public function draftBox(){
        $Document   =   D('Tchat_activity');
        $map        =   array('status'=>3,'uid'=>UID);
        $list       =   $this->lists($Document,$map);
        //获取状态文字
        //int_to_string($list);

        $this->assign('list', $list);
        $this->meta_title = '草稿箱';
        $this->display();
    }

  /**
   * 禁用箱
   */
  public function disabled(){
    $map['status'] = array('eq',0);
    $map['deadline'] = array('not between',array(1,time()));
    $this->getLists($map);
    $this->meta_title = '已禁用活动';
    $this->display(); // 输出模板
  }
  
  /**
   * 回收站
   */
  public function recycle(){
    $map['status'] = array('eq',-1);
    $this->getLists($map);
    $this->meta_title = '活动回收站';
    $this->display(); // 输出模板
  }
  
  /**
   * \(non-PHPdoc)还原数据
   * @see Application/Admin/Controller/AdminController::restore()
   */
  public function restore($Model='Tchat_activity'){
      $ids    =   I('request.ids');
        if(empty($ids)){
            $this->error('请选择要操作的数据');
        }
        $map['id'] = array('in',$ids);
         return parent::restore('Tchat_activity',$map);
  }
  
    /**
     * 清空回收站
     * @author huajie <banhuajie@163.com>
     */
    public function clear(){
        $res = D('Tchat_activity')->remove();
        if($res !== false){
            $this->success('清空回收站成功！');
        }else{
            $this->error('清空回收站失败！');
        }
    }
    
    //TODO 导入活动
    public function batchOperate(){
    
    }
	
    /**
     * 获取数据列表
     * 
     * @param array $map
     */
    private function getLists($map){
      $list   = $this->lists('Tchat_activity',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }
}
