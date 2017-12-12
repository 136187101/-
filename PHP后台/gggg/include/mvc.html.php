<?php
class ProductHtml{
	function htmlHeader(){
		global $_REQUEST;
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>产品管理</title>
	
	</head>
	<body>
	
	
	<div align="center"><font color="#FF0000"><?=urldecode($_REQUEST[msg])?></font></div>
<?php	
	}

	function addMarster( $rows ){
		self::htmlHeader();
?>
	<form id="form1" name="form1" method="post" action="admin.product.php">
	  <table width="50%" border="1" align="center">
    <tr>
      <th colspan="2">添加父类</th>
    </tr>
	
    <tr>
      <td width="61%" align="center">父类名称</td>
      <td width="39%" align="center">操作</td>
    </tr>
	<?php
	foreach($rows as $row){
	?>
    <tr>
      <td><?=$row->title?></td>
      <td align="center">
	  <a href="admin.product.php?act=edit&task=master&id=<?=$row->id?>"> 修改</a> | 
	  <a href="admin.product.php?act=del&task=master&id=<?=$row->id?>">删除</a> |　
	  <a href="admin.product.php?act=addson&parentId=<?=$row->id?>">管理子类</a>
	  </td>
    </tr>
	<?php
	}
	?>
    <tr>
      <td colspan="2"><label>
        <input name="title" type="text" id="title" />
        <input type="submit" name="Submit" value="提交" />
	    <input type="hidden" name="act" value="insertmaster" />
	  </td>
    </tr>
  </table>
</form>
<?	
		self::htmlFooter();
	}
	function addson( $masterParam , $rows ){
		self::htmlHeader();
?>	
	<form id="form1" name="form1" method="post" action="">
  <table width="50%" border="1" align="center">
    <tr>
      <th colspan="2"><?=$masterParam->title?></th>
    </tr>
    <tr>
      <td width="59%">类别名称</td>
      <td width="41%" align="center">操作</td>
    </tr>
	<?php
	foreach($rows as $row){
	?>
    <tr>
      <td><?=$row->title?></td>
      <td align="center">
	  <a href="admin.product.php?act=del&task=son&parentId=<?=$_REQUEST[parentId]?>&id=<?=$row->id?>">删除
	  </a> |<a href="admin.product.php?act=edit&task=son&parentId=<?=$_GET[parentId]?>&id=<?=$row->id?>"> 修改 </a>
	  </td>
    </tr>
	<?php
	}?>
    <tr>
      <td colspan="2"><label>
        <input name="title" type="text" id="title" />
		<input name="parentId" type="hidden" value="<?=$_GET[parentId]?>">
		<input name="act" type="hidden" value="insertson">
        <input type="submit" name="Submit2" value="提交" />
      </label></td>
    </tr>
  </table>
</form>
<?php	
		self::htmlFooter();
	}
	function edit( $row , $task ){
		global $_REQUEST;
		self::htmlHeader();
?>
	<form id="form1" name="form1" method="post" action="admin.product.php">
	  <table width="50%" border="1" align="center">
        <tr>
          <td align="center">修改标题</td>
        </tr>
        <tr>
          <td>
		  <input name="title" type="text"  value="<?=$row->title?>"/>
		  <input name="Submit" type="submit" value="确认">
		  <input name="act" type="hidden" value="editTypeContent">
		  <input name="id" type="hidden"  value="<?=$row->id?>"/>
		  <input name="task" type="hidden" value="<?=$task?>">
		   <input name="parentId" type="hidden" value="<?=$_REQUEST[parentId]?>">
		  </td>
        </tr>
      </table>
    </form>
<?php	
		self::htmlFooter();
	}
	function _default($rows,$page){
		self::htmlHeader();
?>
<table width="80%" border="1" align="center">
  <tr>
    <th colspan="6">所有 产品</th>
  </tr>
  <tr>
    <th>产品名称</th>
    <th>产品 价格</th>
    <th>产品父类</th>
    <th>产品子类  </th>
    <th>发布时间</th>
    <th>操作</th>
  </tr>
  <?php
  
  foreach($rows as $row){
  ?>
  <tr>
    <td><?=$row->productTitle?></td>
    <td><?=$row->price?></td>
    <td><?=$row->masterTitle?></td>
    <td><?=$row->sonTitle?></td>
    <td><?=date("Y-m-d h:i:s",$row->created)?></td>
    <td align="center"><a href="admin.product.php?act=del&task=product&id=<?=$row->id?>">删除</a>|<a href="admin.product.php?act=edit&task=product&id=<?=$row->id?>">修改</a></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td colspan="6" align="center"><?=$page?></td>
  </tr>
</table>
<?php	
		self::htmlFooter();
	}
	function addProduct( $rows ){
		self::htmlHeader();
?>
<form action="admin.product.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
	  <table width="50%" border="1" align="center">
        <tr>
          <td colspan="2" align="center">添加产品</td>
        </tr>
        <tr>
          <td>产品分类</td>
          <td><select name="sonId" id="sonId">
		  <?php
		  
		  foreach($rows as $row){
		  ?>
		  <option value="<?=$row->id?>"><?=$row->title?></option>
		  
		  <?php
		  }
		  ?>
          </select>          </td>
        </tr>
        <tr>
          <td width="17%">产品名称</td>
          <td width="83%"><label>
            <input name="productTitle" type="text" id="productTitle" />
          </label></td>
        </tr>
        <tr>
          <td>产品价格</td>
          <td><label>
            <input name="price" type="text" id="price" />
          </label></td>
        </tr>
        <tr>
          <td>产品图片</td>
          <td><label>
            <input name="image" type="file" id="image" />
          </label></td>
        </tr>
        <tr>
          <td>产品介绍</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <?php require 'edit/edit.php';?>
        <script language="javascript">
		document.write ('<iframe src="editor.php?action=textbox" id="message" width="600" height="350"></iframe>')
		frames.message.document.designMode = "On";
		</script> <input type="hidden" name="productInfo" />
          </label></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><label>
            <input type="submit" name="Submit3" value="提交" OnClick="document.form1.productInfo.value = frames.message.document.body.innerHTML;"/>
          </label>
            <label>
            <input type="reset" name="Submit4" value="重置" />
			<input type="hidden"  name="act" value="save"/>
            <input name="task" type="hidden" id="task" value="new" />
          </label></td>
        </tr>
      </table>
    </form>
<?php
		self::htmlFooter();
	}
	function editProduct( $marterData ,$row){
?>
<script language="javascript">
	function give(){
		frames.message.document.body.innerHTML = document.form1.productInfo.value;
	}
</script>
<body onload="give();">
	<form action="admin.product.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
	  <table width="50%" border="1" align="center">
        <tr>
          <td colspan="2" align="center">添加产品</td>
        </tr>
        <tr>
          <td>产品分类</td>
          <td><select name="sonId" id="sonId">
		 <?php
		 foreach($marterData as $rs){
		 	if($row->parentId == $rs->id){
		 ?>
			 <option value="<?php echo $rs->id?>" selected="selected"><?php echo $rs->title?></option>
		 <?php }else{?>
		 	 <option value="<?php echo $rs->id?>"><?php echo $rs->title?></option>
		  <?php
		  	}
		  }
		  ?>

          </select>          </td>
        </tr>
        <tr>
          <td width="17%">产品名称</td>
          <td width="83%"><label>
            <input name="productTitle" type="text" id="productTitle" value="<?=$row->productTitle?>" />
          </label></td>
        </tr>
        <tr>
          <td>产品价格</td>
          <td><label>
            <input name="price" type="text" id="price" value="<?=$row->price?>" />
          </label></td>
        </tr>
        <tr>
          <td>图片：</td>
          <td><img src="<?=$row->image?>" width="80" height="90" alt="" /></td>
        </tr>
        <tr>
          <td>产品图片</td>
          <td><label>
            <input name="image" type="file" id="image" />
          </label></td>
        </tr>
        <tr>
          <td>产品介绍</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <?php require 'edit/edit.php';?>
        <script language="javascript">
		document.write ('<iframe src="editor.php?action=textbox" id="message" width="600" height="350"></iframe>')
		frames.message.document.designMode = "On";
		</script> <input type="hidden" name="productInfo" value='<?=$row->productInfo?>' />
          </label></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><label>
            <input type="submit" name="Submit3" value="提交" OnClick="document.form1.productInfo.value = frames.message.document.body.innerHTML;"/>
          </label>
            <label>
            <input type="reset" name="Submit4" value="重置" />
			<input type="hidden"  name="act" value="save"/>
            <input name="task" type="hidden" id="task" value="edit" />
			<input name="id" type="hidden" id="id" value="<?php echo $row->id?>" />
          </label></td>
        </tr>
      </table>
    </form>
</body>
<?php	
		self::htmlFooter();
	}
	function htmlFooter(){
?>
	</body>
	</html>
<?php	
	}
}
?>