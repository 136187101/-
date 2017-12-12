<?php
 @header('Content-type: text/html;charset=utf-8');
require_once("../session.php");
require '../../include/init.php';
$sql = "select * from essay_zilei where id = '$_GET[zid]'"; 
$tbb=$db->getOne($sql);
if($Submit == "搜索"){
$sql = "select a.*,c.zititle from essay a left join essay_zilei c on a.ziid=c.id where a.title like '%".$_GET["sou"]."%' or c.zititle like '%".$_GET["sou"]."%' order by a.px desc";
}else{
$sql = "select a.*,c.zititle,c.gid,c.id as ziid from essay a left join essay_zilei c on a.ziid=c.id where c.id = '$_GET[zid]' order by a.px desc";

}

$pagepre = 20;
$num=$db->Query($sql);
$zong = $db->fetch_nums($num);
	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$sq=$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
	 
	  
$rows=$db->fetch_array($sq); 

$rowst = $db->fetch_object($sq);



if($zong == ""){
	  	$kong = "<div style='padding-top:5px;'>
	  当前还没有任何记录,您所在的当前位置是：".$tbb[zititle]."</div>";
	  $zong = 1 ;
}

if($act == "del"){
	//删除图片
	$deinfo=$db->query("select * from essay where id in ($_GET[id])");
	while($rowsdeinfo=$hjd->fetch_array($deinfo))
	{
		@unlink("../..".$rowsdeinfo["image"]);
		@unlink("../../".$rowsdeinfo["image_rot"]);
	}
	$query = "delete from essay where id in($_GET[id])";
	$db->query($query);
	$js->alert("删除成功");
	$js->Gotoxx("?zid=$_GET[zid]&tid=$_GET[tid]&gid=$_GET[gid]&PB_page=".$_GET["PB_page"]);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>网站后台管理系统</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
<script language="javascript">
function sltAll()
{
	var max =document.form1.item("del");
	if(max== null){ alert("没有信息可以选择"); return false;}
	for(j=0;j<max.length;j++)
	{
		document.form1.del[j].checked = true;
	}
}
function sltNull()
{
	var max =document.form1.item("del");
	for(j=0;j<max.length;j++)
	{
		document.form1.item("del",j).checked = false;
	}
}
//-------------以上是全选取消代码---------------//


function SelectChk()
{
	var s=false,delid,n=0,strid,strurl;
	
	var nn =document.form1.item("del");
	for (j=0;j<nn.length;j++)
	{
		if (document.form1.item("del",j).checked)
		{
			n = n + 1;
			s=true;
			delid =document.form1.del[j].value;
			if(n==1){strid = delid;}
			else{strid = strid + "," + delid;}
		}
	}

	if (nn.length==null)
		{
		if (document.form1.del.checked)
		   { s=true;
		   strid =document.form1.del.value;}
		
		}

	strurl = "?act=del&id=" +strid;//据实际修改一下
	if(!s)	{
			alert("请选择要删除的信息！");
			return false;
		}
		
	if ( confirm("你确定要删除这些信息吗？"))
	{
			form1.action = strurl;
			form1.submit();
		}
}
//-------------以上是全选删除代码---------------//

function ConfirmDelBig()
{
   if(confirm("确定要删除吗？一旦删除不能恢复！"))
     return true;
   else
     return false;
	 
}

function ConfirmDelSmall()
{
   if(confirm("确定要删除吗？\n将删除此栏目下所有栏目！"))
     return true;
   else
     return false;
	 
}

function checkSubmit() 
{ 
	if(document.form2.sou.value==''){
				alert('请填写您要搜索的关键词！！');
				form2.sou.focus();
				return false;
	}
	return true; 
}
</script>
<style type="text/css">
<!--
.STYLE4 {font-weight: bold}
.img{ width:60px; height:60px;}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(e) {
        $(".img").hover(function(){
				$(this).css({"width":"100px","height":"100px"})
			},function(){
				$(this).css({"width":"60px","height":"60px"})
				}
			
			)
    });
</script>
<script src="../js/jquery.lazyload.js" type="text/javascript"></script> 
      <script type="text/javascript" charset="utf-8">
      $(function() {
          $("img").lazyload({
			  placeholder : "../images/load1er.gif",
			  effect : "fadeIn", 
			   threshold : 50 
			   
			   }); 
      });
  </script>

