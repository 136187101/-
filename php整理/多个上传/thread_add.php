<?php require_once("../include/global.php");
$gr->cookie_tr($cookie_uid);
$gid=$_GET["gid"];
$rs_grp=$db->get_one("select * from group_list where id='$gid'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php $zj->sys_con("con_name");?></title>
<link type="text/css" href="../main.css" media="screen" rel="stylesheet" />
<link type="text/css" href="../css/ffoot.css" rel="stylesheet">
<link type="text/css" href="../css/group.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/text.js"></script>

<script type="text/javascript" src="js/thread_add.php.js"></script>
</head>

<body>
<?php require_once("../inc/top.php");?>
<div class="grp_content">
	
	<div class="grp_left">
		
		<div class="grp_center"><a href="/community.php">社区中心</a> / <a href="group_index.php?gid=<?=$rs_grp["id"]?>"><?=$rs_grp["grp_name"]?>小组</a> / 发表话题</div>
		
		<div class="grp_thread">
		<div class="error_tips_none" id="lop" style="margin:0px;"></div>
		<?php if($gr->group_cookie($gid)==$cookie_uid || $gr->join_group_cookie($gid,$cookie_uid)!=0){?>
		<form action="user/deal.php?act=thread" method="post" enctype="multipart/form-data" name="formthread" id="formthread" onsubmit="return checkthread();">
			<ul>
				<li><strong>标题：</strong></li>
				<li><input name="title" type="text" id="title" class="grp_adding" /></li>
				<li><strong>标签：</strong></li>
				<li><input name="keyword" type="text" id="keyword" class="grp_adding" />&nbsp;多个"&nbsp;,&nbsp;"隔开</li>
				<li class="lipadding" style="padding-bottom:10px;"><strong>内容：</strong></li>
				<span style="position:relative; right:11px; top:6px; display:block;"><?php 
				$face_canshu = "?xtwvf=formthread";
				require_once("../memb/inc/face_mo.php");?></span>
				<li><textarea name="content" id="content" class="grp_texttarea" style="width:600px;height:100px;"></textarea>
				<input name="hidde" type="hidden" id="hidde" value="<?=date("Ymd",time());?>" />
      <input name="gid" type="hidden" id="gid" value="<?=$gid?>" /></li>
				<li><strong>上传图片：</strong></li>
				<li class="xwvf_tex"><input name="grp_file[]" type="file" onkeydown="return false" id="inp1" class="grp_adding" /><a href="increase" id="zeng_jia_e"class="weilebj">增加</a><a href="reduce" id="zeng_jia_ef" class="weilebj">减少</a></li>
				
				<?php if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)){?>
				<li class="lipadding" id="bubu"><strong>置顶：</strong><input name="zd" type="checkbox" id="zd" value="1" /></li>
				<?php }?>
			</ul>
			
			<ul id="sub_zsh"><input type="submit" name="Submit" value=" " class="grhead_sub" /></ul>
		</form>
		<?php }else{echo "您不是该组成员";}?>
		<br />
		</div>
				
	</div>

	<div class="grp_right">
		<?php require_once("inc/group_right.php");?>
	</div>

</div>
<?php require_once("../inc/z_bottom.php");?>
</body>
</html>
