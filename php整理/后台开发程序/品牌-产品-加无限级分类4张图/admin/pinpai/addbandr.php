<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");
$fuid=$_GET["fuid"];
if($Submit == "提交"){
			//logo图片
			$logo = $_POST["logo"];
			if($_FILES["logo"]["name"]==""){
			$logo1="";
			}else{
			$logo1=$hjd->upload("logo","/bandr/",array(".gif",".jpg",".jpeg",".png"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			}
			//大图片
			$image = $_POST["image"];
			if($_FILES["image"]["name"]==""){
			$image1="";
			}else{
			$image1=$hjd->upload("image","/bandr/",array(".gif",".jpg",".jpeg",".png"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			}
			
			$query = "INSERT INTO bandr(fuid,title,lishi,cont,logo,dalogo,times,px)VALUES('$fuid','$_POST[title]','$_POST[content]','$_POST[content1]','$logo1','$image1','$date','$_POST[px]')";
			if($db->query($query)){
			$js->Alert("添加成功");
			$js->Gotoxx("bandrgl.php?fuid=$fuid");
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
	<script charset="utf-8" src="../hjd_Ub/kindeditor.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
			});
			var editor1 = K.create('textarea[name="content1"]', {
			});
		});
	</script>

</head>
<body>
<h1>
<span class="action-span"><a href="bandrgl.php?fuid=<?php echo $fuid;?>">品牌列表</a></span>
<span class="action-span1">品牌管理</span><span id="search_id" class="action-span1"> - 添加品牌 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">
               <tr>
                 <td width="9%" height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">LOGO：&nbsp;&nbsp;</span></td>
                 <td width="91%" height="24" align="left"bgcolor="#FFFFFF"><input name="logo" type="file" id="logo" style="height:18;" /></td>
      </tr> 
               <tr>
                 <td width="9%" height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">大图：&nbsp;&nbsp;</span></td>
                 <td width="91%" height="24" align="left"bgcolor="#FFFFFF"><input name="image" type="file" id="image" style="height:18;" /></td>
      </tr> 
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
                </tr>
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF"><span class="table_title">品牌历史、优势：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="content" style="width:90%;height:300px;visibility:hidden;"></textarea></td>
                </tr>
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF"><span class="table_title">产品描述、特点：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="content1" style="width:90%;height:300px;visibility:hidden;"></textarea></td>
                </tr>
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
				
      <tr>
        <td class="label">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit" value="提交" />
          <input type="reset" value=" 重置 " class="button" />
</td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
