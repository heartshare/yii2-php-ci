/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50619
 Source Host           : localhost
 Source Database       : phpci

 Target Server Type    : MySQL
 Target Server Version : 50619
 File Encoding         : utf-8

 Date: 08/31/2014 22:42:21 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `phpci_modules`
-- ----------------------------
DROP TABLE IF EXISTS `phpci_modules`;
CREATE TABLE `phpci_modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module` varchar(30) NOT NULL DEFAULT '' COMMENT '模块',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '模块名',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接地址',
  `version` varchar(50) NOT NULL DEFAULT '' COMMENT '版本号',
  `icon` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '图标文件存在与否',
  `category` varchar(30) NOT NULL DEFAULT '' COMMENT '模块所属分类',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '模块描述',
  `config` text COMMENT '模块配置，数组形式',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序 ',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已禁用',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装日期',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `phpci_modules_projects`
-- ----------------------------
DROP TABLE IF EXISTS `phpci_modules_projects`;
CREATE TABLE `phpci_modules_projects` (
  `project_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `config` text,
  PRIMARY KEY (`project_id`,`module_id`),
  KEY `module_id` (`module_id`),
  CONSTRAINT `FK_MODULES_ID` FOREIGN KEY (`module_id`) REFERENCES `phpci_modules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_PROJECTS_ID` FOREIGN KEY (`project_id`) REFERENCES `phpci_projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `phpci_projects`
-- ----------------------------
DROP TABLE IF EXISTS `phpci_projects`;
CREATE TABLE `phpci_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL DEFAULT '' COMMENT '项目名称',
  `created_at` int(10) NOT NULL DEFAULT '0',
  `updated_at` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `phpci_setting`
-- ----------------------------
DROP TABLE IF EXISTS `phpci_setting`;
CREATE TABLE `phpci_setting` (
  `skey` varchar(255) NOT NULL,
  `svalue` text,
  PRIMARY KEY (`skey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
