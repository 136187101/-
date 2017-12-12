<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
$query = "select * from essay where id=$id";
$object=$db->Query($query);
$pro = $db->fetch_object($object);
$image = $pro->image;
$image2 = $pro->image_rot;
//读取添加类别
//type为0的是文章形式，1的是图文形式
$lei_id=$_GET[zid];
$lei=$hjd->get_one("select * from essay_zilei where id='$lei_id'");
//删除图片
if($tupian == "dels"){
			@unlink("../..".$pro->image);
			@unlink("../../".$pro->image_rot);
			$query = "update essay set image_rot='',image='' where id =$id";
			$db->query($query);
			$js->alert("删除成功");
			$js->Gotoxx("?id=$id&zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=$PB_page&sou=$sou");
}

			
			
if($Submit=="修改"){
	
		/*传4张焦点图*/	
	$file_tu2=$_POST["file2"];
	$file_tu3=$_POST["file3"];
	$file_tu4=$_POST["file4"];
	if($_FILES["file2"]["name"]==""){
		$file_tu2=$pro->nr_jd_no2;
	}else{
		$file_tu2=$hjd->upload("file2","/pic/",array(".gif",".jpg",".jpeg",".png"),"900000");
	}
	if($_FILES["file3"]["name"]==""){
		$file_tu3=$pro->nr_jd_no3;
	}else{
		$file_tu3=$hjd->upload("file3","/pic/",array(".gif",".jpg",".jpeg",".png"),"900000");
	}
	if($_FILES["file4"]["name"]==""){
		$file_tu4=$pro->nr_jd_no4;
	}else{
		$file_tu4=$hjd->upload("file4","/pic/",array(".gif",".jpg",".jpeg",".png"),"900000");	
	}

	
	
	$tuijian =!empty($_POST['tuijian'])?$_POST['tuijian']:'0';
	$content=$_POST['content'];//内容转译		
	$shijian=date("Y-m-d H:i:s");
			//图片
			$file = $_POST["file"];
			if($_FILES["file"]["name"]==""){
			$file1="";
			}else{
			$file1=$hjd->upload("file","/pic/",array(".gif",".jpg",".jpeg",".png"),"500000");
				//表单输入框名，根路径 ,						可上传的格式。 数据库添加$file1即可
			//制作缩略图
			$gd=$hjd->file_group("../..{$file1}",$lei["gdwidth"],$lei["gdheight"]);		
			}
	if($file1!="")
		{
			@unlink("../..{$pro->image}");
			@unlink("../../{$pro->image_rot}");
			
			$query="UPDATE `essay` SET `ziid` = '$_POST[zileiid]',`title` = '$_POST[title]',
			`image` = '$file1',
			`image_rot` = '$gd',
			`content` = '$content',
			`px` = '$_POST[px]',
			`times` = '$shijian',
			`keywords`='$_POST[keywords]',
			`description`='$_POST[description]',
			`nr_jd_no2` = '$file_tu2',
			`nr_jd_no3` = '$file_tu3',
			`nr_jd_no4` = '$file_tu4',

			`tuijian` = '$tuijian' WHERE `essay`.`id` =$_GET[id];
			";
		}
		else
		{
			$query="UPDATE `essay` SET `ziid` = '$_POST[zileiid]',`title` = '$_POST[title]',
			`px` = '$_POST[px]',
			`times` = '$shijian',
			`content` = '$content',
			`keywords`='$_POST[keywords]',
			`description`='$_POST[description]',
			`nr_jd_no2` = '$file_tu2',
			`nr_jd_no3` = '$file_tu3',
			`nr_jd_no4` = '$file_tu4',
			`tuijian` = '$tuijian' WHERE `essay`.`id` =$_GET[id];
			";
		}
	$db->query($query);
	$js->alert("修改成功");
	$js->Gotoxx("essay_gl.php?zid=$_GET[zid]&tid=$_GET[tid]&gid=$_GET[gid]&yuyan=$_GET[yuyan]&PB_page=$_GET[PB_page]&sou=$sou");
}


		$sql = "select * from essay_zilei where id = $_GET[zid]";
		$Object=$db->query($sql);
		$row_yi = $db->fetch_Object($Object); 
		$row_zilei = $row_yi->zititle;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
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
    <style type="text/css">
    td.label{ width:15%;}
    td.label1 {width:15%;}
    </style>
