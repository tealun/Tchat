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
 *二维码管理控制器
 *
 */
class WechatQrcodeController extends WechatController {

	/**
	 * 二维码首页列表方法
	 */
	public function index() {
	    $this->getLists();
	    $this->meta_title = '二维码列表';
	    $this->display(); // 输出模板
	}

	/**
	 * 创建二维码
	 */
	public function create() {
		//获取二维码模型
		$model = M('Model') -> where(array('id' => 41)) -> find();
		$info['model_id'] = 41;
		//获取表单字段排序
		$fields = get_model_attribute($model['id']);
		$this -> assign('info', $info);
		$this -> assign('fields', $fields);
		$this -> assign('model', $model);
		
		if ($_GET['id']) {
			$data = M('Tchat_qrcode') -> find($_GET['id']);
			$this -> assign('data',$data);
			$this -> meta_title = '编辑二维码';
			$this -> display(edit);
		} else {
			$this -> meta_title = '新增二维码';
			$this -> display();
		}
	}

	/**
	 * 新增存储二维码
	 */
	public function update() {
        if(IS_POST || IS_AJAX){
		$res = D('Tchat_qrcode')->update($_POST);
		if(!$res){
              $this->error(D('Tchat_qrcode')->getError());
          }else{
		      //新增或更新成功后跳转至相应二维码的查看页面
              $this->success($res['id']?'更新成功':'新增成功', U('showQrcode',array('id',$res['id'])),1);
          }

        }else{
          $this->error('访问错误',U('index'),3);
        }
	}

    /**
     * 设置一条或者多条数据的状态
     * @author huajie <banhuajie@163.com>
     */
    public function setStatus($model='Tchat_qrcode'){
        return parent::setStatus('Tchat_qrcode');
    }
	
	/**
	 * 获取二维码TICKET
	 */
	public function getTicket($expireSeconds = "") {

		IF (!IS_AJAX) {
			halt('页面不存在');
		} ELSE {
			if (!empty($expireSeconds)) {
				$sceneArr['expire_seconds'] = $expireSeconds;
				$sceneArr['action_name'] = "QR_SCENE";
			} else {
				$sceneArr['action_name'] = "QR_LIMIT_SCENE";
				$sceneId = M('tchat_qrcode') -> max('id') + 1;
				$sceneArr['action_info'] = array('scene' => array('scene_id' => $sceneId));
			}
			//转换POST所需的JSON格式
			$content = json_encode($sceneArr,true);
			//POST提交地址
			$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . get_access_token();
			$ticket = vpost($url,$content); // 执行请求 
			$ticket = json_decode($ticket,TRUE);
			$this -> ajaxReturn($ticket, 'json');
		}
	}

	/**
	 * 通过二维码TICKET展示二维码图片
	 * @param int $id
	 */
	public function showQrcode() {
		if (IS_GET) {
			$QRcode = M('Tchat_qrcode');
			$data = $QRcode -> find($_GET['id']);
			if(IS_NULL($data)) $this -> display('index');
			$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . $data['ticket'];
			$this -> assign('data', $data);
			$this -> assign('imgUrl', $url);
			$this -> meta_title = '查看二维码';
			$this -> display();
		} else {
			$this -> display('index');
		}

	}
	
		/**
	 * 检测是否超过有效期秒数限制
	 */
	protected function expireSeconed($time) {
		if ($time >= 1800) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * 获取条目列表
	 */
	private function getLists($map=array()){
      $list   = $this->lists('Tchat_qrcode',$map);
      col_to_string($list);
    $this->assign('_list', $list);
    }

}
