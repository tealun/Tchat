-- -----------------------------
-- Records of  `onethink_attribute`
-- -----------------------------

INSERT INTO `onethink_attribute` VALUES ('33', 'keyword', '关键词', 'varchar(100) NOT NULL ', 'string', '', '多个关键词请用英文半角逗号隔开', '1', '', '4', '0', '1', '1394597230', '1394597230', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('34', 'group_id', '关键词分组ID', 'int(8) unsigned NOT NULL ', 'string', '', '', '0', '', '4', '0', '1', '1394597230', '1394597230', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('35', 'name', '关键词标题', 'varchar(100) NOT NULL ', 'string', '', '为本组关键词取个标题', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('36', 'segment', '板块', 'enum(''costom'',''activity'',''events'',''activity_ticket'') NOT NULL', 'select', 'costom', '关键词组所属板块', '1', 'costom:自定义\r\nactivity:活动\r\nevents:事件\r\nactivity_ticket:优惠券', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('37', 'segment_id', '板块条目ID', 'int(5) NOT NULL ', 'num', '0', '', '0', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('38', 'reply_type', '回复类型', 'enum(''text'',''image'',''news'',''document'',''music'',''url'') NOT NULL ', 'select', 'text', '', '1', 'text:文本\r\nimage:图片\r\nnews:新闻分类\r\ndocument:文章组合\r\nmusic:音乐\r\nurl:链接', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('39', 'reply_id', '回复内容', 'varchar(255) NOT NULL ', 'string', '', '文本及新闻分类只需要一个ID值，文章为多个ID', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('40', 'start_time', '生效时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '设置关键词的<strong>生效时间</strong>', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('41', 'deadline', '失效时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '设置关键词的<strong>失效时间</strong>', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('42', 'dead_text', '失效后回复文本', 'varchar(255) NOT NULL ', 'string', '55', '', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('43', 'status', '是否启用', 'tinyint(2) NOT NULL ', 'bool', '1', '设置添加后的状态', '1', '1:启用\r\n0:禁用', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('44', 'uid', '用户ID', 'int(10) unsigned NOT NULL ', 'num', '0', '', '0', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('45', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'datetime', 'CURRENT_TIMESTAMP', '', '0', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');



-- -----------------------------
-- Records of  `onethink_model`
-- -----------------------------

INSERT INTO `onethink_model`  VALUES ('4', 'tchat_keyword', '关键词', '0', '', '1', '{"1":["33","34"]}', '1:基础', '', '', '', '', 'keyword:关键词\r\ngroup_id:分组', '10', '', '', '1394597229', '1394597323', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('5', 'group', '关键词分组', '4', '', '1', '{"1":["35","33","36","37","38","39","40","41","42","43","44","45"]}', '1:微信设置', '', '', '', '', 'name:关键词组\r\nsegment:所属板块\r\nreply_type:回复类型\r\nstatus:状态', '10', '', '', '1394597354', '1394602636', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('6', 'activity', '关键词分组', '0', '', '1', '{"1":["35","33","36","37","38","39","40","41","42","43","44","45","46"]}', '1:基础2:', '', '', '', '', 'name:关键词组\r\nsegment:所属板块\r\nreply_type:回复类型\r\nstatus:状态', '10', '', '', '1394597354', '1394602636', '1', 'MyISAM');



-- -----------------------------
-- Records of  `onethink_auth_extend`
-- -----------------------------

INSERT INTO `onethink_auth_extend` VALUES ('2','1','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','2','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','11','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','12','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','13','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','14','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','21','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','22','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','23','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','24','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','31','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','32','1');
INSERT INTO `onethink_auth_extend` VALUES ('2','33','1');

INSERT INTO `onethink_auth_extend` VALUES ('4','1','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','2','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','11','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','12','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','13','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','14','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','21','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','22','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','23','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','24','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','31','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','32','1');
INSERT INTO `onethink_auth_extend` VALUES ('4','33','1');


INSERT INTO `onethink_auth_extend` VALUES ('5','21','1');
INSERT INTO `onethink_auth_extend` VALUES ('5','23','1');

-- -----------------------------
-- Records of `onethink_auth_group`
-- -----------------------------
UPDATE `onethink_auth_group` SET `title`='管理组',`description` = '用于公司管理人员的帐号组',`rules` = '1,2,3,5,7,8,9,10,11,12,13,14,15,16,17,18,26,36,37,38,39,40,41,65,67,68,69,70,71,72,73,74,79,88,89,90,91,92,93,107,108,109,110,211,214,215,216,316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375' WHERE `id` ='2' limit 1;
INSERT INTO `onethink_auth_group` VALUES ('3', 'admin', '1', '领导组', '用于领导人员的帐号组', '1', '1,2,17,316,318,322,323,335,337,349,350,351,352,353,354,355,356,357,358,362,364,370');
INSERT INTO `onethink_auth_group` VALUES ('4', 'admin', '1', '行政组', '用于行政人员的帐号组', '1', '1,2,7,8,9,10,11,12,13,14,15,16,17,18,79,211,316,318,319,320,321,322,323,334,337,338,339,340,341,342,343,344,345,346,347,348,349,350,351,352,353,354,355,356,357,358,359,360,361,362,364,365,366,367,368,369,370,371,372,373,374,375');
INSERT INTO `onethink_auth_group` VALUES ('5', 'admin', '1', '活动组', '用于活动管理人员的帐号组', '1', '1,2,7,8,9,10,11,12,13,14,15,16,17,18,79,211,316,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,335,336,337,343,349,350,351,352,353,354,355,356,357,358,359,361,362,364,365,366,367,368,370,371,372,373,374');
INSERT INTO `onethink_auth_group` VALUES ('6', 'admin', '1', '终端组', '用于面向客户的工作人员的帐号组', '1', '1,316,318,323,337,343,349,350,351,352,353,354,355,356,357,359,361,362,364,370');

-- -----------------------------
-- Records of `onethink_auth_group_access`
-- -----------------------------

INSERT INTO `onethink_auth_group_access` VALUES ('2','2');
INSERT INTO `onethink_auth_group_access` VALUES ('3','3');
INSERT INTO `onethink_auth_group_access` VALUES ('4','3');
INSERT INTO `onethink_auth_group_access` VALUES ('5','4');
INSERT INTO `onethink_auth_group_access` VALUES ('6','5');
INSERT INTO `onethink_auth_group_access` VALUES ('7','6');

-- -----------------------------
-- Records of `onethink_auth_rule`
-- -----------------------------
INSERT INTO `onethink_auth_rule` VALUES ('300', 'admin', '2', 'Admin/Wechat/index', '微信', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('301', 'admin', '1', 'Admin/Config/group?id=5','配置微信', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('302', 'admin', '1', 'Admin/WechatKeyword/index','关键词列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('303', 'admin', '1', 'Admin/WechatKeyword/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('304', 'admin', '1', 'Admin/WechatKeyword/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('305', 'admin', '1', 'Admin/WechatKeyword/setStatus','改变状态', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('306', 'admin', '1', 'Admin/WechatKeyword/analytical','关键词分析', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('307', 'admin', '1', 'Admin/WechatKeyword/deadList','过期箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('308', 'admin', '1', 'Admin/WechatKeyword/disabled','禁用箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('309', 'admin', '1', 'Admin/WechatKeyword/recycle','回收站', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('310', 'admin', '1', 'Admin/WechatKeyword/restore','还原', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('311', 'admin', '1', 'Admin/WechatKeyword/clean','彻底删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('312', 'admin', '1', 'Admin/WechatActivity/index','活动列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('313', 'admin', '1', 'Admin/WechatActivity/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('314', 'admin', '1', 'Admin/WechatActivity/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('315', 'admin', '1', 'Admin/WechatActivity/setStatus','改变状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('316', 'admin', '1', 'Admin/WechatActivity/update','保存', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('317', 'admin', '1', 'Admin/WechatActivity/autoSave','保存草稿', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('318', 'admin', '1', 'Admin/WechatActivity/move','移动', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('319', 'admin', '1', 'Admin/WechatActivity/copy','复制', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('320', 'admin', '1', 'Admin/WechatActivity/paste','粘贴', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('321', 'admin', '1', 'Admin/WechatActivity/batchOperate','导入', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('322', 'admin', '1', 'Admin/WechatActivity/delete','删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('323', 'admin', '1', 'Admin/WechatActivity/analytical','活动分析', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('324', 'admin', '1', 'Admin/WechatActivity/draft','活动草稿箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('325', 'admin', '1', 'Admin/WechatActivity/recycle','活动回收站', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('326', 'admin', '1', 'Admin/WechatActivity/restore','还原', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('327', 'admin', '1', 'Admin/WechatActivity/clean','彻底删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('328', 'admin', '1', 'Admin/WechatClient/index','客户列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('329', 'admin', '1', 'Admin/WechatClient/detail','客户信息', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('330', 'admin', '1', 'Admin/WechatMessage/index','消息列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('331', 'admin', '1', 'Admin/WechatMessage/text','文字消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('332', 'admin', '1', 'Admin/WechatMessage/photo','图片消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('333', 'admin', '1', 'Admin/WechatMessage/audio','声讯消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('334', 'admin', '1', 'Admin/WechatMessage/video','视频消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('335', 'admin', '1', 'Admin/WechatMessage/location','位置消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('336', 'admin', '1', 'Admin/WechatMessage/url','链接消息', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('337', 'admin', '1', 'Admin/WechatMessage/analytical','消息分析', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('338', 'admin', '1', 'Admin/WechatMessage/handle','处理消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('339', 'admin', '1', 'Admin/WechatMessage/delete','删除消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('340', 'admin', '1', 'Admin/WechatMessage/reply','回复消息', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('341', 'admin', '1', 'Admin/WechatMenu/view','菜单预览', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('342', 'admin', '1', 'Admin/WechatMenu/create','生成菜单', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('343', 'admin', '1', 'Admin/WechatAlbum/index','相册列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('344', 'admin', '1', 'Admin/WechatAlbum/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('345', 'admin', '1', 'Admin/WechatAlbum/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('346', 'admin', '1', 'Admin/WechatAlbum/setStatus','改变状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('347', 'admin', '1', 'Admin/WechatAlbum/delete','删除', '1', '');


-- -----------------------------
-- Records of `onethink_category`
-- -----------------------------

INSERT INTO `onethink_category` VALUES ('11', 'about', '关于公司', '0', '0', '10', '', '', '', '', '', '', '', '2', '2,1', '0', '0', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `onethink_category` VALUES ('12', 'about_info', '公司介绍', '11', '1', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');
INSERT INTO `onethink_category` VALUES ('13', 'about_business', '业务范围', '11', '2', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');
INSERT INTO `onethink_category` VALUES ('14', 'culture', '企业文化', '11', '3', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');

INSERT INTO `onethink_category` VALUES ('21', 'news', '新闻',  '0', '0', '10', '', '', '', '', '', '', '', '2', '2,1', '0', '0', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `onethink_category` VALUES ('22', 'company_news', '公司新闻', '21', '1', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');
INSERT INTO `onethink_category` VALUES ('23', 'activity_news', '活动优惠', '21', '2', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');
INSERT INTO `onethink_category` VALUES ('24', 'industry_news', '行业动态', '21', '3', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');

INSERT INTO `onethink_category` VALUES ('31', 'share', '分享',  '0', '0', '10', '', '', '', '', '', '', '', '2', '2,1', '0', '0', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `onethink_category` VALUES ('32', 'share_know', '行业知识', '31', '1', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');
INSERT INTO `onethink_category` VALUES ('33', 'share_story', '行业故事', '31', '2', '10', '', '', '', '', '', '', '', '2', '2,1,3', '0', '1', '1', '0', '1', '1', '', '1379475028', '1386839751', '1', '31');

-- -----------------------------
-- Records of `onethink_channel`
-- -----------------------------
DELETE FROM `onethink_channel` WHERE `id` = '2' limit 1;
DELETE FROM `onethink_channel` WHERE `id` = '3' limit 1;
INSERT INTO `onethink_channel` VALUES ('4', '0', '关于', 'Article/index?category=about', '2', '1379475131', '1379483713', '1', '0');
INSERT INTO `onethink_channel` VALUES ('5', '0', '新闻', 'Article/index?category=news', '3', '1379475131', '1379483713', '1', '0');
INSERT INTO `onethink_channel` VALUES ('6', '0', '分享', 'Article/index?category=share', '4', '1379475131', '1379483713', '1', '0');
INSERT INTO `onethink_channel` VALUES ('3', '0', '相册', 'Album/index', '5', '1379475131', '1379483713', '1', '0');

-- -----------------------------
-- Records of `onethink_config`
-- -----------------------------
UPDATE `onethink_config` SET `value` = '1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n5:微信' WHERE `id`= '20' limit 1;
INSERT INTO `onethink_config` VALUES ('40', 'WECHAT_NAME', '1', '微信帐号', '5', '', '公众帐号官方账号', '1378898976', '1379235841', '1', '', '5');
INSERT INTO `onethink_config` VALUES ('41', 'WECHAT_NICKNAME', '1', '微信昵称', '5', '', '公众帐号昵称', '1378898976', '1379235841', '1', '', '5');
INSERT INTO `onethink_config` VALUES ('42', 'WECHAT_TOKEN', '1', '微信TOKEN', '5', '', '公众帐号的接入本地验证码', '1378898976', '1379235841', '1', 'Tchat', '5');
INSERT INTO `onethink_config` VALUES ('43', 'WECHAT_APP_ID', '1', 'APPID', '5', '', '公众帐号的APPID', '1378898976', '1379235841', '1', 'wxcb33ed4ad496e156', '6');
INSERT INTO `onethink_config` VALUES ('44', 'WECHAT_APP_SECRET', '1', 'APP_SECRET', '5', '', '公众帐号的APPSECRET', '1378898976', '1379235841', '1', 'cc23bb31ae3921eef4af82dba3e23bb6', '7');

-- -----------------------------
-- Records of `onethink_document`
-- -----------------------------
INSERT INTO `onethink_document` VALUES ('2', '3', '', '公司简介', '12', '这里填写公司简介的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');
INSERT INTO `onethink_document` VALUES ('3', '3', '', '公司历程介绍', '12', '这里填写公司历程的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');
INSERT INTO `onethink_document` VALUES ('4', '3', '', '公司所获荣誉', '12', '这里填写公司所获荣誉的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');

INSERT INTO `onethink_document` VALUES ('5', '3', '', '公司经营的第一项业务', '13', '这里填写公司所经营的第一项业务的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');
INSERT INTO `onethink_document` VALUES ('6', '3', '', '公司经营的第二项业务', '13', '这里填写公司所经营的第二项业务的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');
INSERT INTO `onethink_document` VALUES ('7', '3', '', '公司经营的第三项业务', '13', '这里填写公司所经营的第三项业务的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');

INSERT INTO `onethink_document` VALUES ('8', '3', '', '公司企业文化介绍', '14', '这里填写公司企业文化的简短描述，内容控制在140字以内', '0', '0', '2', '2', '0', '0', '0', '1', '0', '0', '8', '0', '0', '0', '1387260660', '1387263112', '1');


-- -----------------------------
-- Records of `onethink_document_article`
-- -----------------------------
INSERT INTO `onethink_document_article` VALUES ('2', '0', '<h1>\r\n	这里是公司简介标题\r\n</h1>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink是一个开源的内容管理框架，基于最新的ThinkPHP3.2版本开发，提供更方便、更安全的WEB应用开发体验，采用了全新的架构设计和命名空间机制，融合了模块化、驱动化和插件化的设计理念于一体，开启了国内WEB应用傻瓜式开发的新潮流。&nbsp;</strong> \r\n</p>\r\n<h2>\r\n	主要特性：\r\n</h2>\r\n<p>\r\n	1. 基于ThinkPHP最新3.2版本。\r\n</p>\r\n<p>\r\n	2. 模块化：全新的架构和模块化的开发机制，便于灵活扩展和二次开发。&nbsp;\r\n</p>\r\n<p>\r\n	3. 文档模型/分类体系：通过和文档模型绑定，以及不同的文档类型，不同分类可以实现差异化的功能，轻松实现诸如资讯、下载、讨论和图片等功能。\r\n</p>\r\n<p>\r\n	4. 开源免费：OneThink遵循Apache2开源协议,免费提供使用。&nbsp;\r\n</p>\r\n<p>\r\n	5. 用户行为：支持自定义用户行为，可以对单个用户或者群体用户的行为进行记录及分享，为您的运营决策提供有效参考数据。\r\n</p>\r\n<p>\r\n	6. 云端部署：通过驱动的方式可以轻松支持平台的部署，让您的网站无缝迁移，内置已经支持SAE和BAE3.0。\r\n</p>\r\n<p>\r\n	7. 云服务支持：即将启动支持云存储、云安全、云过滤和云统计等服务，更多贴心的服务让您的网站更安心。\r\n</p>\r\n<p>\r\n	8. 安全稳健：提供稳健的安全策略，包括备份恢复、容错、防止恶意攻击登录，网页防篡改等多项安全管理功能，保证系统安全，可靠、稳定的运行。&nbsp;\r\n</p>\r\n<p>\r\n	9. 应用仓库：官方应用仓库拥有大量来自第三方插件和应用模块、模板主题，有众多来自开源社区的贡献，让您的网站“One”美无缺。&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>&nbsp;OneThink集成了一个完善的后台管理体系和前台模板标签系统，让你轻松管理数据和进行前台网站的标签式开发。&nbsp;</strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h2>\r\n	后台主要功能：\r\n</h2>\r\n<p>\r\n	1. 用户Passport系统\r\n</p>\r\n<p>\r\n	2. 配置管理系统&nbsp;\r\n</p>\r\n<p>\r\n	3. 权限控制系统\r\n</p>\r\n<p>\r\n	4. 后台建模系统&nbsp;\r\n</p>\r\n<p>\r\n	5. 多级分类系统&nbsp;\r\n</p>\r\n<p>\r\n	6. 用户行为系统&nbsp;\r\n</p>\r\n<p>\r\n	7. 钩子和插件系统\r\n</p>\r\n<p>\r\n	8. 系统日志系统&nbsp;\r\n</p>\r\n<p>\r\n	9. 数据备份和还原\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp;[ 官方下载：&nbsp;<a href=\"http://www.onethink.cn/download.html\" target=\"_blank\">http://www.onethink.cn/download.html</a>&nbsp;&nbsp;开发手册：<a href=\"http://document.onethink.cn/\" target=\"_blank\">http://document.onethink.cn/</a>&nbsp;]&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink开发团队 2013</strong> \r\n</p>', '', '0');

INSERT INTO `onethink_document_article` VALUES ('3', '0', '<h1>\r\n	这里是公司历程介绍的标题\r\n</h1> <p>这是一段测试文字</p>', '', '0');
INSERT INTO `onethink_document_article` VALUES ('4', '0', '<h1>\r\n	这里是公司所获荣誉的\r\n</h1> <p>这是一段测试文字</p>', '', '0');

INSERT INTO `onethink_document_article` VALUES ('5', '0', '<h1>\r\n	这里是公司经营的第一项业务的\r\n</h1> <p>这是一段测试文字正文内容&nbsp;以下文字为测试所用</p>', '', '0');
INSERT INTO `onethink_document_article` VALUES ('6', '0', '<h1>\r\n	这里是公司经营的第二项业务的\r\n</h1> <p>这是一段测试文字正文内容&nbsp;以下文字为测试所用</p>', '', '0');
INSERT INTO `onethink_document_article` VALUES ('7', '0', '<h1>\r\n	这里是公司经营的第二项业务的\r\n</h1> <p>这是一段测试文字正文内容&nbsp;以下文字为测试所用</p>', '', '0');
INSERT INTO `onethink_document_article` VALUES ('8', '0', '<h1>\r\n	这里是公司企业文化的\r\n</h1> <p>这是一段测试文字正文内容&nbsp;以下文字为测试所用</p>', '', '0');

-- -----------------------------
-- Records of `onethink_menu`
-- -----------------------------
UPDATE `onethink_menu` SET `title` = '新闻', `tip` = '新闻类型文档管理'  WHERE `id`= '2' limit 1;
INSERT INTO `onethink_menu` VALUES ('300', '微信', '0', '1', 'Admin/Wechat/index', '0', '微信后台模块管理目录', '', '0');

INSERT INTO `onethink_menu` VALUES ('301', '配置微信', '300', '0', 'Admin/Config/group?id=5', '0', '', '配置微信', '0');

INSERT INTO `onethink_menu` VALUES ('321', '关键词列表', '300', '0', 'Admin/WechatKeyword/index', '0', '', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('322', '新增', '321', '0', 'Admin/WechatKeyword/create', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('323', '编辑', '321', '0', 'Admin/WechatKeyword/edit', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('324', '改变状态', '321', '0', 'Admin/WechatKeyword/setStatus', '0', '', '', '0');

INSERT INTO `onethink_menu` VALUES ('325', '关键词分析', '300', '0', 'Admin/WechatKeyword/analytical', '0', '', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('326', '过期箱', '300', '0', 'Admin/WechatKeyword/deadList', '0', '', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('327', '禁用箱', '300', '0', 'Admin/WechatKeyword/disabled', '0', '', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('328', '回收站', '300', '0', 'Admin/WechatKeyword/recycle', '0', '', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('329', '还原', '328', '0', 'Admin/WechatKeyword/restore', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('330', '彻底删除', '328', '0', 'Admin/WechatKeyword/clean', '0', '', '', '0');

INSERT INTO `onethink_menu` VALUES ('341', '活动列表', '300', '0', 'Admin/WechatActivity/index', '0', '', '活动管理', '0');
INSERT INTO `onethink_menu` VALUES ('343', '新增', '341', '0', 'Admin/WechatActivity/create', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('344', '编辑', '341', '0', 'Admin/WechatActivity/edit', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('345', '改变状态', '341', '0', 'Admin/WechatActivity/setStatus', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('346', '保存', '341', '0', 'Admin/WechatActivity/update', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('347', '保存草稿', '341', '0', 'Admin/WechatActivity/autoSave', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('348', '移动', '341', '0', 'Admin/WechatActivity/move', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('349', '复制', '341', '0', 'Admin/WechatActivity/copy', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('350', '粘贴', '341', '0', 'Admin/WechatActivity/paste', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('351', '导入', '341', '0', 'Admin/WechatActivity/batchOperate', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('352', '删除', '341', '0', 'Admin/WechatActivity/delete', '0', '', '', '0');

INSERT INTO `onethink_menu` VALUES ('353', '活动分析', '300', '0', 'Admin/WechatActivity/analytical', '0', '', '活动管理', '0');

INSERT INTO `onethink_menu` VALUES ('354', '活动草稿箱', '300', '0', 'Admin/WechatActivity/draft', '0', '', '活动管理', '0');
INSERT INTO `onethink_menu` VALUES ('355', '活动回收站', '300', '0', 'Admin/WechatActivity/recycle', '0', '', '活动管理', '0');
INSERT INTO `onethink_menu` VALUES ('356', '还原', '355', '0', 'Admin/WechatActivity/restore', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('357', '彻底删除', '355', '0', 'Admin/WechatActivity/clean', '0', '', '', '0');

INSERT INTO `onethink_menu` VALUES ('361', '客户列表', '300', '0', 'Admin/WechatClient/index', '0', '', '客户管理', '0');
INSERT INTO `onethink_menu` VALUES ('362', '客户信息', '300', '0', 'Admin/WechatClient/detail', '0', '', '客户管理', '0');

INSERT INTO `onethink_menu` VALUES ('371', '消息列表', '300', '0', 'Admin/WechatMessage/index', '0', '', '消息管理', '0');
INSERT INTO `onethink_menu` VALUES ('372', '文字消息', '371', '0', 'Admin/WechatMessage/text', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('373', '图片消息', '371', '0', 'Admin/WechatMessage/photo', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('374', '声讯消息', '371', '0', 'Admin/WechatMessage/audio', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('375', '视频消息', '371', '0', 'Admin/WechatMessage/video', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('376', '位置消息', '371', '0', 'Admin/WechatMessage/location', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('377', '链接消息', '371', '0', 'Admin/WechatMessage/url', '0', '', '', '0');

INSERT INTO `onethink_menu` VALUES ('378', '消息分析', '300', '0', 'Admin/WechatMessage/analytical', '0', '', '消息管理', '0');

INSERT INTO `onethink_menu` VALUES ('379', '处理消息', '300', '0', 'Admin/WechatMessage/handle', '0', '', '消息管理', '0');
INSERT INTO `onethink_menu` VALUES ('380', '删除消息', '379', '0', 'Admin/WechatMessage/delete', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('381', '回复消息', '379', '0', 'Admin/WechatMessage/reply', '0', '', '', '0');

INSERT INTO `onethink_menu` VALUES ('391', '菜单预览', '300', '0', 'Admin/WechatMenu/view', '0', '', '自定义菜单', '0');
INSERT INTO `onethink_menu` VALUES ('392', '生成菜单', '300', '0', 'Admin/WechatMenu/create', '0', '', '自定义菜单', '0');

INSERT INTO `onethink_menu` VALUES ('401', '相册列表', '300', '0', 'Admin/WechatAlbum/index', '0', '', '相册管理', '0');
INSERT INTO `onethink_menu` VALUES ('402', '新增', '401', '0', 'Admin/WechatAlbum/create', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('403', '编辑', '401', '0', 'Admin/WechatAlbum/edit', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('404', '改变状态', '401', '0', 'Admin/WechatAlbum/setStatus', '0', '', '', '0');
INSERT INTO `onethink_menu` VALUES ('406', '删除', '401', '0', 'Admin/WechatAlbum/delete', '0', '', '', '0');


-- -----------------------------
-- Table structure for `onethink_tchat_activity`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_activity`;
CREATE TABLE `onethink_tchat_activity` (
	`id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动ID',
	`act_type` ENUM('常规','折扣','优惠券','刮刮卡','大转盘','幸运机','抢红包','抽奖','邀请','竞拍','秒杀') NOT NULL DEFAULT '常规' COMMENT '对应活动类型',
	`startup` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '启动时间',
	`deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
	`act_add` varchar(100) NOT NULL DEFAULT 'Local' COMMENT '活动地点',
	`act_image` varchar(250) NOT NULL DEFAULT './Uploads/Wechat/Tchat/Picture/Activity/default.jpg',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` TIMESTAMP COMMENT '更新时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '活动总表';

-- -----------------------------
-- Records of `onethink_tchat_activity`
-- -----------------------------
INSERT INTO `onethink_tchat_activity` VALUES ('1','折扣','1392825600','1395244800', '各分店', '', '3', '1393292899', '1393292899');
INSERT INTO `onethink_tchat_activity` VALUES ('2', '常规','1392825600','0', '各分店', '', '3', '1393292899', '1393292899');
INSERT INTO `onethink_tchat_activity` VALUES ('3','优惠券','1392825600','1400515200', '各分店', '', '3', '1393292899', '1393292899');
INSERT INTO `onethink_tchat_activity` VALUES ('4','折扣','1392825600','1400515200', '各分店', '', '3', '1393292899', '1393292899');

-- -----------------------------
-- Table structure for `onethink_tchat_activity_discount`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_activity_discount`;
CREATE TABLE `onethink_tchat_activity_discount` (
	`id` int(5) unsigned NOT NULL COMMENT '折扣活动ID',
	`discount` FLOAT(3,2) NOT NULL DEFAULT '0.80' COMMENT '折扣率',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '折扣表';

-- -----------------------------
-- Records of `onethink_tchat_activity_discount`
-- -----------------------------
INSERT INTO `onethink_tchat_activity_discount` VALUES ('1','0.7');
INSERT INTO `onethink_tchat_activity_discount` VALUES ('4','0.7');

-- -----------------------------
-- Table structure for `onethink_tchat_activity_ticket`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_activity_ticket`;
CREATE TABLE `onethink_tchat_activity_ticket` (
	`id` int(5) unsigned NOT NULL COMMENT '活动ID',
	`ticket_prefix` char(4) NOT NULL COMMENT '优惠券前缀',
	`max` int(5) unsigned NOT NULL DEFAULT '300' COMMENT '发行总数量',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '优惠券控制表';

-- -----------------------------
-- Records of `onethink_tchat_activity_ticket`
-- -----------------------------
INSERT INTO `onethink_tchat_activity_ticket` VALUES ('3','CJYH','200');

-- -----------------------------
-- Table structure for `onethink_tchat_activity_tickets`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_activity_tickets`;
CREATE TABLE `onethink_tchat_activity_tickets` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '优惠券ID',
	`act_id` int(5) unsigned NOT NULL COMMENT '活动ID',
	`content` char(8) NOT NULL COMMENT '优惠券码',
	`status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '使用状态',
	`open_id` varchar(32) NOT NULL COMMENT '客户微信openId',
	`create_time` TIMESTAMP COMMENT '更新时间',
	`used_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '优惠券列表';

-- -----------------------------
-- Table structure for `onethink_tchat_album`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_album`;
CREATE TABLE `onethink_tchat_album` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT'相册ID',
	`name` varchar(200) NOT NULL COMMENT '相册标识',
	`title` varchar(200) NOT NULL COMMENT '相册名称',
	`cat_id` int(10) NOT NULL COMMENT '所属分类ID',
	`vote` tinyint(2) NOT NULL COMMENT '投票设置,1为启用，0为禁用',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	PRIMARY KEY (`id`) 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT '相册存储表';


-- -----------------------------
-- Table structure for `onethink_tchat_album_cat`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_album_cat`;
CREATE TABLE `onethink_tchat_album_cat` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
	`name` varchar(30) NOT NULL COMMENT '标志',
	`title` varchar(50) NOT NULL COMMENT '标题',
	`sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
	`list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
	`meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
	`keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
	`description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
	`template_index` varchar(100) NOT NULL COMMENT '频道页模板',
	`template_lists` varchar(100) NOT NULL COMMENT '列表页模板',
	`template_detail` varchar(100) NOT NULL COMMENT '详情页模板',
	`template_edit` varchar(100) NOT NULL COMMENT '编辑页模板',
	`link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
	`allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
	`display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
	`reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
	`check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
	`reply_model` varchar(100) NOT NULL DEFAULT '',
	`extend` text NOT NULL COMMENT '扩展设置',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	`status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
	`icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
	PRIMARY KEY (`id`),
	UNIQUE KEY `uk_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT '相册分类表';


-- -----------------------------
-- Table structure for `onethink_tchat_client`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_client`;
CREATE TABLE `onethink_tchat_client` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '微信客户ID',
	`openid` VARCHAR(100) NOT NULL COMMENT '微信客户openID',
	`subscribe` tinyint(2) DEFAULT '1' COMMENT '微信客户关注状态 1为正在关注 0为取消关注',
    `name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT'客户姓名',
    `phone` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '客户联系电话',
	`nickname` VARCHAR(100) NOT NULL DEFAULT '' COMMENT'微信客户昵称',
	`sex` tinyint(4) DEFAULT '0' COMMENT '微信客户性别，1男2女0未知',
	`city` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '微信客户所在城市',
	`country` VARCHAR(20) NOT NULL DEFAULT '中国' COMMENT '微信客户所在国家',
	`province` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '微信客户所在省份',
	`language` VARCHAR(10) NOT NULL DEFAULT 'zh_CN' COMMENT '微信客户语言',
	`headimgurl` VARCHAR(200) NOT NULL DEFAULT '' COMMENT'微信客户头像',
	`subscribe_time` int(10) NOT NULL DEFAULT '0' COMMENT'微信客户关注时间',
	`event_key` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '扫描关注时的EventKey',
	`ticket` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '扫描时的二维码Ticket,可换取二维码',
	PRIMARY KEY(`id`),
    UNIQUE KEY `uk_openId` (`openId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '微信客户信息表';


-- -----------------------------
-- Table structure for `onethink_tchat_client_photo`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_client_photo`;
CREATE TABLE `onethink_tchat_client_photo` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT'微信客户图片ID',
	`client_id` int(10) NOT NULL COMMENT '微信客户ID',
	`Album_id` int(10) NOT NULL COMMENT '所属相册ID',
	`votes` int(10) NOT NULL DEFAULT '0' COMMENT '投票票数',
	`url` varchar(200) NOT NULL COMMENT '微信客户图片存储地址',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	PRIMARY KEY (`id`) 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT '客户传送图片存储表';


-- -----------------------------
-- Table structure for `onethink_tchat_client_uid`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_client_uid`;
CREATE TABLE `onethink_tchat_client_uid` (
	`client_id` int(10) unsigned NOT NULL COMMENT '微信客户ID',
	`uid` int(10) unsigned NOT NULL COMMENT '系统用户Uid',
	  UNIQUE KEY `client_id_uid` (`client_id`,`uid`),
	  KEY `uid` (`uid`),
	  KEY `client_id` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '微信客户绑定表';

-- -----------------------------
-- Table structure for `onethink_tchat_events`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_events`;
CREATE TABLE `onethink_tchat_events` (
	`id` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT '事件ID',
	`event_name` varchar(100) NOT NULL COMMENT '事件名称,用于中文注释识别',
	`event_type` varchar(50) NOT NULL COMMENT '对应微信事件类型',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '事件判断回复表';

-- -----------------------------
-- Records of `onethink_tchat_events`
-- -----------------------------
INSERT INTO `onethink_tchat_events` VALUES ('1','客户关注','subscribe');

-- -----------------------------
-- Table structure for `onethink_tchat_keyword`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_keyword`;
CREATE TABLE `onethink_tchat_keyword` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '关键词ID',
	`keyword` varchar(100) NOT NULL COMMENT '关键词',
	`group_id` int(8) unsigned NOT NULL COMMENT '关键词分组ID',
	PRIMARY KEY(`id`),
	UNIQUE KEY `id_group_id` (`id`,`group_id`),
	KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '关键词列表';

-- -----------------------------
-- Records of `onethink_tchat_keyword`
-- -----------------------------
INSERT INTO `onethink_tchat_keyword` VALUES ('1','公司介绍','10');
INSERT INTO `onethink_tchat_keyword` VALUES ('2','公司','10');
INSERT INTO `onethink_tchat_keyword` VALUES ('3','业务介绍','11');
INSERT INTO `onethink_tchat_keyword` VALUES ('4','业务','11');
INSERT INTO `onethink_tchat_keyword` VALUES ('5','经营','11');
INSERT INTO `onethink_tchat_keyword` VALUES ('6','范围','11');
INSERT INTO `onethink_tchat_keyword` VALUES ('7','联系','12');
INSERT INTO `onethink_tchat_keyword` VALUES ('8','电话','12');
INSERT INTO `onethink_tchat_keyword` VALUES ('9','地址','12');
INSERT INTO `onethink_tchat_keyword` VALUES ('10','网站','12');
INSERT INTO `onethink_tchat_keyword` VALUES ('11','全部新闻','19');
INSERT INTO `onethink_tchat_keyword` VALUES ('12','公司新闻','20');
INSERT INTO `onethink_tchat_keyword` VALUES ('13','活动新闻','21');
INSERT INTO `onethink_tchat_keyword` VALUES ('14','最新活动','21');
INSERT INTO `onethink_tchat_keyword` VALUES ('15','业态新闻','22');
INSERT INTO `onethink_tchat_keyword` VALUES ('16','行业','22');
INSERT INTO `onethink_tchat_keyword` VALUES ('17','业态','22');
INSERT INTO `onethink_tchat_keyword` VALUES ('18','知识分享','23');
INSERT INTO `onethink_tchat_keyword` VALUES ('19','行业知识','23');
INSERT INTO `onethink_tchat_keyword` VALUES ('20','故事分享','24');
INSERT INTO `onethink_tchat_keyword` VALUES ('21','行业故事','24');
INSERT INTO `onethink_tchat_keyword` VALUES ('22','冬款','25');
INSERT INTO `onethink_tchat_keyword` VALUES ('23','折扣','25');
INSERT INTO `onethink_tchat_keyword` VALUES ('24','打折','25');
INSERT INTO `onethink_tchat_keyword` VALUES ('25','优惠','26');
INSERT INTO `onethink_tchat_keyword` VALUES ('26','折扣','26');
INSERT INTO `onethink_tchat_keyword` VALUES ('27','打折','26');
INSERT INTO `onethink_tchat_keyword` VALUES ('28','优惠券','27');
INSERT INTO `onethink_tchat_keyword` VALUES ('29','优惠','27');
INSERT INTO `onethink_tchat_keyword` VALUES ('30','春节','28');
INSERT INTO `onethink_tchat_keyword` VALUES ('31','打折','28');
INSERT INTO `onethink_tchat_keyword` VALUES ('32','优惠','28');
INSERT INTO `onethink_tchat_keyword` VALUES ('33','折扣','28');
INSERT INTO `onethink_tchat_keyword` VALUES ('34','抢购','28');
INSERT INTO `onethink_tchat_keyword` VALUES ('35','我要优惠券','29');
INSERT INTO `onethink_tchat_keyword` VALUES ('36','活动','25');
INSERT INTO `onethink_tchat_keyword` VALUES ('37','活动','26');
INSERT INTO `onethink_tchat_keyword` VALUES ('38','活动','27');
INSERT INTO `onethink_tchat_keyword` VALUES ('39','活动','28');
INSERT INTO `onethink_tchat_keyword` VALUES ('40','分享','30');
-- -----------------------------
-- Table structure for `onethink_tchat_keyword_group`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_keyword_group`;
CREATE TABLE `onethink_tchat_keyword_group` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '关键词组ID',
	`name` varchar(100) NOT NULL COMMENT '关键词组名',
	`segment` varchar(20) NOT NULL DEFAULT '' COMMENT '关键词回复所属板块',
	`segment_id` int(5) NOT NULL DEFAULT '0' COMMENT '板块条目ID',
	`reply_type` ENUM('text','image','news','document','music','url') NOT NULL DEFAULT'text' COMMENT '回应类型',
	`reply_id` varchar(250) NOT NULL DEFAULT '' COMMENT '回复类型的自定义文章ID，文本及新闻分类只需要一个值',
	`start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
	`deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
	`dead_text` int(5) unsigned  NOT NULL DEFAULT '0' COMMENT '结束后回复文本',
	`status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '关键词使用状态，0为停用，1为使用，-1为删除',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` TIMESTAMP COMMENT '更新时间',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '关键词组回复内容表';

-- -----------------------------
-- Records of `onethink_tchat_keyword_group`
-- -----------------------------
INSERT INTO `onethink_tchat_keyword_group` VALUES ('9','关注事件','events','1','text','21','1393292899','0','0','1','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_keyword_group` VALUES ('10','公司介绍','costom','0','news','12','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('11','业务介绍','costom','0','news','13','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('12','联系我们','costom','0','news','33','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('19','全部新闻','costom','0','news','21','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('20','公司新闻','costom','0','news','22','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('21','活动新闻','costom','0','news','23','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('22','业态新闻','costom','0','news','24','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('23','知识分享','costom','0','news','32','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('24','故事分享','costom','0','news','33','1393292899','0','0','1','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_keyword_group` VALUES ('25','冬款折扣季','activity','1','document','8','1393292899','1395244800','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('26','消费满200送50大酬宾','activity','2','document','5,6,7','1393292899','0','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('27','迎春优惠券赠送活动','activity','3','document','3,4','1393292899','1400515200','0','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('28','春节大抢购活动','activity','4','text','54','1393292899','1393293899','55','1','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_keyword_group` VALUES ('29','我要优惠券','activity_ticket','3','text','','1393292899','1400515200','0','1','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_keyword_group` VALUES ('30','所有分享','costom','0','news','31','1393292899','0','0','1','3','1393292899','1393292899');
-- -----------------------------
-- Table structure for `onethink_tchat_music`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_music`;
CREATE TABLE `onethink_tchat_music` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '音乐型回复内容ID',
	`music_url`	varchar(200) NOT NULL UNIQUE COMMENT '音乐链接地址',
	`music_content` varchar(250) NOT NULL COMMENT '音乐描述',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` TIMESTAMP COMMENT '更新时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '音乐类型回复内容表';

-- -----------------------------
-- Table structure for `onethink_tchat_text`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_text`;
CREATE TABLE `onethink_tchat_text` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '文本型回复内容ID',
	`content` varchar(250) NOT NULL UNIQUE COMMENT '文本回复内容',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` TIMESTAMP COMMENT '更新时间',
	PRIMARY KEY(`id`),
	INDEX(`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '文本类型回复内容表';

-- -----------------------------
-- Records of `onethink_tchat_text`
-- -----------------------------
INSERT INTO `onethink_tchat_text` VALUES ('1','这是第一条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('2','这是第二条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('3','这是第三条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('4','这是第四条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('5','这是第五条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('6','这是第六条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('7','这是第七条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('8','这是第八条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('9','这是第九条测试用的回复文本内容','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('10','这是第十条测试用的回复文本内容','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_text` VALUES ('21','感谢您的关注','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_text` VALUES ('31','这是一条公司介绍的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('32','这是一条业务介绍的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('33','这是一条联系我们的回复','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_text` VALUES ('40','这是一条所有栏目下最新新闻的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('41','这是一条公司最新新闻的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('42','这是一条优惠活动最新新闻的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('43','这是一条行业最新新闻的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('44','这是一条分享行业知识的回复','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('45','这是一条分享行业故事的回复','3','1393292899','1393292899');

INSERT INTO `onethink_tchat_text` VALUES ('51','新春换季，店内所有冬款全部7折，时间有限，错过不再～','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('52','入店消费满200均可获赠50元抵用券，满400送100，以此类推，特价折扣商品不参与哦。','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('53','本优惠券限量200份，回复‘我要优惠券’，即可获得一张，每人限领一张，亲，要快发哦，不然就被抢光啦。','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('54','春节来临的脚步如此匆忙，我们不仅为您准备好了新年礼物，更有多款产品享受折上折优惠，购物划算，还有积分翻倍哦','3','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('55','哎呀，真不好意思，这个活动已经截止啦，好遗憾没能在那个疯狂的日子里见到你的身影，不过我们还有很多其他的活动正在进行，您可以回复“优惠”或“活动”，看看我们有哪些活动吧，这次可不要再错过咯。','3','1393292899','1393292899');

-- -----------------------------
-- Table structure for `onethink_tchat_vote`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_vote`;
CREATE TABLE `onethink_tchat_vote` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '投票项目ID',
	`name` varchar(50) NOT NULL COMMENT '投票项目标识',
	`title` varchar(50) NOT NULL COMMENT '投票项目名称',
	`vote_start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始投票时间',
	`vote_end` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束投票时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '投票项目列表';

-- -----------------------------
-- Table structure for `onethink_tchat_votes`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_votes`;
CREATE TABLE `onethink_tchat_votes` (
	`id` int(8) unsigned NOT NULL COMMENT '投票项目ID',
	`name` varchar(50) NOT NULL UNIQUE COMMENT '投票细项标识',
	`title` varchar(50) NOT NULL UNIQUE COMMENT '投票细项名称',
	`votes` int(10) NOT NULL DEFAULT '0' COMMENT '投票票数',
	`sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '投票细项列表';
