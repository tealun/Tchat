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
	protected function getRZ() {
		//如果账号没有认证过，且账号为订阅号时返回FALSE,否则返回TRUE
		if (0 == C('WECHAT_ACCOUNT_RZ') && 0 == C('WECHAT_ACCOUNT_TYPE')) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * 查看目录
	 * 查看现有服务器上的目录
	 */
	public function viewMenu() {
		if ($this -> getRZ()) {
			$menu = $this->getMenu();
			$this -> assign('meta_title', '查看自定义菜单');
			$this -> assign('menu',$menu);
			$this -> display();
			var_dump($menu);
		} else {
			$this -> error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}

	/**
	 * 配置目录
	 * 对目录进行配置，并接表单数据，将数据整理成为JSON格式的数据变量$data。
	 * 调用本类中setMenu私有方法，将$data传入生成服务器新菜单。
	 */
	public function configMenu() {
		if ($this -> getRZ()) {

		}
	}

	/**
	 * 对目录条目状态进行操作
	 * @see Application/Admin/Controller/AdminController::setStatus()
	 */
	public function setStatus() {
		if ($this -> getRZ()) {

		} else {
			$this -> error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}

	/**
	 * 目录条目回收箱
	 * 已删除的目录条目列表
	 */
	public function recycle() {
		if ($this -> getRZ()) {
			$this -> assign('meta_title', '自定义菜单回收站');
			$this -> display();
		} else {
			$this -> error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}

	/**
	 * 恢复已删除的条目
	 * 判断该级别菜单项是否已经满额，没有满额则设置为启用状态，满额则设置为禁用状态。
	 * @see Application/Admin/Controller/AdminController::restore()
	 */
	public function restore() {
		if ($this -> getRZ()) {

		} else {
			$this -> error('您的账号未进行任何认证,不能使用本功能');
		}
	}

	/**
	 * 清空回收站中的条目
	 * 真删除，不可恢复
	 */
	public function clear() {
		if ($this -> getRZ()) {

			$this -> display();
		} else {
			$this -> error('您的账号未进行任何认证,不能使用本功能');
		}
	}

	/**
	 * 生成菜单到微信服务器
	 * @param  string $data 菜单的array
	 * @return string  返回的结果；
	 */
	private function setMenu($data = array()) {
			if (IS_POST) {
				$content = $data;
				//POST提交地址
				$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . get_access_token();
				vpost($url, $content)?
					$this->success('更新成功！') : 
					$this->error('更新失败！');
			}
		return $menustr;
	}

	/**
	 * 查询微信服务器菜单
	 * @return string  返回的结果；
	 */
	private function getMenu() {

		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$access_token}";
		return $menustr = vget($url);
		
	}

	/**
	 * 删除微信服务器菜单
	 * @return string  返回的结果；
	 */
	private function deleteMenu() {

		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
		$menustr = $this -> http($url, $data);
		return $menustr;

	}

}
