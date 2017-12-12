<?php
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
$lei_id=$_GET[zid];
if($_POST[Submit]=="添加"){	
	if(!empty($_FILES['image']['name'])){
		    $upload =new upload();
		    $upload->field ='image';  //检查文件上传类型是否 符合
		    $upload->file_save_path ='../../newspic/';  //文件路径
			if($upload->upload()){
				$images =new Image();
				$images->resource_path =$upload->save_url;  //文件判断处理后得到新的路径给图片的原路径
				$images->file_save_path ='../../newspic/';  
				$images->make_thumb(153,161);	//制作缩略图  图片 宽 高
			}else{
			//	msg($upload->get_upload_error(),'?act=add',3);
			  // $upload->get_upload_error();
			  $js->Alert($upload->get_upload_error());
			  echo '<script language=javascript> history.back(-1);</script>';
			}
	    }
		$big_image =str_replace('../','',$upload->save_url);
		$image=str_replace('','',$images->thumb_save_path);
        $xinpin =!empty($_POST['hot'])?$_POST['hot']:'0';
		$reshou =!empty($_POST['new'])?$_POST['new']:'0';
		$tuijian =!empty($_POST['tuijian'])?$_POST['tuijian']:'0';
		$shijian=date("Y-m-d H:i:s");
	$content=$_POST['content'];//内容转译
   $query="INSERT INTO `essay` (`ziid` ,`title` ,`name` ,`author` ,`image` ,`image_rot` ,`files_url` ,`zhicheng` ,`type1` ,`type2` ,`type3` ,
`type4` ,`type5` ,`content` ,`px` ,`times` ,`cisu` ,`tuijian`,`keywords`,`description`)VALUES ('$_POST[zileiid]', '$_POST[title]', '$_POST[name]', '$_POST[author]', '$image', '$big_image', '$_POST[files_url]', '$_POST[jiage]', '$_POST[type1]', '$_POST[type2]', '$_POST[type3]', '$_POST[type4]', '$_POST[type5]', '$content', '$px', '$shijian', '0', '0','$_POST[keywords]','$_POST[description]');
";

//exit;
		if($db->query($query)){
			$js->Alert("添加成功");
			$js->Goto("essay_gl.php?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan");
		}
		else
		{
			$js->Alert("添加失败");	
			
		}
}


		$sql = "select * from essay_zilei where id = $_GET[zid]";
		$row_yi = $db->getOne($sql); 
		$row_zilei = "-[".$row_yi[zititle]."]";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/skin.css" rel="stylesheet" type="text/css">
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

</head>
<body>
  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <form action="" method="post" enctype="multipart/form-data" name="myform" id="myform">
  <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="Navitable">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="3%" height="26"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="97%"><span class="STYLE3">你当前的位置</span>：[信息管理]                          <?=$row_zilei?></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" >
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">添加
                  <?=$row_zilei?></span></td>
                </tr>
				
				
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF" >标题：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="title" type="text" id="title" size="60"/></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">Meta关键字：</td>
                  <td width="20" height="20" align="left" bgcolor="#FFFFFF"><textarea name="keywords" cols="50" id="Source"></textarea></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">Meta描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="description" cols="50" id="author"></textarea></td>
                </tr>
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">类别：</td>
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
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">图片：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="image" type="file" id="image" class="file"/></td>
                </tr>
			
					
		
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">文件路径：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="files_url" type="text" id="files_url" value="<?=$files_url?>" size="35"/></td>
                </tr>
                <tr style="display:none">
                  <td height="20" align="right" bgcolor="#FFFFFF">文件：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="files_a" type="file" id="files_a" class="file"/></td>
                </tr>
				
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">排序：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>



			<?php if($_GET[tid]=="3"){?>
                <tr>
                  <td width="100" height="20" align="left" bgcolor="#FFFFFF">简介：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="type1" id="type1" style="width:60%; height:150px;"></textarea>	</td>
                </tr>
			<?php }?>	
				
                <tr style="display:none">
                  <td width="100" height="20" align="left" bgcolor="#FFFFFF">应用范围：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="type2" id="type2" style="width:100%; height:150px;"></textarea></td>
                </tr style="display:none">
                <tr style="display:none">
                  <td width="100" height="20" align="left" bgcolor="#FFFFFF">基本性能规格：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="type3" id="content3" style="width:100%; height:150px;visibility:hidden;"></textarea></td>
                </tr>
                <tr style="display:none">
                  <td width="100" height="20" align="left" bgcolor="#FFFFFF">技术性能规格：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="type4" id="content4" style="width:100%; height:150px;visibility:hidden;"></textarea></td>
                </tr>
                <tr style="display:none">
                  <td width="100" height="20" align="left" bgcolor="#FFFFFF">机身尺寸：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="type5" id="content5" style="width:100%; height:150px;visibility:hidden;"></textarea></td>
                </tr>
			

		<tr>
      <td align="right"  >状态:</td>
      <td bgcolor="#E6F1F7" align="left";>
	<!--    <input name="reshou" type="checkbox" id="reshou" value="1" />
        热销
        <input name="xinpin" type="checkbox" id="xinpin" value="1" />
        新品  -->
        <input name="tuijian" type="checkbox" id="tuijian" value="1" />
        推荐</td>
    </tr>



                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">内容：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
		<textarea name="content" style="width:90%;height:400px;visibility:hidden;"></textarea>
                  
                  </td>
                </tr>
				

				

				<tr>
<td width="100">   </td>
    </tr>

				
				
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="添加"/>                    
                    &nbsp;&nbsp;
                    <input name="Submit2" type="button" class="anniu" id="Submit2" value="返回" onclick="";/></td>
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
    </tr></form>
  </table>

</body>
</html>