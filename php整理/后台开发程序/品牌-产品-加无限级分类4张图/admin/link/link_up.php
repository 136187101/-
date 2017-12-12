<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");

if($_GET[act] == "edit"){
$sql = $query = "select * from link where id = $id";
$rows = $db->getOne($sql);

}


if($_POST[Submit] == "修改"){

				if(!empty($_FILES['image']['name'])){
		    $upload =new upload();

		    $upload->field ='image';  //检查文件上传类型是否 符合

		    $upload->file_save_path ='../../newspic/';  //文件路径
			
			if($upload->upload()){
				$images =new Image();
				$images->resource_path =$upload->save_url;  //文件判断处理后得到新的路径给图片的原路径
				$images->file_save_path ='../../newspic/';  
				$images->make_thumb(173,46);	//制作缩略图  图片 宽 高

		$big_image =str_replace('../','',$upload->save_url);
		$image=str_replace('../../','',$images->thumb_save_path);
			}else{
			//	msg($upload->get_upload_error(),'?act=add',3);
			  // $upload->get_upload_error();
			  $js->Alert($upload->get_upload_error());
			  echo '<script language=javascript> history.back();</script>';
			}
		
	    }
				
if(!empty($image)){
	unlink("../../{$rows[image]}");

$query = "update link set title='$_POST[title]',image='$big_image',px='$_POST[px]',http='$_POST[http]',times='".time()."' where id=$id";
}else{
$query = "update link set title='$_POST[title]',px='$_POST[px]',http='$_POST[http]',times='".time()."' where id=$id";
}
			if($db->query($query)){
			$js->alert("修改成功");
			$js->Gotoxx("link_gl.php?PB_page=$PB_page");
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
<span class="action-span"><a href="link_gl.php">链接列表</a></span><span class="action-span1">友情链接管理</span><span id="search_id" class="action-span1"> - 编辑链接管理 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">
              <tr>
                  <td width="9%" height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="image" type="file" id="image" style="height:18;" />
                  <span class="STYLE5">*</span></td>
                </tr>
                <tr>
                  <td width="9%"></td>
                  <td height="20" width="91%"  align="left" bgcolor="#FFFFFF"><img src="<?="../../".$rows[image]?>" width="230" height="80" /></td>
                </tr> 
                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="50" value="<?=$rows[title]?>"/></td>
                </tr>
                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="http" type="text" id="http" size="50" value="<?=$rows[http]?>"/></td>
                </tr>
                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$rows[px]?>" size="5"/></td>
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

