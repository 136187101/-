<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
$query = "select * from essay where id=$id";
$object=$db->Query($query);
$pro = $db->fetch_object($object);
$image = $pro->image;
$image2 = $pro->image_rot;


			if($tupian == "dels"){
			$query = "update essay set image_rot='',image='' where id =$id";
			$db->setQuery($query);
			$db->query();
			$root = ROOT.$pro->image_rot;
			@unlink($root);
			$js->alert("删除成功");
			$js->goto("?id=$id&zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=$PB_page&sou=$sou");
			}

			
			
if($Submit=="修改"){
//$content=stripslashes($_POST['content']);//内容转译
$content=$_POST['content'];
	if($_FILES['image']['name']){
		    $upload =new upload();

		    $upload->field ='image';  //检查文件上传类型是否 符合
		    $upload->file_save_path ='../../newspic/';  //文件路径
			if($upload->upload()){
				$images =new Image();
				$images->resource_path =$upload->save_url;  //文件判断处理后得到新的路径给图片的原路径
				$images->file_save_path ='../../newspic/';  
				$images->make_thumb(123,139);	//制作缩略图  图片 宽 高

			}else{
			//	msg($upload->get_upload_error(),'?act=add',3);
			  // $upload->get_upload_error();
			  $js->Alert($upload->get_upload_error());
			  echo '<script language=javascript> history.back();</script>';
			}
		$big_image =str_replace('../','',$upload->save_url);
		$image=str_replace('../../','',$images->thumb_save_path);
	    }else{
		
		
		}

		$shijian=date("Y-m-d H:i:s");
		if($big_image!="")
		{
			@unlink("../../{$pro->image}");
			@unlink("../../{$pro->image_rot}");
			$query="UPDATE `essay` SET `ziid` = '$_POST[zileiid]',`title` = '$_POST[title]',
			`name` = '$_POST[name]',
			`author` = '$_POST[author]',
			`image` = '$image',
			`image_rot` = '$big_image',
			`files_url` = '$_POST[files_url]',
			`zhicheng` = '$_POST[zhicheng]',
			`type1` = '$_POST[type1]',
			`type2` = '$_POST[type2]',
			`type3` = '$_POST[type3]',
			`type4` = '$_POST[type4]',
			`type5` = '$_POST[type5]',
			`content` = '$content',
			`px` = '$_POST[px]',
			`times` = '$shijian',
			`cisu` = '$_POST[cisu]',
			`keywords`='$_POST[keywords]',
			`description`='$_POST[description]',
			`tuijian` = '$_POST[tuijian]' WHERE `essay`.`id` =$_GET[id];
			";
		}
		else
		{
			$query="UPDATE `essay` SET `ziid` = '$_POST[zileiid]',`title` = '$_POST[title]',
			`name` = '$_POST[name]',
			`author` = '$_POST[author]',
			`files_url` = '$_POST[files_url]',
			`zhicheng` = '$_POST[zhicheng]',
			`type1` = '$_POST[type1]',
			`type2` = '$_POST[type2]',
			`type3` = '$_POST[type3]',
			`type4` = '$_POST[type4]',
			`type5` = '$_POST[type5]',
			`content` = '$content',
			`px` = '$_POST[px]',
			`times` = '$shijian',
			`cisu` = '$_POST[cisu]',
			`keywords`='$_POST[keywords]',
			`description`='$_POST[description]',
			`tuijian` = '$_POST[tuijian]' WHERE `essay`.`id` =$_GET[id];
			";
		}
	$db->query($query);
	$js->alert("修改成功");
	$js->Goto("essay_gl.php?zid=$_GET[zid]&tid=$_GET[tid]&gid=$_GET[gid]&yuyan=$_GET[yuyan]&PB_page=$_GET[PB_page]&sou=$sou");
}

		$sql = "select * from essay_zilei where id = $_GET[zid]";
		$Object=$db->query($sql);
		$row_yi = $db->fetch_Object($Object); 
		$row_zilei = "-[".$row_yi->zititle."]";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/skin.css" rel="stylesheet" type="text/css">
<title>无标题文档</title>
	<link rel="stylesheet" href="../hjd_Ub/themes/default/default.css" />
	<link rel="stylesheet" href="../hjd_Ub/plugins/code/prettify.css" />
	<script charset="utf-8" src="../hjd_Ub/kindeditor.js"></script>
	<script charset="utf-8" src="../hjd_Ub/lang/zh_CN.js"></script>
	<script charset="utf-8" src="../hjd_Ub/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '../hjd_Ub/plugins/code/prettify.css',
				uploadJson : '../hjd_Ub/php/upload_json.php',
				fileManagerJson : '../hjd_Ub/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=myform]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=myform]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>

</head>
<body>
  
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
<form action="" method="post" enctype="multipart/form-data" name="myform" id="myform" onsubmit="return checkSubmit();">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="Navitable">
          <tr>
            <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[信息管理]<?=$row_zilei?></td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">修改<?=$row_zilei?></span></td>
                </tr>
				
				
		
                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">标题：</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" value="<?=$pro->title?>"/></td>
                </tr>

                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">Meta关键字：</td>
                  <td width="20" height="20" align="left" bgcolor="#FFFFFF"><textarea name="keywords" cols="50" id="Source"><?php echo $pro->keywords?></textarea></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">Meta描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="description" cols="50" id="author"><?php echo $pro->description?></textarea></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">类别：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
				  
				  <select name="zileiid" id="zileiid">
		<?php
		$zlid=$pro->ziid;
		$sqlz_id=mysql_query("select * from essay_zilei where id='$_GET[zid]'");
		$rsz_id=mysql_fetch_array($sqlz_id);
		?>
          <option value="<?=$rsz_id["id"]?>" selected="selected"><?=$rsz_id["zititle"]?></option>
		  
		  
		   <?php
