<?php
	/**
	 * select返回的数组进行整数映射转换
	 *
	 * @param array $map  映射关系二维数组  array(
	 *                                          '字段名1'=>array(映射关系数组),
	 *                                          '字段名2'=>array(映射关系数组),
	 *                                           ......
	 *                                       )
	 * @author 朱亚杰 <zhuyajie@topthink.net>
	 * @return array
	 *
	 *  array(
	 *      array('id'=>1,'title'=>'标题','status'=>'1','status_text'=>'正常')
	 *      ....
	 *  )
	 *
	 */
function col_to_string(&$data,$map=array(
										'status'=>array(1=>'正常',-1=>'已删',0=>'禁用'),
										'reply_type'=>array('text'=>'文本','news'=>'分类','document'=>'文章','music'=>'音乐','special','专属'),
										'segment'=>array('events'=>'事件','costom'=>'自定义','activity'=>'活动','activity_ticket'=>'优惠券')
										)) {
	    if($data === false || $data === null ){
	        return $data;
	    }
	    $data = (array)$data;
	    foreach ($data as $key => $row){
	        foreach ($map as $col=>$pair){
	            if(isset($row[$col]) && isset($pair[$row[$col]])){
	                $data[$key][$col.'_text'] = $pair[$row[$col]];
	            }
	        }
	    }
	    return $data;
	}
	
	/**
 * 获取关键字模型信息
 * @param  integer $id    模型ID
 * @param  string  $field 模型字段
 * @return array
 */
function get_keyword_model($id = null, $field = null){
    static $list;

    /* 非法分类ID */
    if(!(is_numeric($id) || is_null($id))){
        return '';
    }

    /* 读取缓存数据 */
    if(empty($list)){
        $list = S('KEYWORD_MODEL_LIST');
    }

    /* 获取模型名称 */
    if(empty($list)){
        $map   = array('status' => 1, 'extend' => 4);
        $model = M('Tchat_keyword_group')->where($map)->field(true)->select();
        foreach ($model as $value) {
            $list[$value['id']] = $value;
        }
        S('KEYWORD_MODEL_LIST', $list); //更新缓存
    }

    /* 根据条件返回数据 */
    if(is_null($id)){
        return $list;
    } elseif(is_null($field)){
        return $list[$id];
    } else {
        return $list[$id][$field];
    }
}

/**
 * 获取指定关键词分组的关键词列表
 * Enter description here ...
 * @param $groupId
 */
function get_keyword($groupId){
    	$arr = M('Tchat_keyword')->where(array('group_id'=>$groupId))->getField('id,keyword');
    	return $keywords = arr2str($arr);
}