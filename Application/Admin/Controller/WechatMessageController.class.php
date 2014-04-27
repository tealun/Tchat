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
 * 客户消息管理控制器
 * 
 */
class WechatMessageController extends WechatController {

	public function index(){
	 echo ('This page is under construction');
	}
	
	/**
	 * 将指定ID消息列为星标消息
	 * POST过来ID的话，为此ID消息星标处理
	 * 非POST访问则输出星标消息
	 */
	public function setStar(){
	echo ('This page is under construction');
	}
	
	public function analytical(){
	 echo ('This page is under construction');
	}
	
	public function handle(){
	 echo ('This page is under construction');
	}
	
	/**
	 * 存档消息
	 * 将指定条件的消息存档成文件形式，并删除数据库中的数据
	 * TODO 将存档消息导出到EXL格式文件供下载备份
	 */
	public function archive(){
	echo ('This page is under construction');
	}
	
	public function delete(){
	echo ('This page is under construction');
	}
	
	public function reply(){
	echo ('This page is under construction');
	}
	
}