/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : xsql

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-11-02 21:05:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `x_image`
-- ----------------------------
DROP TABLE IF EXISTS `x_image`;
CREATE TABLE `x_image` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `image_title` varchar(60) NOT NULL COMMENT '图片标题',
  `keywords` char(20) DEFAULT NULL COMMENT '图片关键字',
  `image_desc` text COMMENT '图片描述',
  `image` varchar(150) NOT NULL DEFAULT '' COMMENT '图片',
  `thumb` varchar(150) NOT NULL DEFAULT '' COMMENT '图片缩略图',
  `category_id` mediumint(8) unsigned NOT NULL COMMENT '分类id',
  `create_time` int(10) unsigned DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) DEFAULT '0' COMMENT '更新时间',
  `is_on_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架:是1 否 0',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `is_on_sale` (`is_on_sale`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of x_image
-- ----------------------------
INSERT INTO `x_image` VALUES ('26', '132', '123', '123', 'dcd12a70a7d885151a249e2f966a90cf.jpg', 's_dcd12a70a7d885151a249e2f966a90cf.jpg', '0', '1478077528', '0', '1');
INSERT INTO `x_image` VALUES ('27', '', '0', '', '4391d53144639136a5ec886d477bc538.jpg', 's_4391d53144639136a5ec886d477bc538.jpg', '0', '1478078986', '0', '1');
INSERT INTO `x_image` VALUES ('28', '', '0', '', '2173c6680893fe3bc3f410d274f6e2a4.jpg', 's_2173c6680893fe3bc3f410d274f6e2a4.jpg', '0', '1478091565', '0', '1');
INSERT INTO `x_image` VALUES ('29', '', '0', '', '9d09e9e30fc82e9f3d399683b9b5fc13.jpg', 's_9d09e9e30fc82e9f3d399683b9b5fc13.jpg', '0', '1478091607', '0', '1');
