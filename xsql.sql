/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : xsql

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-10-28 22:00:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `x_image`
-- ----------------------------
DROP TABLE IF EXISTS `x_image`;
CREATE TABLE `x_image` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `image_name` varchar(60) NOT NULL COMMENT '图片名称',
  `image` varchar(150) NOT NULL DEFAULT '' COMMENT '图片',
  `thumb` varchar(150) NOT NULL DEFAULT '' COMMENT '图片缩略图',
  `image_desc` text COMMENT '图片描述',
  `is_on_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架:是1 否 0',
  `category_id` mediumint(8) unsigned NOT NULL COMMENT '分类id',
  ` time` int(10) unsigned DEFAULT '0' COMMENT '上传时间',
  `keyword` char(20) DEFAULT NULL COMMENT '图片关键字',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `is_on_sale` (`is_on_sale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of x_image
-- ----------------------------
