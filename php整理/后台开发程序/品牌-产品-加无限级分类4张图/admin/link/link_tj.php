<?php 
@header('Content-type: text/html;charset=utf-8');

require '../../include/init.php';
require_once("../session.php");

if($Submit == "提交"){
			
			
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


			
			$query = "INSERT INTO link(title,image,http,px,times)VALUES('$_POST[title]','$big_image','$_POST[http]','$_POST[px]','".time()."')";
			if($db->query($query)){
			$js->Alert("添加成功");
			$js->Gotoxx("link_gl.php");
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
<span class="action-span"><a href="link_gl.php">链接列表</a></span>
<span class="action-span1">友情链接管理</span><span id="search_id" class="action-span1"> - 添加友情链接 </span>
<div style="clear:both"></div>
</h1>

<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="main-div">
    <table width="100%" id="general-table">
               <tr>
                 <td width="9%" height="24" class="label" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                 <td width="91%" height="24" align="left"bgcolor="#FFFFFF"><input name="image" type="file" id="image" style="height:18;" /></td>
      </tr> 
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
                </tr>
                <tr>
                  <td height="24"  class="label" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="http" type="text" id="http" value="http://" size="50" /></td>
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
