-- -----------------------------
-- 说明：本SQL文件用于旧版本向新版本的更新SQL
-- -----------------------------

INSERT INTO `onethink_tchat_events` VALUES ('4','关键词没有结果','KeywordNoMatch','','','1','客户在发送关键词后没有查找到关键词对应内容时的回复。');
INSERT INTO `onethink_tchat_events` VALUES ('5','分类中没有文章','CategoryNoArticle','','','1','查找某个分类下的内容却没有任何正常状态下的文章时的回复。');

INSERT INTO `onethink_menu` VALUES ('440','创建群发消息','300','0','Admin/WechatMass/createMassMessage','0','创建一条新的群发消息','群发管理','0');
INSERT INTO `onethink_menu` VALUES ('441','触发发送','440','0','Admin/WechatMass/sendMassMessage','0','触发一条消息的发送动作','','0');
INSERT INTO `onethink_menu` VALUES ('442','预览消息','440','0','Admin/WechatMass/previewMassMessage','0','预览一条编辑后的群发消息','','0');
INSERT INTO `onethink_menu` VALUES ('443','查看群发消息','300','0','Admin/WechatMass/listMassMessage','0','查看当前所有的群发消息','群发管理','0');
INSERT INTO `onethink_menu` VALUES ('444','更改状态','443','0','Admin/WechatMass/setStatus','0','更改一条上传了的群发消息的发送状态','','0');
INSERT INTO `onethink_menu` VALUES ('445','刷新状态','443','0','Admin/WechatMass/renewSendStatus','0','刷新一条上传了的群发消息的发送状态','','0');
INSERT INTO `onethink_menu` VALUES ('446','草稿箱','300','0','Admin/WechatMass/draftBox','0','查看草稿箱里的群发消息','群发管理','0');
INSERT INTO `onethink_menu` VALUES ('447','编辑','446','0','Admin/WechatMass/editMassMessage','0','编辑一条草稿箱中的群发消息','','0');
INSERT INTO `onethink_menu` VALUES ('448','回收站','300','0','Admin/WechatMass/recycle','0','查看已在本地删除的群发消息','群发管理','0');
INSERT INTO `onethink_menu` VALUES ('449','彻底删除','448','0','Admin/WechatMass/deleteMessage','0','彻底删除本地和微信上的一条群发消息','','0');

INSERT INTO `onethink_menu` VALUES ('656', '前台主题模板配置', '68', '5', 'HomeControl/theme', '0', '用于配置前台默认的主题模板', '前台配置', '0');

INSERT INTO `onethink_menu` VALUES ('690', '查看版本', '68', '0', 'Admin/Update/index', '0', '用于配置首页特色内容展示', '系统升级', '0');
INSERT INTO `onethink_menu` VALUES ('691', '升级系统', '690', '0', 'Admin/Update/index', '0', '用于配置首页特色内容展示', '', '0');


INSERT INTO `onethink_auth_rule` VALUES ('341', 'admin', '1', 'Admin/WechatMass/createMassMessage','创建群发消息','1','');
INSERT INTO `onethink_auth_rule` VALUES ('342', 'admin', '1', 'Admin/WechatMass/sendMassMessage','触发发送','1','');
INSERT INTO `onethink_auth_rule` VALUES ('343', 'admin', '1', 'Admin/WechatMass/previewMassMessage','预览群发','1','');
INSERT INTO `onethink_auth_rule` VALUES ('344', 'admin', '1', 'Admin/WechatMass/listMassMessage','查看群发消息','1','');
INSERT INTO `onethink_auth_rule` VALUES ('345', 'admin', '1', 'Admin/WechatMass/setStatus','更改状态','1','');
INSERT INTO `onethink_auth_rule` VALUES ('346', 'admin', '1', 'Admin/WechatMass/renewSendStatus','刷新状态','1','');
INSERT INTO `onethink_auth_rule` VALUES ('347', 'admin', '1', 'Admin/WechatMass/draftBox','草稿箱','1','');
INSERT INTO `onethink_auth_rule` VALUES ('348', 'admin', '1', 'Admin/WechatMass/editMassMessage','编辑','1','');
INSERT INTO `onethink_auth_rule` VALUES ('349', 'admin', '1', 'Admin/WechatMass/recycle','回收站','1','');
INSERT INTO `onethink_auth_rule` VALUES ('350', 'admin', '1', 'Admin/WechatMass/deleteMessage','彻底删除','1','');

INSERT INTO `onethink_auth_rule` VALUES ('605', 'admin', '1', 'Admin/HomeControl/theme', '前台主题模板配置', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('650', 'admin', '1', 'Admin/Update/index', '查看版本', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('651', 'admin', '1', 'Admin/Update/update', '升级系统', '1', '');

UPDATE `onethink_auth_group` SET `title`='管理员组',`description` = '用于网络管理人员的帐号组',`rules` = '1,2,3,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,34,36,37,38,39,40,41,46,47,48,49,50,51,52,53,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,100,102,103,107,108,109,110,195,207,211,213,214,215,216,300,301,302,303,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,400,401,402,403,404,405,406,407,408,409,410,411,412,413,450,451,452,453,454,455,456,457,458,459,460,461,464,465,466,467,468,469,470,471,472,473,474,475,550,551,552,553,554,555,600,601,602,603,604,605,650' WHERE `id` ='2' limit 1;
UPDATE `onethink_auth_rule` SET `name`='Admin/HomeControl/feature',`status` = '1' WHERE `id` ='604' limit 1 ;

-- -----------------------------
-- Table structure for `onethink_tchat_mass_message`
-- -----------------------------

DROP TABLE IF EXISTS `onethink_tchat_mass_message`;
CREATE TABLE `onethink_tchat_mass_message` (
	`id` int(10) unsigned NOT NULL auto_increment COMMENT '本地消息ID',
	`msg_id` int(10) unsigned NOT NULL COMMENT'云端消息ID',
	`msgtype` varchar(100) NOT NULL DEFAULT 'text' COMMENT '消息类型',
	`group_id` tinyint(2) NOT NULL DEFAULT '0' COMMENT '分组ID',
	`touser` text NOT NULL DEFAULT '' COMMENT '发送到的用户ID集合，留空为全部',
	`content` text NOT NULL DEFAULT '' COMMENT '消息内容，为字符串json数据格式',
	`status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '消息状态，-1为本地删除[回收站] 0为本地[草稿]未上传 1为已上传微信端[待发送] 2为已提交在[发送中]可刷新状态 3为发送[成功] 4为发送[失败]可重发',
	`uid` int(10) unsigned NOT NULL DEFAULT '2' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY  (`id`),
  INDEX(`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信群发消息数据表';

