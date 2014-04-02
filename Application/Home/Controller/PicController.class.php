<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

/**
 * 文档模型控制器
 * 文档模型列表和详情
 */
class PicController extends HomeController {

    /* 文档模型频道页 */
  public function index(){
    /* 分类信息 */
    if(!$_GET['id']){
      $this->error('页面错误，没有指定图片ID','Home/Index/index');
    }else{
      $id = $_GET['id'];
      $rs = M('Tchat_client_photo')->where(array('id'=>$id))->find();
      
      $data['pic']= $rs['url'];
      
      $client =D('Tchat_client')->getInfo($rs['client_id'],'nickname');
      $album = D('Tchat_album')->getInfo($rs['album_id'],'title,vote');
      
      $detail['client'] = $client['nickname'];
      $detail['album'] = $album['title'];
      $datail['creat_time']=$rs['creat_time'];
      
      if($album['vote']){
        $data['votes']=$rs['votes'];
      }
    }

    $this->assign('data', $data);
    $this->assign('detail',$detail);
    $this->display();
  }

  /* 个人图片列表 */
  public function mylists($openId){
    /* 分类信息 */
    $Client = $this->getClientInfo($openId);

    /* 获取当前分类列表 */
    $Photos = M('Tchat_client_photo');
    $list = $Photos->page($p, 5)->lists($category['client_id']);
    if(false === $list){
      $this->error('获取列表数据失败！');
    }

    /* 模板赋值并渲染模板 */
    $this->assign('category', $category);
    $this->assign('list', $list);
    $this->display($category['template_lists']);
  }

  /* 文档模型详情页 */
  public function detail($id = 0, $p = 1){
    /* 标识正确性检测 */
    if(!($id && is_numeric($id))){
      $this->error('文档ID错误！');
    }

    /* 页码检测 */
    $p = intval($p);
    $p = empty($p) ? 1 : $p;

    /* 获取详细信息 */
    $Document = D('Document');
    $info = $Document->detail($id);
    if(!$info){
      $this->error($Document->getError());
    }

    /* 分类信息 */
    $category = $this->category($info['category_id']);

    /* 获取模板 */
    if(!empty($info['template'])){//已定制模板
      $tmpl = $info['template'];
    } elseif (!empty($category['template_detail'])){ //分类已定制模板
      $tmpl = $category['template_detail'];
    } else { //使用默认模板
      $tmpl = 'Article/'. get_document_model($info['model_id'],'name') .'/detail';
    }

    /* 更新浏览数 */
    $map = array('id' => $id);
    $Document->where($map)->setInc('view');

    /* 模板赋值并渲染模板 */
    $this->assign('category', $category);
    $this->assign('info', $info);
    $this->assign('page', $p); //页码
    $this->display($tmpl);
  }

}