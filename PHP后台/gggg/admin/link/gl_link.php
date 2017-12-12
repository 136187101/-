<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from link where fid = $fids order by px desc";
$pagepre = 15;
$db->setQuery($sql);
$zong = $db->num_rows();
	  if($zong == ""){
	  $kong = "<div style='padding-top:5px;'>当前还没有任何记录</div>";
	  $zong = 1 ;
	  }

	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
$jian = $db->loadObjectList();
$rst = $db->loadobject();
if($act == "del"){
$sql = "delete from link where id in($id)";
$db->setquery($sql);
$db->query();
$js->goto("?PB_page=$PB_page&fids=$fids");
}
if($xian == "wen"){
$sql = "update link set xianshi='$xianshi'";
$db->setquery($sql);
$db->query();
$js->alert("选择文字成功！");
$js->goto("?PB_page=$PB_page&fids=$fids");
}
if($xian == "tu"){
$sql = "update link set xianshi='$xianshi'";
$db->setquery($sql);
$db->query();
$js->alert("选择图片成功！");
$js->goto("?PB_page=$PB_page&fids=$fids");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../js/huanse.js"  language="javascript"></script>
<script src="../js/biaodan.js"  language="javascript"></script>
<script language="javascript">
function sltAll()
{
	var max =document.form1.item("del");
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

	strurl = "?act=del&PB_page=<?=$PB_page?>&fids=<?=$fids?>&id=" +strid;//据实际修改一下
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

<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
        <td><table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="35%" valign="middle">
              <table width="100%" height="25" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="5%">
                    <div align="center"><img src="../images/tb.gif" width="16" height="16" /></div>
                  </td>
                  <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[友情链接管理]-[链接管理]</td>
                </tr>
              </table>
            </td>
            <td width="37%">
<!--				显示方式：
                文字
				  <input type="radio" name="xianshi" value="1" <?php if($rst->xianshi){ echo "checked";}?> onclick="window.location.href='?xian=wen&xianshi=1&PB_page=<?=$_GET["PB_page"];?>&fids=<?=$fids?>';"/>
            	图片
				<input type="radio" name="xianshi" <?php if(!$rst->xianshi){ echo "checked";}?> value="0" onclick="window.location.href='?xian=tu&xianshi=0&PB_page=<?=$_GET["PB_page"];?>&fids=<?=$fids?>';"/>
-->				&nbsp;&nbsp;&nbsp;
				<select onchange="SetLanguage(this.options[this.selectedIndex].value)">
				<option value="1" <?php if($fids == 1){ echo "selected";}?>>友情链接</option>
				</select>
                </td>
            <td width="28%">
<table border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="47"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="33%" class="STYLE1"><img src="../images/22.gif" width="14" height="14" /></td>
                              <td width="67%" class="STYLE1"><a href="tj_link.php" class="STYLE6">新增</a></td>
                            </tr>
                  </table>
				  
				</td>
                        <td width="132"><table border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="60"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/quit.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a class="bai" style="color:#000000" onclick="sltAll();" onmouseover="this.style.cursor='hand'">全选</a></td>
                                  </tr>
                              </table></td>
                              <td width="60"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/33.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a onclick="sltNull();" style="color:#000000" onmouseover="this.style.cursor='hand'">取消</a></td>
                                  </tr>
                              </table></td>
                              <td width="50"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/11.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a onclick="SelectChk();" style="color:#000000" onmouseover="this.style.cursor='hand'">删除</a></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table>			</td>
          </tr>
        </table></td>
        <td width="16"><img src="../images/tab_07.gif" width="16" height="30" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8" background="../images/tab_12.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
          <tr>
            <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><input type="checkbox" name="checkbox" value="checkbox" onclick="sltAll();" onmouseover="this.style.cursor='hand'" /></td>
            <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="STYLE1">序号</span></td>
<!--            <td width="11%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">logo图</td>
-->            <td width="14%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">名称</td>
            <td width="19%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">连接地址</td>
            <td width="14%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">分类</td>
            <td width="15%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">时间</td>
            <td width="5%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">显示方式</td>
            <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">排序</td>
            <td width="12%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">基本操作</td>
          </tr>
          <?php 
		  $i=1;
		  foreach($jian as $rs){
		  ?>
          <tr>
            <td height="20" align="center" bgcolor="#FFFFFF"><input name="del" type="checkbox" id="del" value="<?=$rs->id?>" /></td>
            <td align="center" bgcolor="#FFFFFF"><?=$i?></td>
            <!--<td height="20" align="center" bgcolor="#FFFFFF"><img src="<?=$rs->image?>" width="120" height="50"  /></td>-->
            <td align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;<?=$rs->title?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">&nbsp;&nbsp;<?=$rs->http?></td>
            <td align="center" bgcolor="#FFFFFF"><?php if($rs->fid == 1){ echo "友情链接";}else if($rs->fid == 2){ echo "万顺通教育";}else{ echo "新能源与电力";}?></td>
            <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d",$rs->times);?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
			<? if($rs->xianshi){ echo "<font color='red'>文字</font>";}else{ echo "<font color='red'>图片</font>";}?>			</td>
            <td align="center" bgcolor="#FFFFFF"><?=$rs->px?></td>
            <td height="20" align="center" bgcolor="#FFFFFF">
                    <a href="up_link.php?act=edit&amp;id=<?=$rs->id?>&PB_page=<?=$_GET["PB_page"];?>&fids=<?=$fids?>"><img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>&nbsp; &nbsp;
                  <a href="?act=del&amp;id=<?=$rs->id?>&PB_page=<?=$_GET["PB_page"];?>&fids=<?=$fids?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
          </tr>
          <?php 
		   $i++;
		   }?>
        </table>
        <?=$kong?></td>
        <td width="8" background="../images/tab_15.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="STYLE4">&nbsp;&nbsp;共有 <?=$zong?> 条记录，当前第 <?=$_GET["PB_page"];?>/<?=$liwqbjpage->totalpage?> 页</td>
            <td align="right"><?=$liwqbjpage->show(3)?></td>
          </tr>
        </table></td>
        <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<script src="../js/tu.js"  language="javascript"></script>
</body>
</html>
