<?php
require_once("../../include/global.php");
require_once("../session.php");
if($act=="del"){
	$query = "delete from buy where id in($id)";
	$db->setQuery($query);
	$db->query();
	$query = "delete from belong where bid in($id)";
	$db->setQuery($query);
	$db->query();
	$js->alert("删除成功");
	$js->Goto("?");
}
if($Submit == "搜索"){
$sql = "select * from buy where nickname like '%".$_GET["sou"]."%' order by state asc";
}else{
$sql = "select * from buy order by state asc,btime desc";
}
$pagepre = 10;
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
$rows = $db->loadObjectList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script src="../js/huanse.js"></script>
<script src="../js/tancu.js"></script>
<script  language="javascript">
function checkSubmit() 
{ 
	if(document.form2.yidlei.value==''){
				alert('请选择分类谢谢！！');
				form2.yidlei.focus();
				return false;
	}
	return true; 
}
</script>
<style type="text/css">
<!--
.STYLE7 {	font-size: 12px;
	color: #033d61; text-decoration:none
}
-->
</style>
</head>
<body>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
               		  <form id="form2" name="form2" method="get" action="?PB_page=<?=$_GET["PB_page"];?>&yidlei=<?=$_GET["yidlei"]?>&sou=<?=$_GET["sou"]?>" onsubmit="return checkSubmit();">
			    <tr>
                  <td width="37%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[订单管理]-[<a href="../lianxi/gl_lianxi.php" target="liwqbj2" class="STYLE7">订单信息管理</a>]</td>
                      </tr>
                  </table></td>
                  <td width="13%" align="right">&nbsp;</td>
                  <td width="19%" align="right"><input name="sou" type="text" id="sou" style="height:13px; color:#999999" value="<?=$_GET["sou"]?>" size="20" /></td>
                  <td width="7%" align="left"><input name="submit" type="image" src="../images/tab_21.gif"/></td>
                  <input type="hidden" name="Submit" value="搜索"  />
                  <td width="24%"><table border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="47"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="33%" class="STYLE1">&nbsp;</td>
                          <td width="67%" class="STYLE1">&nbsp;</td>
                        </tr>
                      </table></td>
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
                  </table></td>
                </tr>
				</form>
            </table></td>
            <td width="12"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <form id="form1" name="form1" method="post" action="">	
          <tr>
            <td width="9" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">&nbsp;</td>
                  <td width="10%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">编号</td>
                  <td width="30%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">订单人</td>
                  <td height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">订单状态</td>
                  <td width="19%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">订单时间</td>
                  <td width="17%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">基本操作</td>
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
                  <td height="20" align="center" bgcolor="#FFFFFF"><input name="del" type="checkbox" id="del" value="<?=$row->id?>" />                  </td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF"> &nbsp;<?=$row->nickname?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF">
				  <?php 
					if($row->state == 0){
					echo "<font color='red'>未付款</font>";
					}elseif($row->state == 1){
					echo "<font color='red'>未付款进行中</font>";
					}elseif($row->state == 2){
					echo "<font color='red'>已付款进行中</font>";
					}elseif($row->state ==3){
					echo "<font color='red'>订单成功</font>";
					}
					?>				  				  			  
				  </td>
                  <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d h:i:s",$row->btime)?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><a href="gouwu_x.php?id=<?=$row->id?>">订单详情</a>&nbsp;<a href="?act=del&amp;id=<?=$row->id?>&PB_page=<?=$_GET["PB_page"];?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
                </tr>
                <?php
				
				$i++;
				   }
				   ?>
              </table>
            <?=$kong?></td>
            <td width="9" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
	</form>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="STYLE4">&nbsp;&nbsp;共有
                    <?=$zong?>
                    条记录，当前第
                    <?=$_GET["PB_page"];?>
                    /
                    <?=$liwqbjpage->totalpage?>
                    页，当前 <?=$pagepre?> 条</td>
                  <td align="right"><?=$liwqbjpage->show(3)?></td>
                </tr>
            </table></td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
<script src="../js/tu.js"  language="javascript"></script>
</body>
</html>