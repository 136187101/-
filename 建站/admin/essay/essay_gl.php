 <?php
 @header('Content-type: text/html;charset=utf-8');
require_once("../session.php");
require '../../include/init.php';
$sql = "select * from essay_zilei where id = '$_GET[zid]'"; 
$tbb=$db->getOne($sql);

if($Submit == "搜索"){
$sql = "select a.*,c.zititle from essay a left join essay_zilei c on a.ziid=c.id where a.title like '%".$_GET["sou"]."%' or c.zititle like '%".$_GET["sou"]."%' order by a.px desc";
}else{
$sql = "select a.*,c.zititle,c.gid,c.id as ziid from essay a left join essay_zilei c on a.ziid=c.id where c.id = '$_GET[zid]' order by a.px desc";

}

$pagepre = 20;
$num=$db->Query($sql);
$zong = $db->fetch_nums($num);
	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$sq=$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
	 
	  
$rows=$db->fetch_array($sq); 

$rowst = $db->fetch_object($sq);



if($zong == ""){
	  	$kong = "<div style='padding-top:5px;'>
	  当前还没有任何记录,您所在的当前位置是：".$tbb[zititle]."</div>";
	  $zong = 1 ;
}

if($act == "del"){
	//删除图片
	$deinfo=$db->query("select * from essay where id in ($_GET[id])");
	while($rowsdeinfo=$hjd->fetch_array($deinfo))
	{
		@unlink("../../".$rowsdeinfo["image"]);
		@unlink("../../".$rowsdeinfo["image_rot"]);	
	}
	$query = "delete from essay where id in($_GET[id])";
	$db->query($query);
	$js->alert("删除成功");
	$js->Goto("?zid=$_GET[zid]&tid=$_GET[tid]&gid=$_GET[gid]&PB_page=".$_GET["PB_page"]);
}
/*
if($act == "notui"){
	$query = "update news set tuijian='0' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("首页展示已取消");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan='$yuyan'&PB_page=".$_GET["PB_page"]);
}
if($act == "tui"){
	$query = "update news set tuijian='1' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("首页展示已展示");
	$js->Goto("?zid='$zid'&tid='$tid'&gid='$gid'&yuyan='$yuyan'&PB_page=".$_GET["PB_page"]);
}
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>网站后台管理系统</title>
<link href="../css/skin.css" rel="stylesheet" type="text/css">
<script language="javascript">
function sltAll()
{
	var max =document.form1.item("del");
	if(max== null){ alert("没有信息可以选择"); return false;}
	for(j=0;j<max.length;j++)
	{
		document.form1.del[j].checked = true;
	}
}
function sltNull()
{
	var max =document.form1.item("del");
	for(j=0;j<max.length;j++)
	{
		document.form1.item("del",j).checked = false;
	}
}
//-------------以上是全选取消代码---------------//


function SelectChk()
{
	var s=false,delid,n=0,strid,strurl;
	
	var nn =document.form1.item("del");
	for (j=0;j<nn.length;j++)
	{
		if (document.form1.item("del",j).checked)
		{
			n = n + 1;
			s=true;
			delid =document.form1.del[j].value;
			if(n==1){strid = delid;}
			else{strid = strid + "," + delid;}
		}
	}

	if (nn.length==null)
		{
		if (document.form1.del.checked)
		   { s=true;
		   strid =document.form1.del.value;}
		
		}

	strurl = "?act=del&id=" +strid;//据实际修改一下
	if(!s)	{
			alert("请选择要删除的信息！");
			return false;
		}
		
	if ( confirm("你确定要删除这些信息吗？"))
	{
			form1.action = strurl;
			form1.submit();
		}
}
//-------------以上是全选删除代码---------------//

function ConfirmDelBig()
{
   if(confirm("确定要删除吗？一旦删除不能恢复！"))
     return true;
   else
     return false;
	 
}

function ConfirmDelSmall()
{
   if(confirm("确定要删除吗？\n将删除此栏目下所有栏目！"))
     return true;
   else
     return false;
	 
}

function checkSubmit() 
{ 
	if(document.form2.sou.value==''){
				alert('请填写您要搜索的关键词！！');
				form2.sou.focus();
				return false;
	}
	return true; 
}
</script>
<style type="text/css">
<!--
.STYLE4 {font-weight: bold}
-->
</style>
</head>
<body>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="Navitable">
              <form id="form2" name="form2" method="get" action="?zid=<?php echo $_GET[zid]?>&amp;PB_page=<?php echo $_GET["PB_page"];?>&amp;yidlei=<?php echo $_GET["yidlei"]?>&amp;sou=<?php echo $_GET["sou"]?>" onsubmit="return checkSubmit();">
                <tr>
                  <td width="37%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%" align="left"><table border="0" align="left" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="70" align="center"><a href="essay_tj.php?id=<?php echo $rowst->ziid?>&amp;zid=<?php echo $_GET[zid]?>&amp;tid=<?php echo $_GET[tid]?>&amp;gid=<?php echo $_GET[gid]?>&amp;PB_page=<?php echo $_GET["PB_page"]?>"><strong>添加信息</strong></a></td>
                            <td width="237"><table width="68%" border="0" align="left" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="60"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td><a style="color:#000000" onclick="sltAll();" onmouseover="this.style.cursor='hand'">全选</a></td>
                                      </tr>
                                  </table></td>
                                  <td width="60"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td class="STYLE1">&nbsp;</td>
                                        <td><a onclick="sltNull();" style="color:#000000" onmouseover="this.style.cursor='hand'">取消</a></td>
                                      </tr>
                                  </table></td>
                                  <td width="50"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td class="STYLE1">&nbsp;</td>
                                        <td><a onclick="SelectChk();" style="color:#000000" onmouseover="this.style.cursor='hand'">删除</a></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                  </table></td>
				 
                  <td width="20%" align="right">模糊搜索：</td>
                  <td width="12%" align="right">
                  <input name="sou" type="text" id="sou"  value="<?php echo $_GET['sou']?>" size="20" />
                  <input name="zid" type="hidden" id="zid" value="<?php echo $_GET['zid']?>"/>                  </td>
                  <td width="7%" align="left"><input name="submit" type="submit"  value="搜索" />&nbsp;</td>
                  <input type="hidden" name="Submit" value="搜索">
				 
                  <td width="24%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                      <td width="95%"><span class="STYLE3">你当前的位置</span>：[信息管理]-[
                        <?=$tbb[zititle]?>
                        ]</td>
                    </tr>
                  </table>
				   
				  </td> 
                </tr>
              </form>
            </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <form id="form1" name="form1" method="post" action="">	
          <tr>
            <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1"  bgcolor="#FFFFFF" class="table" >
                <tr>
                  <td width="5%" height="25" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">&nbsp;</td>
                  <td width="5%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>序号</strong></td>

<?php if($_GET[tid]=="3"){?> <td width="6%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>图</strong></td> <?php } ?>

                  <td width="18%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>标题</strong></td>



                  <td width="19%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>类别</strong></td>
                  <td width="18%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>添加时间</strong></td>


	
                  <td width="6%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><strong>排序</strong></td>
                  <td width="15%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" style="cursor:hand"><strong>基本操作</strong></td>
                </tr>
                <?php 
			 	if($_GET["PB_page"] != 1){
		  		$i=$pagepre * ($_GET["PB_page"] - 1) + 1;
		 		 }else{
				$i=1;
				}

				
			 foreach($rows as $row){
				?>
                <tr>
                  <td height="20" align="center" bgcolor="#FFFFFF">
                  <input name="del" type="checkbox" id="del" value="<?=$row[id]?>" />
                  </td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
				  <?php if($_GET[tid]=="3"){?>
                  <td align="center" bgcolor="#FFFFFF" >
				  <?php if($row[image] == ""){?>
				  <img src="../images/zanwu.gif" width="40" height="40"/>
				  <?php }else{?>
				  <img src="<?="../../".$row[image]?>" width="40" height="40" />
				  <?php }?>				  </td>
				  <?php } ?>

                  <td height="20" align="left" bgcolor="#FFFFFF">&nbsp;<?=$row[title]?></td>



				  <td height="20" align="center" bgcolor="#FFFFFF">
				  &nbsp;&nbsp;<?=$row[zititle] ? $row[zititle] : "<font color='red'>暂无分类</font>";?>&nbsp;&nbsp;&nbsp;				  </td>
                  <td align="center" bgcolor="#FFFFFF"><?=$row[times]?></td>

				  
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$row[px]?></td>

                  <td height="20" align="center" bgcolor="#FFFFFF" ><a href="essay_up.php?id=<?=$row[id]?>&zid=<?=$row[ziid]?>&tid=<?php echo $tid?>&gid=<?php echo $gid?>&yuyan=<?php echo $yuyan?>&PB_page=<?php echo $_GET['PB_page'];?>">编辑</a>&nbsp;
				  <?php if($zid != 1 && $zid != 10){?>
				  <a href="?act=del&amp;id=<?=$row[id]?>&zid=<?=$row[ziid]?>&tid=<?php echo $_GET[tid]?>&gid=<?php echo $_GET[gid]?>&PB_page=<?php echo $_GET["PB_page"];?>" onclick="return ConfirmDelBig();">删除</a>
				  <?php }?>				  </td>
                </tr>
                <?php
				$i++;
				   }
				   ?>
              </table>
            <?=$kong?></td>
          </tr>
	</form>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35">&nbsp;</td>
            <td>
			<?php if($zid != 1 && $zid != 10000000){?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
				
   			<td width="47%" class="STYLE4">
   &nbsp;&nbsp;共有<?=$zong?>条记录，当前第<?=$_GET["PB_page"];?>/<?=$liwqbjpage->totalpage?>页，当前 <?=$pagepre?> 条
   			</td>
                  <td align="right" class="STYLE4"><?=$liwqbjpage->show(3)?></td>
                </tr>
            </table><?php }else{?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td>&nbsp;</td>
				  </tr>
			</table>
			<?php }?>
			</td>
            <td width="16" align="right">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table>
 </body>
 </html>