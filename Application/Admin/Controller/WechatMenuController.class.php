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
		 if(0 == C('WECHAT_ACCOUNT_RZ')){
		 	return false;
		 }else{
		   return true;
		 }
	}
	
	public function viewMenu(){
	
	}
	
	public function configMenu(){
	
	}
	
	public function setStatus(){
	
	}
	
	public function recycle(){
	
	}
	
	public function restore(){
	
	}
	
	public function clear(){
	
	}
	
	
	/**
	 * 生成菜单到微信服务器
	 * @param  string $data 菜单的str
	 * @return string  返回的结果；
	 */
	public function setMenu($data = NULL){

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