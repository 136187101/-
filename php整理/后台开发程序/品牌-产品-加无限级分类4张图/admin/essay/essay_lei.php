<?php  
@header('Content-type: text/html;charset=utf-8');
require_once("../../include/init.php");
require_once("../session.php"); 
if($_GET[act] == "zileidel"){
	$query = "DELETE FROM essay_zilei where id='$id'";

	$db->query($query);
	$js->alert("删除成功");
	//$js->Gotoxxlwq("/admin/liwqbj/left.php?zhan=2&fuid=$fuid&yuyan='$yuyan'");
	$js->Gotoxx("essay_lei.php?fuid=$_GET[fuid]&id=$_GET[fuid]");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
<title>网站后台管理系统</title>

<script language="javascript">
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

strurl = "?act=del&PB_page=<?php echo $_GET["PB_page"];?>&id=" +strid;//据实际修改一下

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
</script>
</head>
<h1>
<span class="action-span"><a href="essay_uplei.php?act=fulei&fuid=<?=$_GET[fuid]?>">添加类别</a></span>
<?php
					  if($fuid <> 0){ 
					  $sql = "select * from essay_zilei where id = '$_GET[fuid]'";
					  $news_yi=$db->getOne($sql);
					 // $news_yi=$db->loadobject();
					  $newstitle = "-".$news_yi[zititle];
					  }
?>
<span class="action-span1">类别管理项目</span><span id="search_id" class="action-span1"> - <?php if($fuid!=0){?><a href="essay_lei.php?fuid=0" class="liw">类别管理</a><?=$newstitle?><?php }else{?>类别管理<?php }?></span>
<div style="clear:both"></div>
</h1>
<body id="body">
<div class="list-div" id="listDiv">
  <table width="100%" cellpadding="3" cellspacing="1" id="listTable">
      <tr>
        <th width="32%">类别名称</th>
        <th width="11%">类型</th>
        <th width="9%">子类别</th>
        <th width="15%">添加时间</th>
        <th width="12%">排序</th>
        <th width="21%">操作</th>
      </tr>
                    <?php
					$sql = "SELECT * FROM essay_zilei where fuid = '$_GET[id]' order by zileipx desc";
				//	$tts = mysql_query($sql);	
					$pagepre = 10;
					$num=$db->Query($sql);
					$zong = $db->fetch_nums($num);
					$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
					$sq=$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
					if($_GET["PB_page"] == ""){
					$_GET["PB_page"]= 1;
					}
					while($row = mysql_fetch_array($sq))
					{
					$sql = "SELECT * FROM essay_zilei where fuid = ".$row["id"]." order by zileipx desc";
					
					$ts = mysql_query($sql);
					$num = mysql_num_rows($ts);
					?>
      <tr>
        <td class="first-cell"><a href="?id=<?=$row["id"]?>&amp;fuid=<?=$row["id"]?>" class="liw" title="点击进入添加下一级菜单"><?php echo $row["zititle"]?></a></td>
        <td align="center"><?php if($row[type]==0){echo "文章";}else{echo "图文";}?></td>
        <td align="center"><?=$num?></td>
        <td align="center"><?=date("Y-m-d h:i:s",$row["times"])?></td>
        <td align="center"><?=$row["zileipx"]?></td>
        <td align="center"><a href="essay_uplei.php?act=edit&amp;id=<?php echo $row["id"]?>&amp;fuid=<?php echo $fuid?>">编辑</a>&nbsp;
          <?php //if($fuid <> 1){?>
          <a href="?act=zileidel&amp;id=<?=$row["id"]?>&amp;fuid=<?=$fuid?>" onclick="return ConfirmDelBig();">删除</a>
        <?php //}?></td>
      </tr>
      <?php 
		   $i++;
		   }
		   ?>
      <tr>
        <td align="right" nowrap="nowrap" colspan="8"><!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
          <div id="turn-page">
            <table width="95%" border="0" align="center"  cellpadding="0" cellspacing="0" style="border-collapse:collapse;" class="ye">
              <tr style="border:1px #bfd8e0 solid;">
                <td width="65%" height="28" align="left" bgcolor="#F9FCFD">&nbsp;&nbsp;共有
                  <?=$zong?>
条记录，当前第
<?=$_GET["PB_page"];?>
/
<?=$liwqbjpage->totalpage?>
页，当前
<?=$pagepre?>
条</td>
                <td width="30%" align="right" bgcolor="#F9FCFD"><?=$liwqbjpage->show(3)?>                  <input type="button" name="Submit2" value="返回" class="button" onclick="javascript:history.go(-1)" /></td>
              </tr>
            </table>
          </div></td>
      </tr>
  </table>
</div>
</div>
 </body>
 </html>
