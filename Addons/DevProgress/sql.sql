-- -----------------------------
-- Table structure for `onethink_dev_progress`
-- -----------------------------
DROP TABLE IF EXISTS `onethink_dev_progress`;
CREATE TABLE `onethink_dev_progress` (
	`id` int(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '投票项目ID',
    `pid` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
	`content` varchar(255) NOT NULL UNIQUE COMMENT '内容',
	`status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态，-1为删除，0为待开发，1为开发中，2为已完成',
    `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	`complete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
	PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '投票细项列表';