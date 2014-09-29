-- -----------------------------
-- 说明：本SQL中的新建表均会增加Tchat前缀，表名中不包含Tchat的即为系统自带表
-- 除非是文档模型扩展
-- 本SQL命令文件大多数情况下只向表中添加必要数据，轻易不更改其表原结构
-- 目前更改过结构的表有：
-- 1、`onethink_channel`中增加了一个`group`字段，用于扩展分组导航
-- 2、`onethink_document` 中增加了一个`index_pic`字段，用于设置列表索引方形图（配合微信）
-- -----------------------------

-- -----------------------------
-- Records of  `onethink_addons`
-- -----------------------------
UPDATE `onethink_addons` SET `status` = '0' WHERE `onethink_addons`.`id` IN ('3','4');

-- -----------------------------
-- Records of  `onethink_hooks`
-- -----------------------------
INSERT INTO `onethink_hooks`  VALUES ('30', 'wechatIndex', '微信控制栏目首页钩子', '1', '1397114797', 'TchatIndex');
-- -----------------------------
-- Records of  `onethink_attribute`
-- -----------------------------

INSERT INTO `onethink_attribute` VALUES ('190','index_pic','索引图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无索引图，大于0-索引图片ID，用于列表方形图片索引，尺寸建议为200*200像素', '1', '', '1', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');

-- Attribute of keyword model
INSERT INTO `onethink_attribute` VALUES ('200', 'keyword', '关键词', 'varchar(100) NOT NULL ', 'string', '', '多个关键词请用英文半角逗号隔开', '1', '', '4', '0', '1', '1394597230', '1394597230', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('201', 'group_id', '关键词分组ID', 'int(8) unsigned NOT NULL ', 'string', '', '', '0', '', '4', '0', '1', '1394597230', '1394597230', '', '0', '', '', '', '0', '');
-- Attribute of keyword group model
INSERT INTO `onethink_attribute` VALUES ('202', 'name', '关键词标题', 'varchar(100) NOT NULL ', 'string', '', '为本组关键词取个标题', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('203', 'segment', '模型板块', 'int(5) NOT NULL ', 'select', '0', '关键词组所属模型板块', '1', '0:自定义\r\n6:活动\r\n7:折扣\r\n8:优惠券', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('204', 'segment_id', '板块条目ID', 'int(5) NOT NULL ', 'num', '0', '', '0', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('205', 'reply_type', '回复类型', 'varchar(20) NOT NULL ', 'select', 'text', '', '1', 'text:文本\r\nimage:图片\r\nnews:新闻分类\r\ndocument:文章组合\r\nmusic:音乐\r\nurl:链接', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('206', 'reply_id', '回复内容', 'varchar(255) NOT NULL ', 'string', '', '文本及新闻分类只需要一个ID值，文章为多个ID', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('207', 'start_time', '生效时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '设置关键词的<strong>生效时间</strong>', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('208', 'deadline', '失效时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '设置关键词的<strong>失效时间</strong>', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('209', 'dead_text', '失效后回复文本', 'varchar(255) NOT NULL ', 'string', '55', '', '1', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('210', 'status', '是否现在启用', 'tinyint(2) NOT NULL ', 'bool', '1', '设置添加后的状态', '1', '1:启用\r\n0:禁用', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('211', 'uid', '用户ID', 'int(10) unsigned NOT NULL ', 'num', '0', '', '0', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('212', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'datetime', 'CURRENT_TIMESTAMP', '', '0', '', '5', '0', '1', '1394597354', '1394597354', '', '0', '', '', '', '0', '');

-- Attribute of activity model
INSERT INTO `onethink_attribute` VALUES ('250', 'name', '活动标识', 'varchar(100) NOT NULL ', 'string', '', '活动标识', '1', '', '6', '0', '1', '1396965384', '1396965384', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('251', 'title', '标题', 'varchar(50) NOT NULL ', 'string', '', '活动的标题', '1', '', '6', '0', '1', '1396965384', '1396965384', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('252', 'model_id', '对应活动类型', 'int(5) unsigned NOT NULL ', 'select', '6', '选择活动的类型', '1', '6:常规\r\n7:折扣\r\n8:优惠券\r\n9:刮刮卡\r\n10:大转盘\r\n11:幸运机\r\n12:抢红包\r\n13:抽奖\r\n14:邀请\r\n15:竞拍\r\n16:秒杀\r\n17:抢楼', '6', '0', '1', '1396965384', '1396965384', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('253','check_info','参与活动是否需审核客户信息', 'smallint(5) unsigned NOT NULL ', 'checkbox', '0', '请选择需要客户发送的个人信息项', '1', '1:姓名\r\n2:电话\r\n4:QQ\r\n8:Email', '6', '0', '1', '1383895640', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('254', 'ex_keyword', '前置关键词', 'varchar(10) NOT NULL ', 'string', '', '触发参与报名或获取资格告知的关键词，比如\"我要优惠券\"', '1', '', '6', '0', '1', '1396965384', '1396965384', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('255', 'checked_reply', '验证后回复内容', 'varchar(100) NOT NULL', 'string', '', '获取客户资料后的回复内容', '1', '', '6', '0', '1', '1384508362', '1383891233', '', '0', '', '', '', '0', '');
-- 删除了编号为256的categry_id所属分类字段属性
INSERT INTO `onethink_attribute` VALUES ('257', 'description', '描述', 'char(140) NOT NULL ', 'textarea', '', '', '1', '', '6', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('258', 'root', '根节点', 'int(10) unsigned NOT NULL ', 'num', '0', '该文档的顶级文档编号', '0', '', '6', '0', '1', '1384508323', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('259', 'pid', '所属ID', 'int(10) unsigned NOT NULL ', 'num', '0', '父文档编号', '0', '', '6', '0', '1', '1384508543', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('260', 'type', '内容类型', 'tinyint(3) unsigned NOT NULL ', 'select', '2', '', '1', '1:目录\r\n2:主题\r\n3:段落', '6', '0', '1', '1384511157', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('261', 'position', '推荐位', 'smallint(5) unsigned NOT NULL ', 'checkbox', '0', '多个推荐则将其推荐值相加', '1', '1:列表推荐\r\n2:频道页推荐\r\n4:首页推荐', '6', '0', '1', '1383895640', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('262', 'link_id', '外链', 'int(10) unsigned NOT NULL ', 'num', '0', '0-非外链，大于0-外链ID,需要函数进行链接与编号的转换', '1', '', '6', '0', '1', '1383895757', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('263', 'cover_id', '封面图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无封面，大于0-封面图片ID，建议尺寸360*200像素', '1', '', '6', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('264', 'act_add', '活动地点', 'varchar(100) NOT NULL ', 'string', 'Local', '', '1', '', '6', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('265', 'display', '可见性', 'tinyint(3) unsigned NOT NULL ', 'radio', '1', '', '1', '0:不可见\r\n1:所有人可见', '6', '0', '1', '1386662271', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `onethink_attribute` VALUES ('266', 'startup', '启动时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '设置活动的<strong>启动时间</strong>', '1', '', '6', '0', '1', '1396965384', '1396965384', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('267', 'deadline', '截止时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '0-永久有效', '1', '', '6', '0', '1', '1387163248', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `onethink_attribute` VALUES ('268', 'attach', '附件数量', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '', '0', '', '6', '0', '1', '1387260355', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `onethink_attribute` VALUES ('269', 'view', '浏览量', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '6', '0', '1', '1383895835', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('270', 'comment', '评论数', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '6', '0', '1', '1383895846', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('271', 'extend', '扩展统计字段', 'int(10) unsigned NOT NULL ', 'num', '0', '根据需求自行使用', '0', '', '6', '0', '1', '1384508264', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('272', 'level', '优先级', 'int(10) unsigned NOT NULL ', 'num', '0', '越高排序越靠前', '1', '', '6', '0', '1', '1383895894', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('273', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', '1', '', '6', '0', '1', '1383895903', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('274', 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', '0', '', '6', '0', '1', '1384508277', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('275', 'status', '数据状态', 'tinyint(4) NOT NULL ', 'radio', '0', '', '0', '-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿', '6', '0', '1', '1384508496', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('276', 'uid', '用户ID', 'int(10) unsigned NOT NULL ', 'num', '0', '', '0', '', '6', '0', '1', '1384508362', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('277', 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', '0', '0:html\r\n1:ubb\r\n2:markdown', '6', '0', '1', '1384511049', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('278', 'content', '活动内容', 'text NOT NULL ', 'editor', '', '', '1', '', '6', '0', '1', '1383896225', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('279', 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '参照display方法参数的定义', '1', '', '6', '0', '1', '1383896190', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('280', 'bookmark', '收藏数', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '6', '0', '1', '1383896103', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('281', 'keywords', '关键词', 'varchar(100) NOT NULL ', 'string', '', '获取活动内容的关键词，比如\"春节\"，\"打折\"等', '1', '', '6', '0', '1', '1396965384', '1396965384', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('282','index_pic','索引图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无索引图，大于0-索引图片ID，用于列表方形图片索引，尺寸建议为200*200像素', '1', '', '6', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');

-- Attribute of activity discount model
INSERT INTO `onethink_attribute` VALUES ('290', 'discount', '折扣率', 'float(3,2) NOT NULL ', 'string', '0.80', '', '1', '', '7', '0', '1', '1396968844', '1396968844', '', '0', '', '', '', '0', '');

-- Attribute of activity ticket model
INSERT INTO `onethink_attribute` VALUES ('300', 'ticket_prefix', '优惠券前缀', 'char(4) NOT NULL ', 'string', '', '请使用2-4位大写英文字母', '1', '', '8', '0', '1', '1396968858', '1396968858', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('301', 'max_num', '发行总数量', 'int(5) unsigned NOT NULL ', 'string', '300', '请设置在100000以内', '1', '', '8', '0', '1', '1396968858', '1396968858', '', '0', '', '', '', '0', '');

-- Attribute of tchat_qrcode
INSERT INTO `onethink_attribute` VALUES ('400','ticket','Ticket编码','varchar(250) NOT NULL','string','','获取到的Ticket值','1','','41', '0', '1', '1396968858', '1396968858', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('401','action_name','编码类型','varchar(10) NOT NULL','string','','编码的类型，永久型及临时型','0','','41', '0', '1', '1396968858', '1396968858', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('402','scene','场景','varchar(50) NOT NULL','string','','二维码应用场景，自定义一个场景名称，如“海报、公交广告等”','1','','41','0','1', '1396968858', '1396968858', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('403','scan_num','扫描次数','int(5) unsigned NOT NULL','num','0','二维码扫描次数','0','','41', '0', '1', '1396968858', '1396968858', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('404', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '41', '0', '1', '1396970452', '1396970452', '', '0', '', '', '', '0', '');

-- Attribute of album model
INSERT INTO `onethink_attribute` VALUES ('420', 'name', '相册标识', 'varchar(200) NOT NULL ', 'string', '', '', '1', '', '51', '0', '1', '1396970452', '1396970452', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('421', 'title', '相册名称', 'varchar(200) NOT NULL ', 'string', '', '', '1', '', '51', '0', '1', '1396970452', '1396970452', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('422', 'cat_id', '所属分类ID', 'int(10) NOT NULL ', 'num', '0', '', '1', '', '51', '0', '1', '1396970452', '1396970452', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('423', 'vote', '投票设置', 'tinyint(2) NOT NULL ', 'bool', '0', '是否启用投票', '1', '1:是\r\n0:否', '51', '0', '1', '1396970452', '1396970452', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('424', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '1', '', '51', '0', '1', '1396970452', '1396970452', '', '0', '', '', '', '0', '');

-- Attribute of menu model
INSERT INTO `onethink_attribute` VALUES ('450', 'sort', '排序', 'tinyint(2) NOT NULL ', 'string', '0', '菜单的排列顺序，同一级别下有效', '1', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('451', 'menu_type', '菜单类型', 'varchar(20) NOT NULL ', 'select', 'click', '设置本菜单的类型，是作为一级菜单还是获取回复信息又或者是跳转到网页', '1', 'click:获取回复\r\nbutton:一级菜单\r\nview:转到网址', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('452', 'name', '显示名称', 'varchar(50) NOT NULL ', 'string', '', '菜单上显示的名称', '1', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('453', 'event_key', '系统识别码', 'varchar(50) NOT NULL ', 'string', '', '用于识别菜单的指令代码，可以自己随便写,注意不要用中文', '1', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('454', 'action_type', '触发类型', 'varchar(20) NOT NULL ', 'select', '', '关键词组名、功能、分类编号、文章编号、文本编号', '1', 'keyword:触发关键词\r\nsegement:触发功能\r\nnews:选择分类\r\ndocument:选择文类\r\ntext:选择文本', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('455', 'action_code', '动作指令', 'varchar(100) NOT NULL ', 'string', '', '关键词请填写已有的关键词组名，功能请选择功能，分类及文章请填写分类号和文章号（文章可多个）”', '1', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('456', 'status', '状态', 'tinyint(2) NOT NULL ', 'bool', '1', '是否现在就启用', '1', '1:启用\r\n0:禁用', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('457', 'pid', '上级菜单', 'int(10) unsigned NOT NULL ', 'string', '0', '请选择上级菜单', '1', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('458', 'uid', '用户', 'int(10) unsigned NOT NULL ', 'string', '2', '', '0', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('459', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('460', 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('461', 'url', '跳转链接', 'varchar(250) NOT NULL ', 'string', '0', '请填写点击后跳转到的网址，注意一定要带上"htt://"或者"https://"', '1', '', '52', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');

-- Attribute of product model
INSERT INTO `onethink_attribute` VALUES ('480', 'content', '产品详情', 'text NOT NULL', 'editor', '', '产品详情介绍','1', '', '53','1','1','1408933941','1408933941', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('481', 'special_price', '特价', 'FLOAT(10,2) UNSIGNED NOT NULL', 'num', '0.00', '商品特价','1', '', '53','0','1','1408934868','1408934580', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('482', 'price', '价格', 'FLOAT(10,2) UNSIGNED NOT NULL', 'num', '0', '商品价格','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('483', 'pics', '产品图片', 'VARCHAR(100) NOT NULL', 'string', '0', '产品的展示图片，可多图','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('484', 'style', '产品类型', 'VARCHAR(100) NOT NULL', 'string', '', '指定产品的类型，如型号、批次、类别、归属等','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('485', 'spec', '产品规格', 'VARCHAR(100) NOT NULL', 'string', '', '产品的规格，如：尺寸、面积、质量、体积等','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('486', 'features', '产品特征', 'VARCHAR(100) NOT NULL', 'string', '', '用于标记产品的特征，如，颜色、形状、材质、朝向等','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('487', 'amount', '产品总量', 'int(10) UNSIGNED NOT NULL', 'num', '0', '产品供应的总量','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('488', 'stock', '产品库存', 'int(10) UNSIGNED NOT NULL', 'num', '0', '产品目前的库存量','1', '', '53','0','1','1408934711','1408934711', '','0', '', '', '','0', '');

-- Attribute of product Plan model
INSERT INTO `onethink_attribute` VALUES ('500', 'status', '状态', 'tinyint(2) NOT NULL ', 'bool', '1', '是否现在就启用', '1', '1:启用\r\n0:禁用', '54', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('501', 'name', '套餐标识','VARCHAR(100) NOT NULL', 'string', '', '设置套餐标识，请使用英文字母或拼音','1', '', '54','1','1','1408933941','1408933941', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('502', 'title', '套餐名称','VARCHAR(100) NOT NULL', 'string', '', '填写套餐名称','1', '', '54','1','1','1408933941','1408933941', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('503', 'description', '描述', 'VARCHAR(250) NOT NULL ', 'textarea', '', '', '1', '', '54', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('504', 'products', '产品', 'VARCHAR(100) NOT NULL ', 'string', '0', '请选择要加入套餐的产品', '1', '', '54', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('505', 'price', '价格', 'FLOAT(10,2) UNSIGNED NOT NULL', 'num', '0', '套餐价格','1', '', '54','0','1','1408934711','1408934711', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('506', 'cover_id', '封面图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无封面，大于0-封面图片ID，建议尺寸360*200像素', '1', '', '54', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('507', 'uid', '用户', 'int(10) unsigned NOT NULL ', 'string', '2', '', '0', '', '54', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('508', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '54', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('509', 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '54', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('510', 'deadline', '截止时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '0-永久有效', '1', '', '54', '0', '1', '1387163248', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `onethink_attribute` VALUES ('511','index_pic','索引图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无索引图，大于0-索引图片ID，用于列表方形图片索引，尺寸建议为200*200像素', '1', '', '54', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');

-- Attribute of product Topic model
INSERT INTO `onethink_attribute` VALUES ('530', 'name', '专题标识','VARCHAR(100) NOT NULL', 'string', '', '设置专题标识，请使用英文字母或拼音','1', '', '55','1','1','1408933941','1408933941', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('531', 'title', '专题名称','VARCHAR(100) NOT NULL', 'string', '', '填写专题名称','1', '', '55','1','1','1408933941','1408933941', '','0', '', '', '','0', '');
INSERT INTO `onethink_attribute` VALUES ('532', 'description', '描述', 'VARCHAR(250) NOT NULL ', 'textarea', '', '', '1', '', '55', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('533', 'products', '产品', 'VARCHAR(100) NOT NULL ', 'string', '0', '请选择要加入套餐的产品', '1', '', '55', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('534', 'plans', '套餐', 'VARCHAR(100) NOT NULL ', 'string', '0', '请选择要加入套餐的产品', '1', '', '55', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('535', 'cover_id', '封面图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无封面，大于0-封面图片ID，建议尺寸360*200像素', '1', '', '55', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('536', 'tags', '标签', 'VARCHAR(100) NOT NULL ', 'string', '0', '请为该专题设置标签，将用此标签调取新闻资讯', '1', '', '55', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('537', 'uid', '用户', 'int(10) unsigned NOT NULL ', 'string', '2', '', '0', '', '55', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('538', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '55', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('539', 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'string', '0', '', '0', '', '55', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('540', 'status', '状态', 'tinyint(2) NOT NULL ', 'bool', '1', '是否现在就启用', '1', '1:启用\r\n0:禁用', '55', '0', '1', '1407334493', '1407334493', '', '0', '', '', '', '0', '');
INSERT INTO `onethink_attribute` VALUES ('541', 'deadline', '截止时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '0-永久有效', '1', '', '55', '0', '1', '1387163248', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `onethink_attribute` VALUES ('542','index_pic','索引图片', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无索引图，大于0-索引图片ID，用于列表方形图片索引，尺寸建议为200*200像素', '1', '', '55', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');

-- -----------------------------
-- Records of  `onethink_model`
-- -----------------------------

UPDATE `onethink_model` SET `field_sort`='{\"1\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"190\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]}'  WHERE `id` = '1' limit 1;
UPDATE `onethink_model` SET `field_sort`='{\"1\":[\"3\",\"24\",\"2\",\"5\"],\"2\":[\"9\",\"13\",\"19\",\"10\",\"12\",\"190\",\"16\",\"17\",\"26\",\"20\",\"14\",\"11\",\"25\"]}'  WHERE `id` = '2' limit 1;
UPDATE `onethink_model` SET `field_sort`='{\"1\":[\"3\",\"28\",\"30\",\"32\",\"2\",\"5\",\"31\"],\"2\":[\"13\",\"10\",\"27\",\"9\",\"12\",\"190\",\"16\",\"17\",\"19\",\"11\",\"20\",\"14\",\"29\"]}'  WHERE `id` = '3' limit 1;

INSERT INTO `onethink_model`  VALUES ('4', 'tchat_keyword', '关键词', '0', '', '1', '{\"1\":[\"200\",\"201\"]}', '1:基础', '', '', '', '', 'keyword:关键词\r\ngroup_id:分组', '10', '', '', '1394597229', '1394597323', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('5', 'group', '关键词分组', '4', '', '1', '{\"1\":[\"202\",\"200\",\"203\",\"204\",\"205\",\"206\",\"207\",\"208\",\"209\",\"210\",\"211\",\"212\"]}', '1:基础', '', '', '', '', 'name:关键词组\r\nsegment:所属板块\r\nreply_type:回复类型\r\nstatus:状态', '10', '', '', '1394597354', '1394602636', '1', 'MyISAM');

INSERT INTO `onethink_model`  VALUES ('6', 'tchat_activity', '活动', '0', '', '1', '{\"1\":[\"252\",\"251\",\"281\",\"278\",\"250\",\"264\",\"266\",\"267\"],\"2\":[\"260\",\"265\",\"272\",\"261\",\"263\",\"282\",\"269\",\"270\",\"280\",\"273\",\"262\",\"279\"],\"3\":[\"253\",\"254\",\"255\"]}', '1:基础,2:扩展,3:客户参与设置', '', '', '', '', 'name:关键词组\r\ntitle:活动标题\r\nact_type:活动类型\r\ncheck_info:验证信息\r\nstartup:开始时间\r\ndeadline:结束时间\r\nstatus:状态\r\nact_add:活动地点', '10', '', '', '1396965384', '1396965384', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('7', 'discount', '折扣', '6', '', '1', '{\"1\":[\"252\",\"251\",\"290\",\"281\",\"278\",\"250\",\"264\",\"266\",\"267\"],\"2\":[\"260\",\"265\",\"272\",\"261\",\"263\",\"269\",\"270\",\"280\",\"273\",\"262\",\"279\"],\"3\":[\"253\",\"254\",\"255\"]}', '1:基础,2:扩展,3:客户参与设置', '', '', '', '', 'name:关键词组\r\ntitle:活动标题\r\nact_type:活动类型\r\ndiscount:折扣率\r\nstartup:开始时间\r\ndeadline:结束时间\r\nstatus:状态', '10', '', '', '1396968844', '1396968844', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('8', 'ticket', '优惠券', '6', '', '1', '{\"1\":[\"252\",\"251\",\"281\",\"278\",\"250\",\"264\",\"266\",\"267\"],\"2\":[\"260\",\"265\",\"272\",\"261\",\"263\",\"269\",\"270\",\"280\",\"273\",\"262\",\"279\"],\"3\":[\"253\",\"254\",\"255\",\"300\",\"301\"]}', '1:基础,2:扩展,3:客户参与设置', '', '', '', '', 'name:关键词组\r\ntitle:活动标题\r\nact_type:活动类型\r\nticket_prefix:优惠券前缀\r\nstartup:开始时间\r\ndeadline:结束时间\r\nmax:发行总量', '10', '', '', '1396968858', '1396968858', '1', 'MyISAM');

INSERT INTO `onethink_model`  VALUES ('41','tchat_qrcode','场景二维码','0', '', '1', '{\"1\":[\"400\",\"402\"]}', '1:永久二维码', '', '', '', '', 'action_name:二维码类型\r\nticket:获取二维码Ticket\r\nscene:场景\r\nscene_id:场景值ID', '10', '', '', '1394597229', '1394597323', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('51', 'tchat_album', '相册', '0', '', '1', '{\"1\":[\"420\",\"421\",\"422\",\"423\"]}', '1:基础', '', '', '', '', 'name:相册标识\r\ntitle:相册标题\r\nact_type:所属分类ID\r\nvote:投票设置', '10', '', '', '1396970451', '1396970451', '1', 'MyISAM');
INSERT INTO `onethink_model`  VALUES ('52', 'tchat_menu', '自定义菜单', '0', '', '1', '{\"1\":[\"457\",\"452\",\"451\",\"450\",\"453\",\"454\",\"455\",\"456\"]}', '1:基础', '', '', '', '', 'id:编号\r\nsort:排序\r\nname:显示名称\r\nkey:系统识别码\r\ntype:菜单类型\r\nurl:跳转链接\r\naction_type:触发类型\r\naction:动作指令\r\nstatus:状态\r\nuid:用户\r\n', '10', '', '', '1407334493', '1407334851', '1', 'MyISAM');

INSERT INTO `onethink_model`  VALUES ('53', 'product', '产品', '1', '', '1', '{\"1\":[\"2\",\"3\",\"480\",\"5\",\"12\",\"190\",\"19\"],\"2\":[\"10\",\"11\",\"9\",\"13\",\"14\",\"16\",\"17\",\"20\"],\"3\":[\"482\",\"481\",\"483\",\"484\",\"485\",\"486\",\"487\",\"488\"]}', '1:基础,2:高级,3:属性设置', '', '', '', '', 'id:编号\r\nname:产品\r\nprice:价格\r\nspecial_price:特价', '10', '', '', '1408519938', '1408519938', '1', 'MyISAM');

INSERT INTO `onethink_model`  VALUES ('54', 'tchat_plan', '产品套餐', '0', '', '1', '{\"1\":[\"501\",\"502\",\"505\",\"503\",\"504\",\"506\",\"511\",\"510\",\"500\"]}', '1:基础', '', '', '', '', 'id:编号\r\nname:产品\r\nprice:价格\r\nspecial_price:特价', '10', '', '', '1408519938', '1408519938', '1', 'MyISAM');

INSERT INTO `onethink_model`  VALUES ('55', 'tchat_topic', '产品专题', '0', '', '1', '{\"1\":[\"530\",\"531\",\"532\",\"533\",\"534\",\"535\",\"542\",\"536\",\"541\",\"540\"]}', '1:基础', '', '', '', '', 'id:编号\r\ntitle:名称', '10', '', '', '1408519938', '1408519938', '1', 'MyISAM');


-- -----------------------------
-- 新建产品文档模型扩展表 `onethink_document_product`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_document_product`;
CREATE TABLE `onethink_document_product` (
	`id` int(5) unsigned NOT NULL COMMENT '产品ID',
	`content` text NOT NULL DEFAULT '' COMMENT '产品详情',
    `special_price` FLOAT(10,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '产品特价',
    `price` FLOAT(10,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '产品价格',
    `pics` varchar(100) NOT NULL DEFAULT '0' COMMENT '产品图册图片的ID集合',
    `style` varchar(100) NOT NULL DEFAULT '' COMMENT '产品的类型',
    `spec` varchar(100) NOT NULL DEFAULT '' COMMENT '产品的规格',
    `features` varchar(100) NOT NULL DEFAULT '' COMMENT '产品特征',
    `amount` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '产品总量',
    `stock` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '产品库存',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '产品文档表';

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
UPDATE `onethink_auth_group` SET `title`='管理组',`description` = '用于网络管理人员的帐号组',`rules` = '1,2,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,39,40,46,47,48,49,50,51,52,53,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,100,102,103,107,108,109,110,195,207,211,213,214,300,301,302,303,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,329,330,331,332,333,400,401,402,403,404,405,406,407,408,409,410,411,412,413,450,451,452,453,454,455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,550,551,552,553,554,' WHERE `id` ='2' limit 1;
INSERT INTO `onethink_auth_group` VALUES ('3', 'admin', '1', '领导组', '用于领导人员的帐号组', '1', '1,2,3,15,16,17,18,23,24,26,27,88,107,108,109,110,301,306,307,308,309,310,311,312,313,314,315,316,317,318,322,407,408,409,410,411,412,413,451,453,456,459,461,464,466,550,551,554');
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

-- 微信板块权限设置

INSERT INTO `onethink_auth_rule` VALUES ('300', 'admin', '2', 'Admin/Wechat/index', '微信', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('301', 'admin', '1', 'Admin/WechatKeyword/index','关键词列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('302', 'admin', '1', 'Admin/WechatKeyword/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('303', 'admin', '1', 'Admin/WechatKeyword/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('304', 'admin', '1', 'Admin/WechatKeyword/update','保存', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('305', 'admin', '1', 'Admin/WechatKeyword/setStatus','改变状态', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('306', 'admin', '1', 'Admin/WechatKeyword/analytical','关键词分析', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('307', 'admin', '1', 'Admin/WechatKeyword/deadList','过期箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('308', 'admin', '1', 'Admin/WechatKeyword/disabled','禁用箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('309', 'admin', '1', 'Admin/WechatKeyword/recycle','回收站', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('310', 'admin', '1', 'Admin/WechatKeyword/restore','还原', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('311', 'admin', '1', 'Admin/WechatKeyword/clear','彻底删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('312', 'admin', '1', 'Admin/WechatClient/index','客户列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('313', 'admin', '1', 'Admin/WechatClient/group','客户分组', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('314', 'admin', '1', 'Admin/WechatClient/detail', '详情','1', '');

INSERT INTO `onethink_auth_rule` VALUES ('315', 'admin', '1', 'Admin/WechatMessage/index','消息列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('316', 'admin', '1', 'Admin/WechatMessage/setStar','星标消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('317', 'admin', '1', 'Admin/WechatMessage/archive','存档消息', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('318', 'admin', '1', 'Admin/WechatMessage/analytical','消息分析', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('319', 'admin', '1', 'Admin/WechatMessage/handle','处理消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('320', 'admin', '1', 'Admin/WechatMessage/delete','删除消息', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('321', 'admin', '1', 'Admin/WechatMessage/reply','回复消息', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('322', 'admin', '1', 'Admin/WechatMenu/viewMenu','查看菜单', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('323', 'admin', '1', 'Admin/WechatMenu/add','新增菜单', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('324', 'admin', '1', 'Admin/WechatMenu/edit','编辑菜单', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('325', 'admin', '1', 'Admin/WechatMenu/setStatus','改变状态', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('326', 'admin', '1', 'Admin/WechatEvent/index','事件列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('327', 'admin', '1', 'Admin/WechatEvent/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('328', 'admin', '1', 'Admin/WechatEvent/update','更新', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('338', 'admin', '1', 'Admin/WechatEvent/setStatus','改变状态', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('329', 'admin', '1', 'Admin/WechatQrcode/index','二维码列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('330', 'admin', '1', 'Admin/WechatQrcode/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('331', 'admin', '1', 'Admin/WechatQrcode/setStatus','改变状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('332', 'admin', '1', 'Admin/WechatQrcode/getTicket','获得Ticket', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('333', 'admin', '1', 'Admin/WechatQrcode/showQrcode','查看二维码', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('334', 'admin', '1', 'Admin/WechatText/index','文本列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('335', 'admin', '1', 'Admin/WechatText/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('336', 'admin', '1', 'Admin/WechatText/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('337', 'admin', '1', 'Admin/WechatText/remove','删除', '1', '');
-- 338编号已经用作事件更改状态

-- 活动板块权限设置

INSERT INTO `onethink_auth_rule` VALUES ('400', 'admin', '2', 'Admin/Activity/index','活动', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('401', 'admin', '1', 'Admin/Activity/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('402', 'admin', '1', 'Admin/Activity/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('403', 'admin', '1', 'Admin/Activity/setStatus','改变状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('404', 'admin', '1', 'Admin/Activity/update','保存', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('405', 'admin', '1', 'Admin/Activity/autoSave','保存草稿', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('406', 'admin', '1', 'Admin/Activity/batchOperate','导入', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('407', 'admin', '1', 'Admin/Activity/analytical','活动分析', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('408', 'admin', '1', 'Admin/Activity/disabled','禁用箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('409', 'admin', '1', 'Admin/Activity/draftBox','活动草稿箱', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('410', 'admin', '1', 'Admin/Activity/recycle','活动回收站', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('411', 'admin', '1', 'Admin/Activity/restore','还原', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('412', 'admin', '1', 'Admin/Activity/clear','彻底删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('413', 'admin', '1', 'Admin/Activity/index','活动列表', '1', '');

-- 产品板块权限设置

INSERT INTO `onethink_auth_rule` VALUES ('450', 'admin', '2', 'Admin/Product/myProduct', '产品', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('451', 'admin', '1', 'Admin/Product/index?cate_id=80', '产品列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('452', 'admin', '1', 'Admin/Product/edit', '编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('453', 'admin', '1', 'Admin/Product/setStatus', '更改状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('454', 'admin', '1', 'Admin/Product/remove', '删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('455', 'admin', '1', 'Admin/Product/add', '新增', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('456', 'admin', '1', 'Admin/ProductPlan/index', '产品套餐', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('457', 'admin', '1', 'Admin/ProductPlan/create', '新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('458', 'admin', '1', 'Admin/ProductPlan/edit', '编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('459', 'admin', '1', 'Admin/ProductPlan/setStatus', '更改状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('460', 'admin', '1', 'Admin/ProductPlan/update', '更新', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('461', 'admin', '1', 'Admin/ProductPlan/recycle', '已删除', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('462', 'admin', '1', 'Admin/ProductPlan/clear', '清空', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('463', 'admin', '1', 'Admin/ProductPlan/delete', '彻底删除', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('464', 'admin', '1', 'Admin/ProductTopic/index', '产品专题', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('465', 'admin', '1', 'Admin/ProductTopic/create', '新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('466', 'admin', '1', 'Admin/ProductTopic/edit', '编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('467', 'admin', '1', 'Admin/ProductTopic/setStatus', '更改状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('468', 'admin', '1', 'Admin/ProductTopic/update', '更新', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('469', 'admin', '1', 'Admin/ProductTopic/recycle', '已删除', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('470', 'admin', '1', 'Admin/ProductTopic/clear', '清空', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('471', 'admin', '1', 'Admin/ProductTopic/delete', '彻底删除', '1', '');


INSERT INTO `onethink_auth_rule` VALUES ('472', 'admin', '1', 'Admin/ProductCategory/index', '分类管理', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('473', 'admin', '1', 'Admin/ProductCategory/add', '新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('474', 'admin', '1', 'Admin/ProductCategory/edit', '编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('475', 'admin', '1', 'Admin/ProductCategory/operate', '操作', '1', '');

-- 相册板块权限设置

INSERT INTO `onethink_auth_rule` VALUES ('550', 'admin', '2', 'Admin/Album/index','相册', '1', '');

INSERT INTO `onethink_auth_rule` VALUES ('551', 'admin', '1', 'Admin/Album/index','相册列表', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('552', 'admin', '1', 'Admin/Album/create','新增', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('553', 'admin', '1', 'Admin/Album/edit','编辑', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('554', 'admin', '1', 'Admin/Album/setStatus','改变状态', '1', '');
INSERT INTO `onethink_auth_rule` VALUES ('555', 'admin', '1', 'Admin/Album/delete','删除', '1', '');


-- -----------------------------
-- Records of `onethink_category`
-- 默认设置的目录
-- -----------------------------
INSERT INTO `onethink_category` VALUES ('80', 'product', '产品分类', '0', '0', '10', '', '', '', '', '', '', '', '53', '2,1', '0', '0', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `onethink_category` VALUES ('81', 'product_cat1', '产品系列一', '80', '0', '10', '', '', '', '', '', '', '', '53', '2,1,3', '0', '1', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `onethink_category` VALUES ('82', 'product_cat2', '产品系列二', '80', '0', '10', '', '', '', '', '', '', '', '53', '2,1,3', '0', '1', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
INSERT INTO `onethink_category` VALUES ('83', 'product_cat3', '产品系列三', '80', '0', '10', '', '', '', '', '', '', '', '53', '2,1,3', '0', '1', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');

INSERT INTO `onethink_category` VALUES ('11', 'about', '关于', '0', '0', '10', '', '', '', '', '', '', '', '2', '2,1', '0', '0', '1', '0', '0', '1', '', '1379474947', '1382701539', '1', '0');
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
-- Add COLUMN `group` TO `onethink_channel`
-- -----------------------------
ALTER TABLE `onethink_channel` ADD `group` varchar(100) NOT NULL DEFAULT '' COMMENT '所属分组';

-- -----------------------------
-- Records of `onethink_channel`
-- -----------------------------
DELETE FROM `onethink_channel` WHERE `id` = '2' limit 1;
DELETE FROM `onethink_channel` WHERE `id` = '3' limit 1;
INSERT INTO `onethink_channel` VALUES ('4', '0', '关于', 'Article/index?category=about', '2', '1379475131', '1379483713', '1', '0','默认分组');
INSERT INTO `onethink_channel` VALUES ('5', '0', '新闻', 'Article/index?category=news', '3', '1379475131', '1379483713', '1', '0','默认分组');
INSERT INTO `onethink_channel` VALUES ('6', '0', '活动', 'Article/index?category=share', '4', '1379475131', '1379483713', '1', '0','默认分组');
INSERT INTO `onethink_channel` VALUES ('3', '0', '相册', 'Album/index', '5', '1379475131', '1379483713', '1', '0','默认分组');

-- -----------------------------
-- Records of `onethink_config`
-- -----------------------------
UPDATE `onethink_config` SET `value` = '1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n5:微信' WHERE `id`= '20' limit 1;
INSERT INTO `onethink_config` VALUES ('40', 'WECHAT_GHID', '1', '原始ID', '5', '', '公众帐号原始ID', '1378898976', '1379235841', '1', '', '1');
INSERT INTO `onethink_config` VALUES ('41', 'WECHAT_NAME', '1', '微信号', '5', '', '公众帐号官方账号', '1378898976', '1379235841', '1', '', '2');
INSERT INTO `onethink_config` VALUES ('42', 'WECHAT_NICKNAME', '1', '名称', '5', '', '公众帐号名称', '1378898976', '1379235841', '1', '', '0');
INSERT INTO `onethink_config` VALUES ('43', 'WECHAT_TOKEN', '1', '微信TOKEN', '5', '', '公众帐号的接入本地验证码,可自行设定，请确保微信后台开发者模式TOKEN填写与此保持一致', '1378898976', '1379235841', '1', 'Tchat', '5');
INSERT INTO `onethink_config` VALUES ('44', 'WECHAT_APP_ID', '1', 'APPID', '5', '', '公众帐号的APPID', '1378898976', '1379235841', '1', '', '6');
INSERT INTO `onethink_config` VALUES ('45', 'WECHAT_APP_SECRET', '1', 'APP_SECRET', '5', '', '公众帐号的APPSECRET', '1378898976', '1379235841', '1', '', '7');
INSERT INTO `onethink_config` VALUES ('46', 'WECHAT_ACCOUNT_TYPE', '4', '账号类型', '5', '0:订阅号\r\n1:服务号\r\n2:企业号', '公众帐号类型', '1378898976', '1379235841', '1', '0', '3');
INSERT INTO `onethink_config` VALUES ('47', 'WECHAT_ACCOUNT_RZ', '4', '认证状态', '5', '0:未认证\r\n1:已认证\r\n2:微博认证', '公众账号的认证状态', '1378898976', '1379235841', '1', '0', '4');
INSERT INTO `onethink_config` VALUES ('48', 'WECHAT_CUSTOM_SERVICE', '4', '多客服服务', '5', '0:未开通\r\n1:已开通', '公众帐号后台控制，只有已认证的服务号才可开通', '1378898976', '1379235841', '1', '0', '8');

INSERT INTO `onethink_config` VALUES ('60', 'COMPANY_TELEPHONE', '1', '联系电话', '1', '', '公司联系电话', '1378898976', '1379235841', '1', '', '20');
INSERT INTO `onethink_config` VALUES ('61', 'COMPANY_ADDRESS', '1', '地址', '1', '', '公司地址', '1378898976', '1379235841', '1', '', '21');
-- -----------------------------
-- Records of `onethink_menu`
-- -----------------------------
UPDATE `onethink_menu` SET `title` = '新闻', `tip` = '新闻类型文档管理',`sort`='3'  WHERE `id`= '2' limit 1;

-- 将系统原有的几个顶级目录除了“内容”（即上一条更新为“新闻”的条目）外，其他排序靠后

UPDATE `onethink_menu` SET `sort`='20'  WHERE `id`= '16' limit 1;
UPDATE `onethink_menu` SET `sort`='22'  WHERE `id`= '43' limit 1;
UPDATE `onethink_menu` SET `sort`='21'  WHERE `id`= '68' limit 1;
UPDATE `onethink_menu` SET `sort`='30'  WHERE `id`= '93' limit 1;

-- 新增微信板块管理目录

INSERT INTO `onethink_menu` VALUES ('300', '微信', '0', '2', 'Admin/Wechat/index', '0', '微信后台模块管理目录', '', '0');

INSERT INTO `onethink_menu` VALUES ('321', '关键词列表', '300', '0', 'Admin/WechatKeyword/index', '0', '查看关键词组的列表', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('322', '新增', '321', '0', 'Admin/WechatKeyword/create', '0', '新增一组关键词组', '', '0');
INSERT INTO `onethink_menu` VALUES ('323', '编辑', '321', '0', 'Admin/WechatKeyword/edit', '0', '编辑一组关键词组', '', '0');
INSERT INTO `onethink_menu` VALUES ('324', '改变状态', '321', '0', 'Admin/WechatKeyword/setStatus', '0', '更改当前关键词组的状态', '', '0');

INSERT INTO `onethink_menu` VALUES ('325', '关键词分析', '300', '0', 'Admin/WechatKeyword/analytical', '0', '查看关键词效果分析', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('326', '过期箱', '300', '0', 'Admin/WechatKeyword/deadList', '0', '查看已经过期的关键词组', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('327', '禁用箱', '300', '0', 'Admin/WechatKeyword/disabled', '0', '查看禁用的关键词组', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('328', '回收站', '300', '0', 'Admin/WechatKeyword/recycle', '0', '查看已经删除的关键词组', '关键词管理', '0');
INSERT INTO `onethink_menu` VALUES ('329', '还原', '328', '0', 'Admin/WechatKeyword/restore', '0', '还原一组关键词组', '', '0');
INSERT INTO `onethink_menu` VALUES ('330', '彻底删除', '328', '0', 'Admin/WechatKeyword/clear', '0', '彻底删除一组关键词组', '', '0');

-- 原本活动归到微信下的，但出于管理方便，另行开设顶级菜单，占了此处几个ID

INSERT INTO `onethink_menu` VALUES ('361', '客户列表', '300', '0', 'Admin/WechatClient/index', '0', '查看客户列表', '客户管理', '0');
INSERT INTO `onethink_menu` VALUES ('362', '客户分组', '300', '0', 'Admin/WechatClient/group', '0', '查看和管理客户分组', '客户管理', '0');
INSERT INTO `onethink_menu` VALUES ('363', '详情', '361', '0', 'Admin/WechatClient/detail', '0', '查看客户详细信息', '', '0');

INSERT INTO `onethink_menu` VALUES ('371', '消息列表', '300', '0', 'Admin/WechatMessage/index', '0', '查看客户消息列表', '消息管理', '0');
INSERT INTO `onethink_menu` VALUES ('372', '星标消息', '371', '0', 'Admin/WechatMessage/setStar', '0', '对客户消息进行星标操作', '消息管理', '0');
INSERT INTO `onethink_menu` VALUES ('373', '存档消息', '371', '0', 'Admin/WechatMessage/archive', '0', '存档客户消息条目', '消息管理', '0');

INSERT INTO `onethink_menu` VALUES ('374', '消息分析', '300', '0', 'Admin/WechatMessage/analytical', '0', '查看客户消息的分析', '消息管理', '0');

INSERT INTO `onethink_menu` VALUES ('375', '处理消息', '300', '0', 'Admin/WechatMessage/handle', '0', '处理当前客户的消息', '消息管理', '0');
INSERT INTO `onethink_menu` VALUES ('376', '删除消息', '375', '0', 'Admin/WechatMessage/delete', '0', '删除客户消息', '', '0');
INSERT INTO `onethink_menu` VALUES ('377', '回复消息', '375', '0', 'Admin/WechatMessage/reply', '0', '回复客服消息', '', '0');

INSERT INTO `onethink_menu` VALUES ('391', '查看菜单', '300', '0', 'Admin/WechatMenu/viewMenu', '0', '查看当前菜单', '自定义菜单', '0');
INSERT INTO `onethink_menu` VALUES ('392', '编辑菜单', '391', '0', 'Admin/WechatMenu/edit', '0', '编辑一条菜单项', '', '0');
INSERT INTO `onethink_menu` VALUES ('393', '改变状态', '391', '0', 'Admin/WechatMenu/setStatus', '0', '改变一条菜单的启用状态', '', '0');

INSERT INTO `onethink_menu` VALUES ('394', '新增菜单', '300', '0', 'Admin/WechatMenu/add', '0', '新增一项菜单项', '自定义菜单', '0');

INSERT INTO `onethink_menu` VALUES ('410','文本列表','300','0','Admin/WechatText/index','0','查看文本数据列表','文本素材','0');
INSERT INTO `onethink_menu` VALUES ('411','编辑','410','0','Admin/WechatText/edit','0','编辑文本内容','','0');
INSERT INTO `onethink_menu` VALUES ('412','删除','410','0','Admin/WechatText/remove','0','删除文本内容','','0');
INSERT INTO `onethink_menu` VALUES ('413','新增文本','300','0','Admin/WechatText/create','0','新建文本内容','文本素材','0');

INSERT INTO `onethink_menu` VALUES ('421', '二维码列表', '300', '0', 'Admin/WechatQrcode/index', '0', '所有场景值二维码的列表', '二维码管理', '0');
INSERT INTO `onethink_menu` VALUES ('422', '新增二维码', '300', '0', 'Admin/WechatQrcode/create', '0', '新增一个场景值二维码', '二维码管理', '0');
INSERT INTO `onethink_menu` VALUES ('423', '获取TICKET', '422', '0', 'Admin/WechatQrcode/getTicket', '0', '获取公众账号二维码的TICKET', '', '0');
INSERT INTO `onethink_menu` VALUES ('424', '查看二维码', '421', '0', 'Admin/WechatQrcode/showQrcode', '0', '查看二维码详情', '', '0');
INSERT INTO `onethink_menu` VALUES ('425', '改变状态', '421', '0', 'Admin/WechatQrcode/setStatus', '0', '更改二维码的启用状态', '', '0');

INSERT INTO `onethink_menu` VALUES ('430','事件列表','300','0','Admin/WechatEvent/index','0','查看事件回复设置状态','事件设置','0');
INSERT INTO `onethink_menu` VALUES ('431','编辑','430','0','Admin/WechatEvent/edit','0','设置某一事件回复内容','','0');
INSERT INTO `onethink_menu` VALUES ('432','更新','430','0','Admin/WechatEvent/update','0','更新事件设置内容','','0');
INSERT INTO `onethink_menu` VALUES ('433','更改状态','430','0','Admin/WechatEvent/setStatus','0','更改事件状态','','0');

-- 新增活动板块管理目录

INSERT INTO `onethink_menu` VALUES ('340', '活动', '0', '3', 'Admin/Activity/index', '0', '活动模块管理目录', '', '0');

INSERT INTO `onethink_menu` VALUES ('341', '新增活动', '340', '0', 'Admin/Activity/create', '0', '新增一项活动', '', '0');

INSERT INTO `onethink_menu` VALUES ('342', '活动列表', '340', '1', 'Admin/Activity/index', '0', '当前所有启用状态的活动的列表', '', '0');
INSERT INTO `onethink_menu` VALUES ('344', '编辑', '342', '0', 'Admin/Activity/edit', '0', '编辑一项活动', '', '0');
INSERT INTO `onethink_menu` VALUES ('345', '改变状态', '342', '0', 'Admin/Activity/setStatus', '0', '改变当前活动的状态', '', '0');
INSERT INTO `onethink_menu` VALUES ('346', '保存', '342', '0', 'Admin/Activity/update', '0', '新增或编辑时保存一项活动', '', '0');
INSERT INTO `onethink_menu` VALUES ('347', '保存草稿', '342', '0', 'Admin/Activity/autoSave', '0', '保存活动编辑时的草稿', '', '0');
INSERT INTO `onethink_menu` VALUES ('348', '导入', '342', '0', 'Admin/Activity/batchOperate', '0', '导入一项活动', '', '0');

INSERT INTO `onethink_menu` VALUES ('350', '活动分析', '340', '2', 'Admin/Activity/analytical', '0', '查看活动分析', '', '0');

INSERT INTO `onethink_menu` VALUES ('351', '活动禁用箱', '340', '3', 'Admin/Activity/disabled', '0', '列出当前禁用的活动', '', '0');

INSERT INTO `onethink_menu` VALUES ('352', '活动草稿箱', '340', '4', 'Admin/Activity/draftBox', '0', '活动的草稿箱', '', '0');

INSERT INTO `onethink_menu` VALUES ('353', '活动回收站', '340', '5', 'Admin/Activity/recycle', '0', '已经删除的活动的列表', '', '0');
INSERT INTO `onethink_menu` VALUES ('354', '还原', '353', '0', 'Admin/Activity/restore', '0', '还原已经删除的一项活动', '', '0');
INSERT INTO `onethink_menu` VALUES ('355', '彻底删除', '353', '0', 'Admin/Activity/clear', '0', '彻底删除一项活动', '', '0');

-- ----------------------
-- 新增产品板块管理目录
-- ----------------------
INSERT INTO `onethink_menu` VALUES ('500', '产品', '0', '4', 'Admin/Product/myProduct', '0', '产品后台模块管理目录', '', '0');
INSERT INTO `onethink_menu` VALUES ('501', '产品列表', '500', '0', 'Admin/Product/index?cate_id=80', '0', '列出我的产品', '产品管理', '0');
INSERT INTO `onethink_menu` VALUES ('502', '编辑', '501', '1', 'Admin/Product/edit', '0', '编辑一种产品的详细信息', '', '0');
INSERT INTO `onethink_menu` VALUES ('503', '改变状态', '501', '2', 'Admin/Product/setStatus', '0', '改变一种产品的启用（上架）状态', '', '0');
INSERT INTO `onethink_menu` VALUES ('504', '删除', '501', '3', 'Admin/Product/remove', '0', '删除一种产品', '', '0');

INSERT INTO `onethink_menu` VALUES ('520', '新增产品', '500', '0', 'Admin/Product/add', '0', '新增一种产品', '产品管理', '0');

INSERT INTO `onethink_menu` VALUES ('521', '查看分类', '500', '0', 'Admin/ProductCategory/index', '0', '查看当前的产品分类', '分类管理', '0');
INSERT INTO `onethink_menu` VALUES ('522', '新增', '521', '0', 'Admin/ProductCategory/add', '0', '新增一个产品分类', '', '0');
INSERT INTO `onethink_menu` VALUES ('523', '编辑', '521', '0', 'Admin/ProductCategory/edit', '0', '编辑一个产品分类', '', '0');
INSERT INTO `onethink_menu` VALUES ('524', '操作', '521', '0', 'Admin/ProductCategory/operate', '0', '操作一个产品分类', '', '0');

INSERT INTO `onethink_menu` VALUES ('540', '套餐列表', '500', '1', 'Admin/ProductPlan/index', '0', '多种产品构成的组合套餐', '套餐管理', '0');
INSERT INTO `onethink_menu` VALUES ('541', '新增套餐', '500', '0', 'Admin/ProductPlan/create', '0', '新增一款套餐', '套餐管理', '0');
INSERT INTO `onethink_menu` VALUES ('542', '编辑', '540', '0', 'Admin/ProductPlan/edit', '0', '编辑一款套餐的内容', '', '0');
INSERT INTO `onethink_menu` VALUES ('543', '更改状态', '540', '0', 'Admin/ProductPlan/setStatus', '0', '更改一种套餐的启用状态', '', '0');
INSERT INTO `onethink_menu` VALUES ('544', '更新', '540', '0', 'Admin/ProductPlan/update', '0', '更新数据', '', '0');

INSERT INTO `onethink_menu` VALUES ('545', '已删除', '500', '0', 'Admin/ProductPlan/recycle', '0', '查看已删除的套餐列表', '套餐管理', '0');
INSERT INTO `onethink_menu` VALUES ('546', '清空', '544', '0', 'Admin/ProductPlan/clear', '0', '清空已经删除的套餐', '', '0');
INSERT INTO `onethink_menu` VALUES ('547', '彻底删除', '544', '0', 'Admin/ProductPlan/delete', '0', '彻底删除一条记录', '', '0');

INSERT INTO `onethink_menu` VALUES ('550', '专题列表', '500', '2', 'Admin/ProductTopic/index', '0', '针对某场专题活动而进行的产品或套餐的组合', '专题管理', '0');
INSERT INTO `onethink_menu` VALUES ('551', '编辑', '550', '0', 'Admin/ProductTopic/edit', '0', '编辑一项专题的内容', '', '0');
INSERT INTO `onethink_menu` VALUES ('552', '更改状态', '550', '0', 'Admin/ProductTopic/setStatus', '0', '更改专题的启用状态', '', '0');
INSERT INTO `onethink_menu` VALUES ('553', '更新', '550', '0', 'Admin/ProductTopic/update', '0', '更新数据', '', '0');

INSERT INTO `onethink_menu` VALUES ('554', '新增专题', '500', '0', 'Admin/ProductTopic/create', '0', '新增一项专题', '专题管理', '0');

INSERT INTO `onethink_menu` VALUES ('555', '已删除', '500', '0', 'Admin/ProductTopic/recycle', '0', '查看已删除的专题列表', '专题管理', '0');
INSERT INTO `onethink_menu` VALUES ('556', '清空', '555', '0', 'Admin/ProductTopic/clear', '0', '清空已经删除的专题', '', '0');
INSERT INTO `onethink_menu` VALUES ('557', '彻底删除', '555', '0', 'Admin/ProductTopic/delete', '0', '彻底删除一条记录', '', '0');

-- --------------------
-- 新增相册板块管理目录
-- --------------------

INSERT INTO `onethink_menu` VALUES ('600', '相册', '0', '5', 'Admin/Album/index', '0', '相册模块管理目录', '', '0');

INSERT INTO `onethink_menu` VALUES ('601', '相册列表', '600', '0', 'Admin/Album/index', '0', '查看当前的相册列表', '相册管理', '0');
INSERT INTO `onethink_menu` VALUES ('602', '编辑', '601', '0', 'Admin/Album/edit', '0', '编辑一个相册', '', '0');
INSERT INTO `onethink_menu` VALUES ('603', '改变状态', '601', '0', 'Admin/Album/setStatus', '0', '改变一个相册的启用状态', '', '0');
INSERT INTO `onethink_menu` VALUES ('604', '删除', '601', '0', 'Admin/Album/delete', '0', '删除一个相册', '', '0');

INSERT INTO `onethink_menu` VALUES ('605', '新增相册', '600', '0', 'Admin/Album/create', '0', '新增一个相册', '相册管理', '0');

-- 若有其他板块的目录，可在此添加或在功能板块安装程序中向onethink_menu中添加目录数据，比如针对房地产行业的【地产】板块

-- -----------------------------
-- Add COLUMN `group` TO `onethink_channel`
-- -----------------------------
ALTER TABLE `onethink_document` ADD `index_pic` int(10) NOT NULL DEFAULT '0' COMMENT '索引列图片';

-- ---------------------------------------------
-- Table structure for `onethink_tchat_activity`
-- ---------------------------------------------
DROP TABLE IF EXISTS `onethink_tchat_activity`;
CREATE TABLE `onethink_tchat_activity` (
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动ID',
	`name` varchar(100) NOT NULL COMMENT '活动标识',
	`title` varchar(50) NOT NULL COMMENT '标题',
	`model_id` tinyint(3) unsigned NOT NULL DEFAULT '6' COMMENT '对应活动模型',
    `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
	`check_info` int(5) NOT NULL DEFAULT '0' COMMENT '参与活动是否需审核客户信息',
	`ex_keyword` varchar(10) NOT NULL DEFAULT '' COMMENT '客户个人信息时的前置关键词',
	`checked_reply` varchar(100) NOT NULL DEFAULT '' COMMENT '获取客户资料后的回复内容',
	`description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
	`root` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根节点',
	`pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属ID',
	`type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '内容类型',
	`position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
	`link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
	`cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面图片',
	`act_add` varchar(100) NOT NULL DEFAULT 'Local' COMMENT '活动地点',
	`display` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '可见性',
	`startup` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '启动时间',
	`deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '截止时间',
	`attach` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
	`view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
	`comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
	`extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扩展统计字段',
	`level` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	`status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态，-1-删除，0-禁用，1-正常，2-待审核，3-草稿',
	`parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
	`content` text NOT NULL COMMENT '文章内容',
	`template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
	`bookmark` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
	`index_pic` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '索引图片',
	PRIMARY KEY (`id`),
	KEY `idx_model_status` (`model_id`,`status`),
	KEY `idx_status_type_pid` (`status`,`uid`,`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='活动模型基础表';

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
-- Table structure for `onethink_tchat_activity_ticket`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_activity_ticket`;
CREATE TABLE `onethink_tchat_activity_ticket` (
	`id` int(5) unsigned NOT NULL COMMENT '活动ID',
	`ticket_prefix` char(4) NOT NULL COMMENT '优惠券前缀',
	`max_num` int(5) unsigned NOT NULL DEFAULT '300' COMMENT '发行总数量',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '优惠券控制表';

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
	`vote` tinyint(2) NOT NULL DEFAULT '0' COMMENT '投票设置,1为启用，0为禁用',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	PRIMARY KEY (`id`) 
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT '相册存储表';


-- -----------------------------
-- Table structure for `onethink_tchat_album_category`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_album_category`;
CREATE TABLE `onethink_tchat_album_category` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
	`name` varchar(30) NOT NULL COMMENT '标识',
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
	`allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许投稿',
	`display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
	`reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
	`check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的图片是否需要审核',
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
    `qq` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '客户QQ',
    `email` VARCHAR(100) NOT NULL DEFAULT '' COMMENT'客户电子邮箱',
	`nickname` VARCHAR(100) NOT NULL DEFAULT '' COMMENT'微信客户昵称',
	`sex` tinyint(4) DEFAULT '0' COMMENT '微信客户性别，1男2女0未知',
	`city` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '微信客户所在城市',
	`country` VARCHAR(20) NOT NULL DEFAULT '中国' COMMENT '微信客户所在国家',
	`province` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '微信客户所在省份',
	`language` VARCHAR(10) NOT NULL DEFAULT 'zh_CN' COMMENT '微信客户语言',
	`headimgurl` VARCHAR(200) NOT NULL DEFAULT '' COMMENT'微信客户头像',
	`subscribe_time` int(10) NOT NULL DEFAULT '0' COMMENT'微信客户关注时间',
	`event_key` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '扫描关注时的EventKey',
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
	`pic` varchar(200) NOT NULL COMMENT '微信客户图片id',
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
	`reply_type` varchar(20) NOT NULL DEFAULT'text' COMMENT '回应类型',
	`reply_id` varchar(250) NOT NULL DEFAULT '2' COMMENT '回复类型的自定义文章ID，文本及新闻分类只需要一个值',
	`status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态 -1：暂未开启 0：已经禁用 1：已经启用',
    `comment` varchar(250) NOT NULL DEFAULT '' COMMENT '事件说明',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '事件判断回复表';

-- -----------------------------
-- Records of `onethink_tchat_events`
-- -----------------------------
INSERT INTO `onethink_tchat_events` VALUES ('1','客户关注','subscribe','text','2','1','当客户新关注公众帐号时的回复内容设置');
INSERT INTO `onethink_tchat_events` VALUES ('2','扫描二维码','SCAN','news','21','1','当客户扫描带二维码事件时的回复内容。<br /><strong>注意：</strong>如果客户是通过扫描二维码关注帐号时，回复内容为“关注事件”中设置的内容，如果是已经关注的客户扫描，则回复本设置中的内容。');
INSERT INTO `onethink_tchat_events` VALUES ('3','上报地理位置','LOCATION','','','-1','客户上报地理位置事件的回复内容。');

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
-- Table structure for `onethink_tchat_keyword_group`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_keyword_group`;
CREATE TABLE `onethink_tchat_keyword_group` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '关键词组ID',
	`name` varchar(100) NOT NULL COMMENT '关键词组名',
	`segment` int(5) NOT NULL DEFAULT '0' COMMENT '关键词组所属模型',
	`segment_id` int(5) NOT NULL DEFAULT '0' COMMENT '板块条目ID',
	`reply_type` varchar(20) NOT NULL DEFAULT'text' COMMENT '回应类型',
	`reply_id` varchar(250) NOT NULL DEFAULT '' COMMENT '回复类型的自定义文章ID，文本及新闻分类只需要一个值',
	`start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '生效时间',
	`deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '失效时间',
	`dead_text` int(5) unsigned  NOT NULL DEFAULT '0' COMMENT '失效后回复文本',
	`status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '关键词使用状态，-1为删除，0为禁用，1为正常，',
	`uid` int(10) unsigned NOT NULL DEFAULT '2' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '关键词组回复内容表';

-- -----------------------------
-- Table structure for `onethink_tchat_message`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_message`;
CREATE TABLE `onethink_tchat_message` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '编号',
  `client_id` int(10) unsigned NOT NULL COMMENT'客户ID号',
  `type` varchar(100) NOT NULL COMMENT '消息类型',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) unsigned NOT NULL COMMENT '时间',
  `is_reply` tinyint(1) NOT NULL default '0' COMMENT '是否回复',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信消息数据表';

-- -----------------------------
-- Table structure for `onethink_tchat_menu`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_menu`;
CREATE TABLE `onethink_tchat_menu` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '编号',
  `menu_type` varchar(20) NOT NULL DEFAULT '' COMMENT '菜单类型',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '显示名称',
  `event_key` varchar(50) NOT NULL DEFAULT '' COMMENT '系统识别码',
  `sort` tinyint(2) NOT NULL default '0' COMMENT '排序',
  `url` varchar(250) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `action_type` varchar(20) NOT NULL default '' COMMENT '触发类型',
  `action_code` varchar(100) NOT NULL DEFAULT '' COMMENT '动作指令“关键词、功能、分类号、文章号”',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级菜单ID',
  `status` tinyint(2) NOT NULL default '1' COMMENT '状态',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信菜单数据表';

-- -----------------------------
-- Table structure for `onethink_tchat_music`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_music`;
CREATE TABLE `onethink_tchat_music` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '音乐型回复内容ID',
	`music_url`	varchar(200) NOT NULL UNIQUE COMMENT '音乐链接地址',
	`music_content` varchar(250) NOT NULL COMMENT '音乐描述',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '音乐类型回复内容表';

-- -----------------------------
-- Table structure for `onethink_tchat_plan`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_plan`;
CREATE TABLE `onethink_tchat_plan` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '套餐ID',
	`name`	varchar(100) NOT NULL DEFAULT '' COMMENT '套餐标识',
	`title`	varchar(100) NOT NULL DEFAULT '' UNIQUE COMMENT '套餐名称',
	`description`	varchar(250) NOT NULL DEFAULT '' UNIQUE COMMENT '描述',
	`products`	varchar(100) NOT NULL DEFAULT '0' COMMENT '产品',
	`price`	FLOAT(10,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '套餐价格',
	`cover_id`	int(10) NOT NULL DEFAULT '0' COMMENT '封面图片',
	`index_pic` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '索引图片',
	`status` tinyint(2) NOT NULL default '1' COMMENT '状态',
	`deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '失效时间',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '产品套餐内容表';

-- -----------------------------
-- Table structure for `onethink_tchat_topic`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_topic`;
CREATE TABLE `onethink_tchat_topic` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '专题ID',
	`name`	varchar(100) NOT NULL DEFAULT '' COMMENT '专题标识',
	`title`	varchar(100) NOT NULL DEFAULT '' UNIQUE COMMENT '专题名称',
	`description`	varchar(250) NOT NULL DEFAULT '' UNIQUE COMMENT '描述',
	`products`	varchar(100) NOT NULL DEFAULT '0' COMMENT '产品',
	`plans`	varchar(100) NOT NULL DEFAULT '0' COMMENT '套餐',
	`cover_id`	int(10) NOT NULL DEFAULT '0' COMMENT '封面图片',
	`index_pic` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '索引图片',
	`tags`	varchar(100) NOT NULL DEFAULT '' COMMENT '标签',
	`status` tinyint(2) NOT NULL default '1' COMMENT '状态',
	`deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '失效时间',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '产品专题内容表';

-- -----------------------------
-- Table structure for `onethink_tchat_segment`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_segment`;
CREATE TABLE `onethink_tchat_segment` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '板块ID',
	`name` varchar(30) NOT NULL COMMENT '标识',
	`title` varchar(50) NOT NULL COMMENT '板块标题',
    `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
    `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '板块安装状态 0 未安装 1 已安装',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '音乐类型回复内容表';

-- -----------------------------
-- Records of `onethink_tchat_segment`
-- -----------------------------
INSERT INTO `onethink_tchat_segment` VALUES ('1','activity','活动','各类活动管理','1');
INSERT INTO `onethink_tchat_segment` VALUES ('2','album','相册','相册管理模块','0');
INSERT INTO `onethink_tchat_segment` VALUES ('3','suggestion','建议','收集客户建议','0');
INSERT INTO `onethink_tchat_segment` VALUES ('4','music','音乐','音乐素材管理','0');
INSERT INTO `onethink_tchat_segment` VALUES ('5','vote','投票','投票管理','0');

-- -----------------------------
-- Table structure for `onethink_tchat_suggestion`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_suggestion`;
CREATE TABLE `onethink_tchat_suggestion` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '建议条目ID',
	`client_id` int(10) NOT NULL COMMENT '微信客户ID',
	`content` varchar(250) NOT NULL COMMENT '建议内容',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '微信客户建议内容表';

-- -----------------------------
-- Table structure for `onethink_tchat_text`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_text`;
CREATE TABLE `onethink_tchat_text` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '文本型回复内容ID',
	`content` varchar(250) NOT NULL UNIQUE COMMENT '文本回复内容',
	`uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	PRIMARY KEY(`id`),
	INDEX(`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '文本类型回复内容表';

-- -----------------------------
-- Records of `onethink_tchat_text`
-- 默认的文本内容
-- -----------------------------
INSERT INTO `onethink_tchat_text` VALUES ('1','感谢您的关注，如需了解如何使用请回复“帮助”或“?”','2','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('2','您可以通过回复如下关键字获取我们的信息\n帮助：获得账号的使用帮助\n新闻：了解我们的最新新闻或动态\n活动：了解我们的最新活动\n优惠：了解我们的最新优惠\n建议：给我们提提您的建议','2','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('3','非常感谢您的配合，祝您生活愉快。','2','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('55','哎呀，真不好意思，这个活动已经截止啦，好遗憾没能在那个疯狂的日子里见到你的身影，不过我们还有很多其他的活动正在进行，您可以回复“优惠”或“活动”，看看我们有哪些活动吧，这次可不要再错过咯。','2','1393292899','1393292899');
INSERT INTO `onethink_tchat_text` VALUES ('56','感谢您的配合，您的建议我们会送达相关部门处理，如有需要我们会跟您取得联系，谢谢。','2','1393292899','1393292899');

-- -----------------------------
-- Table structure for `onethink_tchat_qrcode`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_qrcode`;
CREATE TABLE `onethink_tchat_qrcode` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '微信二维码ID',
	`ticket` varchar(250) NOT NULL UNIQUE COMMENT 'Ticket编码',
	`action_name` varchar(10) NOT NULL DEFAULT '' COMMENT '二维码类型，QR_SCENE为临时,QR_LIMIT_SCENE为永久',
	`scene` varchar(50) NOT NULL DEFAULT '' COMMENT '应用场景',
	`scan_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二维码扫描次数', 	
	`create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	PRIMARY KEY(`id`),
	INDEX(`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '二维码存储表';

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
-- Table structure for `onethink_tchat_vote_list`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_tchat_vote_list`;
CREATE TABLE `onethink_tchat_vote_list` (
	`id` int(8) unsigned NOT NULL COMMENT '投票项目ID',
	`name` varchar(50) NOT NULL UNIQUE COMMENT '投票细项标识',
	`title` varchar(50) NOT NULL UNIQUE COMMENT '投票细项名称',
	`votes` int(10) NOT NULL DEFAULT '0' COMMENT '投票票数',
	`sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '投票细项列表';

-- ---------------------------
-- End of install tchat tables
-- ---------------------------
