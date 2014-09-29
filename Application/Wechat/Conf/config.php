<?php
define('CLIENT_PHOTO','./Uploads/Wechat/Client/Picture/');
define('CLIENT_VOICE','./Uploads/Wechat/Client/Voice/');
define('CLIENT_VIDEO','./Uploads/Wechat/Client/Video/');
define('TCHAT_PHOTO','./Uploads/Wechat/Tchat/Picture/');
define('TCHAT_VOICE','./Uploads/Wechat/Tchat/Voice/');
define('TCHAT_VIDEO','./Uploads/Wechat/Tchat/Video/');
return array(

	/* 文件上传相关配置 */
    'DOWNLOAD_UPLOAD' => array(
        'mimes'    => '', //允许上传的文件MiMe类型
        'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
        'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml,mar,mp3', //允许上传的文件后缀
        'autoSub'  => true, //自动子目录保存文件
        'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Wechat/', //保存根路径
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt'  => '', //文件保存后缀，空则使用原后缀
        'replace'  => false, //存在同名是否覆盖
        'hash'     => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ), //下载模型上传配置（文件上传类配置）
	
    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'onethink_wechat', //session前缀
    'COOKIE_PREFIX'  => 'onethink_wechat_', // Cookie前缀 避免冲突
    
    'SHOW_PAGE_TRACE'  => '0' // 页面TRACE关闭
);