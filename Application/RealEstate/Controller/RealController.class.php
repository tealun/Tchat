<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace RealEstate\Controller;
use Think\Controller;

class RealController extends Controller {

	public function index(){
		$test[0] = M('Config')->where(array('name'=>'CONFIG_GROUP_LIST'))->getField('value');
		$test[1] = C('CONFIG_GROUP_LIST');
		var_dump($test);
	}

}