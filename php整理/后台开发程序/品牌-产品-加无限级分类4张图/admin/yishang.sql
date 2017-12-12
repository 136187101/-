-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 04 月 25 日 01:03
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yishang`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `admin_user`
--

INSERT INTO `admin_user` VALUES(1, 'admin', '2be7b1caa5d4d4f7e46d969702003671', 0);
INSERT INTO `admin_user` VALUES(7, '136187101', 'ac29723fdd5823c3e136afe47150723d', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `advertising`
--

INSERT INTO `advertising` VALUES(1, '/admin/newspic/jiaodian/bannr_03.jpg', '', 'http://', 0, 0, '1334550528', 0, 0, '导航下广告');
INSERT INTO `advertising` VALUES(2, '/admin/newspic/jiaodian/avarr2_07.jpg', '', 'http://', 0, 0, '1334549153', 0, 0, '首页课程导航下广告');
INSERT INTO `advertising` VALUES(3, '/admin/newspic/jiaodian/avarr3_44.jpg', '', 'http://', 0, 0, '1334549196', 0, 0, '首页教务通知下广告');
INSERT INTO `advertising` VALUES(4, '/admin/newspic/jiaodian/wkztc_77.jpg', '', 'http://', 0, 0, '1334549235', 0, 0, '首页精品课程优惠下广告');
INSERT INTO `advertising` VALUES(5, '/admin/newspic/jiaodian/avanr.jpg', '', 'http://', 0, 0, '1334549264', 0, 0, '首页书城下广告1');
INSERT INTO `advertising` VALUES(7, '/admin/newspic/jiaodian/shuang_avarr_84.jpg', '', 'http://', 0, 0, '1334549942', 0, 0, '首页报名地点上方广告');
INSERT INTO `advertising` VALUES(8, '/admin/newspic/jiaodian/shuang_avarr_86.jpg', '', 'http://', 0, 0, '1334549972', 0, 0, '首页考试动态上方广告');
INSERT INTO `advertising` VALUES(9, '/admin/newspic/jiaodian/baom_18.jpg', '', 'http://', 0, 0, '1334721567', 0, 0, '课程页左侧支付方式下广告');
INSERT INTO `advertising` VALUES(10, '/admin/newspic/jiaodian/niaotou_14.jpg', '', 'http://', 0, 0, '1334732239', 0, 0, '招生热线图片');

-- --------------------------------------------------------

--
-- 表的结构 `baoming`
--

CREATE TABLE `baoming` (
  `id` int(12) NOT NULL auto_increment COMMENT 'id',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `sex` varchar(2) NOT NULL COMMENT '性别',
  `Degree` varchar(255) NOT NULL COMMENT '学历',
  `tel` varchar(20) NOT NULL COMMENT '电话',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `course` varchar(255) NOT NULL COMMENT '课程',
  `xuefei` varchar(255) NOT NULL COMMENT '学费',
  `dizhi` varchar(255) NOT NULL COMMENT '地址',
  `beizhu` text NOT NULL COMMENT '备注',
  `times` varchar(30) NOT NULL COMMENT '填表时间',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='在线报名表' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `baoming`
--

INSERT INTO `baoming` VALUES(1, '侯建东', '男', '中专或相当学历', '15110024648', '136187101@qq.com', '成人高考', '2500', '北京市昌平区回龙观', '老学员介绍来的。学费有优惠吗？', '2012-04-18 09:13:34');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE `course` (
  `id` int(12) NOT NULL auto_increment COMMENT 'id',
  `fuid` int(12) NOT NULL COMMENT '所属分类',
  `banci` varchar(255) NOT NULL COMMENT '班次',
  `kaiketime` varchar(255) NOT NULL COMMENT '开课时间',
  `sktime` varchar(255) NOT NULL COMMENT '上课时间',
  `xiaoqu` varchar(255) NOT NULL COMMENT '小区',
  `xueshi` varchar(255) NOT NULL COMMENT '学时',
  `xuefei` varchar(255) NOT NULL COMMENT '学费',
  `youhui` varchar(255) NOT NULL COMMENT '优惠',
  `zhuangtai` varchar(255) NOT NULL COMMENT '招生状态',
  `times` varchar(30) NOT NULL COMMENT '添加时间',
  `px` int(12) NOT NULL COMMENT '排序',
  `type` varchar(1) NOT NULL COMMENT '面授或网络',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='课程列表' AUTO_INCREMENT=29 ;

--
-- 导出表中的数据 `course`
--

INSERT INTO `course` VALUES(16, 7, '成人高考速成班', '2012-04-19', '10月3日-10月6日全天', '回龙观校区', '108小时', '1000', '1000', '', '2012-04-13 16:08:25', 0, 'm');
INSERT INTO `course` VALUES(19, 7, '速成班2', '2012-04-18', '7月1日-10月14日双休日', '亚运村校区', '50小时', '1300', '1200', '', '2012-04-13 16:21:01', 0, 'm');
INSERT INTO `course` VALUES(20, 7, '成考网络课程班', '2012-04-26', '每晚八点半到九点半', '', '50小时', '500', '450', '热招中', '2012-04-13 16:22:24', 0, 'w');
INSERT INTO `course` VALUES(21, 27, '一级建造师网络课程', '2012-04-26', '周一到周五', '', '100小时', '1000', '999', '热招中', '2012-04-18 12:01:52', 0, 'w');
INSERT INTO `course` VALUES(22, 8, '考博网络课程', '2012-05-04', '周六日', '', '100小时', '5000', '4800', '初招', '2012-04-18 12:05:14', 0, 'w');
INSERT INTO `course` VALUES(23, 9, '在职申硕英语网络课程班', '2012-04-27', '周一到周六全天', '', '250小时', '4000', '3980', '热招', '2012-04-18 13:28:27', 0, 'w');
INSERT INTO `course` VALUES(24, 10, '网络英语班1', '2012-04-19', '周六日全天', '', '200小时', '2200', '2000', '热招中', '2012-04-18 13:29:24', 0, 'w');
INSERT INTO `course` VALUES(25, 38, '工程硕士网络课程', '2012-04-20', '周六日', '', '400小时', '4000', '3600', '热招', '2012-04-18 13:30:14', 0, 'w');
INSERT INTO `course` VALUES(26, 6, '会计职称网络课程', '2012-05-04', '周六日全天', '', '100小时', '5000', '4500', '已招满', '2012-04-18 13:31:58', 0, 'w');
INSERT INTO `course` VALUES(27, 33, '材料员网络课程', '2012-04-18', '每晚8点-9点', '', '100小时', '2400', '2200', '热招中', '2012-04-18 13:33:32', 0, 'w');
INSERT INTO `course` VALUES(28, 26, '企业法律顾问网络班', '2012-04-27', '每晚8点-9点', '', '200小时', '6000', '5500', '热招中', '2012-04-18 13:41:27', 0, 'w');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `essay`
--

INSERT INTO `essay` VALUES(2, 2, '2012年会计证考试最新辅导方案 ', '', '', '', '', '', '', '', '', '', '', '', '<li>\r\n	2012年会计证考试最新辅导方案\r\n</li>\r\n<li>\r\n	2012年会计证考试最新辅导方案\r\n</li>\r\n<li>\r\n	2012年会计证考试最新辅导方案\r\n</li>\r\n<li>\r\n	2012年会计证考试最新辅导方案\r\n</li>\r\n<li>\r\n	2012年会计证考试最新辅导方案\r\n</li>\r\n<li>\r\n	2012年会计证考试最新辅导方案\r\n</li>', 0, '2012-04-16 09:33:08', 0, 0, '', '');
INSERT INTO `essay` VALUES(3, 2, '教务通知1', '', '', '', '', '', '', '', '', '', '', '', '教务通知1教务通知1教务通知1教务通知1教务通知1教务通知1教务通知1', 0, '2012-04-16 10:28:43', 0, 0, '', '');
INSERT INTO `essay` VALUES(4, 2, '教务通知2', '', '', '', '', '', '', '', '', '', '', '', '按时大声地', 0, '2012-04-16 10:29:24', 0, 0, '', '');
INSERT INTO `essay` VALUES(5, 2, '教务通知3', '', '', '', '', '', '', '', '', '', '', '', '教务通知3教务通知3', 0, '2012-04-16 10:29:33', 0, 0, '', '');
INSERT INTO `essay` VALUES(6, 2, '教务通知4', '', '', '', '', '', '', '', '', '', '', '', '教务通知4教务通知4教务通知4教务通知4教务通知4', 0, '2012-04-16 10:29:43', 0, 0, '', '');
INSERT INTO `essay` VALUES(7, 2, '教务通知5', '', '', '', '', '', '', '', '', '', '', '', '教务通知5教务通知5教务通知5教务通知5教务通知5教务通知5', 0, '2012-04-16 10:29:51', 0, 0, '', '');
INSERT INTO `essay` VALUES(8, 3, '校园网的教育应用校园网的教育应用', '', '', '', '', '', '', '', '', '', '', '', '校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用', 0, '2012-04-16 11:52:07', 0, 0, '', '');
INSERT INTO `essay` VALUES(9, 3, '校园网的教育应用', '', '', '', '', '', '', '', '', '', '', '', '校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用', 0, '2012-04-16 11:25:40', 0, 0, '', '');
INSERT INTO `essay` VALUES(10, 3, '校园网的教育应用', '', '', '', '', '', '', '', '', '', '', '', '校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用', 0, '2012-04-16 11:25:55', 0, 0, '', '');
INSERT INTO `essay` VALUES(11, 3, '校园网的教育应用', '', '', '', '', '', '', '', '', '', '', '', '校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用', 0, '2012-04-16 11:26:04', 0, 0, '', '');
INSERT INTO `essay` VALUES(12, 3, '校园网的教育应用', '', '', '', '', '', '', '', '', '', '', '', '校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用校园网的教育应用', 0, '2012-04-16 11:26:11', 0, 0, '', '');
INSERT INTO `essay` VALUES(13, 3, '校园网的教育应用2', '', '', 'newspic/thumb_55307.jpg', 'newspic/201204167939.jpg', '', '', '', '', '', '', '', '校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2校园网的教育应用2', 0, '2012-04-16 11:48:19', 0, 1, '', '');
INSERT INTO `essay` VALUES(14, 3, '校园网的教育应用', '', '', '../../newspic/thumb_93193.jpg', 'newspic/201204162888.jpg', '', '', '', '', '', '', '', '校园网的教育应用', 0, '2012-04-16 11:29:33', 0, 0, '', '');
INSERT INTO `essay` VALUES(15, 3, 'asdasd', '', '', '../../newspic/thumb_10107.jpg', 'newspic/201204161203.jpg', '', '', '', '', '', '', '', 'asdasdasd', 0, '2012-04-16 11:40:17', 0, 0, '', '');
INSERT INTO `essay` VALUES(16, 3, '爱爱爱', '', '', '../../newspic/thumb_90244.jpg', 'newspic/201204161923.jpg', '', '', '', '', '', '', '', '爱爱爱', 0, '2012-04-16 11:46:29', 0, 0, '', '');
INSERT INTO `essay` VALUES(17, 5, '联系我们', '', '', '', '', '', '', '', '', '', '', '', '联系我们联系我们', 0, '2012-04-17 15:07:05', 0, 0, '', '');
INSERT INTO `essay` VALUES(18, 5, '报名方式', '', '', '../../newspic/thumb_57172.jpg', 'newspic/201204185189.jpg', '', '', '', '', '', '', '', '报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式报名方式', 0, '2012-04-18 11:51:23', 0, 0, '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `essay_zilei`
--

INSERT INTO `essay_zilei` VALUES(2, 0, '教务通知', '', '1334309199', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(3, 0, '教学服务', '', '1334546642', 0, '', '', 0);
INSERT INTO `essay_zilei` VALUES(5, 0, '文章', '', '1334646394', 0, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `jianzhang`
--

CREATE TABLE `jianzhang` (
  `id` int(12) NOT NULL auto_increment COMMENT 'id',
  `fuid` int(12) NOT NULL COMMENT '所属课程分类',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `type` varchar(1) NOT NULL COMMENT '面授或网络',
  `px` int(12) NOT NULL COMMENT '排序',
  `times` varchar(30) NOT NULL COMMENT '添加时间',
  `jingping` int(1) NOT NULL COMMENT '精品课程优惠',
  `tuijian` int(1) NOT NULL COMMENT '推荐',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='招生简章' AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `jianzhang`
--

INSERT INTO `jianzhang` VALUES(1, 7, '成人高考招生简章', '<p>\r\n	成人高考招生简章\r\n</p>', 'w', 0, '2012-04-16 09:13:58', 1, 1);
INSERT INTO `jianzhang` VALUES(2, 7, '成人高考', '成人高考招生简章成人高考招生简章成人高考招生简章\r\n<p>\r\n	&nbsp;\r\n</p>', 'm', 0, '2012-04-16 09:22:19', 0, 1);
INSERT INTO `jianzhang` VALUES(3, 7, '汇聚了北京乃至全国最强的师资阵容', '<p>\r\n	汇聚了北京乃至全国最强的师资阵容\r\n</p>', 'm', 0, '2012-04-16 09:25:31', 0, 1);
INSERT INTO `jianzhang` VALUES(5, 8, '考博招生简章', '<p>\r\n	考博招生简章\r\n</p>', 'm', 0, '2012-04-16 09:26:17', 0, 0);
INSERT INTO `jianzhang` VALUES(6, 29, '11111111', '<p>\r\n	11111111\r\n</p>', 'm', 0, '2012-04-16 11:18:00', 0, 0);
INSERT INTO `jianzhang` VALUES(9, 7, '2012年造价工程师VIP保障班开课', '<p>\r\n	32012年造价工程师VIP保障班开课2012年造价工程师VIP保障班开课2012年造价工程师VIP保障班开课2012年造价工程师VIP保障班开课2012年造价工程师VIP保障班开课\r\n</p>', 'm', 0, '2012-04-17 09:19:42', 1, 1);
INSERT INTO `jianzhang` VALUES(10, 7, '成考网络课程班', '成考网络课程班', 'w', 0, '2012-04-18 10:10:49', 0, 1);

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `jiaodian`
--

INSERT INTO `jiaodian` VALUES(1, '/admin/newspic/jiaodian/QQ截图未命名.jpg', '0', 'http://', 0, 0, '1334548403');
INSERT INTO `jiaodian` VALUES(2, '/admin/newspic/jiaodian/2008071913000140.jpg', '0', 'http://', 0, 0, '1334548416');
INSERT INTO `jiaodian` VALUES(3, '/admin/newspic/jiaodian/20090811160942827.jpg', '0', 'http://', 0, 0, '1334548425');

-- --------------------------------------------------------

--
-- 表的结构 `kc_lei`
--

CREATE TABLE `kc_lei` (
  `id` int(12) NOT NULL auto_increment COMMENT '课程类别',
  `fuid` int(12) NOT NULL COMMENT '父类ID',
  `kctitle` varchar(255) NOT NULL COMMENT '课程名称',
  `px` int(12) NOT NULL COMMENT '排序',
  `times` varchar(30) NOT NULL COMMENT '添加时间',
  `rezhao` int(1) NOT NULL COMMENT '热招',
  `content` text NOT NULL COMMENT '课程介绍',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 导出表中的数据 `kc_lei`
--

INSERT INTO `kc_lei` VALUES(1, 0, '学历类', 0, '2012-04-12 15:34:51', 0, '123123');
INSERT INTO `kc_lei` VALUES(2, 0, '财会类', 0, '2012-04-12 15:39:03', 0, '');
INSERT INTO `kc_lei` VALUES(3, 0, '资格类', 0, '2012-04-12 15:39:19', 0, '');
INSERT INTO `kc_lei` VALUES(4, 0, '工程类', 0, '2012-04-12 15:39:35', 0, '');
INSERT INTO `kc_lei` VALUES(5, 0, '外语类', 0, '2012-04-12 15:39:45', 0, '');
INSERT INTO `kc_lei` VALUES(6, 2, '会计职称', 0, '2012-04-12 15:40:41', 0, '');
INSERT INTO `kc_lei` VALUES(7, 1, '成人高考', 0, '2012-04-12 15:40:55', 1, '部分授课专家\r\n<p>\r\n	袁安锋：人大博士、副教授，一直致力于数学学科的研究与教学，对数学教学有独到的见解，授课条理清晰，通俗易懂，并善于把握考点，通晓成人高考命题规律与趋势，命中率高，因此深受学生推崇。\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>\r\n<p>\r\n	杨 晶：成考数学应试辅导新生代的杰出代表，精通成考数学命题规律与趋势，掌握各种解题技巧对学生快速提高考分帮助极大，多次命中考题。\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>\r\n<p>\r\n	杨桂菊：副教授，语文讲师。杨老师经过多年来的教学，积累了丰富的经验，在成考语文作文方面能准确的分析与判断，应用指导性的教学法，大大提高了学生的应试能力。\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>\r\n<p>\r\n	姚建华：高级讲师，主讲英语。多年致力于成人英语教育，积累了丰富的教学经验，对成考英语的特点有独到的见解，对学生进行综合的英语训练，从基础入手，辅以应试技巧，善于捕捉英语发展动态，讲课生动风趣，深受学生欢迎。\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>\r\n<p>\r\n	时常元：人民大学著名成考辅导权威专家，主讲政治。时老师具有二十余年成人高考辅导经验，讲课生动有趣，善于同学员交流，具有很强的亲和力，同时对考点的把握非常精准，是学员的良师益友。\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>\r\n<p>\r\n	许 丹：教授，成人高考考试大纲编写组成员，全国著名成人高考辅导专家。兼任北京市教育考试指导中心教研员。十多年来，一直承担北京市语文成考串讲工作，以分析、讲解、预测直击考题精髓著称。常年为高校成考教师做一级培训工作。\r\n</p>');
INSERT INTO `kc_lei` VALUES(8, 1, '考博', 0, '2012-04-12 15:48:49', 0, '');
INSERT INTO `kc_lei` VALUES(9, 1, '在职申硕英语', 0, '2012-04-12 15:49:32', 1, '');
INSERT INTO `kc_lei` VALUES(10, 1, '考研英语', 0, '2012-04-12 15:49:42', 0, '');
INSERT INTO `kc_lei` VALUES(12, 2, '会计证', 0, '2012-04-12 15:50:37', 0, '');
INSERT INTO `kc_lei` VALUES(13, 2, '注册会计师', 0, '2012-04-12 15:50:45', 0, '');
INSERT INTO `kc_lei` VALUES(14, 2, '审计师', 0, '2012-04-12 15:50:53', 0, '');
INSERT INTO `kc_lei` VALUES(15, 2, '经济师', 0, '2012-04-12 15:51:01', 0, '');
INSERT INTO `kc_lei` VALUES(16, 2, '统计从业', 0, '2012-04-12 15:51:14', 0, '');
INSERT INTO `kc_lei` VALUES(17, 2, '统计师', 0, '2012-04-12 15:51:23', 0, '');
INSERT INTO `kc_lei` VALUES(18, 2, '银行从业', 0, '2012-04-12 15:51:33', 0, '');
INSERT INTO `kc_lei` VALUES(19, 2, '证券从业', 0, '2012-04-12 15:51:45', 0, '');
INSERT INTO `kc_lei` VALUES(20, 3, '公共营养师', 0, '2012-04-12 15:52:04', 0, '');
INSERT INTO `kc_lei` VALUES(21, 3, '教师资格', 0, '2012-04-12 15:52:14', 0, '');
INSERT INTO `kc_lei` VALUES(22, 3, '出版资格', 0, '2012-04-12 15:52:23', 0, '');
INSERT INTO `kc_lei` VALUES(23, 3, '心理咨询师', 0, '2012-04-12 15:52:32', 0, '');
INSERT INTO `kc_lei` VALUES(24, 3, '人力资源师', 0, '2012-04-12 15:52:44', 0, '');
INSERT INTO `kc_lei` VALUES(25, 3, '职称计算机', 0, '2012-04-12 15:52:52', 0, '');
INSERT INTO `kc_lei` VALUES(26, 3, '企业法律顾问', 0, '2012-04-12 15:53:01', 0, '');
INSERT INTO `kc_lei` VALUES(27, 4, '一级建造师', 0, '2012-04-12 15:53:27', 0, '');
INSERT INTO `kc_lei` VALUES(28, 4, '二级建造师', 0, '2012-04-12 15:53:37', 0, '');
INSERT INTO `kc_lei` VALUES(29, 4, '造价工程师', 0, '2012-04-12 15:53:49', 0, '');
INSERT INTO `kc_lei` VALUES(30, 4, '咨询工程师', 0, '2012-04-12 15:53:57', 0, '');
INSERT INTO `kc_lei` VALUES(31, 4, '监理工程师', 0, '2012-04-12 15:54:09', 0, '');
INSERT INTO `kc_lei` VALUES(32, 4, '安全工程师', 0, '2012-04-12 15:54:17', 0, '');
INSERT INTO `kc_lei` VALUES(33, 4, '材料员', 0, '2012-04-12 15:54:25', 0, '');
INSERT INTO `kc_lei` VALUES(34, 5, '成人英文三级', 0, '2012-04-12 15:54:39', 0, '');
INSERT INTO `kc_lei` VALUES(35, 5, '成人英文四级', 0, '2012-04-12 15:54:48', 0, '');
INSERT INTO `kc_lei` VALUES(36, 5, '成人英文六级', 0, '2012-04-12 15:54:56', 0, '');
INSERT INTO `kc_lei` VALUES(38, 1, '工程硕士', 0, '2012-04-12 16:08:00', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `kzhinan`
--

CREATE TABLE `kzhinan` (
  `id` int(12) NOT NULL auto_increment COMMENT 'id',
  `fuid` int(12) NOT NULL COMMENT '所属课程',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `px` int(12) NOT NULL COMMENT '排序',
  `times` varchar(30) NOT NULL COMMENT '添加时间',
  `type` varchar(2) NOT NULL COMMENT '类型',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='考试指南' AUTO_INCREMENT=28 ;

--
-- 导出表中的数据 `kzhinan`
--

INSERT INTO `kzhinan` VALUES(1, 7, '考试介绍', '<p>\r\n	　　成人高等学校招生全国统一考试(简称“成人高考”)是我国成人进入各类高等学校进行更高层次学历教育的入学考试。\r\n</p>\r\n<p>\r\n	　　考试分专科起点升本科(简称专升本)、高中起点升本科(简称高起本)和高中起点升高职(高专)(简称高职、高专)三个层次。\r\n</p>\r\n<p>\r\n	　　全国成人高等学校招生统一考试成人高等教育属国民教育系列，列入国家招生计划，国家承认学历，参加全国招生统一考试，各省、自治区统一组织录取。\r\n</p>', 0, '2012-04-17 10:17:06', 'z');
INSERT INTO `kzhinan` VALUES(2, 7, '报名时间', '<p>\r\n	　　报名一般在每年的8、9月份，2012年成人高考报名预计8月中旬。考试报名一般采用网上报名、现场资格审核、网上缴费的办法。\r\n</p>\r\n<p>\r\n	　　点击查看：<a href="http://www.studyez.com/news/201106/07/53433.htm" target="_blank"><span style="color:#ff0000;">2011年成人高考报名时间汇总</span></a>\r\n</p>', 0, '2012-04-17 10:17:25', 'z');
INSERT INTO `kzhinan` VALUES(3, 7, '报考条件', '　<strong>高中起点升专科、本科：</strong>应届和往届高中、中专、职高毕业生及同等学历者。\r\n<p>\r\n	　　<strong>专科升本科：</strong>已取得或将取得国民教育系列专科文凭者。\r\n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; (<span style="color:#0000ff;">注释：具体报名条件咨询当地招生办</span>)\r\n</p>\r\n<p>\r\n	　　1.拥护中国共产党的领导，拥护四项基本原则，遵纪守法，品德良好，身体健康。\r\n</p>\r\n<p>\r\n	　　2.在职、从业人员，高中、中专、技校应届毕业生及社会其他人员。\r\n</p>\r\n<p>\r\n	　　3.报考高中起点本、专科考生应具有高中毕业文化程度.\r\n</p>\r\n<p>\r\n	　　4.报考专科起点本科及第二专业专科的考生必须是已取得经教育部审定核准的国民教育系列高等学校或高等教育自学考试机构颁发的大学专科毕业证书的人员。\r\n</p>', 0, '2012-04-17 10:17:40', 'z');
INSERT INTO `kzhinan` VALUES(4, 7, '录取照顾政策', '成人高考招生录取录取三照顾：免试入学、加分投档、降分录取\r\n<p>\r\n	　<strong>　照顾政策一：免试入学</strong>\r\n</p>\r\n<p>\r\n	　　获得"全国劳动模范"、"全国先进工作者"称号，"全国''五一''劳动奖章"获得者，可免试入学。\r\n</p>\r\n<p>\r\n	　　可免试入学的还有奥运会、世界杯赛和世界锦标赛的奥运项目前八名，非奥运项目前六名;亚运会、亚洲杯赛和亚洲锦标赛的奥运项目前六名，非奥运项目前三名;全运会、全国锦标赛和全国冠军赛的奥运项目前三名，非奥运项目冠军获得者。\r\n</p>\r\n<p>\r\n	　　经本人申请，并出具省级体育行政部门审核的《优秀运动员申请免试进入成人高等学校学习推荐表》(国家体育总局监制)，经省成招办审核，招生学校同意，可免试入学。\r\n</p>\r\n<p>\r\n	　　<strong>照顾政策二：加分投档</strong>\r\n</p>\r\n<p>\r\n	　　运动健将和武术项目武英级运动员称号获得者，可加50分投档，一级运动员可加30分。\r\n</p>\r\n<p>\r\n	　　符合下列条件之一的考生，可加20分投档：年满25周岁以上人员;获地市级以上(含地市级)人民政府，国务院各部委及各省(自治区、直辖市)厅、局系统，国家特大型企业授予的劳动模范、先进生产(工作)者及科技进步(成果)奖获得者;获省级工、青、妇等组织授予的"五一劳动奖章"、"新长征突击手"、"三八红旗手"称号者;解放军、武警部队、公安干警荣立个人三等功以上者;归侨、归侨子女、华侨子女、台湾省籍考生;烈士子\r\n</p>\r\n<p>\r\n	　　女、烈士配偶;边疆、山区、牧区和少数民族聚居地区的少数民族考生、国防科技工业三线企业单位(地处地市以上人民政府所在地的除外)获得企业表彰的先进生产(工作)者。\r\n</p>\r\n<p>\r\n	　　自谋职业的城镇退役士兵，可加10分投档，是否录取由招生学校确定。\r\n</p>\r\n<p>\r\n	　　符合照顾政策的考生，须于报名时交验原始证件，符合两项以上照顾政策的考生，照顾分数不累计。\r\n</p>\r\n<p>\r\n	　　<strong>照顾政策三：降分录取</strong>\r\n</p>\r\n<p>\r\n	　　农、林、水利、地质、矿业、公安、监所、测绘、远洋运输、社会福利等专业，在上线生源不足时可适当降分投档，降分幅度最多不超过20分。\r\n</p>', 0, '2012-04-17 10:17:57', 'z');
INSERT INTO `kzhinan` VALUES(5, 7, '考试时间', '<p>\r\n	　　<span style="color:#ff0000;">2012年成人高考考试时间：10月13、14日。</span>\r\n</p>\r\n<p>\r\n	<span style="color:#ff0000;">　　2011年成人高考考试时间：10月15、16日。</span>\r\n</p>', 0, '2012-04-17 10:18:12', 'z');
INSERT INTO `kzhinan` VALUES(6, 7, '考试科目', '<table border="1" cellspacing="0" cellpadding="0" width="578">\r\n	<tbody>\r\n		<tr>\r\n			<td width="578" colspan="2" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>高中起点升本科统考科目（4科）</strong>\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>理科类</strong>\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（理）、外语、理化（物理、化学合卷）\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>文科类</strong>（含外语类）\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（文）、外语、史地（历史、地理合卷），艺术类专业数学考试成绩不计入总分，供录取时参考\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="578" colspan="2" nowrap="nowrap">\r\n				<div align="left">\r\n					<b>高中起点升专科（高职）统考科目（3科）</b>\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>理科类</strong>（含体育类专业）\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（理）、外语\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>文科类</strong>（含外语类、艺术类）\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（文）、外语，艺术类专业数学考试成绩不计入总分，供录取时参考\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>医学类</strong>（中医学类、药学类等两个一级学科除外）各专业\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（理）、外语\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>中医学类</strong>及中药学各专业\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（理）、外语\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>公安类</strong>各专业\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（文）、外语\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="198" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>中央司法警官教育学院开设的监狱管理、劳教管理专业</strong>\r\n				</div>\r\n			</td>\r\n			<td width="379" nowrap="nowrap">\r\n				<div align="left">\r\n					语文、数学（文）、外语\r\n				</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	　　【<strong>注】：</strong>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(1)外语设英语、日语、俄语三个语种，考生可根据招生院校对外语语种的要求选择一种。</span>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(2)高中起点升本科和专科的公共课：语文、数学(文)、数学(理)、英语、日语、俄语、史地(历史、地理合卷)、理化(物理、化学合卷)实行全国统考，试题由教育部统一命制。</span>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(3)高中起点升本、专科统一考试科目每科满分均为150分，考试时间为120分钟。</span>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(4)艺术、体育等专业需加试的专业科目和考试时间，由各招生院校自定，并通知考生。</span>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<table border="1" cellspacing="0" cellpadding="0" width="578">\r\n	<tbody>\r\n		<tr>\r\n			<td width="578" colspan="2" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>专科起点升本科统考科目均为（3科）</strong>\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>哲学、文学</strong>（艺术类除外）历史学以及中医、中药学（一级学科）\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、大学语文\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>艺术类</strong>（一级学科）\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、艺术概论\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>工学、理学</strong>（生物科学类、地理科学类、环境科学类、心理学类等四个一级学科除外）\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、高等数学（一）\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>经济学</strong>、<strong>管理学以及职业教育类、生物科学类、地理科学类、环境科学类、心理学类、药学类</strong>（除中药学类外）等六个一级学科\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、高等数学（二）\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>法学类</strong>\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、民法\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>教育学</strong>（职业教育类一级学科除外）\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、教育理论\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>农学类</strong>\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、生态学基础\r\n				</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td width="205" nowrap="nowrap">\r\n				<div align="left">\r\n					<strong>医学</strong>（中医学类、药学类等两个一级学科除外）\r\n				</div>\r\n			</td>\r\n			<td width="373" nowrap="nowrap">\r\n				<div align="left">\r\n					政治、外语、医学综合\r\n				</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<span style="color:#800000;"> \r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="color:#000000;">　　【<strong>注</strong>】：</span>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(1)外语设英语、日语、俄语三个语种，考生可根据招生院校对外语语种的要求选择一种。</span>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(2)专科起点升本科统一考试科目每科满分均为150分，考试时间为150分钟。</span>\r\n</p>\r\n<p>\r\n	<span style="color:#0000ff;">　　(3)专科起点升本科统一考试科目试题均由教育部统一命制。除统考科目外，是否再加试专业课，由招生院校自行确定。如需加试专业课，由招生院校向社会公布并自行组织命题和考试。</span>\r\n</p>\r\n</span>', 0, '2012-04-17 10:18:31', 'z');
INSERT INTO `kzhinan` VALUES(7, 7, '考试教材', '　成考用书除了大纲全国统一以外，教材辅导书试题集都没有做统一规定。考生在选择教材时应谨慎。选择辅导书、习题集时要看看出书组织单位是否是合法的法人，编写小组是否有正式的名称，出版社、出版单位最好选正规的单位，购书时最好到大书店或者各区县成考办以防购买到盗版和假冒伪劣书籍，选择辅导书不能贪多也不可贪便宜。\r\n<p>\r\n	　　一般而言，<span style="color:#ff0000;">高中起点升专(本)科</span>的教材分为<strong>人民教育出版社、高等教育出版社，还有人大出版社和成教出版社出版等</strong>，<span style="color:#ff0000;">专升本教材</span>则由<strong>中央广播电视大学出版社、人民教育出版社、高等教育出版社出版等</strong>。据了解，如果上辅导班的话高中起点的教材用人民教育出版社的，专升本的教材用电大版高教版的比较多，自学最好用高教版的教材。\r\n</p>\r\n<p>\r\n	<strong>&nbsp;&nbsp;&nbsp; <a href="http://www.studyez.com/book/BookList.aspx?cid=231" target="_blank">学易网校采用教材</a>：高升专/本</strong>为《人民教育出版社》出版||<strong>专升本</strong>为《高等教育出版社》出版\r\n</p>', 0, '2012-04-17 10:18:48', 'z');
INSERT INTO `kzhinan` VALUES(8, 7, '成绩查询', '<p>\r\n	&nbsp;&nbsp;&nbsp; 各地成人高考成绩一般在考试完1个月左右陆续公布，考生可以登陆当地招生考试信息网进行查询。\r\n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 点击查看：<a href="http://www.studyez.com/news/201110/17/99818.htm" target="_blank"><span style="color:#0000ff;">2011年成人高考成绩查询汇总</span></a>\r\n</p>', 0, '2012-04-17 10:19:01', 'z');
INSERT INTO `kzhinan` VALUES(9, 7, '录取分数线', '<p>\r\n	&nbsp;&nbsp;&nbsp; 成人高考分数线一般在考完1个月左右公布，学易网校会及时发布相关信息。敬请关注！\r\n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp; 点击查看：<a href="http://www.studyez.com/news/201106/24/63990.htm" target="_blank"><span style="color:#ff0000;">2010年成人高考录取分数线汇总</span></a>\r\n</p>', 0, '2012-04-17 10:19:15', 'z');
INSERT INTO `kzhinan` VALUES(17, 7, '学易一级建造师考试通过率神话', '<a href="http://www.studyez.com/news/201103/09/3013.htm" target="_blank">学易一级建造师考试通过率神话</a>', 0, '2012-04-17 12:18:59', 'k');
INSERT INTO `kzhinan` VALUES(18, 7, '新版教材大纲具体变动情况汇总', '<a href="http://www.studyez.com/news/201106/07/54039.htm" target="_blank">新版教材大纲具体变动情况汇总</a>', 0, '2012-04-17 12:19:23', 'k');
INSERT INTO `kzhinan` VALUES(19, 7, '2012年一级建造师考试报名汇总 ', '<a href="http://www.studyez.com/news/201202/17/193428.htm" target="_blank"><span style="color:red;">2012年一级建造师考试报名汇总</span></a>', 0, '2012-04-17 12:19:37', 'k');
INSERT INTO `kzhinan` VALUES(20, 7, '一级注册建造师考试历年真题汇总', '<a href="http://www.studyez.com/news/201106/10/56414.htm" target="_blank">一级注册建造师考试历年真题汇总</a>', 0, '2012-04-17 12:22:48', 'k');
INSERT INTO `kzhinan` VALUES(21, 7, '福建省2012年一建报名：4月13日', '<a href="http://www.studyez.com/news/201202/15/192445.htm" target="_blank">福建省2012年一建报名：4月13日</a>', 0, '2012-04-17 12:22:59', 'k');
INSERT INTO `kzhinan` VALUES(22, 7, '2012年一建考试时间：9月22、23日', '2012年一建考试时间：9月22、23日', 0, '2012-04-17 14:01:58', 'k');
INSERT INTO `kzhinan` VALUES(23, 7, '新版教材大纲具体变动情况汇总', '<a href="http://www.studyez.com/news/201106/07/54039.htm" target="_blank">新版教材大纲具体变动情况汇总</a>', 0, '2012-04-17 14:05:31', 'k');
INSERT INTO `kzhinan` VALUES(24, 7, '2012年一级建造师签约保障套餐方案', '<a title="宁夏2012年一级建造师考试报名提示" href="http://www.studyez.com/news/201204/13/211785.htm" target="_blank">宁夏2012年一级建造师考试报名提示</a>', 0, '2012-04-17 14:10:59', 'k');
INSERT INTO `kzhinan` VALUES(25, 7, '宁夏2012年一级建造师考试报名提示', '<a title="宁夏2012年一级建造师考试报名提示" href="http://www.studyez.com/news/201204/13/211785.htm" target="_blank">宁夏2012年一级建造师考试报名提示</a>', 0, '2012-04-17 14:11:06', 'k');
INSERT INTO `kzhinan` VALUES(26, 7, '四川省2012年一级建造师考试报名提示', '<a title="四川省2012年一级建造师考试报名提示" href="http://www.studyez.com/news/201204/13/211774.htm" target="_blank">四川省2012年一级建造师考试报名提示</a>', 0, '2012-04-17 14:11:17', 'k');
INSERT INTO `kzhinan` VALUES(27, 8, '四川省2012年一级建造师考试报名提示', '<a title="四川省2012年一级建造师考试报名提示" href="http://www.studyez.com/news/201204/13/211774.htm" target="_blank">四川省2012年一级建造师考试报名提示</a>', 0, '2012-04-17 14:12:36', 'k');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `link`
--

INSERT INTO `link` VALUES(1, '清华', 'newspic/201204165341.jpg', 0, 'http://', '1334563958', '', 0);
INSERT INTO `link` VALUES(2, '北大', 'newspic/201204163852.jpg', 0, 'http://', '1334563980', '', 0);
INSERT INTO `link` VALUES(3, '科大', 'newspic/201204168470.jpg', 0, 'http://', '1334563995', '', 0);
INSERT INTO `link` VALUES(4, '交大', 'newspic/201204163448.jpg', 0, 'http://', '1334564010', '', 0);
INSERT INTO `link` VALUES(5, '石油大', 'newspic/201204169291.jpg', 0, 'http://', '1334564029', '', 0);
INSERT INTO `link` VALUES(6, '师范大学', 'newspic/201204168273.jpg', 0, 'http://', '1334564092', '', 0);

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
  `bm_info` text NOT NULL,
  `tel` varchar(255) NOT NULL COMMENT '电话',
  `chuanzhen` varchar(15) NOT NULL COMMENT '传真',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `dizhi` varchar(50) NOT NULL COMMENT '地址',
  `luxian` varchar(255) NOT NULL COMMENT '乘车路线',
  `zstel` varchar(255) NOT NULL COMMENT '招生热线',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `site_info`
--

INSERT INTO `site_info` VALUES(1, '北京易尚教育', '', '北京易尚教育,北京易尚教育', '北京易尚教育,北京易尚教育北京易尚教育,北京易尚教育北京易尚教育,北京易尚教育北京易尚教育,北京易尚教育', '', '', '', '版权所有：易尚教育 技术支持;北京创想家园<br />\r\n地址：北京市海淀区中关村南大街12号天作国际1号楼B座1201室<br />\r\n电话：82101260 82101276 82101267 E-mail：bjzzys@126.com 京 ICP备08080888号<br />', '82101260,82101276', '010-82101267', 'infoava@avabeijing.com.cn', '北京市海淀区中关村南大街12号天作国际1号楼B座1201室                     ', '地铁4号线魏公村站B口出公交697、717、332、653、689、651、26、85、320、608、614 运通105、运通106、运通205、 特4、特6中国农业科学院下车                                ', '400-888888,010-82660177,010-82668233,010-88888888');

-- --------------------------------------------------------

--
-- 表的结构 `zhifu`
--

CREATE TABLE `zhifu` (
  `id` int(12) NOT NULL auto_increment COMMENT 'id',
  `yinhang` varchar(255) NOT NULL COMMENT '开户行',
  `users` varchar(30) NOT NULL COMMENT '账号',
  `name` varchar(10) NOT NULL COMMENT '收款人',
  `px` int(12) NOT NULL COMMENT '排序',
  `timesw` varchar(30) NOT NULL COMMENT '添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='支付方式' AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `zhifu`
--

INSERT INTO `zhifu` VALUES(1, '招商银行北京分行中关村', '6225 8001 0070 8178', '某某某', 0, '2012-04-18 11:28:52');
INSERT INTO `zhifu` VALUES(3, '招商银行北京分行中关村分行', '6225 8001 0070 8675', '某某某', 0, '2012-04-18 11:44:22');
INSERT INTO `zhifu` VALUES(4, '华夏银行北京成府路分行', '4540 5871 0547 5187 ', '王某也', 0, '2012-04-18 15:42:56');
INSERT INTO `zhifu` VALUES(5, '1', '1', '1', 0, '2012-04-18 15:43:44');
INSERT INTO `zhifu` VALUES(6, '2', '2', '2', 0, '2012-04-18 15:43:49');

-- --------------------------------------------------------

--
-- 表的结构 `ziliao`
--

CREATE TABLE `ziliao` (
  `id` int(12) NOT NULL auto_increment COMMENT '资料id',
  `fuid` int(12) NOT NULL COMMENT '所属分类',
  `title` varchar(255) NOT NULL COMMENT '名称',
  `annex` varchar(255) NOT NULL COMMENT '附件',
  `content` text NOT NULL COMMENT '介绍',
  `sort` int(12) NOT NULL COMMENT '排序',
  `times` varchar(30) NOT NULL COMMENT '添加时间',
  `images` varchar(255) NOT NULL COMMENT '资料图片',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资料下载' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `ziliao`
--


-- --------------------------------------------------------

--
-- 表的结构 `ziliaofl`
--

CREATE TABLE `ziliaofl` (
  `id` int(12) NOT NULL auto_increment COMMENT '资料下载分类ID',
  `title` varchar(255) NOT NULL COMMENT '资料下载分类名称',
  `px` int(12) NOT NULL COMMENT '排序',
  `times` varchar(30) NOT NULL COMMENT '添加时间',
  `fuid` int(12) NOT NULL COMMENT '父id',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资料下载分类' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `ziliaofl`
--

