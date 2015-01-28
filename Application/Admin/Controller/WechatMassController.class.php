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
 * 群发消息管理控制器
 *
 */
class WechatMassController extends WechatController {


	/**
	 * 创建新的群发消息
	 * @param $copyId num 要复制的消息ID，为空时不复制直接创建新消息
	 */
	public function createMassMessage($copyId=''){
		
		$this->display('create');
	}
	
	/**
	 * 编辑一条群发消息
	 * 只针对状态为本地草稿的才可编辑
	 */
	public function editMassMessage(){
		
		$this->display('edit');
	}
	
	/**
	 * 查看已发送的消息
	 */
	public function listMassMessages(){
        $Document   =   D('Tchat_mass_massage');
        $map        =   array('status'=>array('gt',1),'uid'=>UID);
        $list       =   $this->lists($Document,$map);

        $this->assign('list', $list);
        $this->meta_title = '查看已发送的消息';
        $this->display('list');
	}
	
	/**
     * 草稿箱
     * @author huajie <banhuajie@163.com>
     */
    public function draftBox(){
        $Document   =   D('Tchat_mass_massage');
        $map        =   array('status'=>3,'uid'=>UID);
        $list       =   $this->lists($Document,$map);

        $this->assign('list', $list);
        $this->meta_title = '群发消息草稿箱';
        $this->display();
    }
	
	/**
	 * 回收站
	 */
	public function recycle(){
		$map['status'] = array('eq',-1);
		$this->getLists($map);
		$this->meta_title = '群发消息回收站';
		$this->display(); // 输出模板
	}
	
	/**
	 * 触发群发
	 * 群发有两种方式，一种是根据分组群发，一种是根据OPENID群发
	 */
	public function sendMassMessage(){
		if(IS_POST || IS_AJAX){
			$sendType=I('post.send_type');
			if($sendType == 'group'){
				//这里是按分组群发代码
			}else{
				//这里是按openid群发代码
			}
		}
		
	}
	
	/**
	 * 设置状态
	 * 设置一条群发消息的状态，主要是本地删除和本地恢复操作
	 * -1为本地删除[回收站] 0为本地[草稿]未上传 1为已上传微信端[待发送] 2为已提交在[发送中]可刷新状态 3为发送[成功] 4为发送[失败]可重发
	 */
	public function setStatus(){
		
	}
	
	/**
	 * 刷新消息的发送状态
	 * 当消息上传到微信端后，消息状态为发送中时，可通过本方法获取一条群发消息的最新状态，并更新到状态中
	 * @param $messageId string 微信服务器上的msg_id
	 */
	public function renewSendStatus($messageId){

	}
	
	/**
	 * 从本地和服务器删除一条群发消息
	 * @param $messageId string 微信服务器上的msg_id
	 */
	public function deleteMessage($messageId){
		
	}
	
	/**
	 * 群发预览
	 * 将编辑好的消息发送到指定微信号预览排版和样式
	 * @param $openId   string 要发送预览到关注者的微信号openId
	 * @param $msgtype  string 发送的预览消息类型
	 * @param $mediaId  string 消息的media_id，文本类型的消息此处传入为消息文本内容
	 * @author Tealun Du
	 */
	public function previewMassMessage($openId,$msgtype,$mediaId){
		if(IS_POST || IS_AJAX){
			/*整理发送的数据为数组*/
			if($msgtype !== 'text'){//如果msgtype不是文本类型，就将传入的$mediaId字符串整理为数组，为文本时就是字符串内容；
				$mediaId = array('media_id'=>$mediaId);
			}
			$data = array(
						'touser'=>$openId, //接收者的OPENID
						$msgtype=>$mediaId, //传送的内容
						'msgtype'=>$msgtype //传送的消息类型
						);
			$data = json_encode($data);//整理数据为json格式
			
			/*开始发送数据*/
			$url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=".get_access_token();
			$json = vpost($url,$data); //获取返回的json数据
			$respons = json_decode($json); //json数据转数组
			
			/*返回预览状态*/
			if($respons['errcode'] == 0){ //判断是否成功
				$this->ajaxReturn('已发送到指定账号，请注意查看');
			}else{//错误时返回错误提示
				$errMessage = get_wechat_response($respons['errcode']);
				$this->ajaxReturn($errMessage);
			}
		}
	}
	
	/**
	 * 上传图文消息
	 */
	private function uploadNews($news=array()){
		$url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=".get_access_token();
	}
	
	
}
