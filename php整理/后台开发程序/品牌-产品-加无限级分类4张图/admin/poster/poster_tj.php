<?php 
require '../../include/init.php';
require_once("../session.php");

if($Submit == "提交"){
			
			

			$file = $_POST["file"];
	
			if($_FILES["file"]["name"]==""){
			$file1="";
			}else{
			$file1=$hjd->upload("file","/admin/newspic/jiaodian/",array(".gif",".jpg",".jpeg",".png",".rar"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			}
			
			$query = "INSERT INTO`jiaodian` (`image`, `logo`, `url`, `px`, `zhanshi`, `times`, `text`) VALUES ('$file1', '0', '$_POST[url]', '$_POST[px]', '0', '".time()."','$_POST[text]')";
			if($db->query($query)){
			$js->Alert("添加成功");
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
<span class="action-span"><a href="poster_gl.php">焦点图列表</a></span>
<span class="action-span1">焦点图管理</span><span id="search_id" class="action-span1"> - 添加焦点图 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">
               <tr>
                  <td width="9%" height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="24" align="left" bgcolor="#FFFFFF"><input name="file" type="file" id="file" style="height:18;" />
                  </td>
      			</tr> 
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">说明：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="text" type="text" id="url" size="50" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="url" type="text" id="url" value="http://" size="50" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
        <td class="label">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit" value="提交" />                    
                    &nbsp;&nbsp;
          <input name="Submit22" type="button" class="button" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
