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
    $this->meta_title = '关键词列表';
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
    
  public function disabled(){
    $map['status'] = array('eq',0);
    $map['deadline'] = array('not between',array(1,time()));
    $this->getLists($map);
    $this->meta_title = '已禁用关键词';
    $this->display(); // 输出模板
  }
  
  public function recycle(){
    $map['status'] = array('eq',-1);
    $this->getLists($map);
    $this->meta_title = '关键词回收站';
    $this->display(); // 输出模板
  }
  
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
