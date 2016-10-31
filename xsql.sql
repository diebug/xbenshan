/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : xsql

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-31 21:00:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `x_image`
-- ----------------------------
DROP TABLE IF EXISTS `x_image`;
CREATE TABLE `x_image` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `image_title` varchar(60) NOT NULL COMMENT '图片名称',
  `image` varchar(150) NOT NULL DEFAULT '' COMMENT '图片',
  `thumb` varchar(150) NOT NULL DEFAULT '' COMMENT '图片缩略图',
  `image_desc` text COMMENT '图片描述',
  `is_on_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架:是1 否 0',
  `category_id` mediumint(8) unsigned NOT NULL COMMENT '分类id',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `keywords` char(20) DEFAULT NULL COMMENT '图片关键字',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `is_on_sale` (`is_on_sale`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of x_image
-- ----------------------------
INSERT INTO `x_image` VALUES ('9', '', '58970748edc620fe5e783e66d8c25fcb.jpg', '', null, '1', '0', '1477916264', null, '1477916264');
INSERT INTO `x_image` VALUES ('10', '0123132', '2de1ecd1b37873223cfcff79bea09822.jpg', '', '79879', '1', '0', '1477917534', '456465', '1477917534');
INSERT INTO `x_image` VALUES ('11', '789', '', '', '789', '1', '0', '1477917599', '789', '1477917599');
INSERT INTO `x_image` VALUES ('12', '123', '2728e8a225eb6fee7ef2f62445a2f6c4.jpg', '', '123', '1', '0', '1477917642', '123', '1477917642');
