-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost:3306
-- ��������: 2004 �� 03 �� 22 �� 19:35
-- �������汾: 5.0.27
-- PHP �汾: 5.2.0
-- 
-- ���ݿ�: `data`
-- 

-- --------------------------------------------------------

-- 
-- ��Ľṹ `product`
-- 

CREATE TABLE `product` (
  `id` int(11) NOT NULL auto_increment,
  `productname` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=8 ;

-- 
-- �������е����� `product`
-- 

INSERT INTO `product` (`id`, `productname`) VALUES 
(1, 'ϴ�»�'),
(2, 'ϴ�·�'),
(3, 'ϴ�ྫ'),
(4, '����'),
(5, '����'),
(6, '�绰'),
(7, '���ӻ�');
