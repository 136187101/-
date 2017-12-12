<?php 
require '../../include/init.php';
require_once("../session.php");

if($_GET[act] == "edit"){
$sql = $query = "select * from jiaodian where id = $id";
$rows = $db->getOne($sql);

}


if($_POST[Submit] == "修改"){


			$file = $_POST["file"];
	
			if($_FILES["file"]["name"]==""){
			$file1="";
			}else{
			$file1=$hjd->upload("file","/admin/newspic/jiaodian/",array(".gif",".jpg",".jpeg",".png",".rar"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			}
	if(!empty($file1)){
	@unlink("../../{$rows[image]}");	
$query = "UPDATE `jiaodian` SET `image` = '$file1',`url` = '$_POST[url]',`px` = '$_POST[px]',`times` = '".time()."',`text` = '$_POST[text]' WHERE `id` =$id";
	}else{
	$query = "UPDATE `jiaodian` SET `url` = '$_POST[url]',`px` = '$_POST[px]',`times` = '".time()."',`text` = '$_POST[text]' WHERE `id` =$id";
	}
	if($db->query($query)){

	$js->alert("修改成功");
	$js->Gotoxx("poster_gl.php");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
</head>
<body>
<h1>
<span class="action-span"><a href="poster_gl.php">焦点图列表</a></span><span class="action-span1">焦点图管理</span><span id="search_id" class="action-span1"> - 编辑焦点图 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">
              <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="file" type="file" id="file" style="height:18;" />
                  <span class="STYLE5">*</span></td>
      </tr>
                <tr>
                  <td width="9%"></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><img src="<?="../../".$rows[image]?>" width="230" height="80" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">说明：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="text" type="text" id="url" size="50" value="<?=$rows[text]?>" /></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="url" type="text" id="url" size="50" value="<?=$rows[url]?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$rows[px]?>" size="5"/></td>
                </tr>
      <tr>
        <td class="label">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit" value="修改" />                    
                    &nbsp;&nbsp;
          <input name="Submit22" type="button" class="button" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>

