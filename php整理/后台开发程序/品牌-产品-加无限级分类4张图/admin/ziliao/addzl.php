<?php 
require '../../include/init.php';
require_once("../session.php");
$fuid=$_GET["fuid"];
//读取资料父类
$rs_zl=$hjd->get_one("select * from ziliaofl where id = '$fuid'");

if($Submit == "提交"){
				
	$file = $_POST["file"];
	if($_FILES["file"]["name"]==""){
		$file1="";
	}else{
		$file1=upload("file","/annex_h/",array(".pdf",".doc",".docx",".xls",".rar"),"50000000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
	}
	$date=date("Y-m-d H:i:s");
			$query = "INSERT INTO ziliao(fuid,title,annex,content,sort,times)VALUES('$fuid','$_POST[title]','$file1','$_POST[content]','$_POST[px]','$date')";
			if($db->query($query)){
			$js->Alert("添加成功");
			$js->Gotoxx("ziliaogl.php?fuid={$fuid}");
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
                        <td width="5%"><div align="center"></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[<?php echo $rs_zl["title"]?>管理]-[资料添加]</td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
            <td width="16"></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>添加友情链接</strong></td>
                </tr> 
                <tr>
                  <td width="9%" height="24" align="right" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td width="91%" height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">附件：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input type="file" name="file" id="file" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
<!--                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF">介绍：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="content" id="content" cols="65" rows="5" style="height:400px; width:90%"></textarea></td>
                </tr>-->
			<script charset="utf-8" src="../../include/editor/kindeditor.js"></script>
  			 <script>
       			 KE.show({
             		   id : 'content'
    		    });
  			 </script> 
				
                <tr>
                  <td height="24" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="提交" />                    
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
            <td width="12" height="35"></td>
            <td>&nbsp;</td>
            <td width="16"></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>