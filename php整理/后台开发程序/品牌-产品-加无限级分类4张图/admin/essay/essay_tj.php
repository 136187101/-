<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
//读取添加类别
//type为0的是文章形式，1的是图文形式
$lei_id=$_GET[zid];
$lei=$hjd->get_one("select * from essay_zilei where id='$lei_id'");
if($_POST[Submit]=="添加"){
	$tuijian =!empty($_POST['tuijian'])?$_POST['tuijian']:'0';
	$content=$_POST['content'];//内容转译		
	//判断改类别形式
	if($lei[type]=="1"){//图片形式			
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


			
/*传4张焦点图*/	
	$file_tu2=$_POST["file2"];
	$file_tu3=$_POST["file3"];
	$file_tu4=$_POST["file4"];
	if($_FILES["file2"]["name"]==""){
		$file_tu2="";
	}else{
		$file_tu2=$hjd->upload("file2","/pic/",array(".gif",".jpg",".jpeg",".png"),"500000");
	}
	if($_FILES["file3"]["name"]==""){
		$file_tu3="";
	}else{
		$file_tu3=$hjd->upload("file3","/pic/",array(".gif",".jpg",".jpeg",".png"),"500000");
	}
	if($_FILES["file4"]["name"]==""){
		$file_tu4="";
	}else{
		$file_tu4=$hjd->upload("file4","/pic/",array(".gif",".jpg",".jpeg",".png"),"500000");	
	}
/*传4张焦点图END*/
			
			
	  	 	$query="INSERT INTO `essay` (`ziid` ,`title`,`image` ,`image_rot`,`content` ,`px` ,`times` ,`cisu` ,`tuijian`,`keywords`,`description`, `nr_jd_no2`, `nr_jd_no3`, `nr_jd_no4`)VALUES ('$_POST[zileiid]', '$_POST[title]', '$file1', '$gd', '$content', '$px', '$date', '0', '0','$_POST[keywords]','$_POST[description]','$file_tu2','$file_tu3','$file_tu4');";
	
	}
	else//文章形式
	{
			$query="INSERT INTO `essay` (`ziid` ,`title`,`image` ,`image_rot`,`content` ,`px` ,`times` ,`cisu` ,`tuijian`,`keywords`,`description`, `nr_jd_no2`, `nr_jd_no3`, `nr_jd_no4`)VALUES ('$_POST[zileiid]', '$_POST[title]', '', '', '$content', '$px', '$date', '0', '0','$_POST[keywords]','$_POST[description]','$file_tu2','$file_tu3','$file_tu4');";	
	}
	if($db->query($query)){
			$js->Alert("添加成功");
			$js->Gotoxx("essay_gl.php?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan");
	}
	else
	{
			$js->Alert("添加失败");	
	}
}


		$sql = "select * from essay_zilei where id = $_GET[zid]";
		$row_yi = $db->getOne($sql); 
		$row_zilei = $row_yi[zititle];
//查看是否为案例
$alid=$db->query("select * from essay_zilei where fuid = '13'");
while($rowsal=$wy->fetch_array($alid))
{
	$al_id.=$rowsal[id].",";	
}
$al_id=substr($al_id,0,-1);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>
<title>网站后台管理系统</title>
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
    </style>
</head>
<body>
<h1>
<span class="action-span"><a onclick="javascript:history.go(-1)" href="#"><?=$row_zilei?></a></span>
<span class="action-span1">信息管理</span><span id="search_id" class="action-span1"> -   添加<?=$row_zilei?> </span>
<div style="clear:both"></div>
</h1>
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <div class="maindi">
      <table width="100%" id="general-table">
                <tr>
                  <td width="20%" height="20" bgcolor="#FFFFFF" class="label" >标题：</td>
                  <td width="80%" height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="60"/></td>
                </tr>
<!--                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">Meta关键字：</td>
                  <td width="20" height="20" align="left" bgcolor="#FFFFFF"><textarea name="keywords" cols="50" id="Source"></textarea></td>
                </tr>
                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">Meta描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="description" cols="50" id="author"></textarea></td>
                </tr>
-->                <tr>
        <td height="20" class="label" bgcolor="#FFFFFF">类别：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
				<select name="zileiid" id="zileiid"> 
				 <?php
					$rs_lb=$db->query("SELECT * FROM essay_zilei order  by zileipx desc");//查询父ID等于0的值
					$rows_lb=$db->fetch_array($rs_lb);
					foreach ($rows_lb as $lb)
					{
					?>
                    	<option value="<?=$lb[id]?>" <?php if($lb[id]==$lei_id){echo 'selected';}?>><?=$lb[zititle]?></option>
                    <?php }?>
				</select>
  				</td>
                </tr>
               	<?php if($lei[type]=='1'){?>
                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">图片：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="file" type="file" id="file" style="height:18;" /></td>
                </tr>
                <?php }?>
                
                <?php
                if($lei_id=='14' || $lei_id=='15'  ){
				?>
<!--案例-->
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">内容焦点图二：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="file2" type="file" id="image" class="file"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">内容焦点图三：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="file3" type="file" id="image" class="file"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">内容焦点图四：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="file4" type="file" id="image" class="file"/></td>
                </tr>


<!--案例END-->         
		<?php }?>
                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">排序：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>



			<?php if($_GET[tid]=="3"){?>
			<?php }?>
			

		<tr>
		  <td class="label">状态：</td>
		  <td align="left";>
		    <!--    <input name="reshou" type="checkbox" id="reshou" value="1" />
        热销
        <input name="xinpin" type="checkbox" id="xinpin" value="1" />
        新品  -->
		    <input name="tuijian" type="checkbox" id="tuijian" value="1" />
		    推荐</td>
	    </tr>



                <tr>
                  <td height="20" class="label" bgcolor="#FFFFFF">内容：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
		<textarea name="content" style="width:90%;height:400px;visibility:hidden;"></textarea>
                  
                  </td>
                </tr>
				
        <tr>
          <td class="label">&nbsp;</td>
          <td><input name="Submit" type="submit"  class="button" id="Submit" value="添加"/>                    
                    &nbsp;&nbsp;
            <input name="Submit2" type="button" class="button" id="Submit2" value="返回" onclick="javascript:history.go(-1)"/></td>
        </tr>
      </table>
  </div>
</form>
</body>
</html>