<?php
require_once("../../include/global.php");
require_once("../session.php");
switch ($act){
	case "del" :
		$query = "delete from news where id in($uid)";
		$db->setQuery($query);
		$db->query();
		$js->Goto("?id=$id&msg=".urlencode('删除成功'));
		break;	
}
	$sql = "select * from news where img_id = $id order by times desc";
	$pagepre = 10;
	$db->setQuery($sql);
	$zong = $db->num_rows();
	  if($zong == ""){
	  $kong = "<tr><td align='center'>当前没有任何记录数</td></tr>";
	  $zong = 1 ;
	  }
	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
$rows = $db->loadObjectList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function sltAll()
{
	var max =document.form1.item("del");
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

strurl = "?act=del&uid=" +strid;//据实际修改一下
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
<script src="../js/tancu.js"></script>
</head>
<body>
<div align="center"><font color="Red"><?=urldecode($msg)?></font></div>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <form id="form2" name="form2" method="get" action="?PB_page=<?=$_GET["PB_page"];?>&amp;yidlei=<?=$_GET["yidlei"]?>&amp;sou=<?=$_GET["sou"]?>" onsubmit="return checkSubmit();">
                <tr>
                  <td width="37%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="47%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[图片管理]</td>
                        <td width="48%" class="STYLE1">
                          <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td align="right">
                                <table width="70" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="33%" class="STYLE1"><img src="../images/22.gif" width="14" height="14" /></td>
                                    <td width="67%" align="left" class="STYLE1"><a href="news_img_tj.php?id=<?=$id?>&PB_page=<?=$_GET["PB_page"]?>" class="STYLE6">新增</a></td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                  </table></td>
                  <input type="hidden" name="Submit" value="搜索">
                </tr>
              </form>
            </table>
            </td>
            <td width="12"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <form id="form1" name="form1" method="post" action="">	
          <tr>
            <td width="9" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <?php 
				  $i=1;
				  foreach($rows as $rs){?>
                  <td align="center">
                    <table width="140" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0px;">
                      <tr>
                        <td align="center"><img src="../../<?=$rs->image?>" width="140" height="110" /></td>
                      </tr>
                      <tr>
                        <td height="25" align="center">&nbsp;<a href="news_img_up.php?img_id=<?=$id?>&id=<?=$rs->id?>&PB_page=<?=$_GET["PB_page"];?>"><img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="news_img_gl.php?act=del&id=<?=$id?>&uid=<?=$rs->id?>&PB_page=<?=$_GET["PB_page"];?>"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
                      </tr>
                    </table>
                  </td>
                  <?php
				  if($i % 4 == 0){
				  	echo "</tr><tr>";
				  } 
				  $i++;
				  }?>
				</tr>
                <?=$kong?>
              </table>
            </td>
            <td width="9" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
	</form>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="STYLE4">&nbsp;&nbsp;共有
                    <?=$zong?>
                    条记录，当前第
                    <?=$_GET["PB_page"];?>
                    /
                    <?=$liwqbjpage->totalpage?>
                    页，当前 <?=$pagepre?> 条</td>
                  <td align="right"><?=$liwqbjpage->show(3)?></td>
                </tr>
            </table></td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
</body>
</html>