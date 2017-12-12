-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 03 月 25 日 14:32
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zhannuo`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_user`
--

CREATE TABLE `admin_user` (
  `uid` int(2) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `quanxian` int(1) NOT NULL COMMENT '管理权限',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `admin_user`
--

INSERT INTO `admin_user` VALUES(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0);
INSERT INTO `admin_user` VALUES(5, '136187101', 'ac29723fdd5823c3e136afe47150723d', 1);

-- --------------------------------------------------------

--
-- 表的结构 `advertising`
--

CREATE TABLE `advertising` (
  `id` int(9) NOT NULL auto_increment,
  `image` varchar(1000) collate utf8_unicode_ci NOT NULL,
  `logo` varchar(50) collate utf8_unicode_ci NOT NULL,
  `url` varchar(100) collate utf8_unicode_ci NOT NULL,
  `px` int(9) NOT NULL,
  `zhanshi` int(9) NOT NULL default '0',
  `times` varchar(10) collate utf8_unicode_ci NOT NULL,
  `wide` int(9) NOT NULL,
  `high` int(9) NOT NULL,
  `weizhi` varchar(1000) character set utf8 NOT NULL COMMENT '广告位置',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `advertising`
--


-- --------------------------------------------------------

--
-- 表的结构 `brand`
--

CREATE TABLE `brand` (
  `brand_id` smallint(5) NOT NULL auto_increment,
  `brand_name` varchar(30) NOT NULL,
  `brand_logo` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `order_number` smallint(5) NOT NULL,
  `register` varchar(100) NOT NULL,
  `shelf` varchar(100) NOT NULL,
  `sale` int(9) NOT NULL,
  `founder` varchar(100) NOT NULL COMMENT '创始人',
  `ChineseName` varchar(100) NOT NULL,
  `Englishname` varchar(100) NOT NULL,
  `createtime` varchar(100) NOT NULL,
  `sort` varchar(100) NOT NULL,
  `brand_icon` varchar(100) NOT NULL,
  `synopsis` varchar(200) NOT NULL,
  PRIMARY KEY  (`brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `brand`
--


-- --------------------------------------------------------

--
-- 表的结构 `collect`
--

CREATE TABLE `collect` (
  `id` int(9) NOT NULL auto_increment,
  `user_id` int(9) NOT NULL,
  `news_id` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `collect`
--

INSERT INTO `collect` VALUES(4, 4, 6);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `comment_id` smallint(5) NOT NULL auto_increment,
  `user_id` smallint(5) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateline` int(10) NOT NULL,
  `reply_content` text NOT NULL,
  `state` int(1) NOT NULL COMMENT '状态',
  `status` int(2) NOT NULL default '0',
  `spare1` varchar(100) NOT NULL,
  `spare2` varchar(100) NOT NULL,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `comment`
--

INSERT INTO `comment` VALUES(12, 7, '5', 'sefsefse', 'segsegseg', 1307937843, 'fsegsegsegw', 1, 0, '', '');
INSERT INTO `comment` VALUES(11, 7, '5', 'aefsef', 'esfsef', 1307937839, 'gdhfthfhh', 1, 0, '', '');
INSERT INTO `comment` VALUES(14, 0, '0', 'sfsd', 'sdsd', 1309246485, '', 1, 0, '匿名用户', 'hfaidzh@163.com');

-- --------------------------------------------------------

--
-- 表的结构 `essay`
--

CREATE TABLE `essay` (
  `id` int(9) NOT NULL auto_increment,
  `ziid` int(9) NOT NULL,
  `title` varchar(50) collate utf8_unicode_ci NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `author` varchar(50) collate utf8_unicode_ci NOT NULL,
  `image` varchar(50) collate utf8_unicode_ci NOT NULL,
  `image_rot` varchar(50) collate utf8_unicode_ci NOT NULL,
  `files_url` varchar(50) collate utf8_unicode_ci NOT NULL,
  `zhicheng` varchar(50) collate utf8_unicode_ci NOT NULL,
  `type1` text collate utf8_unicode_ci NOT NULL,
  `type2` text character set utf8 collate utf8_turkish_ci NOT NULL,
  `type3` text collate utf8_unicode_ci NOT NULL,
  `type4` text collate utf8_unicode_ci NOT NULL,
  `type5` text collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `px` int(9) NOT NULL default '0',
  `times` varchar(30) collate utf8_unicode_ci NOT NULL,
  `cisu` int(9) NOT NULL,
  `tuijian` int(3) NOT NULL default '0',
  `keywords` varchar(300) character set utf8 NOT NULL COMMENT 'Meta关键字',
  `description` varchar(300) character set utf8 NOT NULL COMMENT 'Meta描述',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `essay`
--

INSERT INTO `essay` VALUES(1, 1, '公司介绍', '', '', '../../newspic/thumb_10244.jpg', 'newspic/201203259762.jpg', '', '', '', '', '', '', '', '<div>\r\n	<p style="text-align:left;text-indent:24pt;">\r\n		<span style="font-family:''宋体'';font-size:14px;">北京绽诺思特生物科技有限公司是中国第一家注册成立的，专注于为全国各地科研院所、学校和相关实验机构及公司提供生测实验用虫的公司。公司以国内植保方面试虫养殖和生测技术最标准的研究所为技术依托，打造国际化标准的专业化试虫培育和实验基地，根据客户对试虫种类和数量的要求，以订单式生产确保实验之需。</span><span style="font-family:''宋体'';font-size:12pt;"></span> \r\n	</p>\r\n	<p style="text-align:left;text-indent:24pt;">\r\n		<span style="font-family:''宋体'';font-size:14px;">北京绽诺思特生物科技有限公司以中国农业科技的发展为最高奋斗目标，本着承诺、守诺和信诺的工作精神，坚持提供最标准、最优质丰富的试虫产品，以及相应最周全的配套技术和服务，以诚实守信为原则，省力便捷为宗旨，根据客户的多元化需求，满足在农业害虫生物和药效实验中的各种需要，为您的实验助力！</span><span style="font-family:''宋体'';font-size:12pt;"></span> \r\n	</p>\r\n	<p style="text-align:left;text-indent:24pt;">\r\n		<span style="font-family:''宋体'';font-size:14px;">如今，我们以试虫饲养和生测技术在国内最顶端的实验室为技术依托，针对目前国内外研究进展状况，批量生产各种实验用虫及提供试虫饲料和生测技术。</span><span style="font-family:''宋体'';font-size:12pt;"></span> \r\n	</p>\r\n</div>', 0, '2012-03-25 19:11:51', 0, 0, '', '');
INSERT INTO `essay` VALUES(2, 1, '经典案例', '', '', '', '', '', '', '', '', '', '', '', '<p style="text-indent:-18pt;margin-left:36pt;">\r\n	<span style="font-family:''Arial'';color:#000000;font-size:14px;">•&nbsp;</span><span style="font-family:''宋体'';color:#000000;font-size:14px;">山东农科院植保所</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>\r\n<p style="text-indent:-18pt;margin-left:36pt;">\r\n	<span style="font-family:''Arial'';color:#000000;font-size:14px;">•&nbsp;</span><span style="font-family:''宋体'';color:#000000;font-size:14px;">安徽省农科院植保所</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>\r\n<p style="text-indent:-18pt;margin-left:36pt;">\r\n	<span style="font-family:''Arial'';color:#000000;font-size:14px;">•&nbsp;</span><span style="font-family:''宋体'';color:#000000;font-size:14px;">海南农科院植保所</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>\r\n<p style="text-indent:-18pt;margin-left:36pt;">\r\n	<span style="font-family:''Arial'';color:#000000;font-size:14px;">•&nbsp;</span><span style="font-family:''宋体'';color:#000000;font-size:14px;">浙江化工技术研究院</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>\r\n<p style="text-indent:-18pt;margin-left:36pt;">\r\n	<span style="font-family:''Arial'';color:#000000;font-size:14px;">•&nbsp;</span><span style="font-family:''宋体'';color:#000000;font-size:14px;">河南农业大学</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>\r\n<p style="text-indent:-18pt;margin-left:36pt;">\r\n	<span style="font-family:''Arial'';color:#000000;font-size:14px;">•&nbsp;</span><span style="font-family:''宋体'';color:#000000;font-size:14px;">浙江大学</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>\r\n<p style="text-indent:-27.35pt;margin-left:27.35pt;">\r\n	<span style="font-family:''Calibri'';color:#000000;font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;…….</span><span style="font-family:''宋体'';font-size:15pt;"></span>\r\n</p>', 0, '2012-03-25 19:11:43', 0, 0, '', '');
INSERT INTO `essay` VALUES(3, 3, '棉铃虫', '', '', '../../newspic/thumb_59111.jpg', 'newspic/201203258321.jpg', '', '', '', '', '', '', '', '<div>\r\n	<p>\r\n		<span style="font-family:''宋体'';font-size:14px;">棉铃虫：鳞翅目夜蛾科，</span><span style="font-family:''Calibri'';font-size:14px;">拉丁名：</span><span style="font-style:italic;font-family:''Times New Roman'';font-size:14px;">Helicoverpa</span><span style="font-style:italic;font-family:''宋体'';font-size:14px;">&nbsp;</span><span style="font-style:italic;font-family:''Times New Roman'';font-size:14px;">armigera</span><span style="font-style:italic;font-family:''宋体'';font-size:14px;">&nbsp;</span><span style="font-family:''Times New Roman'';font-size:14px;">Hubner</span><span style="font-family:''宋体'';font-size:14px;">，</span><span style="font-family:''Calibri'';font-size:14px;">是棉花蕾铃期重要钻蛀性害虫，主要蛀食蕾、花、铃，也取食嫩叶。广泛分布在</span><span><a href="http://baike.baidu.com/view/61891.htm"><span style="font-family:''Calibri'';font-size:14px;">中国</span></a></span><span style="font-family:''Calibri'';font-size:14px;">及世界各地，中国棉区和蔬菜种植区均有发生。</span><span><a href="http://baike.baidu.com/view/416446.htm"><span style="font-family:''Calibri'';font-size:14px;">黄河流域</span></a></span><span style="font-family:''Calibri'';font-size:12pt;"><span style="font-size:14px;">棉区、长江流域棉区受害较重。</span><a name="_GoBack"></a></span><span style="font-family:''Calibri'';font-size:10.5pt;"></span> \r\n	</p>\r\n</div>', 0, '2012-03-25 20:37:06', 0, 1, '', '');
INSERT INTO `essay` VALUES(4, 3, '玉米螟', '', '', '../../newspic/thumb_59567.jpg', 'newspic/201203251816.jpg', '', '', '', '', '', '', '', '<div>\r\n	<p style="background:#ffffff;">\r\n		<span style="font-family:''宋体'';font-size:14px;">玉米螟：鳞翅目螟蛾科，拉丁名：</span><span style="font-family:''宋体'';font-size:14px;">玉米螟</span><span style="font-style:italic;font-family:''Calibri'';font-size:14px;">Ostrinia&nbsp;furnacalis</span><span style="font-family:''Calibri'';font-size:14px;">&nbsp;Guenee</span><span style="font-family:''宋体'';font-size:14px;">，</span><span style="font-family:''Times New Roman'';font-size:14px;">是玉米的主要虫害</span><span style="font-family:''宋体'';font-size:14px;">，</span><span style="font-family:''Times New Roman'';font-size:14px;">可发危害玉米植株地上的各个部位，降低籽粒产量。主要分布于北京、东北、河北、</span><span><a href="http://baike.baidu.com/view/2874.htm"><span style="font-family:''Times New Roman'';font-size:14px;">河南</span></a></span><span style="font-family:''Times New Roman'';font-size:14px;">、四川、</span><span><a href="http://baike.baidu.com/view/4652.htm"><span style="font-family:''Times New Roman'';font-size:14px;">广西</span></a></span><span style="font-family:''Times New Roman'';font-size:12pt;"><span style="font-size:14px;">等地。各地的春、夏、秋播玉米都有不同程度受害，尤以夏播玉米最重。</span><a name="_GoBack"></a></span><span style="font-family:''Times New Roman'';font-size:12pt;"></span>\r\n	</p>\r\n	<p>\r\n		<span style="font-family:''Calibri'';font-size:10.5pt;"></span>\r\n	</p>\r\n</div>', 0, '2012-03-25 19:22:35', 0, 0, '', '');
INSERT INTO `essay` VALUES(5, 3, '水稻二化螟', '', '', '../../newspic/thumb_82446.jpg', 'newspic/201203252129.jpg', '', '', '', '', '', '', '', '<div>\r\n	<p>\r\n		<span style="font-family:''宋体'';font-size:14px;">水稻二化螟：鳞翅目螟蛾科，拉丁名：</span><span style="font-style:italic;font-family:''Times New Roman'';font-size:14px;">Chilo</span><span style="font-style:italic;font-family:''宋体'';font-size:14px;">&nbsp;</span><span style="font-style:italic;font-family:''Times New Roman'';font-size:14px;">suppressalis</span><span style="font-style:italic;font-family:''宋体'';font-size:14px;">&nbsp;</span><span style="font-family:''Times New Roman'';font-size:14px;">Walke</span><span style="font-family:''宋体'';font-size:14px;">，</span><span style="font-family:''Calibri'';font-size:14px;">是我国水稻上危害最为严重的</span><span><a href="http://baike.baidu.com/view/1102012.htm"><span style="font-family:''Times New Roman'';font-size:14px;text-decoration:none;">常发</span></a></span><span style="font-family:''Calibri'';font-size:14px;">性害虫之一，在分蘖期受害造成枯鞘、枯心苗，在穗期受害造成虫伤株和</span><span><a href="http://baike.baidu.com/view/1561070.htm"><span style="font-family:''Times New Roman'';font-size:14px;text-decoration:none;">白穗</span></a></span><span style="font-family:''Calibri'';font-size:10.5pt;"><span style="font-size:14px;">。国内各稻区均有分布，主要以长江流域及以南稻区发生较重。二化螟除危害水稻外，还能危害茭白、玉米、高粱、甘蔗、油菜、蚕豆、麦类等。</span><a name="_GoBack"></a></span><span style="font-family:''Calibri'';font-size:10.5pt;"></span>\r\n	</p>\r\n</div>', 0, '2012-03-25 19:23:14', 0, 0, '', '');
INSERT INTO `essay` VALUES(6, 3, '桃蛀螟', '', '', '../../newspic/thumb_67343.jpg', 'newspic/201203254201.jpg', '', '', '', '', '', '', '', '桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟桃蛀螟', 0, '2012-03-25 19:23:56', 0, 0, '', '');
INSERT INTO `essay` VALUES(7, 3, '小菜蛾', '', '', '../../newspic/thumb_57238.jpg', 'newspic/201203256417.jpg', '', '', '', '', '', '', '', '小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾小菜蛾', 0, '2012-03-25 19:24:15', 0, 0, '', '');
INSERT INTO `essay` VALUES(8, 5, '最新动态1', '', '', '', '', '', '', '', '', '', '', '', '最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1最新动态1', 0, '2012-03-25 19:59:46', 0, 0, '', '');
INSERT INTO `essay` VALUES(9, 5, '最新动态2', '', '', '', '', '', '', '', '', '', '', '', '最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2最新动态2<span style="display:none;" id="__kindeditor_bookmark_start_25__"></span>最新动态2最新动态2最新动态2最新动态2\r\n<div style="position:absolute;width:1px;white-space:nowrap;height:1px;overflow:hidden;top:42px;left:-1981px;" class="__kindeditor_paste__">\r\n	最新动态2\r\n</div>', 0, '2012-03-25 19:59:58', 0, 0, '', '');
INSERT INTO `essay` VALUES(10, 5, '最新动态3', '', '', '', '', '', '', '', '', '', '', '', '最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3最新动态3', 0, '2012-03-25 20:00:06', 0, 0, '', '');
INSERT INTO `essay` VALUES(11, 5, '最新动态4', '', '', '', '', '', '', '', '', '', '', '', '最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4最新动态4', 0, '2012-03-25 20:00:16', 0, 0, '', '');
INSERT INTO `essay` VALUES(12, 5, '最新动态5', '', '', '', '', '', '', '', '', '', '', '', '最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5最新动态5vvvvvvvvvvvvvv最新动态5最新动态5', 0, '2012-03-25 20:00:25', 0, 0, '', '');
INSERT INTO `essay` VALUES(13, 6, '订购指南', '', '', '', '', '', '', '', '', '', '', '', '<img alt="" src="/admin/hjd_Ub/attached/image/20120325/20120325121836_44996.jpg" /><strong></strong>', 0, '2012-03-25 20:18:38', 0, 0, '', '');
INSERT INTO `essay` VALUES(14, 6, '联系我们', '', '', '', '', '', '', '', '', '', '', '', '<p>\r\n	<span style="font-family:''宋体'';font-size:14pt;"><span style="font-size:14px;">公司地址</span><span style="font-size:14px;">:</span><span style="font-size:14px;">北京市海淀区阜成路</span><span style="font-size:14px;">46</span><span style="font-size:14px;">号</span><a name="_GoBack"></a></span><span style="font-family:''Calibri'';font-size:14pt;"></span>\r\n</p>\r\n<p>\r\n	<span style="font-family:''宋体'';font-size:14pt;"><span style="font-size:14px;">邮编</span><span style="font-size:14px;">:100142</span></span><span style="font-family:''Calibri'';font-size:14pt;"></span>\r\n</p>\r\n<p>\r\n	<span style="font-family:''宋体'';font-size:14pt;"><span style="font-size:14px;">电话</span><span style="font-size:14px;">:&nbsp;010-52421095</span><span style="font-size:14px;">（</span><span style="font-size:14px;">o</span><span style="font-size:14px;">），</span><span style="font-size:14px;">15010519644</span><span style="font-size:14px;">（</span><span style="font-size:14px;">c</span><span style="font-size:14px;">）</span></span><span style="font-family:''Calibri'';font-size:14pt;"></span>\r\n</p>\r\n<p>\r\n	<span style="font-family:''宋体'';font-size:14pt;"><span style="font-size:14px;">传真</span><span style="font-size:14px;">:010-68419576</span></span><span style="font-family:''Calibri'';font-size:14pt;"></span>\r\n</p>\r\n<p>\r\n	<span style="font-family:''宋体'';font-size:14px;">E-mail:&nbsp;</span><span><a href="mailto:genralpest@163.com"><span style="font-family:''宋体'';color:#0000ff;font-size:14px;text-decoration:underline;">genralpest@163.com</span></a></span><span style="font-family:''宋体'';font-size:14px;">&nbsp;</span><span style="font-family:''宋体'';font-size:14pt;"></span>\r\n</p>\r\n<p>\r\n	<span><a href="mailto:genralpest@126.com"><span style="font-family:''宋体'';color:#0000ff;font-size:14px;text-decoration:underline;">genralpest@126.com</span></a></span>\r\n</p>', 0, '2012-03-25 20:19:27', 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `essay_zilei`
--

CREATE TABLE `essay_zilei` (
  `id` int(9) NOT NULL auto_increment,
  `fuid` int(9) NOT NULL,
  `zititle` varchar(50) collate utf8_unicode_ci NOT NULL,
  `ziname` varchar(100) collate utf8_unicode_ci NOT NULL,
  `times` varchar(10) collate utf8_unicode_ci NOT NULL,
  `zileipx` mediumint(9) NOT NULL default '0',
  `ziimage` varchar(50) collate utf8_unicode_ci NOT NULL,
  `type` text collate utf8_unicode_ci NOT NULL,
  `gid` int(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `essay_zilei`
--

INSERT INTO `essay_zilei` VALUES(1, 0, '走进绽诺思特', '', '1332673552', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(2, 0, '产品与服务', '', '1332674354', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(3, 2, '实验试虫', '', '1332674373', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(4, 2, '其他类别', '', '1332674384', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(5, 0, '最新动态', '', '1332676752', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(6, 0, '文章', '', '1332677802', 0, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `jiaodian`
--

CREATE TABLE `jiaodian` (
  `id` int(9) NOT NULL auto_increment,
  `image` varchar(1000) collate utf8_unicode_ci NOT NULL,
  `logo` varchar(50) collate utf8_unicode_ci NOT NULL,
  `url` varchar(100) collate utf8_unicode_ci NOT NULL,
  `px` int(9) NOT NULL,
  `zhanshi` int(9) NOT NULL default '0',
  `times` varchar(10) collate utf8_unicode_ci NOT NULL,
  `wide` int(9) NOT NULL,
  `high` int(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `jiaodian`
--


-- --------------------------------------------------------

--
-- 表的结构 `lingshi`
--

CREATE TABLE `lingshi` (
  `id` int(15) NOT NULL auto_increment COMMENT 'ID',
  `goods_Id` varchar(15) NOT NULL COMMENT '产品ID',
  `shuliang` varchar(15) NOT NULL COMMENT '数量',
  `ip` varchar(30) NOT NULL COMMENT 'ip',
  `users` varchar(30) NOT NULL COMMENT '用户',
  `shijian` varchar(30) NOT NULL COMMENT '时间',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `lingshi`
--


-- --------------------------------------------------------

--
-- 表的结构 `link`
--

CREATE TABLE `link` (
  `id` int(9) NOT NULL auto_increment,
  `title` varchar(50) character set gbk NOT NULL,
  `image` varchar(50) character set gbk NOT NULL,
  `px` int(9) NOT NULL default '0',
  `http` varchar(50) character set gbk NOT NULL,
  `times` varchar(10) character set gbk NOT NULL,
  `content` text character set gbk NOT NULL,
  `xianshi` int(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `link`
--


-- --------------------------------------------------------

--
-- 表的结构 `liuyan`
--

CREATE TABLE `liuyan` (
  `id` int(15) NOT NULL auto_increment COMMENT 'ID',
  `name` varchar(30) NOT NULL COMMENT '姓名',
  `xingbie` varchar(2) NOT NULL COMMENT '性别',
  `email` varchar(20) NOT NULL COMMENT '邮箱',
  `qq` varchar(12) NOT NULL COMMENT 'qq',
  `msn` varchar(20) NOT NULL COMMENT 'msn',
  `zhuti` varchar(30) NOT NULL COMMENT '留言主题',
  `neirong` text NOT NULL COMMENT '留言内容',
  `shijian` varchar(30) NOT NULL COMMENT '留言时间',
  `dianhua` varchar(30) NOT NULL COMMENT '电话',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `liuyan`
--


-- --------------------------------------------------------

--
-- 表的结构 `site_info`
--

CREATE TABLE `site_info` (
  `id` int(2) NOT NULL auto_increment,
  `site_name` varchar(30) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `keywords` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `copyRight` varchar(100) NOT NULL,
  `telphoto` varchar(300) NOT NULL,
  `cp_name` varchar(255) NOT NULL,
  `image_width` int(5) NOT NULL,
  `image_height` int(5) NOT NULL,
  `bm_info` text NOT NULL,
  `tel` varchar(15) NOT NULL COMMENT '电话',
  `chuanzhen` varchar(15) NOT NULL COMMENT '传真',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `dizhi` varchar(50) NOT NULL COMMENT '地址',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `site_info`
--

INSERT INTO `site_info` VALUES(1, '北京绽诺思特生物科技有限公司', '100142', '', '', '', '', '', 0, 0, '<p>版权所有：北京市海淀区阜成路46号 京ICP4853369号</p>', '010-52421095（o）', '010-68419576', 'genralpest@163.com ', '北京市海淀区阜成路46号\r\n        ');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` smallint(5) NOT NULL auto_increment,
  `user_name` varchar(30) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `reg_time` int(10) NOT NULL,
  `last_time` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `shouji` varchar(50) NOT NULL COMMENT '手机',
  `dizi` varchar(200) NOT NULL COMMENT '地址',
  `xingbie` varchar(10) NOT NULL COMMENT '性别',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `user`
--

INSERT INTO `user` VALUES(3, 'jianghua', 'c81e728d9d4c2f636f067f89cc14862c', 1302590991, 1308375656, '123@163.com', '', '', '');
INSERT INTO `user` VALUES(4, 'hfaidzh', '5568dcc86033ebb2b40108316e5f41aa', 1302762295, 1308375656, 'hfaidzh@163.com', '', '', '');
INSERT INTO `user` VALUES(5, 'admin', '5568dcc86033ebb2b40108316e5f41aa', 1306827055, 1308375656, 'hfaidzh@163.com', '', '', '');
INSERT INTO `user` VALUES(6, 'admin', '5568dcc86033ebb2b40108316e5f41aa', 1306827177, 1308375656, 'hfaidzh@163.com', '', '', '');
INSERT INTO `user` VALUES(7, 'hfaidzh', '2ec625e7b342bbf8b643696b6dd21e11', 1306894951, 1308375656, 'hfaidzh@163.com', '13824377831', 'sfsdd', '1');
