/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : wenjianguanli

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2016-02-29 13:27:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `file_inf`
-- ----------------------------
DROP TABLE IF EXISTS `file_inf`;
CREATE TABLE `file_inf` (
  `file_id` int(255) NOT NULL auto_increment,
  `md5file` varchar(255) NOT NULL,
  `file_name` varchar(255) character set gbk NOT NULL,
  `type_id` varchar(255) character set gbk NOT NULL,
  `upload_date` datetime NOT NULL,
  `share` enum('1','0') NOT NULL default '0',
  `download_count` smallint(50) NOT NULL default '0',
  `file_size` int(255) NOT NULL,
  `folder_id` int(255) NOT NULL default '0',
  `rem_name` varchar(50) character set gbk NOT NULL,
  PRIMARY KEY  (`file_id`,`rem_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file_inf
-- ----------------------------
INSERT INTO `file_inf` VALUES ('2', '', 'ceshi2.mp3', '4', '0000-00-00 00:00:00', '1', '0', '15123', '0', 'ceshi2');
INSERT INTO `file_inf` VALUES ('3', '', 'ceshi3.avi', '3', '0000-00-00 00:00:00', '1', '0', '13412', '0', 'ceshi3');
INSERT INTO `file_inf` VALUES ('4', '', 'ceshi4.gif', '1', '0000-00-00 00:00:00', '1', '0', '13512341', '0', 'ceshi4');
INSERT INTO `file_inf` VALUES ('5', '', 'ceshi5.doc', '2', '0000-00-00 00:00:00', '1', '0', '1341234', '0', 'ceshi5');
INSERT INTO `file_inf` VALUES ('6', '', 'ceshi1.rar', '5', '0000-00-00 00:00:00', '1', '0', '125433221', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('7', '27ee3ba49d3764fb82c9dc9b4233914f', 'php.txt', '2', '2016-02-29 10:13:51', '0', '0', '20', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('8', '1e576f541f8ab3408ffe94f323eb1c85', '新建文本文档.txt', '2', '2016-02-29 10:14:56', '0', '0', '369', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('9', '1e576f541f8ab3408ffe94f323eb1c85', '新建文本文档.txt', '2', '2016-02-29 10:50:42', '0', '0', '369', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('10', '1e576f541f8ab3408ffe94f323eb1c85', '新建文本文档.txt', '2', '2016-02-29 12:21:15', '0', '0', '369', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('11', '1e576f541f8ab3408ffe94f323eb1c85', '新建文本文档.txt', '2', '2016-02-29 12:21:33', '0', '0', '369', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('12', 'd41d8cd98f00b204e9800998ecf8427e', '新建文本文档.txt', '2', '2016-02-29 12:24:27', '0', '0', '0', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('13', 'd41d8cd98f00b204e9800998ecf8427e', '新建文本文档.txt', '2', '2016-02-29 12:30:56', '0', '0', '0', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('14', 'd41d8cd98f00b204e9800998ecf8427e', '新建文本文档.txt', '2', '2016-02-29 12:37:10', '0', '0', '0', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('15', '032f0677fd0e093c4de2b99efc119bd7', '02-数据库和jdbc.rar', '5', '2016-02-29 12:40:56', '0', '0', '3229630', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('16', '1e576f541f8ab3408ffe94f323eb1c85', '新建文本文档.txt', '2', '2016-02-29 12:47:59', '0', '0', '369', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('17', '1e576f541f8ab3408ffe94f323eb1c85', '新建文本文档.txt', '2', '2016-02-29 12:48:19', '0', '0', '369', '0', 'ceshi1');
INSERT INTO `file_inf` VALUES ('18', 'd41d8cd98f00b204e9800998ecf8427e', '新建文本文档.txt', '2', '2016-02-29 12:48:35', '0', '0', '0', '0', 'ceshi1');

-- ----------------------------
-- Table structure for `folder_inf`
-- ----------------------------
DROP TABLE IF EXISTS `folder_inf`;
CREATE TABLE `folder_inf` (
  `id` int(255) unsigned NOT NULL auto_increment,
  `pid` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `rem_name` varchar(20) NOT NULL,
  `creat_time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of folder_inf
-- ----------------------------
INSERT INTO `folder_inf` VALUES ('1', '0', 'ceshi', 'ceshi1', '0000-00-00 00:00:00');
INSERT INTO `folder_inf` VALUES ('2', '0', 'ceshi1', 'ceshi1', '0000-00-00 00:00:00');
INSERT INTO `folder_inf` VALUES ('7', '0', 'ceshi2', 'ceshi1', '2016-02-23 16:55:30');
INSERT INTO `folder_inf` VALUES ('8', '0', 'an', 'ceshi1', '2016-02-23 21:16:21');
INSERT INTO `folder_inf` VALUES ('9', '1', 'ceshi', 'ceshi1', '2016-02-23 21:19:46');

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` smallint(50) NOT NULL auto_increment,
  `message_id` varchar(20) NOT NULL,
  `message_topic` varchar(20) NOT NULL,
  `message_inf` varchar(255) NOT NULL,
  `message_time` datetime NOT NULL,
  `reply_id` varchar(20) NOT NULL,
  `reply_inf` varchar(255) NOT NULL,
  `reply_time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', 'ceshi2', 'ceshi5', 'ceshi5ceshi5ceshi5ceshi5', '2016-02-09 18:19:57', '', '', '0000-00-00 00:00:00');
INSERT INTO `message` VALUES ('2', 'ceshi4', 'ceshi0', 'ceshi0ceshi0ceshi0ceshi0ceshi0ceshi0', '2016-02-16 15:05:54', '', '', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `rele_list`
-- ----------------------------
DROP TABLE IF EXISTS `rele_list`;
CREATE TABLE `rele_list` (
  `id` int(11) NOT NULL,
  `file_id` int(11) default NULL,
  `rem_id` varchar(255) character set gbk default NULL,
  `file_path` varchar(255) character set gbk default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rele_list
-- ----------------------------

-- ----------------------------
-- Table structure for `rem_inf`
-- ----------------------------
DROP TABLE IF EXISTS `rem_inf`;
CREATE TABLE `rem_inf` (
  `rem_id` smallint(20) unsigned NOT NULL auto_increment,
  `rem_name` varchar(20) character set gbk NOT NULL,
  `rem_password` varchar(32) character set gbk NOT NULL,
  `vip` enum('1','0') NOT NULL default '0',
  `rem_sex` text NOT NULL,
  `login_time` datetime NOT NULL,
  `lastlogin_time` datetime NOT NULL,
  `login_count` int(20) NOT NULL,
  `personal_inf` varchar(50) character set gbk NOT NULL default '' COMMENT 'select if (personal_inf=''''){personal_inf=''请编辑您的信息''} ',
  `rem_email` varchar(20) character set gbk NOT NULL,
  PRIMARY KEY  (`rem_id`,`rem_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rem_inf
-- ----------------------------
INSERT INTO `rem_inf` VALUES ('1', 'ceshi1', '9464c3798239e316379036767f0ff7d1', '0', '男', '2016-01-03 15:25:17', '2016-02-29 10:13:38', '16', 'ceshi1ceshi1ceshi1ce', 'ceshi1@qw.cn');
INSERT INTO `rem_inf` VALUES ('2', 'ceshi2', '278d3dc8e6f014c132bf1b24e5f34712', '0', '女', '2016-01-03 15:25:31', '2016-02-23 17:09:24', '16', '企鹅礼金卡辜负了看过法国进口了发展目标文艺片缺乏的风', 'ceshi2@zcz.cn');
INSERT INTO `rem_inf` VALUES ('3', 'ceshi3', '0251a46981c76c258eca554794309f10', '0', '女', '2016-01-03 15:25:45', '2016-01-28 16:14:53', '3', 'ceshi3ceshi3ceshi3ce', 'ceshi3@afsd.cn');
INSERT INTO `rem_inf` VALUES ('4', 'ceshi4', '8500aa2679567187afcec22d80d06fc5', '0', '男', '2016-01-03 15:25:58', '2016-02-20 13:48:06', '11', '请编辑', 'ceshi4@qfasd.cn');
INSERT INTO `rem_inf` VALUES ('10', '阿三地方', 'a152e841783914146e4bcd4f39100686', '0', '女', '2016-01-17 14:41:04', '2016-02-09 17:17:56', '12', '', 'ceshi4@qfasd.cn');
INSERT INTO `rem_inf` VALUES ('14', 'ceshi11', 'cdb2db9c8bd70c014be0ed36dc05a363', '0', '男', '2016-02-24 13:32:05', '2016-02-24 13:32:24', '1', '', 'ceshi11@qw.cn');

-- ----------------------------
-- Table structure for `rem_record`
-- ----------------------------
DROP TABLE IF EXISTS `rem_record`;
CREATE TABLE `rem_record` (
  `note_id` int(50) unsigned NOT NULL auto_increment,
  `rem_name` varchar(20) NOT NULL,
  `rem_op` varchar(20) NOT NULL default '用户登录',
  `rem_ip` varchar(15) NOT NULL,
  `op_date` datetime NOT NULL,
  PRIMARY KEY  (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rem_record
-- ----------------------------
INSERT INTO `rem_record` VALUES ('1', 'test_demo', '用户登录', '127.0.0.1', '2015-12-06 18:59:13');
INSERT INTO `rem_record` VALUES ('2', '阿三的风格', '用户登录', '127.0.0.1', '2015-12-07 14:36:07');
INSERT INTO `rem_record` VALUES ('3', '阿三地方', '用户登录', '127.0.0.1', '2016-01-17 14:43:25');
INSERT INTO `rem_record` VALUES ('4', '阿三地方', '用户登录', '127.0.0.1', '2016-01-18 12:27:45');
INSERT INTO `rem_record` VALUES ('5', '阿三地方', '用户登录', '127.0.0.1', '2016-01-18 13:13:45');
INSERT INTO `rem_record` VALUES ('6', '阿三地方', '用户登录', '127.0.0.1', '2016-01-18 21:16:03');
INSERT INTO `rem_record` VALUES ('7', '阿三地方', '用户登录', '127.0.0.1', '2016-01-19 17:22:21');
INSERT INTO `rem_record` VALUES ('8', '阿三地方', '用户登录', '127.0.0.1', '2016-01-20 14:38:39');
INSERT INTO `rem_record` VALUES ('9', '阿三地方', '用户登录', '127.0.0.1', '2016-01-20 15:19:08');
INSERT INTO `rem_record` VALUES ('10', '阿三地方', '用户登录', '127.0.0.1', '2016-01-20 15:35:49');
INSERT INTO `rem_record` VALUES ('11', '阿三地方', '用户登录', '127.0.0.1', '2016-01-20 16:41:32');
INSERT INTO `rem_record` VALUES ('12', 'ceshi1', '用户登录', '127.0.0.1', '2016-01-20 18:52:42');
INSERT INTO `rem_record` VALUES ('13', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-20 18:55:31');
INSERT INTO `rem_record` VALUES ('14', 'ceshi1', '用户登录', '127.0.0.1', '2016-01-20 19:47:35');
INSERT INTO `rem_record` VALUES ('15', '阿三地方', '用户登录', '127.0.0.1', '2016-01-21 10:56:53');
INSERT INTO `rem_record` VALUES ('16', 'ceshi1', '用户登录', '127.0.0.1', '2016-01-21 12:51:34');
INSERT INTO `rem_record` VALUES ('17', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-21 16:29:52');
INSERT INTO `rem_record` VALUES ('18', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-21 16:30:49');
INSERT INTO `rem_record` VALUES ('19', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-21 16:41:53');
INSERT INTO `rem_record` VALUES ('20', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-21 16:55:52');
INSERT INTO `rem_record` VALUES ('21', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-21 16:59:11');
INSERT INTO `rem_record` VALUES ('22', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-21 17:00:54');
INSERT INTO `rem_record` VALUES ('23', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-24 15:39:11');
INSERT INTO `rem_record` VALUES ('24', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-24 16:36:34');
INSERT INTO `rem_record` VALUES ('25', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-24 16:57:19');
INSERT INTO `rem_record` VALUES ('26', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-24 16:59:58');
INSERT INTO `rem_record` VALUES ('27', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-25 15:20:28');
INSERT INTO `rem_record` VALUES ('28', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-25 16:26:15');
INSERT INTO `rem_record` VALUES ('29', 'ceshi4', '用户登录', '127.0.0.1', '2016-01-27 11:48:13');
INSERT INTO `rem_record` VALUES ('30', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-27 15:36:15');
INSERT INTO `rem_record` VALUES ('31', 'ceshi2', '用户登录', '127.0.0.1', '2016-01-28 14:20:40');
INSERT INTO `rem_record` VALUES ('32', 'ceshi3', '用户登录', '127.0.0.1', '2016-01-28 15:17:25');
INSERT INTO `rem_record` VALUES ('33', 'ceshi3', '用户登录', '127.0.0.1', '2016-01-28 16:09:48');
INSERT INTO `rem_record` VALUES ('34', 'ceshi3', '用户登录', '127.0.0.1', '2016-01-28 16:14:53');
INSERT INTO `rem_record` VALUES ('35', '阿三地方', '用户登录', '127.0.0.1', '2016-02-09 17:17:56');
INSERT INTO `rem_record` VALUES ('36', 'ceshi2', '用户登录', '127.0.0.1', '0000-00-00 00:00:00');
INSERT INTO `rem_record` VALUES ('37', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-09 18:12:42');
INSERT INTO `rem_record` VALUES ('38', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-10 15:59:10');
INSERT INTO `rem_record` VALUES ('39', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-16 14:55:56');
INSERT INTO `rem_record` VALUES ('40', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-16 14:57:25');
INSERT INTO `rem_record` VALUES ('41', 'ceshi4', '用户登录', '127.0.0.1', '2016-02-16 15:05:08');
INSERT INTO `rem_record` VALUES ('42', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-19 10:05:47');
INSERT INTO `rem_record` VALUES ('43', 'ceshi4', '用户登录', '127.0.0.1', '2016-02-20 13:48:06');
INSERT INTO `rem_record` VALUES ('44', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-20 15:56:57');
INSERT INTO `rem_record` VALUES ('45', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-21 13:16:39');
INSERT INTO `rem_record` VALUES ('46', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-22 09:38:01');
INSERT INTO `rem_record` VALUES ('47', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-22 09:40:10');
INSERT INTO `rem_record` VALUES ('48', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-22 09:42:02');
INSERT INTO `rem_record` VALUES ('49', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-22 16:20:52');
INSERT INTO `rem_record` VALUES ('50', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-23 15:59:53');
INSERT INTO `rem_record` VALUES ('51', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-23 16:34:06');
INSERT INTO `rem_record` VALUES ('52', 'ceshi2', '用户登录', '127.0.0.1', '2016-02-23 17:09:24');
INSERT INTO `rem_record` VALUES ('53', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-23 17:10:33');
INSERT INTO `rem_record` VALUES ('54', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-24 12:17:56');
INSERT INTO `rem_record` VALUES ('55', 'ceshi11', '用户登录', '127.0.0.1', '2016-02-24 13:32:24');
INSERT INTO `rem_record` VALUES ('56', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-24 15:08:17');
INSERT INTO `rem_record` VALUES ('57', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-26 15:59:44');
INSERT INTO `rem_record` VALUES ('58', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-27 09:59:17');
INSERT INTO `rem_record` VALUES ('59', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-28 13:51:24');
INSERT INTO `rem_record` VALUES ('60', 'ceshi1', '用户登录', '127.0.0.1', '2016-02-29 10:13:38');

-- ----------------------------
-- Table structure for `type`
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` int(11) unsigned NOT NULL auto_increment,
  `type_name` varchar(20) character set gbk NOT NULL,
  `type_inf` varchar(255) default NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
INSERT INTO `type` VALUES ('1', '图片', '图片图片图片图片图片');
INSERT INTO `type` VALUES ('2', '文档', '文档文档文档文档文档文档');
INSERT INTO `type` VALUES ('3', '视频', '');
INSERT INTO `type` VALUES ('4', '音乐', '');
INSERT INTO `type` VALUES ('5', '其他', '');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `ID` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_logincount` int(20) NOT NULL,
  `user_describe` varchar(20) NOT NULL default '管理员',
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'admin', '64', '管理员');
INSERT INTO `user` VALUES ('2', 'admin1', 'admin1', '11', '管理员');

-- ----------------------------
-- Table structure for `user_record`
-- ----------------------------
DROP TABLE IF EXISTS `user_record`;
CREATE TABLE `user_record` (
  `id` smallint(20) unsigned NOT NULL auto_increment,
  `user_name` varchar(29) NOT NULL,
  `user_operation` varchar(20) NOT NULL default '管理员登录',
  `user_ip` varchar(15) NOT NULL,
  `user_opdate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_record
-- ----------------------------
INSERT INTO `user_record` VALUES ('1', 'admin', '管理员登录', '127.0.0.1', '2015-12-06 18:44:42');
INSERT INTO `user_record` VALUES ('2', 'admin1', '管理员登录', '127.0.0.1', '2015-12-07 14:37:44');
INSERT INTO `user_record` VALUES ('3', 'admin', '管理员登录', '127.0.0.1', '2015-12-07 16:11:55');
INSERT INTO `user_record` VALUES ('4', 'admin', '管理员登录', '127.0.0.1', '2015-12-13 17:06:51');
INSERT INTO `user_record` VALUES ('5', 'admin', '管理员登录', '127.0.0.1', '2015-12-13 17:08:17');
INSERT INTO `user_record` VALUES ('6', 'admin', '管理员登录', '127.0.0.1', '2015-12-13 17:10:05');
INSERT INTO `user_record` VALUES ('7', 'admin', '管理员登录', '127.0.0.1', '2015-12-13 17:10:57');
INSERT INTO `user_record` VALUES ('8', 'admin', '管理员登录', '127.0.0.1', '2015-12-13 17:11:49');
INSERT INTO `user_record` VALUES ('9', 'admin', '管理员登录', '127.0.0.1', '2015-12-14 14:19:15');
INSERT INTO `user_record` VALUES ('10', 'admin', '管理员登录', '127.0.0.1', '2015-12-14 15:58:51');
INSERT INTO `user_record` VALUES ('11', 'admin', '管理员登录', '127.0.0.1', '2015-12-16 16:50:41');
INSERT INTO `user_record` VALUES ('12', 'admin', '管理员登录', '127.0.0.1', '2015-12-16 16:56:08');
INSERT INTO `user_record` VALUES ('13', 'admin', '管理员登录', '127.0.0.1', '2015-12-18 15:53:46');
INSERT INTO `user_record` VALUES ('14', 'admin', '管理员登录', '127.0.0.1', '2015-12-18 15:54:46');
INSERT INTO `user_record` VALUES ('15', 'admin', '管理员登录', '127.0.0.1', '2015-12-18 17:00:29');
INSERT INTO `user_record` VALUES ('16', 'admin', '管理员登录', '127.0.0.1', '2015-12-21 16:28:30');
INSERT INTO `user_record` VALUES ('17', 'admin', '管理员登录', '127.0.0.1', '2015-12-21 17:05:43');
INSERT INTO `user_record` VALUES ('18', 'admin', '管理员登录', '127.0.0.1', '2015-12-21 17:36:23');
INSERT INTO `user_record` VALUES ('19', 'admin', '管理员登录', '127.0.0.1', '2015-12-21 17:36:24');
INSERT INTO `user_record` VALUES ('20', 'admin', '管理员登录', '127.0.0.1', '2015-12-21 17:49:14');
INSERT INTO `user_record` VALUES ('21', 'admin', '管理员登录', '127.0.0.1', '2015-12-22 14:24:04');
INSERT INTO `user_record` VALUES ('22', 'admin', '管理员登录', '127.0.0.1', '2015-12-22 14:46:45');
INSERT INTO `user_record` VALUES ('23', 'admin1', '管理员登录', '127.0.0.1', '2015-12-23 15:22:29');
INSERT INTO `user_record` VALUES ('24', 'admin1', '管理员登录', '127.0.0.1', '2015-12-23 15:23:06');
INSERT INTO `user_record` VALUES ('25', 'admin1', '管理员登录', '127.0.0.1', '2015-12-23 15:26:15');
INSERT INTO `user_record` VALUES ('26', 'admin1', '管理员登录', '127.0.0.1', '2015-12-23 16:48:12');
INSERT INTO `user_record` VALUES ('27', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 16:39:36');
INSERT INTO `user_record` VALUES ('28', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 17:42:37');
INSERT INTO `user_record` VALUES ('29', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 18:06:05');
INSERT INTO `user_record` VALUES ('30', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 18:06:52');
INSERT INTO `user_record` VALUES ('31', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 19:51:37');
INSERT INTO `user_record` VALUES ('32', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 19:58:22');
INSERT INTO `user_record` VALUES ('33', 'admin', '管理员登录', '127.0.0.1', '2015-12-27 20:01:59');
INSERT INTO `user_record` VALUES ('34', 'admin1', '管理员登录', '127.0.0.1', '2015-12-28 13:36:16');
INSERT INTO `user_record` VALUES ('35', 'admin1', '管理员登录', '127.0.0.1', '2015-12-28 13:51:15');
INSERT INTO `user_record` VALUES ('36', 'admin1', '管理员登录', '127.0.0.1', '2015-12-28 14:32:46');
INSERT INTO `user_record` VALUES ('37', 'admin1', '管理员登录', '127.0.0.1', '2015-12-29 13:22:49');
INSERT INTO `user_record` VALUES ('38', 'admin', '管理员登录', '127.0.0.1', '2015-12-30 16:20:16');
INSERT INTO `user_record` VALUES ('39', 'admin', '管理员登录', '127.0.0.1', '2015-12-30 19:48:29');
INSERT INTO `user_record` VALUES ('40', 'admin', '管理员登录', '127.0.0.1', '2015-12-30 20:12:10');
INSERT INTO `user_record` VALUES ('41', 'admin1', '管理员登录', '127.0.0.1', '2015-12-30 20:14:40');
INSERT INTO `user_record` VALUES ('42', 'admin', '管理员登录', '127.0.0.1', '2015-12-30 20:18:43');
INSERT INTO `user_record` VALUES ('43', 'admin', '管理员登录', '127.0.0.1', '2016-01-02 11:52:30');
INSERT INTO `user_record` VALUES ('44', 'admin1', '管理员登录', '127.0.0.1', '2016-01-02 13:08:01');
INSERT INTO `user_record` VALUES ('45', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:21:58');
INSERT INTO `user_record` VALUES ('46', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:23:09');
INSERT INTO `user_record` VALUES ('47', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:24:00');
INSERT INTO `user_record` VALUES ('48', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:24:09');
INSERT INTO `user_record` VALUES ('49', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:24:14');
INSERT INTO `user_record` VALUES ('50', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:24:19');
INSERT INTO `user_record` VALUES ('51', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:24:36');
INSERT INTO `user_record` VALUES ('52', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:25:34');
INSERT INTO `user_record` VALUES ('53', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 16:27:26');
INSERT INTO `user_record` VALUES ('54', '121212', '修改成员[121212]信息', '127.0.0.1', '2016-01-02 18:39:15');
INSERT INTO `user_record` VALUES ('55', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:05:33');
INSERT INTO `user_record` VALUES ('56', '111111', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:05:37');
INSERT INTO `user_record` VALUES ('57', 'test_demo', '修改成员[test_demo]信息', '127.0.0.1', '2016-01-02 19:06:02');
INSERT INTO `user_record` VALUES ('58', 'test_demo', '修改成员[test_demo]信息', '127.0.0.1', '2016-01-02 19:07:06');
INSERT INTO `user_record` VALUES ('59', 'test_demo', '修改成员[test_demo]信息', '127.0.0.1', '2016-01-02 19:07:09');
INSERT INTO `user_record` VALUES ('60', 'test_demo', '修改成员[test_demo]信息', '127.0.0.1', '2016-01-02 19:08:06');
INSERT INTO `user_record` VALUES ('61', 'test_demo', '修改成员[test_demo]信息', '127.0.0.1', '2016-01-02 19:08:10');
INSERT INTO `user_record` VALUES ('62', '1234321', '修改成员[1234321]信息', '127.0.0.1', '2016-01-02 19:08:47');
INSERT INTO `user_record` VALUES ('63', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:17:12');
INSERT INTO `user_record` VALUES ('64', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:20:45');
INSERT INTO `user_record` VALUES ('65', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:20:48');
INSERT INTO `user_record` VALUES ('66', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:21:15');
INSERT INTO `user_record` VALUES ('67', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:21:46');
INSERT INTO `user_record` VALUES ('68', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:24:01');
INSERT INTO `user_record` VALUES ('69', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:30:56');
INSERT INTO `user_record` VALUES ('70', 'admin', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:33:25');
INSERT INTO `user_record` VALUES ('71', 'admin', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:38:07');
INSERT INTO `user_record` VALUES ('72', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:40:06');
INSERT INTO `user_record` VALUES ('73', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:41:04');
INSERT INTO `user_record` VALUES ('74', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:42:07');
INSERT INTO `user_record` VALUES ('75', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:42:38');
INSERT INTO `user_record` VALUES ('76', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:48:37');
INSERT INTO `user_record` VALUES ('77', 'admin1', '修改成员[121212]信息', '127.0.0.1', '2016-01-02 19:48:48');
INSERT INTO `user_record` VALUES ('78', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:50:31');
INSERT INTO `user_record` VALUES ('79', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:50:49');
INSERT INTO `user_record` VALUES ('80', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:50:58');
INSERT INTO `user_record` VALUES ('81', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:51:57');
INSERT INTO `user_record` VALUES ('82', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:52:09');
INSERT INTO `user_record` VALUES ('83', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:52:15');
INSERT INTO `user_record` VALUES ('84', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:52:39');
INSERT INTO `user_record` VALUES ('85', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:58:31');
INSERT INTO `user_record` VALUES ('86', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 19:59:27');
INSERT INTO `user_record` VALUES ('87', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 20:00:31');
INSERT INTO `user_record` VALUES ('88', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 22:31:05');
INSERT INTO `user_record` VALUES ('89', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 22:31:15');
INSERT INTO `user_record` VALUES ('90', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 22:58:49');
INSERT INTO `user_record` VALUES ('91', 'admin1', '修改成员[111111]信息', '127.0.0.1', '2016-01-02 23:01:22');
INSERT INTO `user_record` VALUES ('92', 'admin', '管理员登录', '127.0.0.1', '2016-01-03 12:42:08');
INSERT INTO `user_record` VALUES ('93', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:12:48');
INSERT INTO `user_record` VALUES ('94', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:13:28');
INSERT INTO `user_record` VALUES ('95', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:13:42');
INSERT INTO `user_record` VALUES ('96', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:14:50');
INSERT INTO `user_record` VALUES ('97', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:15:07');
INSERT INTO `user_record` VALUES ('98', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:15:23');
INSERT INTO `user_record` VALUES ('99', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:16:22');
INSERT INTO `user_record` VALUES ('100', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:16:34');
INSERT INTO `user_record` VALUES ('101', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:17:00');
INSERT INTO `user_record` VALUES ('102', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:20:21');
INSERT INTO `user_record` VALUES ('103', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 13:25:06');
INSERT INTO `user_record` VALUES ('104', 'admin', '修改成员[ceshi3]信息', '127.0.0.1', '2016-01-03 14:05:44');
INSERT INTO `user_record` VALUES ('105', 'admin', '修改成员[ceshi3]信息', '127.0.0.1', '2016-01-03 14:05:53');
INSERT INTO `user_record` VALUES ('106', 'admin', '修改成员[ceshi3]信息', '127.0.0.1', '2016-01-03 14:06:08');
INSERT INTO `user_record` VALUES ('107', 'admin', '修改成员[ceshi3]信息', '127.0.0.1', '2016-01-03 14:07:30');
INSERT INTO `user_record` VALUES ('108', 'admin', '修改成员[ceshi3]信息', '127.0.0.1', '2016-01-03 14:08:26');
INSERT INTO `user_record` VALUES ('109', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:09:01');
INSERT INTO `user_record` VALUES ('110', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:12:07');
INSERT INTO `user_record` VALUES ('111', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:12:10');
INSERT INTO `user_record` VALUES ('112', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:14:44');
INSERT INTO `user_record` VALUES ('113', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:16:55');
INSERT INTO `user_record` VALUES ('114', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:17:35');
INSERT INTO `user_record` VALUES ('115', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:17:39');
INSERT INTO `user_record` VALUES ('116', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:17:52');
INSERT INTO `user_record` VALUES ('117', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:17:53');
INSERT INTO `user_record` VALUES ('118', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:17:59');
INSERT INTO `user_record` VALUES ('119', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:18:41');
INSERT INTO `user_record` VALUES ('120', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:18:44');
INSERT INTO `user_record` VALUES ('121', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:41:31');
INSERT INTO `user_record` VALUES ('122', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:43:03');
INSERT INTO `user_record` VALUES ('123', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 14:43:53');
INSERT INTO `user_record` VALUES ('124', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:01:24');
INSERT INTO `user_record` VALUES ('125', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:01:27');
INSERT INTO `user_record` VALUES ('126', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:01:34');
INSERT INTO `user_record` VALUES ('127', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:10:41');
INSERT INTO `user_record` VALUES ('128', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:10:45');
INSERT INTO `user_record` VALUES ('129', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:11:22');
INSERT INTO `user_record` VALUES ('130', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:20:38');
INSERT INTO `user_record` VALUES ('131', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:21:03');
INSERT INTO `user_record` VALUES ('132', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:21:24');
INSERT INTO `user_record` VALUES ('133', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:21:32');
INSERT INTO `user_record` VALUES ('134', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:21:57');
INSERT INTO `user_record` VALUES ('135', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:22:11');
INSERT INTO `user_record` VALUES ('136', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:23:11');
INSERT INTO `user_record` VALUES ('137', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:24:33');
INSERT INTO `user_record` VALUES ('138', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:24:40');
INSERT INTO `user_record` VALUES ('139', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:27:25');
INSERT INTO `user_record` VALUES ('140', 'admin', '删除成员[]信息', '127.0.0.1', '2016-01-03 15:27:49');
INSERT INTO `user_record` VALUES ('141', 'admin', '修改管理员[admin]信息', '127.0.0.1', '2016-01-03 16:22:43');
INSERT INTO `user_record` VALUES ('142', 'admin', '删除管理员[admin2]信息', '127.0.0.1', '2016-01-03 18:24:43');
INSERT INTO `user_record` VALUES ('143', 'admin', '修改管理员[admin]信息', '127.0.0.1', '2016-01-03 18:24:54');
INSERT INTO `user_record` VALUES ('144', 'admin', '管理员登录', '127.0.0.1', '2016-01-04 16:08:15');
INSERT INTO `user_record` VALUES ('145', 'admin', '管理员登录', '127.0.0.1', '2016-01-05 13:23:58');
INSERT INTO `user_record` VALUES ('146', 'admin', '修改成员[]信息', '127.0.0.1', '2016-01-05 13:52:07');
INSERT INTO `user_record` VALUES ('147', 'admin', '修改成员[]信息', '127.0.0.1', '2016-01-05 13:52:11');
INSERT INTO `user_record` VALUES ('148', 'admin', '修改成员[]信息', '127.0.0.1', '2016-01-05 13:53:07');
INSERT INTO `user_record` VALUES ('149', 'admin', '修改成员[]信息', '127.0.0.1', '2016-01-05 13:53:12');
INSERT INTO `user_record` VALUES ('150', 'admin', '修改成员[]信息', '127.0.0.1', '2016-01-05 13:54:39');
INSERT INTO `user_record` VALUES ('151', 'admin', '修改成员[]信息', '127.0.0.1', '2016-01-05 13:55:20');
INSERT INTO `user_record` VALUES ('152', 'admin', '修改管理员[]信息', '127.0.0.1', '2016-01-05 14:01:19');
INSERT INTO `user_record` VALUES ('153', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:07:05');
INSERT INTO `user_record` VALUES ('154', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:07:12');
INSERT INTO `user_record` VALUES ('155', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:07:23');
INSERT INTO `user_record` VALUES ('156', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:07:34');
INSERT INTO `user_record` VALUES ('157', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:12:46');
INSERT INTO `user_record` VALUES ('158', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:28:14');
INSERT INTO `user_record` VALUES ('159', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:28:30');
INSERT INTO `user_record` VALUES ('160', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:29:49');
INSERT INTO `user_record` VALUES ('161', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:32:31');
INSERT INTO `user_record` VALUES ('162', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:32:44');
INSERT INTO `user_record` VALUES ('163', 'admin', '修改文件类型信息', '127.0.0.1', '2016-01-05 14:37:44');
INSERT INTO `user_record` VALUES ('164', 'admin', '删除文件ceshi1.jpg', '127.0.0.1', '2016-01-05 18:56:57');
INSERT INTO `user_record` VALUES ('165', 'admin', '修改文件信息', '127.0.0.1', '2016-01-05 18:57:17');
INSERT INTO `user_record` VALUES ('166', 'admin', '修改文件信息', '127.0.0.1', '2016-01-05 18:57:33');
INSERT INTO `user_record` VALUES ('167', 'admin', '管理员登录', '127.0.0.1', '2016-01-19 22:22:17');
INSERT INTO `user_record` VALUES ('168', 'admin', '管理员登录', '127.0.0.1', '2016-01-20 16:18:55');
INSERT INTO `user_record` VALUES ('169', 'admin', '修改类型信息', '127.0.0.1', '2016-01-20 17:10:38');
INSERT INTO `user_record` VALUES ('170', 'admin', '管理员登录', '127.0.0.1', '2016-01-21 10:58:24');
INSERT INTO `user_record` VALUES ('171', 'admin', '管理员登录', '127.0.0.1', '2016-01-24 16:42:57');
INSERT INTO `user_record` VALUES ('172', 'admin', '管理员登录', '127.0.0.1', '2016-01-27 14:17:03');
INSERT INTO `user_record` VALUES ('173', 'admin', '管理员登录', '127.0.0.1', '2016-01-28 16:10:55');
INSERT INTO `user_record` VALUES ('174', 'admin', '管理员登录', '127.0.0.1', '2016-02-02 22:33:10');
INSERT INTO `user_record` VALUES ('175', 'admin', '管理员登录', '127.0.0.1', '2016-02-02 22:33:10');
INSERT INTO `user_record` VALUES ('176', 'admin', '管理员登录', '127.0.0.1', '2016-02-02 22:33:11');
INSERT INTO `user_record` VALUES ('177', 'admin', '管理员登录', '127.0.0.1', '2016-02-16 14:59:23');
INSERT INTO `user_record` VALUES ('178', 'admin', '管理员登录', '127.0.0.1', '2016-02-16 14:59:34');
