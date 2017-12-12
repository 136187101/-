<?php
require_once("../../include/global.php");
require_once("../session.php");
$query = "select * from liwq_dan where id=$id";
$db->setQuery($query);
$pro = $db->loadObject();
$image = $pro->image;
if($Submit=="修改"){
			if($_FILES[image][name]){
				$img = new Image("image","newspic");
				if($img->upload()){
					$image = $img->getImgPath();
					$root = ROOT.$rows->image;
					@unlink($root);
				}else{
					echo $image;
				}
			}
	$query = "update liwq_dan set title='$title',author='$author',content='$content',times='".time()."',px='$px' where id = $id";
	$db->setQuery($query);
	$db->query();
	$js->alert("修改成功");
	$js->Goto("?");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form action="" method="post" enctype="multipart/form-data" name="myform" id="myform" onsubmit="return checkSubmit();">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[新闻管理]-[新闻管理项目]-[编辑]</td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
            <td width="16"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">修改[<font  color="#FF0000"><?=$pro->title?></font>]信息</td>
                </tr>
                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">名称：</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" value="<?=$pro->title?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">作者：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="author" type="text" id="author" value="<?=$pro->author?>"/></td>
                </tr>
                <tr>
                  <td height="20" colspan="2" align="center" bgcolor="#FFFFFF">					
				  <?php
                            $oFCKeditor = new FCKeditor ( 'content' );
                            $oFCKeditor->BasePath = "/include/fckeditor/";
                            $oFCKeditor->Value = stripslashes($pro->content);
                            $oFCKeditor->Height = 350;
                            $oFCKeditor->Create ();
                    ?>
</td>
                </tr>
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="修改" /></td>
                </tr>
            </table></td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td>&nbsp;</td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>