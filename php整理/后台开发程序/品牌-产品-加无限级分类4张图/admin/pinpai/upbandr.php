<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");

if($_GET[act] == "edit"){
$sql = $query = "select * from bandr where id = '$id'";
$rows = $db->getOne($sql);

}


if($_POST[Submit] == "修改"){
			//logo图片
			$logo = $_POST["logo"];
			if($_FILES["logo"]["name"]==""){
			$logo1=$rows[logo];
			}else{
			$logo1=$hjd->upload("logo","/bandr/",array(".gif",".jpg",".jpeg",".png"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			//删除图片
			@unlink("../..$rows[logo]");
			}
			//大图片
			$image = $_POST["image"];
			if($_FILES["image"]["name"]==""){
			$image1=$rows[dalogo];
			}else{
			$image1=$hjd->upload("image","/bandr/",array(".gif",".jpg",".jpeg",".png"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			@unlink("../..$rows[dalogo]");
			}


$query = "update bandr set title='$_POST[title]',px='$_POST[px]',lishi='$_POST[content]',cont='$_POST[content1]',logo='$logo1',dalogo='$image1' where id=$id";
			if($db->query($query)){
			$js->alert("修改成功");
			$js->Gotoxx("bandrgl.php?PB_page=$PB_page&fuid=$fuid");
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
<span class="action-span"><a href="bandrgl.php?fuid=<?php echo $fuid?>">品牌列表</a></span><span class="action-span1">品牌管理</span><span id="search_id" class="action-span1"> - 编辑品牌 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">
      <tr>
        <td height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">LOGO：&nbsp;&nbsp;</span></td>
        <td height="24" align="left"bgcolor="#FFFFFF"><input name="logo" type="file" id="logo" style="height:18;" /><br />
       <img src="<?=$rows[logo]?>" width="100" height="50" />
        </td>
      </tr>
      <tr>
        <td height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">大图：&nbsp;&nbsp;</span></td>
        <td height="24" align="left"bgcolor="#FFFFFF"><input name="image" type="file" id="image" style="height:18;" /><br />
        <img src="<?=$rows[dalogo]?>" width="100" height="50" />
        </td>
      </tr>
      <tr>
        <td height="24"  class="label" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
        <td height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" value="<?=$rows[title]?>" size="30" /></td>
      </tr>
      <tr>
        <td height="24"  class="label" bgcolor="#FFFFFF"><span class="table_title">品牌历史、优势：&nbsp;&nbsp;</span></td>
        <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="content" style="width:90%;height:300px;visibility:hidden;"><?=$rows[lishi]?>
        </textarea></td>
      </tr>
      <tr>
        <td height="24"  class="label" bgcolor="#FFFFFF"><span class="table_title">产品描述、特点：&nbsp;&nbsp;</span></td>
        <td height="24" align="left" bgcolor="#FFFFFF"><textarea name="content1" style="width:90%;height:300px;visibility:hidden;"><?=$rows[cont]?>
        </textarea></td>
      </tr>
                <tr>
                  <td width="9%" height="20" bgcolor="#FFFFFF" class="label">排序：&nbsp;&nbsp;</td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$rows[px]?>" size="5"/></td>
                </tr>
      <tr>
        <td class="label">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit3" value="修改" />
          <input name="Submit3" type="button" class="button" id="Submit4" value="返回" onclick='javascript:history.go(-1)';/>
</td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>

