<?php
namespace Install\Controller;
use Think\Controller;
use Think\Db;
use Think\Storage;

class TestController extends Controller{

	public function test(){
	$sql = file_get_contents(MODULE_PATH . 'Data/install.sql');
	//Tchat 载入Wechat数据
	$sql .= file_get_contents(MODULE_PATH . 'Data/tchat.sql');
	echo $sql;
}
}