-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-12-10 05:36:25
-- 服务器版本： 5.7.26
-- PHP 版本： 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `qiye`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` char(32) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `login_count` int(4) DEFAULT NULL,
  `last_time` int(11) DEFAULT NULL,
  `is_update` tinyint(4) DEFAULT '1',
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `login_count`, `last_time`, `is_update`, `update_time`) VALUES
(1, 'admin', 'e99a18c428cb38d5f260853678922e03', 'php@qq.com', 61, 1575907401, 1, NULL),
(2, 'zhukui', 'e10adc3949ba59abbe56e057f20f883e', 'php@qq.com', 15, 1575907775, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `content` varchar(1024) NOT NULL,
  `source` varchar(64) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `source`, `update_time`, `delete_time`, `view_count`, `status`, `category_id`) VALUES
(2, '测试12', '<p>测试1</p>', '测试12', 1575856937, NULL, 0, 0, 3),
(3, '测试标题', '<p>测试标题测试标题</p>', '测试标题', 1575022578, 1575022578, 0, 1, 6),
(4, '测试标题2', '<p>测试内容测试内容测试内容</p>', '测试', 1575022578, 1575022578, 0, 1, 6),
(5, '测试标题', '<p>测试标题测试标题测试标题</p>', '测试标题测试标题', 1575856937, NULL, 0, 0, 4),
(6, '测试标题', '<p>测试标题测试标题</p>', '测试标题测试标题', 1575856937, NULL, 0, 0, 3),
(7, '娱乐新闻', '这是一则娱乐新闻', '网上', 1575856975, NULL, 0, 1, 9);

-- --------------------------------------------------------

--
-- 表的结构 `auth_group`
--

DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE IF NOT EXISTS `auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group`
--

INSERT INTO `auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '1,2,3,10,17,18,16,4,5,6,8,9'),
(2, '配置管理员', 1, '1,2,3,10,17,18,16');

-- --------------------------------------------------------

--
-- 表的结构 `auth_group_access`
--

DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE IF NOT EXISTS `auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_group_access`
--

INSERT INTO `auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` mediumint(9) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(5) NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `auth_rule`
--

INSERT INTO `auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `pid`, `level`, `sort`) VALUES
(1, 'admin', '管理员', 1, 1, '', 0, 0, 7),
(2, 'Admin/index', '管理员列表', 1, 1, '', 1, 1, 50),
(3, 'AuthRule/lst', '权限列表编辑', 1, 1, '', 1, 1, 50),
(4, 'system', '系统设置', 1, 1, '', 0, 0, 6),
(5, 'system/edit', '编辑设置', 1, 1, '', 4, 1, 50),
(6, 'system/del', '设置删除', 1, 1, '', 4, 1, 50),
(8, 'config', '设置', 1, 1, '', 0, 0, 5),
(9, 'Category/index', '栏目列表设置', 1, 1, '', 8, 1, 50),
(10, 'admin/del', '管理员删除', 1, 1, '', 1, 1, 50),
(18, 'AuthGroup/edit', '修改用户组', 1, 1, '', 17, 2, 50),
(17, 'AuthGroup/lst', '用户组管理', 1, 1, '', 1, 1, 50),
(16, 'Admin/edit', '修改管理员', 1, 1, '', 1, 1, 50);

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `image` varchar(200) NOT NULL COMMENT '图片路径与名称',
  `link` varchar(200) NOT NULL COMMENT '链接地址',
  `desc` varchar(200) NOT NULL COMMENT '图片描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`id`, `image`, `link`, `desc`) VALUES
(4, '20170825/34b7042cb210c640ce4be2a8fa828e54.jpg', 'www.php.cn', 'php中文网'),
(2, '20170825/d2a9713339a9f56f2521431a35b24ba9.png', 'peter.php.cn', 'ThinkPHP5企业站点开发'),
(6, '20191209\\b04101835c684b701eb944aea1488c6d.png', 'www.baidu.com', '式神少女闪屏');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cate_name` varchar(200) NOT NULL COMMENT '分类名称 ',
  `cate_order` int(4) NOT NULL DEFAULT '0' COMMENT '分类排序',
  `pid` int(11) NOT NULL COMMENT '父ID',
  `delete_time` int(11) DEFAULT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `cate_name`, `cate_order`, `pid`, `delete_time`, `status`) VALUES
(1, '新闻', 0, 0, NULL, 1),
(2, '资讯', 0, 0, NULL, 1),
(3, '公司新闻', 0, 1, NULL, 0),
(4, '部门新闻', 0, 1, NULL, 0),
(9, '娱乐咨询', 0, 2, NULL, 1),
(8, '公司咨询', 0, 2, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

DROP TABLE IF EXISTS `system`;
CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '网站标题',
  `keywords` varchar(255) NOT NULL COMMENT '网站关键字',
  `desc` varchar(255) NOT NULL COMMENT '网站描述',
  `is_close` tinyint(2) NOT NULL COMMENT '是否关闭1:关0:开',
  `is_update` tinyint(2) NOT NULL COMMENT '更新标志位',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`id`, `title`, `keywords`, `desc`, `is_close`, `is_update`) VALUES
(1, 'PHP中文网', 'php,thinkphp5,php中文网', 'ThinkPHP5企业站点快速开发教程', 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
