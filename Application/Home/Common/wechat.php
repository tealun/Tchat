<?php 

function timeTip($time){
  $num = time()-$time;
  if($num < 3600){
    $num = floor($num/60);
    $re = $num.'分钟';
  }elseif (3600<=$num && $num < 86400){
    $num = floor($num/3600);
    $re = $num.'小时';
  }elseif (86400<=$num && $num < 604800){
    $num = floor($num/86400);
    $re = $num.'天';
  }elseif (604800<=$num && $num < 31449600){
    $num = floor($num/604800);
    $re = $num.'周';
  }elseif (31449600<=$num){
    $num = floor($num/31449600);
    $re = $num.'年';
  }
  return $re;
}

function get_model_column_name($model_id,$column){
	    /* 非法ID */
    if(empty($model_id) || !is_numeric($model_id)){
        return '';
    }
	
	   $map = array('model_id'=>$model_id);
       return M('attribute')->where($map)->getFieldByName($column,'title');
}

?>