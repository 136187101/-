<?php 
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");

if($_GET[act] == "edit"){
$sql = $query = "select * from advertising where id = $id";
$rows = $db->getOne($sql);

}


if($_POST[Submit] == "修改"){


			$file = $_POST["file"];
	
			if($_FILES["file"]["name"]==""){
			$file1="";
			}else{
			$file1=upload("file","/admin/newspic/jiaodian/",array(".gif",".jpg",".jpeg",".png",".rar"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			}
	if(!empty($file1)){
	unlink("..". substr($rows[image],6,100));	
$query = "UPDATE `advertising` SET `image` = '$file1',`url` = '$_POST[url]',`px` = '$_POST[px]',`times` = '".time()."',`wide` = '$_POST[wide]',`high` = '$_POST[high]',weizhi='$_POST[weizhi]' WHERE `id` =$id";
	}else{
	$query = "UPDATE `advertising` SET `url` = '$_POST[url]',`px` = '$_POST[px]',`times` = '".time()."',weizhi='$_POST[weizhi]' WHERE `id` =$id";
	}
	if($db->query($query)){

	$js->alert("修改成功");
	$js->Goto("poster_gl.php");
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
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[广告管理]-[编辑]</td>
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
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="file" type="file" id="file" style="height:18;" />
                  <span class="STYLE5">*</span></td>
                </tr>
                <tr>
                  <td height="20" colspan="2" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?="../../".$rows[image]?>" width="230" height="80" /></td>
                </tr> 
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="url" type="text" id="url" size="50" value="<?=$rows[url]?>"/></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">位置：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="weizhi" cols="70" rows="3" id="weizhi"><?=$rows[weizhi]?></textarea></td>
                </tr>
                
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$rows->px?>" size="5"/></td>
                </tr>
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

