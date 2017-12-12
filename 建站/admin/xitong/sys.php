<?php require '../../include/init.php';?>
<?php require_once("../session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php
if(isset($_POST['submit'])){
	//配置信息
    $sys['site_name'] = $_POST['site_name'];
	$sys['site_url'] = $_POST['site_url'];
	$sys['keywords'] = $_POST['keywords'];
	$sys['description'] =$_POST['description'];
	$sys['telphoto'] = $_POST['telphoto'];
	//$sys['image_width'] = $_POST['thumb_width'];
	//$sys['image_height'] = $_POST['thumb_height'];
	$sys['bm_info'] = $_POST['bm_info'];
/*	$sys['tel'] = $_POST['tel'];
	$sys['chuanzhen'] = $_POST['chuanzhen'];
	$sys['email'] = $_POST['email'];
	$sys['dizhi'] = $_POST['dizhi'];
*/
	$sql ="SELECT * FROM `site_info`";
	$info =$db->getAll($sql);
	if(!empty($info)){
	    $status = $db->update($sys,"site_info",'id=1');
	}else{
	    $status = $db->insert($sys,"site_info");
	}
	if($status){
	   // msg('操作成功!','sys.php',2);
			$js->Alert('操作成功!');
			$js->Goto('sys.php');
	}else{
		//msg('操作失败','sys.php',2);
			$js->Alert('操作失败');
			$js->Goto('sys.php');
	}
}else{
	$sql ="SELECT * FROM `site_info` WHERE `id`=1";
	$info =$db->getOne($sql);
	}
?>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="Navitable">
  <tr>
    <td width="12" height="30">&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
            <td width="95%"><span class="STYLE3">你当前的位置</span>：[系统信息]</td>
          </tr>
        </table></td>
        <td width="54%">&nbsp;</td>
      </tr>
    </table></td>
    <td width="16">&nbsp;</td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="99%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#F5FBFE">
    <tr>
      <td width="169" align="right">网站名称:</td>
      <td width="1147" bgcolor="#FFFFFF"><label for="site_name"></label>
      <input name="site_name" type="text" class="input" id="site_name"  value="<?=$info[site_name]?>"/></td>
    </tr>
<!--   <tr>
      <td align="right">电话:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <input name="tel" type="text" class="input" id="site_url"  value="<?=$info[tel]?>"/></td>
    </tr>
--><!--     <tr>
      <td align="right">传真:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <input name="chuanzhen" type="text" class="input" id="site_url"  value="<?=$info[chuanzhen]?>"/></td>
    </tr>
     -->    
<!--    <tr>
      <td align="right">邮箱:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <input name="email" type="text" class="input" id="site_url"  value="<?=$info[email]?>"/></td>
    </tr>    
-->
    <tr>
      <td align="right">网站地址:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <input name="site_url" type="text" class="input" id="site_url"  value="<?=$info[site_url]?>"/></td>
    </tr>    
    
    
    
    <tr>
      <td align="right">Meta关键字:</td>
      <td bgcolor="#FFFFFF"><label for="keywords"></label>
      <textarea name="keywords" id="keywords" cols="45" rows="5"><?=$info[keywords]?></textarea>
      (关键字用,号隔开)</td>
    </tr>
 	<tr>
      <td align="right">Meta描述:</td>
      <td bgcolor="#FFFFFF"><label for="description"></label>
      <textarea name="description" id="description" cols="45" rows="5"><?=$info[description]?></textarea></td>
    </tr>
<!-- <tr>
      <td align="right">地址:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <textarea name="dizhi" cols="45" rows="3" class="input" id="site_url"><?=$info[dizhi]?>
        </textarea></td>
    </tr> -->     <!--  <tr>
      <td>图片缩略图设置:</td>
      <td><label for="thumb_width"></label>
      宽:
        <input name="thumb_width" type="text" id="thumb_width" size="10"  value="<?=$info[image_width]?>"/>
        高:
        <label for="thumb_height"></label>
        <input name="thumb_height" type="text" id="thumb_height" size="10"  value="<?=$info[image_height]?>"/>
        (单位:px)</td>
    </tr> -->
    <tr>
      <td align="right">底部信息:</td>
      <td bgcolor="#FFFFFF"><label for="bm_info"></label>
      <textarea name="bm_info" id="bm_info" cols="45" rows="5" style="width:900px; height:180px"><?=$info[bm_info]?></textarea>
   <script charset="utf-8" src="../../include/editor/kindeditor.js"></script>
   <script>
        KE.show({
                id : 'bm_info'
        });
   </script></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FFFFFF">　　　　　　　　
        <input type="submit" name="submit" id="submit" value="提交" />　　
        <input type="reset" name="button2" id="button2" value="重置" /></td>
    </tr>
  </table>
</form>
</body>
</html>
