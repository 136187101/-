-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost:3306
-- 生成日期: 2004 年 03 月 22 日 19:35
-- 服务器版本: 5.0.27
-- PHP 版本: 5.2.0
-- 
-- 数据库: `data`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `product`
-- 

CREATE TABLE `product` (
  `id` int(11) NOT NULL auto_increment,
  `productname` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=8 ;

-- 
-- 导出表中的数据 `product`
-- 

INSERT INTO `product` (`id`, `productname`) VALUES 
(1, '洗衣机'),
(2, '洗衣粉'),
(3, '洗洁精'),
(4, '肥皂'),
(5, '电脑'),
(6, '电话'),
(7, '电视机');
