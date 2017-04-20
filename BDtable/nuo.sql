-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 04 月 20 日 11:05
-- 服务器版本: 5.6.24
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `nuo`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admin_user`
--

INSERT INTO `admin_user` (`Id`, `username`, `password`) VALUES
(1, 'Admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- 表的结构 `decodekey`
--

CREATE TABLE IF NOT EXISTS `decodekey` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `decodekey`
--

INSERT INTO `decodekey` (`Id`, `key`) VALUES
(1, 'addxaewdfasfxze1213');

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `GId` int(11) NOT NULL AUTO_INCREMENT,
  `lng` double DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`GId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`GId`, `lng`, `lat`, `description`, `name`) VALUES
(4, 102.85843438720703, 24.833008682250977, NULL, '狼人社'),
(2, 102.85999896240234, 24.831998596191408, NULL, 'B114'),
(3, 102.85799896240235, 24.833008682251, NULL, '樱华'),
(1, NULL, NULL, NULL, '糯团小助手'),
(6, 102.8609989624, 24.832098596191, '123465', 'Artix'),
(7, 102.8579989624, 24.833008682251, '', 'TEST12');

-- --------------------------------------------------------

--
-- 表的结构 `g_activity`
--

CREATE TABLE IF NOT EXISTS `g_activity` (
  `actID` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`actID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `g_dynamics`
--

CREATE TABLE IF NOT EXISTS `g_dynamics` (
  `DId` int(11) NOT NULL AUTO_INCREMENT,
  `imgsrc` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `Gid` int(11) NOT NULL,
  PRIMARY KEY (`DId`),
  KEY `Gid` (`Gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `g_dynamics`
--

INSERT INTO `g_dynamics` (`DId`, `imgsrc`, `date`, `description`, `Gid`) VALUES
(1, 'null', '2016-10-25', '为什么说没有明天。', 4),
(2, 'null', '2016-11-01', '你还没有女朋友', 2),
(3, 'null', '2016-11-02', '？？？？', 3),
(4, 'null', '2016-11-02', '我还没有女盆友', 2),
(5, 'null', '2016-11-02', 'acfun', 4),
(6, 'null', '2016-11-3', '下拉加载更多', 4),
(7, 'null', '1996-06-02', '欢迎来到糯团', 1),
(8, 'null', '2016-11-9', 'Hello', 4);

-- --------------------------------------------------------

--
-- 表的结构 `relations`
--

CREATE TABLE IF NOT EXISTS `relations` (
  `RId` int(11) NOT NULL AUTO_INCREMENT,
  `Uid` int(11) DEFAULT NULL,
  `Gid` int(11) DEFAULT NULL,
  PRIMARY KEY (`RId`),
  KEY `Uid` (`Uid`),
  KEY `Gid` (`Gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `relations`
--

INSERT INTO `relations` (`RId`, `Uid`, `Gid`) VALUES
(1, 9, 4),
(2, 9, 2),
(3, 9, 3),
(20, 49, 1),
(19, 48, 1),
(11, 9, 1),
(18, 47, 1),
(17, 46, 1),
(21, 50, 1),
(22, 51, 1),
(23, 52, 1),
(24, 53, 1),
(25, 54, 1),
(26, 55, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`UId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`UId`, `username`, `password`, `email`, `phone`, `token`) VALUES
(53, 'yansong', 'e10adc3949ba59abbe56e057f20f883e', '', 15151515151, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(52, '123456', 'e10adc3949ba59abbe56e057f20f883e', '', 13118311234, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(51, '123456', 'e10adc3949ba59abbe56e057f20f883e', '', 131117812371, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(9, 'kanoyami', 'e10adc3949ba59abbe56e057f20f883e', '12#@qq.com', 15687777122, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(54, '章回', 'e10adc3949ba59abbe56e057f20f883e', '', 18487255048, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(46, 'Secpro', 'e10adc3949ba59abbe56e057f20f883e', '', 13111781237, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(47, '大正', 'e10adc3949ba59abbe56e057f20f883e', '', 13503272432, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(48, '啊啊啊啊啊', 'e10adc3949ba59abbe56e057f20f883e', '', 11115645454, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(49, '哈哈哈哈', 'e10adc3949ba59abbe56e057f20f883e', '', 123456789000, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy'),
(50, '三星', 'cc10b6de9fb639c4b21f75f1495a7a1f', '', 15808870604, 'rfXt54yR3swCcUnI5KrO0GI+ztyDKu0d82iqfj7YT+1Om/uAwz3IA4SMDgAezSYy'),
(55, '12312', 'e10adc3949ba59abbe56e057f20f883e', '', 13111781236, '6vVfK6wA2bTOR2wJ1igiv4juhMY+qTWjXn6jyHHwTh5Om/uAwz3IA4SMDgAezSYy');

-- --------------------------------------------------------

--
-- 表的结构 `u_dynamics`
--

CREATE TABLE IF NOT EXISTS `u_dynamics` (
  `Did` int(11) NOT NULL AUTO_INCREMENT,
  `imgcrc` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `Uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`Did`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `u_dynamics`
--

INSERT INTO `u_dynamics` (`Did`, `imgcrc`, `date`, `description`, `Uid`) VALUES
(1, 'null', '2014-11-22', 'HelloWorld', 9),
(2, NULL, NULL, NULL, 46),
(3, NULL, '70-01-01', '今天我来到糯团啦', 47),
(4, NULL, '70-01-01', '今天我来到糯团啦', 48),
(5, NULL, '70-01-01', '今天我来到糯团啦', 49),
(6, NULL, '70-01-01', '今天我来到糯团啦', 50),
(7, NULL, '70-01-01', '今天我来到糯团啦', 51),
(12, NULL, '2016-11-16', '%23#~', 9),
(11, NULL, '2016-11-16', '54135', 9),
(13, NULL, '2016-11-16', '1283', 9),
(14, NULL, '2016-11-16', '%2&amp;#', 9),
(15, NULL, '2016-11-16', 'q82e', 9),
(16, NULL, '2016-11-16', 'q82e', 9),
(17, NULL, '2016-11-16', 'q82e', 9),
(18, NULL, '2016-11-16', '13', 9),
(19, NULL, '2016-11-16', '13', 9),
(20, NULL, '2016-11-16', '13', 9),
(21, NULL, '2016-11-16', '13', 9),
(22, NULL, '2016-11-16', '13', 9),
(23, NULL, '2016-11-16', 'oncnwibxiq', 9),
(24, NULL, '2016-11-16', 'oncnwibxiq', 9),
(25, NULL, '2016-11-16', 'oncnwibxiq', 9),
(26, NULL, '2016-11-16', '', 9),
(27, NULL, '70-01-01', '今天我来到糯团啦', 53),
(28, NULL, '70-01-01', '今天我来到糯团啦', 54),
(29, NULL, '2016-11-26', '648797', 9),
(30, NULL, '2016-11-26', '648797', 9),
(31, NULL, '2016-11-26', '', 9),
(32, NULL, '2016-11-26', '5494', 9),
(33, NULL, '70-01-01', '今天我来到糯团啦', 55),
(34, NULL, '2016-12-07', '23423', 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
