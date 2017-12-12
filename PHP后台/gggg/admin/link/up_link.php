<?php 
require_once("../../include/global.php");
require_once("../session.php");
if($act == "edit"){
$sql = $query = "select * from link where id = $id";
$db->setQuery($sql);
$rows = $db->loadObject();
$image = $rows->image;
}
if($Submit == "修改"){
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
$query = "update link set title='$title',fid='$fids',image='$image',px='$px',http='$http',times='".time()."' where id=$id";
			$db->setQuery($query);
			if($db->query()){
			$js->Goto("gl_link.php?PB_page=$PB_page&fids=$fids");
			}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
</head>
<body>
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
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
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[友情链接管理]-[链接管理]-[编辑]</td>
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
            <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">修改友情链接</td>
                </tr>
                <tr style="display:none">
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">图片：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><input name="image" type="file" id="image" style="height:18;" />
                  <span class="STYLE5">*图片的大小是 120 X 50 </span></td>
                </tr>
                <tr style="display:none">
                  <td height="20" colspan="2" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?=$rows->image?>" width="230" height="80" /></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">分类： &nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
				  <select name="fids" id="fids">
                    <option value="1" <?php if($rows->fid == 1){ echo "selected";}?>>友情链接</option>
                  </select>
				  </td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">名称：&nbsp;&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="50" value="<?=$rows->title?>"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">连接：&nbsp;&nbsp;</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="http" type="text" id="http" size="50" value="<?=$rows->http?>"/></td>
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

