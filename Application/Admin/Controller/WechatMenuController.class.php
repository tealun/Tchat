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
class WechatMenuController extends WechatController {
	
	/**
	 * 获取微信账号的验证状态
	 * 在微信后台配置中设置WECHAT_ACCOUNT_RZ配置项
	 * Enter description here ...
	 */
	 protected function getRZ(){
	 	 //如果账号没有认证过，且账号为订阅号时返回FALSE,否则返回TRUE
		 if(0 == C('WECHAT_ACCOUNT_RZ') && 0 == C('WECHAT_ACCOUNT_TYPE')){
		 	return false;
		 }else{
		   return true;
		 }
	}
	
	/**
	 * 查看目录
	 * 查看现有服务器上的目录
	 */
	public function viewMenu(){
		if($this->getRZ()){
			$json = '{"menu":{"button":[{"type":"click","name":"今日歌曲","key":"V1001_TODAY_MUSIC","sub_button":[]},{"type":"click","name":"歌手简介","key":"V1001_TODAY_SINGER","sub_button":[]},{"name":"菜单","sub_button":[{"type":"view","name":"搜索","url":"http://www.soso.com/","sub_button":[]},{"type":"view","name":"视频","url":"http://v.qq.com/","sub_button":[]},{"type":"click","name":"赞一下我们","key":"V1001_GOOD","sub_button":[]}]}]}}';
			//$json = $this->getMenu();
			$WXmenu = json_decode($json,true);
			print_r($WXmenu['menu']['button']);
			$this->assign('WXmenu',$WXmenu['menu']['button']);
			$this->assign('meta_title','查看自定义菜单');
			$this->display();
		}else{
		$this->error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}
	
	/**
	 * 配置目录
	 * 对目录进行配置，并接表单数据，将数据整理成为JSON格式的数据变量$data。
	 * 调用本类中setMenu私有方法，将$data传入生成服务器新菜单。
	 */
	public function configMenu(){
		if($this->getRZ()){
			$json = '{"menu":{"button":[{"type":"click","name":"今日歌曲","key":"V1001_TODAY_MUSIC","sub_button":[]},{"type":"click","name":"歌手简介","key":"V1001_TODAY_SINGER","sub_button":[]},{"name":"菜单","sub_button":[{"type":"view","name":"搜索","url":"http://www.soso.com/","sub_button":[]},{"type":"view","name":"视频","url":"http://v.qq.com/","sub_button":[]},{"type":"click","name":"赞一下我们","key":"V1001_GOOD","sub_button":[]}]}]}}';
			//$json = $this->getMenu();
			$WXmenu = json_decode($json,true);
			$this->assign('WXmenu',$WXmenu['menu']['button']);
			$this->assign('ButtonType',array('view','click'));
			$this->assign('meta_title','配置自定义菜单');
			$this->display();
		}else{
		$this->error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}
	
	/**
	 * 对目录条目状态进行操作
	 * @see Application/Admin/Controller/AdminController::setStatus()
	 */
	public function setStatus(){
		if($this->getRZ()){
			

		}else{
		$this->error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}
	
	/**
	 * 目录条目回收箱
	 * 已删除的目录条目列表
	 */
	public function recycle(){
	if($this->getRZ()){
			$this->assign('meta_title','自定义菜单回收站');
			$this->display();
		}else{
		$this->error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}
	
	/**
	 * 恢复已删除的条目
	 * 判断该级别菜单项是否已经满额，没有满额则设置为启用状态，满额则设置为禁用状态。
	 * @see Application/Admin/Controller/AdminController::restore()
	 */
	public function restore(){
	if($this->getRZ()){
			

		}else{
		$this->error('您的账号未进行任何认证,不能使用本功能');
		}
	}
	
	/**
	 * 清空回收站中的条目
	 * 真删除，不可恢复
	 */
	public function clear(){
	if($this->getRZ()){
			
			$this->display();
		}else{
		$this->error('您的账号未进行任何认证,不能使用本功能');
		}
	}
	
	
	/**
	 * 生成菜单到微信服务器
	 * @param  string $data 菜单的str
	 * @return string  返回的结果；
	 */
	private function setMenu($data = NULL){

		$smenu = S('WECHATADDONS_MENU');
		if ($smenu == false) {
			$access_token = get_access_token();
			$this->deleteMenu($access_token);
			$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
			$menustr = $this->http($url, $data, 'POST', array("Content-type: text/html; charset=utf-8"), true);
			$_url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$access_token}";
			$_menustr = $this->http($_url, $data);
			S('WECHATADDONS_MENU',json_decode ($_menustr, true ),15000); // 放进缓存
		} else {
			$menustr = $smenu;
		}
		return $menustr;

	}
	/**
	 * 查询微信服务器菜单
	 * @return string  返回的结果；
	 */
	private function getMenu(){

		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$access_token}";
		$menustr = $this->http($url, $data);

	}
	/**
	 * 删除微信服务器菜单
	 * @return string  返回的结果；
	 */
	private function deleteMenu(){

		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
		$menustr = $this->http($url, $data);
		return $menustr;

	}

	
	/**
	 * 发送HTTP请求方法，目前只支持CURL发送请求
	 * @param  string $url    请求URL
	 * @param  array  $params 请求参数
	 * @param  string $method 请求方法GET/POST
	 * @return array  $data   响应数据
	 */
	private function http($url, $params, $method = 'GET', $header = array(), $multi = false){
		$opts = array(
				CURLOPT_TIMEOUT        => 30,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_HTTPHEADER     => $header
		);
	
		/* 根据请求类型设置特定参数 */
		switch(strtoupper($method)){
			case 'GET':
				$param = is_array($params)?'?'.http_build_query($params):'';
				$opts[CURLOPT_URL] = $url . $param;
				break;
			case 'POST':
				//判断是否传输文件
				//$params = $multi ? $params : http_build_query($params);
				$opts[CURLOPT_URL] = $url;
				$opts[CURLOPT_POST] = 1;
				$opts[CURLOPT_POSTFIELDS] = $params;
				break;
			default:
				throw new \Think\ThinkException('不支持的请求方式！');
		}
	
		/* 初始化并执行curl请求 */
		$ch = curl_init();
		curl_setopt_array($ch, $opts);
		$data  = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if($error) throw new \Think\ThinkException('请求发生错误：' . $error);
		return  $data;
	}
}