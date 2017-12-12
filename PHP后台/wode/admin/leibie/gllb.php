<?php 
	require_once("../inc/anquan.php");
	require_once("../inc/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../houtai/css/css.css"/>
<title>无标题文档</title>
<style type="text/css">
.STYLE1 {	color: #e1e2e3;
	font-size: 12px;
}
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {	color: #344b50;
	font-size: 12px;
}
.STYLE21 {	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {	font-size: 12px;
	color: #295568;
}
.STYLE6 {color: #000000; font-size: 12; }
a{ color:#295568;}
</style>
<?php
	$mys=5;
	$sql="select count(xlb_id) from books_xlb";
	$rs_s=mysql_query($sql);
	$rows_s=mysql_fetch_array($rs_s);
	$zys= ceil($rows_s[0]/$mys);
	$dqy=$_GET["dqy"];
	if($dqy=="" || $dqy<1)
	{
		$dqy=1;	
	}
	if($dqy>$zys)
	{
		$dqy=$zys;	
	}
	$xsys=($dqy-1)*$mys;
	if($_POST["Submin"])
	{
		$paixu=$_POST["paixu"];
	}
?>
<script language="javascript">
	function yeshu(value){
		window.location.href='?dqy='+value;
	}
	function quanx(){
		nri=document.form1.checkbox11;
		nri2=document.form1.checkbox2;
		id="";
		if(nri.checked == true)
		{
			for(i=0;i<nri2.length;i++)
			{
				nri2[i].checked = true;
				id=","+nri2[i].value+id;
			}
		}
		else
		{
			for(i=0;i<nri2.length;i++)
			{
				nri2[i].checked = false;
			}	
		}
		id=id.substr(1,9999)
	}
	function danxuan()
	{
		dqysdz=document.form1.dqysdz.value;
		id="";
		nri2=document.form1.checkbox2;

		for(i=0;i<nri2.length;i++)
		{
			if(nri2[i].checked == true)
			{
				id=","+nri2[i].value+id;
			}	
		}
		id=id.substr(1,9999);	
		if(id=="")
		{
			alert("您没有选择");	
			return false;
		}
		else
		{
			if(confirm("确定要删除这些内容吗？"))
				{
					window.location.href='delete.php?id='+id+'&dqysdz='+dqysdz;
				}
			else
				{
					return false;	
				}
		}
	}
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" class="guanliyuan" bordercolor="#EBE9ED">
  <tr></tr>
  <tr>
    <td height="25" colspan="4" bgcolor="#353C44">&nbsp;&nbsp;<img src="../houtai/images/tb.gif" width="14" height="14" style="position:relative; top:2px;" />&nbsp;&nbsp;<span style="color:#e1e2e3">书籍类别信息列表</span></td>
  </tr>
  <tr>
    <td height="25" colspan="3"><a href="add_dl.php">&nbsp;&nbsp;添加根栏目</a></td>
    <td align="right">排序：
      <input name="paixu" type="radio" id="radio" value="asc"  />
      升序
      <input name="paixu" type="radio" id="radio2" value="desc" />
      降序
      <input name="Submin" type="submit" class="anniu" id="Submin" value="排序" />
      当前为：<?php
      	if($paixu==desc)
		{
			echo "降序";
		}
		else
		{
			echo "升序";
		}
	  
	  ?>
      
      </td>
  </tr>
  <tr>
    <td width="5%" align="center" bgcolor="#eeeeee">ID</td>
    <td width="64%" align="center" bgcolor="#eeeeee">栏目名称</td>
    <td width="4%" align="center" bgcolor="#eeeeee">排序</td>
    <td width="27%" height="25" align="center" bgcolor="#eeeeee">操作</td>
  </tr>
 <?php
 $sql="select * from boods_dl order by dl_px $paixu limit $xsys,$mys"; 
 $rs=mysql_query($sql);
 while($rows=mysql_fetch_array($rs))
 {
 ?> 
  <tr>
    <th align="center"><?php echo $rows["dl_id"]?></th>
    <th align="left">&nbsp;&nbsp;&nbsp;<img src="../houtai/images/add.gif" width="10" height="10" />&nbsp;<?php echo $rows["dl_name"]?></th>
    <th align="center"><?php echo $rows["dl_px"]?></th>
    <th height="25" align="center"><a href="addlb.php?dl=<?php echo $rows["dl_id"]?>">添加子栏目&nbsp;</a>| <a href="dlgl/updl.php?id=<?php echo $rows["dl_id"]?>">修改 </a>| <a onclick="if(confirm('确定要删除该类别吗？')){window.location.href='dlgl/delete.php?id=<?php echo $rows[dl_id]?>&dqysdz=<?php echo $dqy?>'}" style=" cursor:pointer">删除</a></th>
  </tr>    
 <!--二级开始-->
  <?php
 $sql_x="select * from books_xlb where xlb_dydl=$rows[dl_id] order by xlb_px $paixu ";
 $rs_x=mysql_query($sql_x);
 while($rows_x=mysql_fetch_array($rs_x))
 {
 ?>   
  <tr>
    <td align="center"><?php echo $rows_x["xlb_id"]?></td>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rows_x["xlb_name"]?></td>
    <td align="center"><?php echo $rows_x["xlb_px"]?></td>
    <td height="25" align="center">
    <a href="upxlb.php?id=<?php echo $rows_x["xlb_id"]?>&dydl=<?php echo $rows_x["xlb_dydl"]?>">修改&nbsp;</a>|&nbsp;
    <a onclick="if(confirm('确定要删除该类别吗？')){window.location.href='delete.php?id=<?php echo $rows_x['xlb_id']?>&dqysdz=<?php echo $dqy?>'}" style=" cursor:pointer">删除</a></td>
  </tr>
   <?
 }
 ?> 
 <!--二级结束-->
 <?
 }
 ?> 
  </table>
</form>
</body>
</html>

