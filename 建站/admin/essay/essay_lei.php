<?php  
@header('Content-type: text/html;charset=utf-8');
require_once("../../include/init.php");
require_once("../session.php"); 
if($_GET[act] == "zileidel"){
	$query = "DELETE FROM essay_zilei where id='$id'";

	$db->query($query);
	$js->alert("删除成功");
	//$js->Gotolwq("/admin/liwqbj/left.php?zhan=2&fuid=$fuid&yuyan='$yuyan'");
	$js->Goto("essay_lei.php?fuid=$_GET[fuid]&id=$_GET[fuid]");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/skin.css" rel="stylesheet" type="text/css">
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
<body id="body">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
                  <td width="40%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="Navitable">
                    <tr>
                      <td width="47%" height="24">&nbsp;&nbsp;
					  <?php
					  if($fuid <> 1){ 
					  $sql = "select * from essay_zilei where id = '$_GET[fuid]'";
					  $news_yi=$db->getOne($sql);
					 // $news_yi=$db->loadobject();
					  $newstitle = "-[".$news_yi[zititle]."]";
					  }
					  ?>你当前的位置：[类别管理项目]<?php if($fuid!=0){?>-[<a href="essay_lei.php?fuid=0" class="liw">类别管理</a>]<?=$newstitle?><?php }?></td>
                    </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" class="table">
				<tr>
                  <td width="9%" height="26" align="center" background="../images/bg.gif">
			
				  <a href="essay_uplei.php?act=fulei&fuid=<?=$_GET[fuid]?>" title="添加子类别"><strong>添加类别</strong></a>
		  </td>
                  <td width="91%" align="center" background="../images/bg.gif">类别管理</td>
				</tr>
                <tr>
                  <td height="20" colspan="2" align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" >
                    <tr>
                      <td width="499" height="26" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp; 类别名称</td>
                      <td width="40" height="24" align="center" bgcolor="#FFFFFF">图片</td>
                      <td width="49" height="24" align="center" bgcolor="#FFFFFF">子类别</td>
                      <td width="194" height="24" align="center" bgcolor="#FFFFFF">添加时间</td>
                      <td width="42" height="24" align="center" bgcolor="#FFFFFF">排序</td>
                      <td width="221" height="24" align="center" bgcolor="#FFFFFF">操作</td>
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
                      <td height="24" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp; <a href="?id=<?=$row["id"]?>&amp;fuid=<?=$row["id"]?>" class="liw" title="点击进入添加下一级菜单">【<?php echo $row["zititle"]?>】</a> </td>
                      <td align="center" bgcolor="#FFFFFF"><?php if($row["ziimage"]){?>
                          <img src="<?=$row["ziimage"]?>" width="40" height="40"/>
                          <?php }?>
                      </td>
                      <td align="center" bgcolor="#FFFFFF"><?=$num?></td>
                      <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d h:i:s",$row["times"])?></td>
                      <td align="center" bgcolor="#FFFFFF"><?=$row["zileipx"]?></td>
                      <td align="center" bgcolor="#FFFFFF"><a href="essay_uplei.php?act=edit&id=<?php echo $row["id"]?>&fuid=<?php echo $fuid?>">编辑</a>&nbsp;
                          <?php //if($fuid <> 1){?>
                          <a href="?act=zileidel&amp;id=<?=$row["id"]?>&amp;fuid=<?=$fuid?>" onclick="return ConfirmDelBig();">删除</a>
                        <?php //}?></td>
                    </tr>
                    <?php 
}
	?>
                  </table></td>
              </tr>
              </table>		    </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35">&nbsp;</td>
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="right">&nbsp;&nbsp;共有
                        <?=$zong?>
                      条记录，当前第
                      <?=$_GET["PB_page"];?>
                      /
                      <?=$liwqbjpage->totalpage?>
                      页，当前
                      <?=$pagepre?>
                      条
                      <?=$liwqbjpage->show(3)?>
                      <input type="button" name="Submit" value="返回" class="anniu" onclick="javascript:history.go(-1)" />
                      &nbsp; </td>
                  </tr>
                </table>                 </td>
              </tr>
            </table></td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
 </body>
 </html>