</head>
<body>
<h1>
<span class="action-span"><a onclick="location.href='essay_gl.php?zid=<?=$zid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$PB_page?>&sou=<?=$sou?>'" href="#"><?=$row_zilei?>列表</a></span><span class="action-span1">信息管理</span><span id="search_id" class="action-span1">-<?=$row_zilei?></span>
<div style="clear:both"></div>
</h1>
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="maindi">
    <table width="100%" id="general-table">
                <tr>
                  <td width="11%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">标题：</span></td>
                  <td width="89%" height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" value="<?=$pro->title?>"/></td>
                </tr>

<!--                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">Meta关键字：</td>
                  <td width="20" height="20" align="left" bgcolor="#FFFFFF"><textarea name="keywords" cols="50" id="Source"><?php echo $pro->keywords?></textarea></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">Meta描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="description" cols="50" id="author"><?php echo $pro->description?></textarea></td>
                </tr>
-->                <tr>
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
				
				
				
				
				
				
				
				<?php if($lei[type]=='1'){?>
                <tr>
                  <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">图片：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><a href="?tupian=dels&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"></a>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="file" type="file" id="file" style="height:18;" /></td>
                        <td width="73%" align="left"><a href="?tupian=dels&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>">删除图片</a>
						<?php if($pro->image != ""){?>
                       
						<img src="../../<?=$pro->image_rot?>" style="margin-left:200px;"/>
						<?php }?>						</td>
                      </tr>
                    </table>                  </td>
                </tr>
				<?php }?>
              <?php
                if($lei_id=='14' || $lei_id=='15'  ){
				?>
<!--案例-->

                <tr>
                <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">内容焦点图片2：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                  <a href="?tupian=dels2&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"></a>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="file2" type="file" id="file2" class="file" /></td>
                        <td width="73%" align="left"><a href="?tupian=dels2&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>">删除图片</a>
						<?php if($pro->nr_jd_no2 != ""){?>
                       
						<img src="<?=$pro->nr_jd_no2?>" style="margin-left:200px;" width="128" height="70"/>
						<?php }?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">内容焦点图片3：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                  <a href="?tupian=dels3&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"></a>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="file3" type="file" id="file3" class="file" /></td>
                        <td width="73%" align="left"><a href="?tupian=dels3&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>">删除图片</a>
						<?php if($pro->nr_jd_no3 != ""){?>
                       
						<img src="<?=$pro->nr_jd_no3?>" style="margin-left:200px;" width="128" height="70"/>
						<?php }?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                <tr>
                  <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">内容焦点图片4：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                  <a href="?tupian=dels4&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"></a>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="file4" type="file" id="file4" class="file" /></td>
                        <td width="73%" align="left"><a href="?tupian=dels4&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>">删除图片</a>
						<?php if($pro->nr_jd_no4 != ""){?>
                       
						<img src="<?=$pro->nr_jd_no4?>" style="margin-left:200px;" width="128" height="70"/>
						<?php }?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
         <!--案例END-->         
		<?php }?>               
                
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$pro->px?>" size="5"/></td>
                </tr>

	<tr>
      <td align="right">状态：</td>
      <td height="25" align="left"><!--
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
        <td class="label1">&nbsp;</td>
        <td><input name="Submit" type="submit"  class="button" id="Submit" value="修改"/>                    
                    &nbsp;&nbsp;
          <input name="Submit2" type="button" class="button" id="Submit2" value="返回" onclick="location.href='essay_gl.php?zid=<?=$zid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$PB_page?>&sou=<?=$sou?>'";/></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
