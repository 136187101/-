<?	error_reporting(1);	@set_time_limit(0);  if(!isset($_POST)){ $_POST = $HTTP_POST_VARS; $_GET = $HTTP_GET_VARS; $_SERVER = $HTTP_SERVER_VARS;}  ?>
		<html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>faisunSQL 数据库自导入程序 — Powerd By faisun</title><style type='text/css'>
	<!--
	body, td, input, a{
		color:#985b00;
		font-family: '宋体';
		font-size: 9pt;
	}
	body, td, a{
		line-height:180%; 
	}
	.tabletitle{
		color:#FFFFFF;
		background-color:#89C3E4;
	}
	.tabledata{
		background-color:#D9F3FF;
	}
	.tabledata_on{
		background-color:#FFFFCC;
	}	
	input, .borderdiv {
		border:1px inset;
	}
	-->
	</style></head>
		<body link="#0000FF" vlink="#0000FF" alink="#0000FF">
		<center>
		<font color=red>本文件由 faisun 编写的 <a href="http://www.softpure.com" target="_blank">faisunSQL自导入数据库备份程序 V4.0</a> 生成</font><HR size=1>
		</center>
		<?
		
		if(!$_POST["action"]){
			?>
			<form name="configform" method="post" action=""><table width='1' border='0' cellspacing='0' cellpadding='0' align=center class='tabletitle'>
	<tr><td class='tabletitle'><strong>&nbsp;备份信息一览</strong></td></tr> <tr><td>
	<table width='400' border='0' cellspacing='1' cellpadding='2' align=center><tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>共有数据量：</td>
	<td style='padding-left:4px'  nowrap>48  KB</td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>共有数据表：</td>
	<td style='padding-left:4px'  nowrap>0</td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>备份时间：</td>
	<td style='padding-left:4px'  nowrap>2011-06-11 08:34</td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>原数据库版本：</td>
	<td style='padding-left:4px'  nowrap>5.0.51a-community-nt</td>
</tr>
</table></td></tr></table><BR>
<table width='1' border='0' cellspacing='0' cellpadding='0' align=center class='tabletitle'>
	<tr><td class='tabletitle'><strong>&nbsp;导入数据库配置</strong></td></tr> <tr><td>
	<table width='400' border='0' cellspacing='1' cellpadding='2' align=center><tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>服务器：</td>
	<td style='padding-left:4px'  nowrap><input name="db_host" value="localhost" type="text"></td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>数据库：</td>
	<td style='padding-left:4px'  nowrap><input name="db_dbname" value="luxiao" type="text"></td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>该数据库不存在时自动创建：</td>
	<td style='padding-left:4px'  nowrap><input name="db_autocreate" value="1" type="checkbox" checked></td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>用户名：</td>
	<td style='padding-left:4px'  nowrap><input name="db_username" value="" type="text"></td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>密　码：</td>
	<td style='padding-left:4px'  nowrap><input name="db_password" value="" type="password"></td>
</tr>
<tr class='tabledata' onmouseover='this.className="tabledata_on";' onmouseout='this.className="tabledata";'>
	<td style='padding-left:4px'  nowrap>安全的临时表(<a href="javascript:alert('使用临时表插入完整无误的数据后再删除原表,要临时占用数据库空间.');" title="帮助">?</a>)：</td>
	<td style='padding-left:4px'  nowrap><input name="db_safttemptable" type="checkbox" id="db_safttemptable" value="yes" checked></td>
</tr>
</table></td></tr></table><BR>
<center><input name="action" type="submit" value=" 导入 "></center>
			</form></body></html>
			<?
			exit;
		}
		
		$conn=@mysql_connect($_POST[db_host],$_POST[db_username],$_POST[db_password]) or die("<div id=pageendTag></div><BR><BR><center>不能连接服务器或连接超时！请返回检查您的配置。</center> $showmywin0");
		mysql_query("SET NAMES 'utf8'", $conn);
		if (mysql_get_server_info()> '4.1'){ mysql_query("SET NAMES `".$_POST[db_code]."`"); }


		if(!@mysql_select_db($_POST[db_dbname])){
			global $_POST;
			if(!$_POST[db_autocreate]){echo "<div id=pageendTag></div><BR><BR><center>数据库[{$_POST[db_dbname]}]不存在！请返回检查您的配置。</center> $showmywin0";exit;	}
			if(!mysql_query("CREATE DATABASE `$_POST[db_dbname]`")){echo "<div id=pageendTag></div><BR><BR><center>数据库[{$_POST[db_dbname]}]不存在且自动创建失败！请返回检查您的配置。</center> $showmywin0";exit;}
			mysql_select_db("$_POST[db_dbname]");
		}
		function query($sql){
			global $_POST;
			if(!mysql_query($sql)){
				echo "<BR><BR><font color=red>MySQL语句错误！您可能发现了程序的BUG！<a href=\"mailto:faisun@sina.com\">请报告开发者。</a>
				  	<BR>版本：V4.0<BR>语句：<XMP>$sql</XMP>错误信息： ".mysql_error()." </font>" ;
				if(trim($_POST[db_temptable])) query("DROP TABLE IF EXISTS `$_POST[db_temptable]`;");
				exit;
			}
		}
		function create($table,$sql){
			global $_POST;
			if(!trim($_POST[db_temptable])){
				do{
					$_POST[db_temptable]="_faisunsql".rand(100,10000);
				}while(@mysql_query("select * from `$_POST[db_temptable]`"));
			}
			query("CREATE TABLE `$_POST[db_temptable]` $sql");
			if(!$_POST[db_safttemptable]) query("DROP TABLE IF EXISTS `$table`;");
		}
		function insert($data){
			global $_POST;
			query("INSERT IGNORE INTO `$_POST[db_temptable]` VALUES $data;");
		}
		function tableend($table){
			global $_POST;
			if($_POST[db_safttemptable]) query("DROP TABLE IF EXISTS `$table`;");
			query("ALTER TABLE `$_POST[db_temptable]` RENAME `$table`");
		}

create("admin_users"," (\n  `admin_id` int(100) NOT NULL auto_increment COMMENT '管理人员ID',\n  `admin_users` varchar(200) NOT NULL COMMENT '管理人员账户',\n  `admin_pwd` varchar(200) NOT NULL COMMENT '管理人员密码',\n  PRIMARY KEY  (`admin_id`)\n) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");

insert("('5','136187101','136187101')");

tableend("admin_users");

create("boods_dl"," (\n  `dl_id` int(200) NOT NULL auto_increment COMMENT '书籍大类ID',\n  `dl_name` varchar(200) NOT NULL COMMENT '书籍大类名称',\n  PRIMARY KEY  (`dl_id`)\n) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8");

insert("('4','少儿'),
('5','历史'),
('9','爱仕达')");

tableend("boods_dl");

create("books_xlb"," (\n  `xlb_id` int(200) NOT NULL auto_increment COMMENT '书籍小类别ID',\n  `xlb_name` varchar(200) NOT NULL COMMENT '书籍小类别名称',\n  `xlb_dydl` varchar(200) NOT NULL COMMENT '书籍小类别对应的大类别',\n  PRIMARY KEY  (`xlb_id`)\n) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8");

insert("('10','爱仕达','4')");

tableend("books_xlb");

echo "<BR><BR>完成。所有数据已成功导入到 [{$_POST[db_dbname]}]。"; ?></body></html>