$query = "SELECT * FROM essay_zilei where fuid = 0 order by zileipx desc";
$arr=$db->getAll($query);
   if(!empty($arr)){
foreach($arr as $row){
$sql="select * from essay_zilei where fuid=$row[id]";		
$nem=$db->query($sql);	
$nums=$db->fetch_nums($nem);	
		 if($nums){?>
		 


  <?php news_list($row[id])?>


	<?php }else{?>
	<?php if($rsz_id["id"]==$row["id"]){ }else{?> 
<option value="<?=$row["id"]?>"><?=$row["zititle"]?></option>
		<?php } } } }?>
        </select>
		
 <?php
  function news_list($id){
  $sele="select * from essay_zilei where fuid=$id";
 	echo "<ul>"; 	
		  $ppt = mysql_query($sele);
		while($v = @mysql_fetch_array($ppt)){
		 $quer="select * from essay_zilei where fuid=$v[id]";
		 	$ne=mysql_query($quer);
			 $num=mysql_num_rows($ne);
		 if(!empty($num)){ 
		
			news_list($v[id]);			
		
		  }else{
		                  if($rsz_id["id"]==$v[id]){ }else{
		 echo "<option value=".$v[id].">".$v[zititle]."</option>";
		  }

		 } }		

  }
  
 
  ?>  
					<span class="STYLE7">*</span></td>
                </tr>
				
				
				
				
				
				
                <tr  style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">价格：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="jiage" type="text" id="jiage" value="<?=$pro->jiage?>" /></td>
                </tr>
				
				
				<tr  style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">库存：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="kucun" type="text" id="kucun" value="<?=$pro->kucun?>"/></td>
                </tr>
				
				
				

	
                <tr>
                  <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">图片：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><a href="?tupian=dels&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"></a>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="image" type="file" id="image" class="file" /></td>
                        <td width="73%" align="left"><a href="?tupian=dels&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>">删除图片</a>
						<?php if($pro->image != ""){?>
                       
						<img src="../../<?=$pro->image?>" style="margin-left:200px;"/>
						<?php }?>						</td>
                      </tr>
                    </table>                  </td>
                </tr>

				
			
				

                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">文件路径：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF" style="color:red;"><input name="files_url" type="text" id="files_url" value="<?=$pro->files_url?>" size="35"/> 
                    &nbsp;&nbsp;*&nbsp;如文件超出服务器限制大小请在这里直接填写路径</td>
                </tr>
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">文件：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF" style="color:#FF0000;"><input name="files_a" type="file" id="files_a" class="file"/>
                    *上传文件格式（.rar&nbsp;&nbsp;&nbsp;&nbsp; .txt&nbsp;&nbsp; &nbsp;.doc&nbsp;&nbsp; &nbsp;&nbsp;.pdf ）的类型</td>
                </tr>
	
				
				

				
				
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$pro->px?>" size="5"/></td>
                </tr>


	
	
<?php if($_GET[tid]=="3"){?>
                <tr>
				  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">简介：</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
				  <textarea name="type1" id="type1" style="width:60%; height:150px;"><?=stripslashes($pro->type1)?></textarea>	</td>
                </tr>
					<?php }?>	
				
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">应用范围：</td>
                  <td height="20" align="right" bgcolor="#FFFFFF">
				  <textarea name="type2" id="type2" style="width:100%; height:150px;"><?=stripslashes($pro->type2)?></textarea></td>
                </tr>
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">基本性能规格：</td>
                  <td height="20" align="right" bgcolor="#FFFFFF">
				  <textarea name="type3" id="content3" style="width:100%; height:150px;visibility:hidden;"><?=stripslashes($pro->type3)?></textarea></td>
                </tr>
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">技术性能规格：</td>
                  <td height="20" align="right" bgcolor="#FFFFFF">
				  <textarea name="type4" id="content4" style="width:100%; height:150px;visibility:hidden;"><?=stripslashes($pro->type4)?></textarea></td>
                </tr>
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">机身尺寸：</td>
                  <td height="20" align="right" bgcolor="#FFFFFF">
				  <textarea name="type5" id="content5" style="width:100%; height:150px;visibility:hidden;"><?=stripslashes($pro->type5)?></textarea></td>
                </tr>
	
	<tr>
      <td align="right">状态:</td>
      <td height="25" bgcolor="#E6F1F7" align="left"><!--
	  <input name="reshou" type="checkbox" id="reshou" value="1" <?php //if($pro->reshou){?>checked="checked" <?php //} ?>/>
        热销
        <input name="xinpin" type="checkbox" id="xinpin" value="1" <?php //if($pro->xinpin){?>checked="checked"<?php //} ?>/>
        新品   -->
        <input name="tuijian" type="checkbox" id="tuijian" value="1" <?php if($pro->tuijian){?>checked="checked"<?php } ?>/>
        推荐</td>
    </tr>
	
		
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">内容：</td>
				  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="content" style="width:90%;height:400px;visibility:hidden;"><?=stripslashes($pro->content)?></textarea>
				 </td>
				  <td>
			 </td>
                </tr>

				
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="修改"/>                    
                    &nbsp;&nbsp;
                    <input name="Submit2" type="button" class="anniu" id="Submit2" value="返回" onclick="location.href='essay_gl.php?zid=<?=$zid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$PB_page?>&sou=<?=$sou?>'";/></td>
                </tr>
            </table></td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
</form>  </table>

</body>
</html>
