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
			$js->Goto("link_gl.php");
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
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[友情链接管理]-[链接添加]</td>
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
                  <td width="9%" height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="24" align="left" bgcolor="#FFFFFF"><input name="image" type="file" id="image" style="height:18;" />
                  <span class="STYLE5">*图片的大小是 120 X 50 </span></td>
                </tr> 
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="30" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="http" type="text" id="http" value="http://" size="50" /></td>
                </tr>
                <tr>
                  <td height="24" align="right" bgcolor="#FFFFFF">排序：&nbsp;&nbsp;</td>
                  <td height="24" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
				

				
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
