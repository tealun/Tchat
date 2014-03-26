<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model;

/**
 * 相册模型
 */
class TchatAlbumModel extends Model{

	/**
	 * 获取相册详细信息
	 * @param  milit   $id 相册id
	 * @param  boolean $field 查询字段
	 * @return array     相册信息
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function getInfo($id, $field = true){
		/* 获取客户信息 */
		$map = array();
		if(is_numeric($id)){ //通过ID查询
			$map['id'] = $id;
		} else { //通过标识查询
			$map['name'] = $id;
		}
		return $this->field($field)->where($map)->find();
	}

}
