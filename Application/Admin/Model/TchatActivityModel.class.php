<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;
use Admin\Model\AuthGroupModel;

/**
 * 文档基础模型
 */
class TchatActivityModel extends Model{

    /* 自动验证规则 */
    protected $_validate = array(
        array('name', '/^[a-zA-Z]\w{0,39}$/', '文档标识不合法', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', 'checkName', '标识已经存在', self::VALUE_VALIDATE, 'callback', self::MODEL_BOTH),
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,80', '标题长度不能超过80个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
      array('level', '/^[\d]+$/', '优先级只能填正整数', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
        //TODO: 外链编辑验证
        //array('link_id', 'url', '外链格式不正确', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
        array('description', '1,140', '简介长度不能超过140个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
        array('model_id', 'require', '模型不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_INSERT),
        array('model_id', 'checkModel', '该模型不存在', self::EXISTS_VALIDATE , 'callback', self::MODEL_UPDATE),
        array('deadline', '/^\d{4,4}-\d{1,2}-\d{1,2}(\s\d{1,2}:\d{1,2}(:\d{1,2})?)?$/', '日期格式不合法,请使用"年-月-日 时:分"格式,全部为数字', self::VALUE_VALIDATE  , 'regex', self::MODEL_BOTH),
        array('create_time', '/^\d{4,4}-\d{1,2}-\d{1,2}(\s\d{1,2}:\d{1,2}(:\d{1,2})?)?$/', '日期格式不合法,请使用"年-月-日 时:分"格式,全部为数字', self::VALUE_VALIDATE  , 'regex', self::MODEL_BOTH),
    array('content', 'getContent', '内容不能为空！', self::MUST_VALIDATE , 'callback', self::MODEL_BOTH),
    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('title', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
        array('description', 'htmlspecialchars', self::MODEL_BOTH, 'function'),
      array('root', 'getRoot', self::MODEL_BOTH, 'callback'),
        array('link_id', 'getLink', self::MODEL_BOTH, 'callback'),
        array('attach', 0, self::MODEL_INSERT),
        array('view', 0, self::MODEL_INSERT),
        array('comment', 0, self::MODEL_INSERT),
        array('extend', 0, self::MODEL_INSERT),
        array('create_time', 'getCreateTime', self::MODEL_BOTH,'callback'),
    array('reply_time', 'getCreateTime', self::MODEL_INSERT,'callback'),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
        array('position', 'getPosition', self::MODEL_BOTH, 'callback'),
        array('check_info', 'getCheckInfo', self::MODEL_BOTH, 'callback'),
        array('deadline', 'strtotime', self::MODEL_BOTH, 'function'),
    );

    /**
     * 获取活动列表
     * @param  integer  $model    活动所属模型ID
     * @param  string   $order    排序规则
     * @param  integer  $status   状态
     * @param  boolean  $count    是否返回总数
     * @param  string   $field    字段 true-所有字段
     * @param  string   $limit    分页参数
     * @param  array    $map      查询条件参数
     * @return array              文档列表
     * @author huajie <banhuajie@163.com>
     */
    public function lists($model="", $order = '`id` DESC', $status = 1, $field = true, $limit = '10', $map = array()){
        if(empty($model) || $model == 6){
          $model = M('Model')->where(array('pid'=>6))->getFeild('id');
        }
    $map = array_merge($this->listMap($model, $status), $map);
        return $this->field($field)->where($map)->order($order)->limit($limit)->select();
    }

    /**
     * 计算列表总数
     * @param  number  $model    模型ID
     * @param  integer $status   状态
     * @return integer           总数
     */
    public function listCount($model, $status = 1, $map = array()){
        $map = array_merge($this->listMap($model, $status), $map);
        return $this->where($map)->count('id');
    }

    /**
     * 获取详情页数据
     * @param  integer $id 文档ID
     * @return array       详细数据
     */
    public function detail($id){
        /* 获取基础数据 */
        $info = $this->field(true)->find($id);
        if(!(is_array($info) || 1 !== $info['status'])){
            $this->error = '活动被禁用或已删除！';
            return false;
        }

        /* 获取扩展模型数据 */
        $logic  = $this->logic($info['model_id']);
        $detail = $logic->detail($id); //获取指定ID的数据
        if(!$detail){
            $this->error = $logic->getError();
            return false;
        }
        return array_merge($info, $detail);
    }

    /**
     * 返回前一活动信息
     * @param  array $info 当前文档信息
     * @return array
     */
    public function prev($info){
        $map = array(
            'id'          => array('lt', $info['id']),
            'status'      => 1,
        );

        /* 返回前一条数据 */
        return $this->field(true)->where($map)->order('id DESC')->find();
    }

    /**
     * 获取下一活动基本信息
     * @param  array    $info 当前文档信息
     * @return array
     */
    public function next($info){
        $map = array(
            'id'          => array('gt', $info['id']),
            'status'      => 1,
        );

        /* 返回下一条数据 */
        return $this->field(true)->where($map)->order('id')->find();
    }

    /**
     * 新增或更新一个活动
     * @param array  $data 手动传入的数据
     * @return boolean fasle 失败 ， int  成功 返回完整的数据
     * @author huajie <banhuajie@163.com>
     */
    public function update($data = null){
      /* 检查文档类型是否符合要求 */
      $res = $this->checkDocumentType( I('type'), I('pid') );
      if(!$res['status']){
        $this->error = $res['info'];
        return false;
      }

        /* 获取数据对象 */
        $data = $this->create($data);
        if(empty($data)){
            return false;
        }

        /* 添加或新增基础内容 */
        if(empty($data['id'])){ //新增数据
            $id = $this->add(); //添加基础内容
            if(!$id){
                $this->error = '新增基础内容出错！';
                return false;
            }
        } else { //更新数据
            $status = $this->save(); //更新基础内容
            if(!$status){
                $this->error = '更新基础内容出错！';
                return false;
            }
        }

    if($data['model_id'] !== 6){
          /* 添加或新增扩展内容 */
          $logic = $this->logic($data['model_id']);
          if(!$logic->update($id)){
              if(isset($id)){ //新增失败，删除基础数据
                  $this->delete($id);
              }
              $this->error = $logic->getError();
              return false;
          }      
    }


        hook('documentSaveComplete', array('model_id'=>$data['model_id']));

        //行为记录
        if($id){
          action_log('add_document', 'document', $id, UID);
        }

        //内容添加或更新完成
        return $data;
    }

    /**
     * 获取段落列表
     * @param  integer $id    文档ID
     * @param  integer $page  显示页码
     * @param  boolean $field 查询字段
     * @param  boolean $logic 是否查询模型数据
     * @return array
     */
    public function part($id, $page = 1, $field = true, $logic = true){
        $map  = array('status' => 1, 'type' => 3, 'pid' => $id);
        $info = $this->field($field)->where($map)->page($page, 10)->order('id')->select();
        if(!$info) {
            $this->error = '该文档没有段落！';
            return false;
        }

        /* 不获取段落详情 */
        if(!$logic){
            return $info;
        }

        /* 获取段落详情 */
        $model = $logic = array();
        foreach ($info as $value) {
            $model[$value['model_id']][] = $value['id'];
        }
        foreach ($model as $model_id => $ids) {
            $data   = $this->logic($model_id)->lists($ids);
            $logic += $data;
        }

        /* 合并数据 */
        foreach ($info as &$value) {
            $value = array_merge($value, $logic[$value['id']]);
        }

        return $info;
    }

    /**
     * 获取指定文档的段落总数
     * @param  number $id 段落ID
     * @return number     总数
     */
    public function partCount($id){
        $map = array('status' => 1, 'type' => 3, 'pid' => $id);
        return $this->where($map)->count('id');
    }

    /**
     * 获取推荐位数据列表
     * @param  number  $pos      推荐位 1-列表推荐，2-频道页推荐，4-首页推荐
     * @param  number  $model    模型ID
     * @param  number  $limit    列表行数
     * @param  boolean $filed    查询字段
     * @return array             数据列表
     */
    public function position($pos, $model = null, $limit = null, $field = true){
        $map = $this->listMap($model, 1, $pos);

        /* 设置列表数量 */
        is_numeric($limit) && $this->limit($limit);

        /* 读取数据 */
        return $this->field($field)->where($map)->select();
    }

    /**
     * 获取数据状态
     * @return integer 数据状态
     */
    protected function getStatus(){
      $id = I('post.id');
        if(empty($id)){  //新增
          $status = 1;
        }else{        //更新
      $status = $this->getFieldById($id, 'status');
      //编辑草稿改变状态
      if($status == 3){
        $status = 1;
      }
        }
        return $status;
    }

    /**
     * 获取根节点id
     * @return integer 数据id
     * @author huajie <banhuajie@163.com>
     */
    protected function getRoot(){
      $pid = I('post.pid');
      if($pid == 0){
        return 0;
      }
      $pRoot = $this->getFieldById($pid, 'root');
      return $pRoot == 0 ? $pid : $Root;
    }

    /**
     * 创建时间不写则取当前时间
     * @return int 时间戳
     * @author huajie <banhuajie@163.com>
     */
    protected function getCreateTime(){
        $createTime    =   I('post.create_time');
        return $createTime?strtotime($createTime):NOW_TIME;
    }

    /**
     * 验证模型是否存在
     * @param  integer $id 模型ID
     * @return boolean     true-存在，false-不存在
     */
    public function checkModel($id){
        $status = M("model")->where(array('id'=>$id))->getField('id');
        return $status ? true : false;
    }

    /**
     * 获取扩展模型对象
     * @param  integer $model 模型编号
     * @return object         模型对象
     */
    private function logic($model){
        return D(get_activity_model($model, 'name'), 'Logic');
    }

    /**
     * 设置where查询条件
     * @param  number  $model    模型ID
     * @param  number  $pos      推荐位
     * @param  integer $status   状态
     * @return array             查询条件
     */
    private function listMap($model, $status = 1, $pos = null){
        /* 设置状态 */
        $map = array('status' => $status);

        /* 设置分类 */
        if(!is_null($model)){
            if(is_numeric($model)){
                $map['model_id'] = $model;
            } else {
                $map['model_id'] = array('in', str2arr($model));
            }
        }

        /* 设置推荐位 */
        if(is_numeric($pos)){
            $map[] = "position & {$pos} = {$pos}";
        }

        return $map;
    }

    /**
     * 检查标识是否已存在(只需在同一根节点下不重复)
     * @param string $name
     * @return true无重复，false已存在
     * @author huajie <banhuajie@163.com>
     */
    protected function checkName(){
        $name = I('post.name');
        $pid = I('post.pid', 0);
        $id = I('post.id', 0);

        //获取根节点
        if($pid == 0){
          $root = 0;
        }else{
          $root = $this->getFieldById($pid, 'root');
          $root = $root == 0 ? $pid : $root;
        }

        $map = array('root'=>$root, 'name'=>$name, 'id'=>array('neq',$id));
        $res = $this->where($map)->getField('id');
        if($res){
          return false;
        }
        return true;
    }

    /**
     * 生成不重复的name标识
     * @author huajie <banhuajie@163.com>
     */
    private function generateName(){
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789';  //源字符串
        $min = 10;
        $max = 39;
        $name = false;
        while (true){
            $length = rand($min, $max);  //生成的标识长度
            $name = substr(str_shuffle(substr($str,0,26)), 0, 1);  //第一个字母
            $name .= substr(str_shuffle($str), 0, $length);
            //检查是否已存在
            $res = $this->getFieldByName($name, 'id');
            if(!$res){
                break;
            }
        }
        return $name;
    }

    /**
     * 生成推荐位的值
     * @return number 推荐位
     * @author huajie <banhuajie@163.com>
     */
    protected function getPosition(){
        $position = I('post.position');
        if(!is_array($position)){
            return 0;
        }else{
            $pos = 0;
            foreach ($position as $key=>$value){
                $pos += $value;    //将各个推荐位的值相加
            }
            return $pos;
        }
    }

    /**
     * 生成验证信息的值
     * @return number 验证信息
     * @author huajie <banhuajie@163.com>
     */
    protected function getCheckInfo(){
        $checkInfo = I('post.check_info');
        if(!is_array($checkInfo)){
            return 0;
        }else{
            $check = 0;
            foreach ($checkInfo as $key=>$value){
                $check += $value;    //将各个推荐位的值相加
            }
            return $check;
        }
    }

    /**
     * 删除状态为-1的数据（包含扩展模型）
     * @return true 删除成功， false 删除失败
     * @author huajie <banhuajie@163.com>
     */
    public function remove(){
        //查询假删除的基础数据

        $map = array('status'=>-1);

        $baseList = $this->where($map)->field('id,model_id')->select();
        //删除扩展模型数据
        $baseIds = array_column($baseList,'id');
        //孤儿数据
        $orphan   = get_stemma( $baseIds,$this, 'id,model_id');

        $allList  = array_merge( $baseList,$orphan );
        foreach ($allList as $key=>$value){
            $logic = $this->logic($value['model_id']);
            $logic->delete($value['id']);
        }

        //删除基础数据
        $ids = array_merge( $baseIds, (array)array_column($orphan,'id') );
        if(!empty($ids)){
          $res = $this->where( array( 'id'=>array( 'IN',trim(implode(',',$ids),',') ) ) )->delete();
        }

        return $res;
    }

    /**
     * 获取链接id
     * @return int 链接对应的id
     * @author huajie <banhuajie@163.com>
     */
    protected function getLink(){
        $link = I('post.link_id');
        if(empty($link)){
            return 0;
        } else if(is_numeric($link)){
            return $link;
        }else{
          $res = D('Url')->update(array('url'=>$link));
          return $res['id'];
        }

    }

    /**
     * 保存为草稿
     * @return array 完整的数据， false 保存出错
     * @author huajie <banhuajie@163.com>
     */
    public function autoSave(){
        $post = I('post.');

        /* 检查文档类型是否符合要求 */
        $res = $this->checkDocumentType( I('type'), I('pid') );
        if(!$res['status']){
          $this->error = $res['info'];
          return false;
        }

        //触发自动保存的字段
        $saveList = array('name','title','description','position','link_id','cover_id','deadline','create_time','content');
        foreach ($saveList as $value){
            if(!empty($post[$value])){
                $ifSave = true;
                break;
            }
        }

        if(!$ifSave){
            $this->error = '您未填写任何内容';
            return false;
        }

        //重置自动验证
        $this->_validate = array(
            array('name', '/^[a-zA-Z]\w{0,39}$/', '文档标识不合法', self::VALUE_VALIDATE, 'regex', self::MODEL_BOTH),
            array('name', '', '标识已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
            array('title', '1,80', '标题长度不能超过80个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
            array('description', '1,140', '简介长度不能超过140个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
            array('model_id', 'require', '模型不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
            array('model_id', 'checkModel', '该模型不存在', self::EXISTS_VALIDATE , 'callback', self::MODEL_UPDATE),
            array('deadline', '/^\d{4,4}-\d{1,2}-\d{1,2}(\s\d{1,2}:\d{1,2}(:\d{1,2})?)?$/', '日期格式不合法,请使用"年-月-日 时:分"格式,全部为数字', self::VALUE_VALIDATE  , 'regex', self::MODEL_BOTH),
            array('create_time', '/^\d{4,4}-\d{1,2}-\d{1,2}(\s\d{1,2}:\d{1,2}(:\d{1,2})?)?$/', '日期格式不合法,请使用"年-月-日 时:分"格式,全部为数字', self::VALUE_VALIDATE  , 'regex', self::MODEL_BOTH),
      array('content', 'getContent', '内容不能为空！', self::MUST_VALIDATE , 'callback', self::MODEL_BOTH),
        );
        $this->_auto[] = array('status', '3', self::MODEL_BOTH);

        if(!($data = $this->create())){
            return false;
        }

        /* 添加或新增基础内容 */
        if(empty($data['id'])){ //新增数据
            $id = $this->add(); //添加基础内容
            if(!$id){
          $this->error = '新增基础内容出错！';
                return false;
            }
            $data['id'] = $id;
        } else { //更新数据
            $status = $this->save(); //更新基础内容
            if(!$status){
          $this->error = '更新基础内容出错！';
                return false;
            }
        }

        /* 添加或新增扩展内容 */
        $logic = $this->logic($data['model_id']);
        if(!$logic->autoSave($id)){
            if(isset($id)){ //新增失败，删除基础数据
                $this->delete($id);
            }
            $this->error = $logic->getError();
            return false;
        }

        //内容添加或更新完成
        return $data;
    }

    /**
     * 获取目录列表
   * TODO 检测是否缓存会造成不同根节点缓存的混乱
     * @param intger $pid 目录的根节点
     * @return boolean
     * @author huajie <banhuajie@163.com>
     */
    public function getDirectoryList($pid = null){
      if(empty($pid)){
        return false;
      }
      $tree = S('sys_directory_tree');
    if(empty($tree)){
      $res = $this->getChild($pid);
      S('sys_directory_tree', $tree);
    }
    return $res;
    }

    /**
     * 递归查询子活动文档
     * @param intger $pid
     * @return array: 子活动文档数组
     * @author huajie <banhuajie@163.com>
     */
    private function getChild($pid){
      $tree = array();
      $map = array('status'=>1,'type'=>1);
      if(is_array($pid)){
        $map['pid'] = array('in', implode(',', $pid));
      }else{
        $map['pid'] = $pid;
      }
    /* 查找出所有指定PID的数据列表 */
      $child = $this->where($map)->field('id,name,title,pid')->order('level DESC,id DESC')->select();
      if(!empty($child)){
        foreach ($child as $key=>$value){
          $pids[] = $value['id']; //遍历出所有数据ID值
        }
      /*再递归查找出所有PID为数据列表中的ID的深层数据*/
        $tree = array_merge($child, $this->getChild($pids));
      }
      return $tree;
    }

  /**
   * 获取活动的详细内容
   * @return boolean
   * @author huajie <banhuajie@163.com>
   */
  protected function getContent(){
    $type = I('post.type');
    $content = I('post.content');
    if($type > 1){  //主题和段落必须有内容
      if(empty($content)){
        return false;
      }
    }else{      //目录没内容则生成空字符串
      if(empty($content)){
        $_POST['content'] = ' ';
      }
    }
    return true;
  }

    /**
     * 检查指定文档下面子文档的类型
     * @param intger $type 子文档类型
     * @param intger $pid 父文档类型
     * @return array 键值：status=>是否允许（0,1），'info'=>提示信息
     * @author huajie <banhuajie@163.com>
     */
    public function checkDocumentType($type = null, $pid = null){
      $res = array('status'=>1, 'info'=>'');
    if(empty($type)){
      return array('status'=>0, 'info'=>'文档类型不能为空');
    }
    if(empty($pid)){
      return $res;
    }
    //查询父文档的类型
    if(is_numeric($pid)){
      $ptype = $this->getFieldById($pid, 'type');
    }else{
      $ptype = $this->getFieldByName($pid, 'type');
    }
    //父文档为目录时
    if($ptype == 1){
      return $res;
    }
    //父文档为主题时
    if($ptype == 2){
      if($type != 3){
        return array('status'=>0, 'info'=>'主题下面只允许添加段落');
      }else{
        return $res;
      }
    }
    //父文档为段落时
    if($ptype == 3){
      return array('status'=>0, 'info'=>'段落下面不允许再添加子内容');
    }
    return array('status'=>0, 'info'=>'父文档类型不正确');
    }

}
