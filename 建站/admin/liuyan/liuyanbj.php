<?php 
@header('Content-type: text/html;charset=utf-8');
require '../../include/init.php';
require_once("../session.php");
$id=$_GET['id'];
//echo $id;
if($_GET['act'] == "edit"){

$sql = "select * from liuyan where id =$id ";
//echo $sql;
$rows = $db->getOne($sql);
}

//回复
if($_POST["Submit"])
{
		$content=$_POST["content"];
		$db->query("INSERT INTO `reply` (`l_id`, `content`, `xianshi`, `times`) VALUES ('$id', '$content', '0', '$date');");
		$js->Alert("回复成功");
		$js->Goto("liuyanbj.php?id=$id&act=edit");
}
//删除回复
if($_GET["de"]==1)
{
	
	$db->query("delete from reply where id = '$_GET[did]'");
	$js->Alert("删除成功");
	$js->Goto("liuyanbj.php?id=$id&act=edit");
}
//修改回复
if($_POST["update"])
{
	$content=$_POST["content1"];
	$db->query("update reply set content='$content' where id = '$_POST[upid]'");
	$js->Alert("修改成功");
	$js->Goto("liuyanbj.php?id=$id&act=edit");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="form1" enctype="multipart/form-data" name="form1" method="post" action="">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="30">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[留言板管理]-[管理]-[查看]</td>
                      </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
            <td width="16">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="80%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>查看留言信息</strong></td>
                </tr>
                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">姓　名：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[name];?>
                 </td>
                </tr>

                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">Email：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[email];?>
                 </td>
                </tr>
				
				 <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">电话：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[dianhua];?>
                 </td>
                </tr>
				 <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">地址：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[dizhi];?>
                 </td>
                </tr>
                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">主  题：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[zhuti]?>
                 </td>
                </tr>

                <tr>
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">留言内容：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[neirong]?>
                 </td>
                </tr>
                <tr> 
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">时间：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF"><?=$rows[shijian]?>
                 </td>
                </tr>
<!--                <?php
				//编辑回复
                	if($_GET["up"]==1)
					{
						$upnr=$hjd->get_one("select * from reply where id = $_GET[upid]");
						
				?>
                <tr> 
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">编辑回复：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF">
				      <textarea name="content1" id="content1" cols="65" rows="5" style="height:200px; width:90%"><?php echo $upnr[content];?></textarea>
<br />					
					  <input name="upid" type="hidden" value="<?php echo $_GET["upid"];?>" />
				      <input name="update" type="submit" value="提交" />
				      <script charset="utf-8" src="../../include/editor/kindeditor.js"></script>
				      
				      <script>
                         KE.show({
                               id : 'content1'
                        });
                     </script>
		          </p></td>
                </tr>
                <?php
					}
				else
					{
                //已回复状态
				$rs_hf=$db->query("select * from reply where l_id='$id'");
				if($hjd->num_rows($rs_hf)!=0)
				{
				?>
                <tr> 
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">已回复：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF">
                  <?php
                  	while($rows_hf=$hjd->fetch_array($rs_hf))
					{
					?>
					<div><?php echo $rows_hf["content"]?></div>
                    <hr />
					回复时间：<?php echo $rows_hf["times"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?up=1&act=edit&id=<?php echo $id?>&upid=<?php echo $rows_hf[id]?>">编辑</a>&nbsp;&nbsp;<a onclick="if(confirm('确定要删除该回复吗？')){}else{return false;}" href="?de=1&id=<?php echo $id?>&act=edit&did=<?php echo $rows_hf[id]?>">删除回复</a>&nbsp;&nbsp;
					<?	
					
					}
				  
				  ?>
                 </td>
                </tr>
                <?php
				}
				//未回复状态
                if($_GET["h"]==1)
				{
				?>
              <tr> 
                  <td width="9%" height="20" align="right" bgcolor="#FFFFFF"><span class="table_title">回复：&nbsp;&nbsp;</span></td>
                  <td width="91%" height="20" align="left" bgcolor="#FFFFFF">
                  <textarea name="content" id="content" cols="65" rows="5" style="height:200px; width:90%"></textarea>
                  </td>
                
                </tr>
			<script charset="utf-8" src="../../include/editor/kindeditor.js"></script>
					
  			 <script>
       			 KE.show({
             		   id : 'content'
    		    });
  			 </script>
                
                
                <tr>
                <?php
					}
				?>
                  <td height="20" colspan="2" align="center" bgcolor="#FFFFFF">    
               <?php
                	if($_GET["h"]!=1)
					{
				?>
          
                  <a href="?h=1&id=<?php echo $id;?>&act=edit">回复</a>
                  <a onclick='javascript:history.go(-1)' href="#">返回</a>
                <?php
					}
					else
					{
				?>
                	<input name="Submit" type="submit" value="提交" />
                    <input name="" type="button" value="返回" onclick='javascript:history.go(-1)' />
                <?php
					}
				?>
                 </td>
                </tr>
                <?php
					}
				?>
            </table></td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
   <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"></td>
            <td>&nbsp;</td>
            <td width="16"></td>
          </tr>
      </table></td>
    </tr>--> 
  </table>
</form>
</body>
</html>

