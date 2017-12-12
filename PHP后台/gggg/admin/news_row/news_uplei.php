<?php 
require_once("../../include/global.php");
require_once("../session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return liwq();">
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                  <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[类别管理项目]-[编辑]</td>
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
          <td align="center">
<?php 
	if($act == "fulei"){
		$img = new Image("image","newspic");
		if($img->upload()){
			$image = $img->getImgPath();
		}		
		if($Submit=="添加"){
		$query = "INSERT INTO news_zilei(zititle,ziname,yzititle,fuid,zileipx,type,ziimage,times,gid) VALUES('$name','$ziname','$yzititle','$fuid','$zileipx','$type','$image','".time()."','$gid')";
		$db->setQuery($query);
		$db->query();
		$js->alert("添加成功");
		$js->Gotolwq("../liwqbj/left.php?zhan=2&fuid=$fuid&yuyan=$yuyan");
		}
?>		  
		  <table width="60%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
            <tr>
              <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">子类添加</td>
              </tr>
            <tr>
              <td width="41%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">名称：</span></td>
              <td width="59%" height="20" align="left" bgcolor="#FFFFFF"><input name="name" type="text" id="name"/></td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">标题：</td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input name="ziname" type="text" id="ziname"/></td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">英文标题：</td>
              <td height="20" align="left" bgcolor="#FFFFFF">
                <input name="yzititle" type="text" id="yzititle"/>
              </td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">图片：</td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input type="file" name="image" /></td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input name="zileipx" type="text" id="px" value="0" size="5"/></td>
            </tr>
			<?php 
			if($_SESSION["user_name"] != "liwqbj"){
			$display = "style='display:none'";
			}else{
			$display = "style='display:'";	
			}
			?>
            <tr <?=$display?>>
              <td height="20" align="right" bgcolor="#FFFFFF">方式：                </td>
              <td height="20" align="left" bgcolor="#FFFFFF">
			  <input name="gid" type="radio" value="1" />
                是
                  <input name="gid" type="radio" value="0" checked="checked" />
                  否&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">（是否有子类别）</font></td>
            </tr>
            <tr>
              <td height="30" colspan="2" align="center" bgcolor="#FFFFFF">
			  <textarea name="type" style="width:98%; height:100px;"></textarea>			  </td>
            </tr>
            <tr>
              <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input type="Submit" class="anniu" name="Submit" value="添加"/>
                &nbsp;&nbsp;
                <input name="fanhui" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
            </tr>
          </table>
<?php }
	if($act == "edit"){ 
	$sql = "select * from news_zilei where id = $id";
	$db->setQuery($sql);
	$row = $db->loadObject();
	$image1 = $row->ziimage;
	if($Submit2 == "修改"){
			if($_FILES[image1][name]){
				$img = new Image("image1","newspic");
				if($img->upload()){
					$image1 = $img->getImgPath();
					$root = $image1;
					@unlink($root);
				}else{
					echo $image1;
				}
			}
	 $sql = "update news_zilei set zititle='$name1',ziname='$ziname1',yzititle='$yzititle1',zileipx='$px1',ziimage='$image1',type='$type',times='".time()."',gid='$gidzi' where id = $id";
	 $db->setQuery($sql);
	 $db->query();
	 $js->Alert("修改成功");
	 $js->Gotolwq("../liwqbj/left.php?zhan=2&fuid=$fuid&yuyan=$yuyan");
	}
	?>
		  <table width="60%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
            <tr>
              <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">修改子类</td>
              </tr>
            <tr>
              <td width="41%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">名称：</span></td>
              <td width="59%" height="20" align="left" bgcolor="#FFFFFF"><input name="name1" type="text" id="name1" value="<?=$row->zititle?>"/></td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">标题：</td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input name="ziname1" type="text" id="ziname1" value="<?=$row->ziname?>"/></td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">英文标题：</td>
              <td height="20" align="left" bgcolor="#FFFFFF">
                <input name="yzititle1" type="text" id="yzititle1" value="<?=$row->yzititle?>"/>
              </td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">图片：</td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input name="image1" type="file" id="image1" />
                <input name="fanhui12" type="button" class="anniu" id="fanhui1" value="删除" onclick="javascript:location.href='?tupian=dels&id=<?=$id?>&fuid=<?=$fuid?>&yuyan=<?=$yuyan?>'"/></td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">&nbsp;</td>
              <td height="20" align="left" bgcolor="#FFFFFF">
			  <?php if($row->ziimage){?>
			  <img src="<?=$row->ziimage?>" width="100" height="80" />
			  <?php }else{?>
			  <img src="../images/zanwu.gif" width="100" height="80"/>
			  <?php }?>			  </td>
            </tr>
            <tr>
              <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input name="px1" type="text" id="px1" size="5" value="<?=$row->zileipx?>"/></td>
            </tr>
			<?php 
			if($_SESSION["user_name"] != "liwqbj"){
			$display = "style='display:none'";
			}else{
			$display = "style='display:'";	
			}
			?>
            <tr <?=$display?>>
              <td height="20" align="right" bgcolor="#FFFFFF">方式： </td>
              <td height="20" align="left" bgcolor="#FFFFFF">
			  
				<input name="gidzi" type="radio" value="1"<?php if($row->gid == 1){ echo "checked";}?>/>
				是
				<input type="radio" name="gidzi" value="0"<?php if($row->gid == 0){ echo "checked";}?>/> 
				否
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">（是否有子类别）</font></td>
            </tr>
            <tr>
              <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type" style="width:98%; height:100px;"><?=$row->type?></textarea></td>
            </tr>
            <tr>
              <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit2" type="Submit" class="anniu" value="修改"/>
                &nbsp;&nbsp;
                <input name="fanhui1" type="button" class="anniu" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
            </tr>
          </table>
<?php }
			if($tupian == "dels"){
			$query = "update news_zilei set ziimage='' where id =$id";
			$db->setQuery($query);
			$db->query();
			$root = ROOT.$row->ziimage;
			@unlink($root);
			$js->alert("删除成功");
			$js->Gotolwq("../liwqbj/left.php?zhan=2&fuid=$fuid&yuyan=$yuyan");
			}
?>
          </td>
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
