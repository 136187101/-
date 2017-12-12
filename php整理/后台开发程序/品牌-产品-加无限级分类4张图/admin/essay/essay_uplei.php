<?php   
@header('Content-type: text/html;charset=utf-8');
require_once("../../include/init.php");
require_once("../session.php"); 
if($_GET[act]=='fulei'){$title="添加类别";}else{$title="修改类别";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
.type{ display:none;}
</style>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
<link rel="stylesheet" type="text/css" href="../../ubb/themes/default/default.css"/>
		<script charset="utf-8" src="../../ubb/kindeditor-min.js"></script>
		<script>

			// 自定义插件 #2

			function getParam(url, name) {
				return url.match(new RegExp('[?&]' + name + '=([^?&]+)', 'i')) ? unescape(RegExp.$1) : '';
			}
			KindEditor.ready(function(K) {
				var tabTitleList = [''];
				var optionMap = {
					'content0' : {
						cssPath : '../plugins/code/prettify.css',
						allowFileManager : true
					},
					'content1' : {
						cssPath : '../plugins/code/prettify.css',
						resizeType : 1,
						allowPreviewEmoticons : false,
						allowImageUpload : false,
						items : [
							'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
							'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
							'insertunorderedlist', '|', 'emoticons', 'image', 'link']
					},

				};
				var editor = null;
				var tabs = K.tabs({
					src : K('#tabs'),
					cls : 'ke-tabs-example',
					afterSelect : function(i) {
						if (editor) {
							editor.remove();
							editor = null;
						}
						if (i == 2) {
							return;
						}
						editor = K.create('#tab' + i + ' textarea[name=content]', optionMap['content' + i]);
					}
				});
				K.each(tabTitleList, function(i, title) {
					tabs.add({
						title : title,
						panel : K('#tab' + i)
					});
				})
				var index = parseInt(getParam(location.href, 'tab') || 0, 10);
				tabs.select(index);
			});
		</script>
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript">
        	$(document).ready(function(e) {
                $(".danxuan").click(function(){
						if($(this).val()=="1")
						{
							$(".type").css("display","block")	
						}
						else
						{
							$(".type").css("display","none")	
						}
					})
            });
        </script>
        
</head>
<body>
<h1>
<span class="action-span"><a onclick='javascript:history.go(-1)' href="#">类别列表</a></span>
<span class="action-span1">类别管理</span><span id="search_id" class="action-span1"> - <?php echo $title?> </span>
<div style="clear:both"></div>
</h1>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return liwq();">
  <?php 
	if($_GET[act] == "fulei"){
		
	if(!empty($_FILES['image']['name'])){
		    $upload =new upload();

		    $upload->field ='image';  //检查文件上传类型是否 符合

		    $upload->file_save_path ='../../newspic/';  //文件路径
			
			if($upload->upload()){
				$images =new Image();
				$images->resource_path =$upload->save_url;  //文件判断处理后得到新的路径给图片的原路径
				$images->file_save_path ='../../newspic/';  
				$images->make_thumb(120,160);	//制作缩略图  图片 宽 高

			}else{
			//	msg($upload->get_upload_error(),'?act=add',3);
			  // $upload->get_upload_error();
			  $js->Alert($upload->get_upload_error());
			  echo '<script language=javascript> history.back();</script>';
			}
		
	    }
		$image=str_replace('','',$images->thumb_save_path);


		if($Submit=="添加"){	
		
		$query = "INSERT INTO essay_zilei(zititle,ziname,fuid,zileipx,type,ziimage,times,gdwidth,gdheight) VALUES('$_POST[name]','$_POST[ziname]','$_GET[fuid]','$_POST[zileipx]','$_POST[type]','$image','".time()."','$_POST[gdwidth]','$_POST[gdheight]')";


		$db->query($query);
		$js->alert("添加成功");
		//$js->Gotoxxlwq("/admin/liwqbj/left.php?zhan=2&fuid=$fuid&yuyan=$yuyan");
		$js->Gotoxx("essay_lei.php?fuid=$_GET[fuid]&id=$_GET[fuid]");
		}
?>
<div class="main-div">
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
    <tr>
      <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">子类添加</td>
    </tr>
    <tr>
      <td width="9%" height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">名称：</span></td>
      <td width="91%" height="20" align="left" valign="top" bgcolor="#FFFFFF"><input name="name" type="text" id="name"/></td>
    </tr>
    <!-- <tr>
              <td height="20" class="label" bgcolor="#FFFFFF">标题：</td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input name="ziname" type="text" id="ziname"/></td>
            </tr> 
            <tr>
              <td height="20" class="label" bgcolor="#FFFFFF">图片：</td>
              <td height="20" align="left" bgcolor="#FFFFFF"><input type="file" name="image" /></td>
            </tr>-->
    <tr>
      <td height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF"><input name="zileipx" type="text" id="px" value="0" size="5"/></td>
    </tr>
    <?php 
			if($_SESSION["user_name"] != "liwqbj"){
			$display = "style='display:none'";
			}else{
			$display = "style='display:'";	
			}
			?>
    <tr>
      <td height="20" class="label" bgcolor="#FFFFFF">方式： </td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF">文章
        <input name="type" type="radio" value="0" checked="checked" class="danxuan"/>
        图文
        <input name="type" type="radio" value="1"  class="danxuan"/></td>
    </tr>
    <tr class="type">
      <td height="20" class="label" bgcolor="#FFFFFF">缩略图： </td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF">宽：
        <input name="gdwidth" type="text" id="gdwidth" size="3" />
        像素，高：
        <input name="gdheight" type="text" id="gdheight" size="3" />
        像素</td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><!--<textarea name="type" style="width:98%; height:100px;"></textarea>	
              <div id="tab0" style="display:none;">
      			<textarea name="content" style="width:962px;height:400px;visibility:hidden;">
				</textarea>
      		</div>--></td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" class="button" name="Submit"  value="添加"/>
        &nbsp;&nbsp;
        <input name="fanhui" type="button" class="button" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
    </tr>
  </table>
 </div>
  <?php }
	if($_GET[act] == "edit"){ 
	$sql = "select * from essay_zilei where id = '$_GET[id]'";
	$row = $db->getOne($sql);
	$image1 = $row[ziimage];
	if($Submit2 == "修改"){
	
	
			 if(!empty($_FILES['image1']['name'])){
		    $upload =new upload();

		    $upload->field ='image1';  //检查文件上传类型是否 符合

		    $upload->file_save_path ='../../newspic/';  //文件路径
			
			if($upload->upload()){
				$image =new Image();
				$image->resource_path =$upload->save_url;  //文件判断处理后得到新的路径给图片的原路径
				$image->file_save_path ='../../newspic/';  
				$image->make_thumb(123,139);	//制作缩略图  图片 宽 高
			    
			}else{
			//	msg($upload->get_upload_error(),'?act=add',3);
			  // $upload->get_upload_error();
			  $js->Alert($upload->get_upload_error());
			  echo '<script language=javascript> history.back();</script>';
			}
		
	    }
		//$big_image =str_replace('../','',$upload->save_url);
		$image1=str_replace('','',$image->thumb_save_path);
	
	
	 $image1;
		if($image1!="")	
		{
		 $sql = "update essay_zilei set zititle='$name1',ziname='$_POST[ziname1]',zileipx='$_POST[px1]',ziimage='$image1',type='$_POST[type]',times='".time()."',gdwidth='$_POST[gdwidth]',gdheight='$_POST[gdheight]' where id = $_GET[id]";

		}
		else if($image1=="")
		{
		 $sql = "update essay_zilei set zititle='$name1',ziname='$_POST[ziname1]',zileipx='$_POST[px1]',type='$_POST[type]',times='".time()."',gdwidth='$_POST[gdwidth]',gdheight='$_POST[gdheight]' where id = $_GET[id]";

		}		
		 $db->query($sql);
		 $js->Alert("修改成功");
		 $js->Gotoxx("essay_lei.php?id=$_GET[fuid]&fuid=$_GET[fuid]");
	}
	?>
    <div class="main-div">
  <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" >
    <tr>
      <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">修改子类</td>
    </tr>
    <tr>
      <td width="9%" height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">名称：</span></td>
      <td width="91%" height="20" align="left" valign="top" bgcolor="#FFFFFF"><input name="name1" type="text" id="name1" value="<?=$row[zititle]?>"/></td>
    </tr>
    <tr style="display:none;">
      <td height="20" class="label" bgcolor="#FFFFFF">图片：</td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF"><input name="image1" type="file" id="image1" />
        <input name="fanhui12" type="button" class="anniu" id="fanhui1" value="删除" onclick="javascript:location.href='?tupian=dels&amp;id=<?=$id?>&amp;fuid=<?=$fuid?>'"/></td>
    </tr>
    <!-- <tr>
              <td height="20" align="right" bgcolor="#FFFFFF">&nbsp;</td>
              <td height="20" align="left" bgcolor="#FFFFFF">
			  <?php //if($row[ziimage]){?>
			  <img src="<?php //$row[ziimage]?>" width="100" height="80" />
			  <?php //}?>			  </td>
            </tr> -->
    <tr>
      <td height="20" class="label" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF"><input name="px1" type="text" id="px1" size="5" value="<?=$row[zileipx]?>"/></td>
    </tr>
    <?php 
			if($_SESSION["user_name"] != "liwqbj"){
			$display = "style='display:none'";
			}else{
			$display = "style='display:'";	
			}
			?>
    <tr>
      <td height="20" class="label" bgcolor="#FFFFFF">方式： </td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF"> 文章
        <input name="type" type="radio" value="0" class="danxuan" <?php if($row["type"]==0){echo "checked";}?> />
        图文
        <input name="type" type="radio" value="1" class="danxuan" <?php if($row["type"]==1){echo "checked";}?> /></td>
    </tr>
    <tr class="type" <?php if($row["type"]==1){echo " style=\"display:block\"";}?>>
      <td height="20" class="label" bgcolor="#FFFFFF">缩略图： </td>
      <td height="20" align="left" valign="top" bgcolor="#FFFFFF">宽：
        <input name="gdwidth" type="text" id="textfield3" size="3" value="<?php echo $row["gdwidth"]?>" />
        像素，高：
        <input name="gdheight" type="text" id="textfield4" size="3" value="<?php echo $row["gdheight"]?>"/>
        像素</td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="" bgcolor="#FFFFFF"><!-- <div id="tab0" style="display:none;">
              <textarea name="content" style="width:962px;height:400px;visibility:hidden;">
              	
				</textarea>
            </div>
            --></td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit2" type="submit" class="button" value="修改"/>
        &nbsp;&nbsp;
        <input name="fanhui1" type="button" class="button" id="Submit2" value="返回" onclick='javascript:history.go(-1)';/></td>
    </tr>
  </table>
  </div>
  <?php }
			if($tupian == "dels"){
			$query = "update essay_zilei set ziimage='' where id =$_GET[id]";
			$db->query($query);
			
			$root = ROOT.$row[ziimage];
			@unlink($root);
			$js->alert("删除成功");
			//$js->Gotoxxlwq("/admin/liwqbj/left.php?zhan=2&fuid=$fuid&yuyan=$yuyan");
			$js->Gotoxx("essay_uplei.php?act=edit&id=$_GET[id]fuid=$fuid");
			}
?>
</form>
</body>
</html>
