<?php 
	require_once("../../inc/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
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
	$mys=10;
	$sql="select count(admin_id) from admin_users";
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
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24" bgcolor="#353c44"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="4%" height="19" valign="bottom"><div align="center"><img src="../images/tb.gif" width="14" height="14" /></div></td>
                  <td width="96%" valign="bottom"><span class="STYLE1"> 管理员信息列表</span></td>
                </tr>
              </table></td>
              <td><div align="right"><span class="STYLE1">
                <input name="checkbox11" type="checkbox" id="checkbox11" onclick="quanx()" />
                全选      &nbsp;&nbsp;<img src="../images/add.gif" width="10" height="10" /> <a href="../../guanli/tjnews.php">添加</a> &nbsp; <img src="../images/del.gif" width="10" height="10" /> <a style=" cursor:pointer;" onclick="danxuan()">删除</a>    &nbsp;   &nbsp;</span><span class="STYLE1"> &nbsp;</span></div></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce">
        <tr>
          <td width="2%" height="20" bgcolor="d3eaef" class="STYLE10"><div align="center">
            <input type="checkbox" name="checkbox" id="checkbox" />
          </div></td>
          <td width="7%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">编号</div></td>
          <td width="23%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">管理员账号</div></td>
          <td width="31%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">管理员注册IP</div></td>
          <td width="30%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center">注册时间</div></td>
          <td width="7%" height="20" bgcolor="d3eaef" class="STYLE6"><div align="center"><span class="STYLE10">基本操作</span></div></td>
        </tr>
        <?php 
	$sql="select * from admin_users limit $xsys,$mys";
	$rs=mysql_query($sql);
	$u=0;
	while($rows=mysql_fetch_array($rs))
	{
		$u++;
?>
        <tr>
          <td height="20" bgcolor="#FFFFFF"><div align="center">
            <input type="checkbox" name="checkbox2" id="checkbox2"  value="<?php echo $rows["admin_id"]?>" />
          </div></td>
          <td height="20" bgcolor="#FFFFFF" class="STYLE6"><div align="center"><?php echo $u?></div></td>
          <td height="20" align="left" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rows["admin_users"]?></div> </td>
            <td height="20" align="left" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rows["admin_ip"]?></div> </td>
            <td height="20" align="left" bgcolor="#FFFFFF" class="STYLE19"><div align="center"><?php echo $rows["admin_time"]?></div> </td>
          <td height="20" bgcolor="#FFFFFF"><div align="center" class="STYLE21"><a href="delete.php?id=<?php echo $rows["admin_id"]?>&amp;dqysdz=<?php echo $dqy?>">删除</a></div></td>
        </tr>
        <?php
	}
?>
      </table></td>
    </tr>
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33%" bgcolor="#FFFFFF"><div align="left"><span class="STYLE22">&nbsp;&nbsp;&nbsp;&nbsp;共有<strong> <?php echo $rows_s[0]?></strong> 条记录，当前第<strong> <?php echo $dqy;?></strong> 页，共 <strong><?php echo $zys;?></strong> 页</span></div></td>
          <td width="67%"><table width="263" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="49"><div align="center"><span class="STYLE22"><a href="?dqy=<?php echo $dqy-1?>">上一页</a></span></div></td> 
              <td width="49"><div align="center">
                <sapn class="STYLE22"><a href="?dqy=<?php echo $dqy+1?>">下一页</a></sapn>
              </div></td>
              <td width="49"><div align="center"><span class="STYLE22"><a href="?dqy=1">首页</a></span></div></td>
              <td width="37" class="STYLE22"><div align="center">转到</div></td>
              <td width="22"><div align="center">
              <input name="dqysdz" type="hidden" value="<?php echo $dqy?>" />
                <input type="text" name="textfield" id="textfield"  style="width:20px; height:12px; font-size:12px; border:solid 1px #7aaebd;" value="<?php echo $dqy?>" onblur="yeshu(this.value)"/>
              </div></td>
              <td width="22" class="STYLE22"><div align="center">页</div></td>
              <td width="35" align="center"><span class="STYLE22"><a href="?dqy=<?php echo $zys?>">末页</a></span></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>