<?php require '../../include/init.php';?>
<?php require_once("../session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $web_sz["site_name"];?></title>
<link rel="stylesheet" type="text/css" href="../hjdxx/css/main.css"/>

</head>

<body>
<?php
if(isset($_POST['submit'])){
	//配置信息
    $sys['site_name'] = $_POST['site_name'];
	$sys['site_url'] = $_POST['site_url'];
	$sys['keywords'] = $_POST['keywords'];
	$sys['description'] =$_POST['description'];
	//$sys['telphoto'] = $_POST['telphoto'];
	$sys['bm_info'] = $_POST['bm_info'];
	//$sys['tel'] = $_POST['tel'];
	//$sys['chuanzhen'] = $_POST['chuanzhen'];
	$sys['email'] = $_POST['email'];
	//$sys['dizhi'] = $_POST['dizhi'];
	//$sys['luxian'] = $_POST['luxian'];
	//$sys['zstel'] = $_POST['zstel'];
	
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
			$js->Gotoxx('sys.php');
	}else{
		//msg('操作失败','sys.php',2);
			$js->Alert('操作失败');
			$js->Gotoxx('sys.php');
	}
}else{
	$sql ="SELECT * FROM `site_info` WHERE `id`=1";
	$info =$db->getOne($sql);
	}
?>
<h1>

<span class="action-span1">系统信息</span>
<div style="clear:both"></div>
</h1>
<form id="form1" name="form1" method="post" action="">
  <div style="  background: #F4FAFB;border: 1px solid #c1d6b5;margin-bottom: 10px;padding: 2px;">
    <table width="100%" id="general-table">
    <tr>
      <td width="169" class="label">网站名称:</td>
      <td width="1147" bgcolor="#FFFFFF"><label for="site_name"></label>
      <input name="site_name" type="text" class="input" id="site_name"  value="<?=$info[site_name]?>"/></td>
    </tr>
<!--   <tr>
      <td class="label">投诉邮箱:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <input name="email" type="text" class="input" id="site_url"  value="<?=$info[email]?>"/></td>
    </tr>   --> 
    <tr>
      <td class="label">网站地址:</td>
      <td bgcolor="#FFFFFF"><label for="site_url"></label>
      <input name="site_url" type="text" class="input" id="site_url"  value="<?=$info[site_url]?>"/></td>
    </tr>
    <tr>
      <td class="label">Meta关键字:</td>
      <td bgcolor="#FFFFFF"><label for="keywords"></label>
      <textarea name="keywords" id="keywords" cols="45" rows="5"><?=$info[keywords]?></textarea>
      (关键字用,号隔开)</td>
    </tr>
 	<tr>
      <td class="label">Meta描述:</td>
      <td bgcolor="#FFFFFF"><label for="description"></label>
      <textarea name="description" id="description" cols="45" rows="5"><?=$info[description]?></textarea></td>
    </tr>
<!--    <tr>
 	  <td  class="label">电话:</td>
 	  <td bgcolor="#FFFFFF"><label for="site_url8"></label>
 	    <input name="tel" type="text" class="input" id="site_url8"  value="<?=$info[tel]?>" size="40"/></td>
    </tr>
 	<tr>
 	  <td  class="label">传真:</td>
 	  <td bgcolor="#FFFFFF"><label for="zstel"></label>
      <input name="chuanzhen" type="text" class="input" id="site_url2"  value="<?=$info[chuanzhen]?>" size="40"/></td>
    </tr>
 	<tr>
 	  <td  class="label">招生热线:</td>
 	  <td bgcolor="#FFFFFF"><label for="site_url7"></label>
 	    <input name="zstel" type="text" class="input" id="site_url7"  value="<?=$info[zstel]?>" size="80"/>
 	    多个电话请用&quot;,&quot;号隔开</td>
    </tr>
    
 	<tr>
 	  <td  class="label">地址:</td>
 	  <td bgcolor="#FFFFFF"><label for="site_url4"></label>
 	    <textarea name="dizhi" cols="80" rows="3" class="input" id="site_url4"><?=$info[dizhi]?>
        </textarea></td>
    </tr>
     <tr>
       <td  class="label">乘车路线:</td>
       <td bgcolor="#FFFFFF"><label for="chuanzhen"></label>
         <textarea name="luxian" cols="80" rows="3" class="input" id="site_url3"><?=$info[luxian]?>
        </textarea></td>
     </tr>
-->     <tr>
	 <td class="label">底部信息:</td>
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
      <tr>
        <td class="label">&nbsp;</td>
        <td><input type="submit" value=" 确定 " name="submit" class="button" />
          <input type="reset" value=" 重置 " class="button" />
          <input type="hidden" name="act" value="insert" />
          <input type="hidden" name="id" value="" /></td>
      </tr>
    </table>
  </div>
</form>
</body>
</html>
