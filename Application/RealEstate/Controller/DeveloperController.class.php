<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------

namespace Realestate\Controller;
use Think\Controller;

class DeveloperController extends Controller{

	public function brief (){
	$brief = S("DEVELOPERBRIEF")?S("DEVELOPERBRIEF"):"还没有介绍文字呢。";
	var_dump($brief);
	}
	
	public function projects(){
	
	}
	
	public function history(){
	
	}
	
	public function honors (){
	
	}
	
}