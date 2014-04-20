<?php
// +----------------------------------------------------------------------
// | Tchat 
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.tealun.com
// +----------------------------------------------------------------------
// | Author: Tealun Du <tealun@tealun.com> <http://www.tealun.com>
// +----------------------------------------------------------------------
namespace Wechat\Logic;

class CheckInfoLogic{
	private $pregs = array(
	  0 => '[ \-\+]?',
	  1 => '[^ \+\f\n\r\t\v0-9]+',
	  2 => '(1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$',
	  4 => '(\d{5,11}))$',
	  8 => '^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$', 
	);

	public function index($num){
	  $pregs = $this->pregs;
	  foreach ($pregs as $k => $v){
	    if($this->check($num,$k)){
	      $pregStr .= $pregStr?$v:"(?:".$pregWord.")".$v;
	      
	            'hongbao'=>"/^[ \-\+]?([^ \+\f\n\r\t\v0-9]+)?[ \-\+]?((1[34578]\d{9})$|((0\d{2,3})?-?(\d{7,8}))$)?/",
	    }
	  }
	}
	
	public function check($pos = 0, $contain = 0){
    if(empty($pos) || empty($contain)){
        return false;
    }

    //将两个参数进行按位与运算，不为0则表示$contain属于$pos
    $res = $pos & $contain;
    if($res !== 0){
        return true;
    }else{
        return false;
    }
}

}
