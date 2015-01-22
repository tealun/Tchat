-- -----------------------------
-- 说明：本SQL文件用于为符合TCHAT系统需要而对ONETHINK系统数据表进行的一些结构和数据更改；
-- 目前更改过结构的表有：
-- 1、`onethink_channel`中增加了一个`group`字段，用于扩展分组导航
-- 2、`onethink_document` 中增加了一个`index_pic`字段，用于设置列表索引方形图（配合微信）
-- 3、`onethink_attribute` 中更新了id为12的的`remark`字段值，用于描述`onethink_document`中`cover_id`属性描述
-- -----------------------------

/*禁用插件id为3和4的插件*/
UPDATE `onethink_addons` SET `status` = '0' WHERE `onethink_addons`.`id` IN ('3','4');

/*更新文档模型cover_id的属性*/
UPDATE `onethink_attribute` SET `remark`='0-无封面，大于0-封面图片ID,建议尺寸为900*500像素(px)或700*420像素' WHERE `id` = '12' LIMIT 1；

/*更新配置的选项*/
UPDATE `onethink_config` SET `value` = '1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n5:微信' WHERE `id`= '20' limit 1;

/*为文档模型增加一个index_pic字段，用于微信显示方形文章图标*/
ALTER TABLE `onethink_document` ADD `index_pic` int(10) NOT NULL DEFAULT '0' COMMENT '索引列图片';

/*更新文档模型的显示字段排序*/
UPDATE `onethink_model` SET `field_sort`='{\"1\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"190\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]}'  WHERE `id` = '1' limit 1;
UPDATE `onethink_model` SET `field_sort`='{\"1\":[\"3\",\"24\",\"2\",\"5\"],\"2\":[\"9\",\"13\",\"19\",\"10\",\"12\",\"190\",\"16\",\"17\",\"26\",\"20\",\"14\",\"11\",\"25\"]}'  WHERE `id` = '2' limit 1;
UPDATE `onethink_model` SET `field_sort`='{\"1\":[\"3\",\"28\",\"30\",\"32\",\"2\",\"5\",\"31\"],\"2\":[\"13\",\"10\",\"27\",\"9\",\"12\",\"190\",\"16\",\"17\",\"19\",\"11\",\"20\",\"14\",\"29\"]}'  WHERE `id` = '3' limit 1;

/*扩展用户分组字段容量用于后期*/
ALTER TABLE `onethink_auth_group` CHANGE `rules` `rules` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开';
/*向管理员组添加权限主要为添加TCHAT权限*/
UPDATE `onethink_auth_group` SET `title`='管理员组',`description` = '用于网络管理人员的帐号组',`rules` = '1,2,3,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,34,36,37,38,39,40,41,46,47,48,49,50,51,52,53,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,100,102,103,107,108,109,110,195,207,211,213,214,215,216,300,301,302,303,305,306,307,308,309,310,311,312,313,314,315,316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,400,401,402,403,404,405,406,407,408,409,410,411,412,413,450,451,452,453,454,455,456,457,458,459,460,461,464,465,466,467,468,469,470,471,472,473,474,475,550,551,552,553,554,555,600,601,602,603,604,650' WHERE `id` ='2' limit 1;

/*向onethink_channel频道表中添加所属分组字段*/
ALTER TABLE `onethink_channel` ADD `group` varchar(100) NOT NULL DEFAULT '' COMMENT '所属分组';

/*将系统原有的几个顶级目录除了“内容”外，其他排序靠后*/
UPDATE `onethink_menu` SET `sort`='20'  WHERE `id`= '16' limit 1;
UPDATE `onethink_menu` SET `sort`='22'  WHERE `id`= '43' limit 1;
UPDATE `onethink_menu` SET `sort`='21'  WHERE `id`= '68' limit 1;
UPDATE `onethink_menu` SET `sort`='30'  WHERE `id`= '93' limit 1;

