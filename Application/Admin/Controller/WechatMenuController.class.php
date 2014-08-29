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
	 * 查看菜单
	 * 查看现有服务器上的目录
	 */
	public function viewMenu() {
		if ($this -> getRZ()) {
			$tree = D('Tchat_menu') -> getTree(0, 'id,sort,name,pid,status');
			$this -> assign('tree', $tree);
			C('_TCHAT_GET_MENU_TREE_', true);
			//标记系统获取分类树模板
			$this -> assign('meta_title', '查看自定义菜单');
			$this -> display();
		} else {
			$this -> error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}

	/**
	 * 显示菜单树，仅支持内部调
	 * @param  array $tree 菜单树
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function tree($tree = null) {
		C('_TCHAT_GET_MENU_TREE_') || $this -> _empty();
		$this -> assign('tree', $tree);
		$this -> display('tree');
	}

	/**
	 * 编辑自定义菜单
	 */
	public function edit($id = null, $pid = 0) {

		if (IS_GET) {
			$id = I('get.id', '');
			if (empty($id)) {
				$this -> error('参数不能为空！');
			}

			$info['model_id'] = '52';
			$info['id'] = $id;
			$info['pid'] = $pid;

			/*获取一条记录的详细数据*/
			$TchatMenu = D('Tchat_menu');
			$data = $TchatMenu -> info($id);
			if (!$data) {
				$this -> error($TchatMenu -> getError());
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
		//如果有传入上级菜单ID，判断上级菜单的状态并且获取相关信息
		if ($pid) {
			/* 获取上级菜单信息 */
			$pidInfo = $TchatMenu -> info($pid, 'id,name,status');
			if (!($pidInfo && 1 == $pidInfo['status'])) {
				$this -> error('指定的上级菜单不存在或被禁用！');
			}
			//赋值上级菜单信息,这个变量要以JSON格式发送到页面的JAVASCRIPT脚本使用
			$pidInfo = json_encode($pidInfo);
			$pidInfo = decodeUnicode($pidInfo);
			$this -> assign('pidInfo', $pidInfo);
		}

		$this -> meta_title = '编辑菜单';
		$this -> display();

	}

	/**
	 * 新增自定义菜单
	 */
	public function add($pid = 0) {
		$TchatMenu = D('Tchat_menu');
		$info['model_id'] = '52';
		if ($pid) {
			/* 获取上级菜单信息 */
			$pidInfo = $TchatMenu -> info($pid, 'id,name,status');
			if (!($pidInfo && 1 == $pidInfo['status'])) {
				$this -> error('指定的上级菜单不存在或被禁用！');
			} else {
				//获取到的上级菜单信息，用于添加二级菜单时的数据
				$pidInfo = json_encode($pidInfo);
				$pidInfo = decodeUnicode($pidInfo);
				$this -> assign('pidInfo', $pidInfo);
			}
		}
		/* 新增菜单页面的变量赋值 */

		//获取菜单模型
		$model = M('Model') -> where(array('id' => $info['model_id'])) -> find();

		//获取表单字段排序
		$fields = get_model_attribute($model['id']);
		$this -> assign('info', $info);
		$this -> assign('fields', $fields);
		$this -> assign('model', $model);
		/* 获取菜单信息 */
		$this -> meta_title = '新增菜单';
		$this -> display();

	}

	/**
	 * 新增或更新数据
	 */
	public function update() {

		$TchatMenu = D('Tchat_menu');
		if (IS_POST) {
			$id = I('post.id');
			if (false !== $TchatMenu -> update()) {
				if (!empty($id)) {
					$this -> success('更新成功！', U('viewMenu'));
				} else {
					$this -> success('新增成功！', U('viewMenu'));
				}

			} else {
				$error = $TchatMenu -> getError();
				$this -> error(empty($error) ? '未知错误！' : $error);
			}
		}

	}

	/**
	 * 删除一个菜单
	 * @author huajie <banhuajie@163.com>
	 */
	public function remove() {
		$menu_id = I('id');
		if (empty($menu_id)) {
			$this -> error('参数错误!');
		}

		//判断该菜单下有没有子菜单，有则不允许删除
		$child = M('Tchat_menu') -> where(array('pid' => $menu_id)) -> field('id') -> select();
		if (!empty($child)) {
			$this -> error('请先删除该菜单下的子菜单');
		}

		//删除该菜单信息
		$res = M('Tchat_menu') -> delete($menu_id);
		if ($res !== false) {
			//记录行为
			action_log('delete_tchat_menu', 'tchatMenu', $menu_id, UID);
			$this -> success('删除菜单成功！');
		} else {
			$this -> error('删除菜单失败！');
		}
	}

	/**
	 * 更改状态
	 * TODO 对目录条目状态进行操作
	 * @see Application/Admin/Controller/AdminController::setStatus()
	 */
	public function setStatus() {
		if ($this -> getRZ()) {

		} else {
			$this -> error('您的微信账号为[订阅账号]，且未进行任何认证,不能使用本功能');
		}
	}


	/**
	 * 生成菜单到微信服务器
	 * @param  string $data 菜单的array
	 * @return string  返回的结果；
	 */
	public function setMenu() {
		//if (IS_POST) {
		$tree = D('Tchat_menu') -> getTree(0, 'id,pid,menu_type,name,event_key,url');
		
		//清理掉$tree中用于排序和分级而获取到的字段，这些字段不需要发送到服务器		
		$menu['button'] = $this -> clearTreeArr($tree);
		
		//使用PHP的json_decode()函数将数组转换为JSON格式，但汉字会变成 \uxxxx形式的问题
		$content = json_encode($menu,true);
		
		//使用一个函数解决转换过来的JSON数据中汉字变成 \uxxxx形式的问题
		$content = decodeUnicode($content);

		//POST提交地址
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . get_access_token();
		$rs = vpost($url, $content);

		if ($rs) {
			$this -> success('更新成功！');
		} else {
			$this -> error('更新失败！');
		}

	}

	/**
	 * 查询微信服务器菜单
	 * @return string  返回的结果；
	 */
	private function getMenu() {

		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$access_token;
		$menustr = vget($url);
		return $menustr;
	}

	/**
	 * 将获取到的目录树整理成为符合微信目录JSON数据的结构
	 */
	private function clearTreeArr($arr) {
		if (is_array($arr)) {
			foreach ($arr as $key => $value) {

				//删除不必要的ID PID选项
				unset($arr[$key]['id'], $arr[$key]['pid']);

				//如果类型是BUTTON的话，就删除TYPE键位和键值
				if ($arr[$key]['menu_type'] == 'button') {
					unset($arr[$key]['menu_type']);
				} else {
					$arr[$key]['type'] = $arr[$key]['menu_type'];
					unset($arr[$key]['menu_type']);
				}

				//如果键值为空的字段，则直接去掉
				if (empty($arr[$key]['event_key'])) {
					unset($arr[$key]['event_key']);
				} else {
					$arr[$key]['key'] = $arr[$key]['event_key'];
					unset($arr[$key]['event_key']);
				}

				if (empty($arr[$key]['url']))
					unset($arr[$key]['url']);

				//判断是否有二级菜单，有则再进行一次自身遍历
				if (is_array($arr[$key]['_'])) {

					//将目录树里的二级键位替换为sub_button，并清空原键位数据
					$arr[$key]['sub_button'] = $this -> clearTreeArr($arr[$key]['_']);
					unset($arr[$key]['_']);
				}
			}
		}
		return $arr;
	}

	/**
	 * 删除微信服务器菜单
	 * @return string  返回的结果；
	 */
	private function deleteMenu() {

		$access_token = get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=" . $access_token;
		$menustr = vget($url);
		$status = json_decode($menustr);
		var_dump($status);
		if ($status) {
			$this -> error($status);
		} else {
			return TRUE;
		}
	}

}
