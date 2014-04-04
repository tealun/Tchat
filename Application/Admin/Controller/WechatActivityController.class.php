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
     * 获取列表
     * 
     * @param array $map
     */
    private function getLists($map){
      $list   = $this->lists('Tchat_activity',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }
}
