-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-01-16 08:19:47
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mms`
--

-- --------------------------------------------------------

--
-- 表的结构 `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(12) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `groups`
--

INSERT INTO `groups` (`groupid`, `groupname`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `msgid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言id',
  `s_ip` varchar(15) NOT NULL COMMENT '发送者ip',
  `s_email` varchar(30) NOT NULL COMMENT '发送者邮箱',
  `m_id` int(11) unsigned NOT NULL COMMENT '接受者',
  `new` tinyint(1) NOT NULL COMMENT '新消息？',
  `content` varchar(100) NOT NULL COMMENT '内容',
  `time` timestamp NOT NULL COMMENT '时间',
  PRIMARY KEY (`msgid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `name` varchar(16) NOT NULL COMMENT '姓名',
  `sex` tinyint(1) NOT NULL COMMENT '1=>man 0=>woman',
  `avatar` varchar(40) NOT NULL COMMENT '头像',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `groups` int(2) unsigned NOT NULL COMMENT '分组',
  `description` varchar(60) NOT NULL COMMENT '个人说明',
  `phone` int(11) unsigned NOT NULL COMMENT '电话',
  `qq` int(11) unsigned NOT NULL COMMENT 'qq',
  `status` int(2) unsigned NOT NULL COMMENT '状态',
  `security` varchar(32) NOT NULL COMMENT '安全验证字段',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `name`, `sex`, `avatar`, `email`, `groups`, `description`, `phone`, `qq`, `status`, `security`) VALUES
(1, 'admin', '496da530c794fefdca2adb5f33cbce8f', 'aaa', 0, '', '', 1, '', 0, 0, 0, 'b6a95ce95559ad85905a85f4d6e1e7cb');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