</head>
<body>
<h1>
<span class="action-span"><a href="essay_tj.php?id=<?php echo $rowst->ziid?>&amp;zid=<?php echo $_GET[zid]?>&amp;tid=<?php echo $_GET[tid]?>&amp;gid=<?php echo $_GET[gid]?>&amp;PB_page=<?php echo $_GET["PB_page"]?>">添加信息</a></span>
<span class="action-span1">信息管理</span><span id="search_id" class="action-span1"> - <?=$tbb[zititle]?>列表 </span>
<div style="clear:both"></div>
</h1>
<div class="form-div">
  <form id="form2" name="form2" method="get" action="?zid=<?php echo $_GET[zid]?>&amp;PB_page=<?php echo $_GET["PB_page"];?>&amp;yidlei=<?php echo $_GET["yidlei"]?>&amp;sou=<?php echo $_GET["sou"]?>" onsubmit="return checkSubmit();">
    <img src="../hjdxx/images/fdj_39.jpg" width="23" height="27"border="0" alt="SEARCH" />
    关键字 <input  name="sou" type="text" id="sou"  value="<?php echo $_GET['sou']?>" size="25" />
    	<input name="zid" type="hidden" id="zid" value="<?php echo $_GET['zid']?>"/> 
    <input type="submit" value=" 搜索 " class="button" name="Submit" />
     <input type="hidden" name="Submit" value="搜索">
  </form>
</div>
<form id="form1" name="form1" method="post" action="">
  <div class="list-div" id="listDiv">
    <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
      <tr>
        <th>&nbsp;</th>
        <th><strong>序号</strong></th>
        <?php if($tbb["type"]!='0'){?>
        <th><strong>图</strong></th>
        <?php }?>
        <th><strong>标题</strong></th>
        <th><strong>类别</strong></th>
        <th>添加时间</th>
        <th>排序</th>
        <th>操作</th>
      </tr>
      <?php
	  $i=1;
			 foreach($rows as $row){
					?>
      <tr>
        <td align="center" class="first-cell"><input name="del" type="checkbox" id="del" value="<?=$row[id]?>" /></td>
        <td align="center" class="first-cell"><a href="?id=<?=$row["id"]?>&amp;fuid=<?=$row["id"]?>" class="liw" title="点击进入添加下一级菜单">
          <?=$i?>
        </a></td>
        <?php if($tbb["type"]!='0'){?>
        <td align="center"><?php if($row[image_rot] == ""){?>
          <img src="../images/load1er.gif" data-original="../images/zanwu.jpg" class="img" />
          <?php }else{?>
          <img src="../images/load1er.gif" data-original="<?="../../".$row[image_rot]?>"  class="img"/>
          <?php }?></td>
        <?php }?>
        <td align="center"><?=$row[title]?></td>
        <td align="center"><?=$row[zititle] ? $row[zititle] : "<font color='red'>暂无分类</font>";?></td>
        <td align="center"><?=$row[times]?></td>
        <td align="center"><?=$row[px]?></td>
        <td align="center"><a href="essay_up.php?id=<?=$row[id]?>&amp;zid=<?=$row[ziid]?>&amp;tid=<?php echo $tid?>&amp;gid=<?php echo $gid?>&amp;yuyan=<?php echo $yuyan?>&amp;PB_page=<?php echo $_GET['PB_page'];?>">编辑</a>&nbsp; <a href="?act=del&amp;id=<?=$row[id]?>&amp;zid=<?=$row[ziid]?>&amp;tid=<?php echo $_GET[tid]?>&amp;gid=<?php echo $_GET[gid]?>&amp;PB_page=<?php echo $_GET["PB_page"];?>" onclick="return ConfirmDelBig();">删除</a></td>
      </tr>
      <?php 
		   $i++;
		   }
		   ?>
      <tr>
        <td align="right" nowrap="nowrap" colspan="10"><!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
          <div id="turn-page">
            <table width="95%" border="0" align="center"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="ye">
              <tr style="border:1px #bfd8e0 solid;">
                <td width="65%" height="28" align="left" bgcolor="#F9FCFD">&nbsp;<span class="STYLE4"> <a style="color:#000000" onclick="sltAll();" onmouseover="this.style.cursor='hand'">全选</a> <a onclick="sltNull();" style="color:#000000" onmouseover="this.style.cursor='hand'">取消</a> <a onclick="SelectChk();" style="color:#000000" onmouseover="this.style.cursor='hand'">删除</a> &nbsp;&nbsp;共有
                  <?=$zong?>
                  条记录，当前第
                  <?=$_GET["PB_page"];?>
                  /
                  <?=$liwqbjpage->totalpage?>
                  页，当前
                  <?=$pagepre?>
                  条 </span></td>
                <td width="30%" align="right" bgcolor="#F9FCFD"><span class="STYLE4">
                  <?=$liwqbjpage->show(3)?>
                </span></td>
              </tr>
            </table>
          </div></td>
      </tr>
    </table>
  </div>
</form>
</div>
</body>
 </html>