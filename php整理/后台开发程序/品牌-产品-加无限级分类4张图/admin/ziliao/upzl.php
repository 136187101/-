<?php 
require '../../include/init.php';
require_once("../session.php");
$fuid=$_GET["fuid"];
$id=$_GET["id"];
//读取资料父类
$rs_zl=$hjd->get_one("select * from ziliaofl where id = '$fuid'");
//读取资料内容
if($_GET[act] == "edit"){

$sql = $query = "select * from ziliao where id ='$id'";
$rows = $db->getOne($sql);

}
if($_GET["actd"]=="dfj")
{
	@unlink("../../{$rows[annex]}");
	$db->query("update ziliao set annex='' where id = '$id'");
	$js->Alert("删除成功");
	$js->Gotoxx("upzl.php?act=edit&PB_page=$PB_page&fuid={$fuid}&id={$id}");
}




if($_POST[Submit] == "修改"){
	$file = $_POST["file"];
	if($_FILES["file"]["name"]==""){
		$file1="";
	}else{
		$file1=upload("file","/annex_h/",array(".pdf",".doc",".docx",".xls",".rar"),"50000000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
	}
	$date=date("Y-m-d H:i:s");
	if($file1=="")
	{
		$query = "update ziliao set title='$_POST[title]',content ='$_POST[content]',sort='$_POST[px]',times='$date' where id=$id";
	}
	else
	{
		@unlink("../../{$rows[annex]}");
		$query="update ziliao set title='$_POST[title]',annex='$file1',content ='$_POST[content]',sort='$_POST[px]',times='$date' where id=$id";	
	}
			if($db->query($query)){
			$js->alert("修改成功");
			$js->Gotoxx("ziliaogl.php?PB_page=$PB_page&fuid={$fuid}");
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="Navitable">
          <tr>
            <td width="12" height="30">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[资料管理]-[<?php echo $rs_zl["title"];?>]-[<?php echo $rows["title"]?>]-[资料编辑]</td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">修改友情链接</td>
                </tr> 
                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="50" value="<?=$rows[title]?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$rows["sort"]?>" size="5"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">附件：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="file" type="file" />
                  <?php 
				  	if($rows["annex"]!="")
					{
				  ?>
                  <img src="../images/gif-0173.gif" width="15" height="15" /><a href="?act=actd&actd=dfj&PB_page=<?php echo $PB_page;?>&fuid=<?php echo $fuid?>&id=<?php echo $id?>">删除附件</a>
                  <?php 
					}
					else
					{
				  ?>
                  暂无附件
                  <?php
					}
				  ?>
                  </td>
                </tr>
<!--                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">内容：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="content" id="content" cols="65" rows="5" style="height:400px; width:90%"><?=$rows["content"];?></textarea></td>
                </tr>-->
			<script charset="utf-8" src="../../include/editor/kindeditor.js"></script>
  			 <script>
       			 KE.show({
             		   id : 'content'
    		    });
  			 </script>                 
                <tr>
                  <td height="20" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="修改" />                    
                    &nbsp;&nbsp;
                  <input name="Submit22" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
                </tr>
            </table></td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>

