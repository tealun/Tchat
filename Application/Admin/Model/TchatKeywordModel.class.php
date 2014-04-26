<?php

namespace Admin\Model;
use Think\Model;
use Admin\Model\AuthGroupModel;

/**
 * 关键词模型
 */
class TchatKeywordModel extends Model{
	    //初始化参数定义
		private $new = array();
		private $old = array();
		
		/**
		 * 新增或编辑关键词
		 * @param string $keywordStr
		 * @param int $groupId
		 */
        public function update($keywordStr,$groupId){
    	$condition = array('，',' ','|');
    	$keywordStr = str_replace($condition, ',', $keywordStr);
		//将接收到的关键字进行转换成新的数组
    	$this->new = str2arr($keywordStr);
		//查看数据库中是否存在该GROUP_ID的关键字，并赋值到OLD数组变量中
    	$this->old = $this->where(array('group_id'=>$groupId))->getField('id,keyword');
		//存在该GROUP_ID的关键字，则进行关键字的过滤
    	if(!empty($this->old)){
    		//对新旧关键字进行过滤，过滤出需要删除和新添加的关键字
			$filter = $this->keywordFilter($this->new, $this->old);
			//删除关键字
			if(!empty($filter['delete'])){
			$map['id']  = array('in',$filter['delete']);
			  $this->where($map)->delete();
			}
			//新增关键字
			if(!empty($filter['create'])){
				foreach ($filter['create'] as $v){
				$dataList[] = array(
					'keyword'=>$v,
					'group_id' =>$groupId,
					);
				}
				$this->addAll($dataList);
			}
		//系统数据库中没有该GROUP_ID时，则新增关键字
		}else{
			foreach ($this->new as $v){
				$dataList[] = array(
					'keyword'=>$v,
					'group_id' =>$groupId,
					);
				}
			$this->addAll($dataList);
		}
	}
	
	/**
	 * 新旧关键字过滤方法
	 * @param array $new
	 * @param array $old
	 */
	private function keywordFilter($new,$old){

		//获取旧关键字中新关键词没有的词的ID，用于删除记录
		$delete = $this->deleteFilter($old);
		$filter['delete'] = array_keys($delete);
		unset($delete);
		
		//获取新关键字中旧关键词没有的值，用于新增记录
		$create = $this->createFilter($new);
		$filter['create'] = array_values($create);
		unset($create);
		
		return $filter;
		}
	
	/**
	 * 过滤粗来需要删除的关键词
	 * 返回以ID为键名，关键词为键值的数组
	 * @param array $old
	 */
	private function deleteFilter($old){
		$new = $this->new;
	foreach ($old as $k=>$v){
		if (!in_array($v, $new)){
		$delete[$k] = $v;
		}
	}
	return $delete?$delete:false;
	}
	
	/**
	 * 过滤粗来需要新增的关键词
	 * 返回要新增的关键词数组
	 * @param array $new
	 */
	private function createFilter($new){
		$old = $this->old;
	foreach ($new as $v){
		if (!in_array($v, $old)){
		$create[] = $v;
		}
	}
	return $create?$create:false;
	}
}

