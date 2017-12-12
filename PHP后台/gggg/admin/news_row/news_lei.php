<?php
require_once("../../include/global.php");
require_once("../session.php");
if($act == "zileidel"){
	$query = "DELETE FROM news_zilei where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("删除成功");
	$js->Gotolwq("../liwqbj/left.php?zhan=2&fuid=$fuid&yuyan=$yuyan");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script src="../js/huanse.js"></script>
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

strurl = "?act=del&PB_page=<?=$_GET["PB_page"];?>&id=" +strid;//据实际修改一下

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
</script></head>
<body id="body">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
                  <td width="40%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                      <td width="47%" class="STYLE1">
					  <?php
					  if($fuid <> 0){ 
					  $sql = "select * from news_zilei where id = $fuid";
					  $db->setquery($sql);
					  $news_yi=$db->loadobject();
					  $newstitle = "-[".$news_yi->zititle."]";
					  }
					  ?>
					  <span class="STYLE3">你当前的位置</span>：[类别管理项目]-[<a href="news_lei.php?fuid=0&yuyan=<?=$yuyan?>" class="liw">类别管理</a>]<?=$newstitle?>
					  </td>
                      <td width="48%" class="STYLE1">
					  </td>
                    </tr>
                  </table></td>
                </tr>
            </table></td>
            <td width="16"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center">
			<table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CDE9FC">
				<tr>
                  <td width="9%" height="23" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">
				  <?php //if($fuid <> 0){?>
				  <a href="../news_row/news_uplei.php?act=fulei&fuid=<?=$fuid?>&yuyan=<?=$yuyan?>" title="添加子类别">添加类别</a>
				  <?php //}?>
				  </td>
                  <td width="91%" align="center" background="../images/bg.gif">类别管理</td>
				</tr>
                <tr>
                  <td height="20" colspan="2" align="center">
				  
				  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" onmouseover="changeto()"  onmouseout="changeback()">
                    <tr>
                      <td width="499" height="24" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp; 类别名称</td>
                      <td width="40" height="24" align="center" bgcolor="#FFFFFF">图片</td>
                      <td width="49" height="24" align="center" bgcolor="#FFFFFF">子类别</td>
                      <td width="194" height="24" align="center" bgcolor="#FFFFFF">添加时间</td>
                      <td width="42" height="24" align="center" bgcolor="#FFFFFF">排序</td>
                      <td width="221" height="24" align="center" bgcolor="#FFFFFF">操作</td>
                    </tr>
                    <?php
					$sql = "SELECT * FROM news_zilei where fuid = $fuid order by zileipx desc";
					$tts = mysql_query($sql);
					while($row = mysql_fetch_array($tts))
					{
					$sql = "SELECT * FROM news_zilei where fuid = ".$row["id"]." order by zileipx desc";
					$ts = mysql_query($sql);
					$num = mysql_num_rows($ts);
					?>
                    <tr>
                      <td height="20" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;
					  <?php if($row["gid"]){?>
					  <a href="?id=<?=$row["id"]?>&fuid=<?=$row["id"]?>&yuyan=<?=$yuyan?>" class="liw" title="点击进入添加下一级菜单">【<?php echo $row["zititle"]?>】</a> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red;"> 点击进入子栏目进行添加、编辑、删除</span>
					  <?php }else{?>
					  【<?php echo $row["zititle"]?>】
					  <?php }?>					  </td>
                      <td align="center" bgcolor="#FFFFFF">
					  <?php if($row["ziimage"]){?>
					  <img src="<?=$row["ziimage"]?>" width="40" height="40"/>
					  <?php }else{?>
					  <img src="../images/zanwu.gif" width="40" height="40"/>
					  <?php }?>
					  </td>
                      <td align="center" bgcolor="#FFFFFF"><?=$num?></td>
                      <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d h:i:s",$row["times"])?></td>
                      <td align="center" bgcolor="#FFFFFF"><?=$row["zileipx"]?></td>
                      <td align="center" bgcolor="#FFFFFF">
			<a href="../news_row/news_uplei.php?act=edit&amp;id=<?=$row["id"]?>&fuid=<?=$fuid?>&yuyan=<?=$yuyan?>"> <img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>&nbsp; 
			<?php //if($fuid <> 0){?>
			<a href="?act=zileidel&amp;id=<?=$row["id"]?>&fuid=<?=$fuid?>&yuyan=<?=$yuyan?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a><?php //}?></td>
                    </tr>
	<?php 
}
	?>
                  </table></td>
              </tr>
              </table>
		    </td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right">
<!--				  <input type="button" name="Submit" value="返回" class="anniu" onclick="javascript:history.go(-1)" />&nbsp;
-->                  <input type="button" name="Submit2" value="返回" class="anniu" onclick="location.href='news_lei.php?fuid=0&yuyan=0'" />
                </td>
              </tr>
            </table></td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
 </body>
 </html>
