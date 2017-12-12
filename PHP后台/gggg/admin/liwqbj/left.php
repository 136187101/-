<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from lwq_user where id = ".$_SESSION["user_id"];
$db->setQuery($sql);
$admin = $db->loadObject();
?>
<style type="text/css">
<!--
body{padding:0px; margin:0px; font-size:12px; color:#666666; background:#fff;}
dl{padding:0px; margin:0px;}
dd{padding:0px; margin:0px;}
dt{padding:0px; margin:0px;}
li{padding:0px; margin:0px; list-style-type:none;}
ul{padding:0px; margin:0px; list-style:none}
form{padding:0px; margin:0px;}
img{border:0px;}
a:link {color: #000;text-decoration: none;}
a:visited {text-decoration: none;color: #000;}
a:hover {text-decoration: none;color:red;}
a:active {text-decoration: none;color: #000;}
.centent{ width:100%; height:auto; border:#33CCFF solid 1px; margin-top:2px; font-size:12px;}
.shou{ width:auto; height:30px; padding-top:7px; margin:auto; background:#EFEFEF; cursor:pointer; }
.shou_a{ float:left; padding-left:5px; width:auto;}
.shou_b{ color:#669900; cursor:pointer; text-align:right; padding-right:5px; }
.shou_er{ width:100%; height:20px; padding-top:5px; padding-left:5px;}
.STYLE1 {
	font-size: 12px;
	color: #FFFFFF;
}
.STYLE3 {
	font-size: 12px;
	color: #033d61; text-decoration:none
}
-->
</style>
<script>
var he=document.body.clientHeight-105
document.write("<div id=tt style=height:"+he+";overflow:hidden>")
</script>
<script language="JavaScript" type="text/JavaScript">
function liwqbj_zhan(c_Str,text)
		{
				if(document.getElementById(c_Str).style.display=='none')
						{
							document.getElementById(c_Str).style.display='block';
							document.getElementById(text).style.color='#FF9933';
							document.getElementById(text).style.cursor='pointer';
							document.getElementById(text).innerHTML='+ 展开';
						}
				else
						{
						document.getElementById(c_Str).style.display='none';
						document.getElementById(text).style.color='#669900';
						document.getElementById(text).style.cursor='pointer';
						document.getElementById(text).innerHTML="- 收缩";
						}
		}

</script>
<script>
function showsubmenu(sid)
{
whichEl = eval("submenu" + sid);
imgmenu = eval("imgmenu" + sid);
if (whichEl.style.display == "none")
{
eval("submenu" + sid + ".style.display=\"\";");
imgmenu.background="images/main_47.gif";
}
else
{
eval("submenu" + sid + ".style.display=\"none\";");
imgmenu.background="images/main_48.gif";
}
}
</script>

<table width="165" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="28" background="images/main_40.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="19%">&nbsp;</td>
        <td width="81%" height="20"><span class="STYLE1">管理菜单</span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">
<div style="height:100%; width:auto; overflow:auto;">
	<table width="151" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>
<!----------------------------------------第一阶段---------------------------------------->

<?php 
//系统管理的权限
if(strstr($admin->quanxian,"1")){?>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu1" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(1)" onmouseout="this.className='menu_title';" style="cursor:pointer">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">系统管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu1" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="prober.php" target="liwqbj2" class="STYLE3">系统信息</a></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="data/index.php" target="liwqbj2" class="STYLE3" >数据库备份</a></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><span class="STYLE3"><a href="../liwq_user/lwq_gluser.php" target="liwqbj2" class="STYLE3">管理员管理</a></span></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><span class="STYLE3"><a href="../liwq_user/lwq_user.php" target="liwqbj2" class="STYLE3" >添加管理员</a></span></td>
                                </tr>
                            </table></td>
                          </tr>
						  <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><span class="STYLE3"><a href="../liwq_user/lwq_xinxi.php" target="liwqbj2" class="STYLE3" >基本信息</a></span></td>
                                </tr>
                            </table></td>
                          </tr>

                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>









<?php 
//栏目管理的权限
//if(strstr($admin->quanxian,"2")){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu2" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(2)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">栏目管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu2" style=" <?php if($zhan == 2){ echo "display:block";}else{ echo "display:none";}?>">
<div class="sec_menu">			  
<?php
$query = "SELECT * FROM news_zilei where fuid = 0 order by zileipx desc";
$tts = mysql_query($query);
$i=1;
while($row = mysql_fetch_array($tts)){
?>
<div class="centent">
<div class="shou">
		<?php if(!$row["gid"]){?>
<div class="shou_a"><img src="images/submenusub.gif" width="11" height="7">&nbsp;
<a href='../news_row/news_gl.php?zid=<?=$row["id"]?>&gid=<?=$row["gid"]?>&tid=<?=$row["fuid"]?>&yuyan=<?=$row["yuyan"]?>' target='liwqbj2'><?=$row["zititle"]?></a>
		<?php }else{?>
<div class="shou_a" onClick='liwqbj_zhan("tip<?=$i?>","text<?=$i?>");'><img src="images/submenusub.gif" width="11" height="7">&nbsp;<?=$row["zititle"]?>
		<?php }?>
</div>
		<?php if($row["gid"]){?>
		<div id="text<?=$i?>" class="shou_b" onClick='liwqbj_zhan("tip<?=$i?>","text<?=$i?>");'>- 收缩</div>
		<?php }else{echo "";}?>
</div>
	<div id="tip<?=$i?>" style="display:none">
	<?php
	$tid = $row["id"];
	echo lanmu($tid,"&clubs;");
	?>
    </div>
</div>
<?php 
$i++;
}
function lanmu($ids,$naai){
			$sql = "select * from news_zilei where fuid = $ids order by zileipx desc";
			$ppt = mysql_query($sql);
			while($rst = @mysql_fetch_array($ppt))
			{
			if(!$rst["gid"]){
			echo "<div class='shou_er' onMouseOver='this.style.background='#FFFFD0';this.style.cursor='pointer'' onMouseOut='this.style.background='ffffff''><span style='color:#3399FF'>".$naai."</span>&nbsp;<a href='../news_row/news_gl.php?zid=".$rst["id"]."&gid=".$rst["gid"]."&tid=".$rst["fuid"]."&yuyan=".$rst["yuyan"]."' target='liwqbj2'>".$rst["zititle"]."</a></div>";
			}else{
			echo "<div class='shou_er' onMouseOver='this.style.background='#FFFFD0';this.style.cursor='pointer'' onMouseOut='this.style.background='ffffff''><span style='color:#3399FF'>".$naai."</span>&nbsp;".$rst["zititle"]."</div>";
			}
			$ids = $rst["id"];
			lanmu($ids,"&nbsp;&nbsp;".$naai);
			}
}
?>
</div></td>
</tr>
</table>
<?php // }?>















<?php 
//新闻管理信息的权限
if(strstr($admin->quanxian,"3")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu3" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(3)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">在线下单管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu3" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="/admin/xiadan/xiadan_gl.php" target="liwqbj2" class="STYLE3">管理下单</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table><?php }?>
<?php 
//生成静态管理信息的权限
if(strstr($admin->quanxian,"4")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu4" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(4)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">生成静态页面管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu4" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<!--                          <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="../html/jintai_gl.php" target="liwqbj2" class="STYLE3">静态生成设置</a></td>
                                </tr>
                            </table></td>
                          </tr>
                          
-->							<tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="../html/weijintai_gl.php" target="liwqbj2" class="STYLE3">伪静态生成设置</a></td>
                                </tr>
                            </table></td>
                          </tr>                          
						<tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="../temp/index.php" target="liwqbj2" class="STYLE3">静态页面生成</a></td>
                                </tr>
                            </table></td>
                          </tr>                          
                          
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table><?php }?>

<?php 
//类别管理项目的权限
if(strstr($admin->quanxian,"5")){
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu5" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(5)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">类别管理项目</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu5" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="../news_row/news_lei.php?yuyan=0&fuid=0" target="liwqbj2" class="STYLE3">类别管理</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>


<?php 
//留言板管理的权限
if(strstr($admin->quanxian,"6")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu6" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(6)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">留言板管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu6" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="/admin/leve/gl_leve.php" target="liwqbj2" class="STYLE3">管理留言</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>


<?php 
//订单管理管理信息的权限
if(strstr($admin->quanxian,"7")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu7" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(7)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">订单管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu7" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="/admin/gou/gouwu_gl.php" target="liwqbj2" class="STYLE3">订单信息管理</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table><?php }?>


<?php 
//会员管理管理信息的权限
if(strstr($admin->quanxian,"8")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu8" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(8)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">地区申请管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu8" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="/admin/user/user_gl.php" target="liwqbj2" class="STYLE3">地区申请管理</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>



<?php 
//投票管理管理信息的权限
if(strstr($admin->quanxian,"9")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu9" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(9)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">投票管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu9" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="/admin/poll/managePollTitle.php" target="liwqbj2" class="STYLE3">管理</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>



<?php 
//友情链接管理信息的权限
if(strstr($admin->quanxian,"10")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu10" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(10)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">友情链接管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu10" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="/admin/link/gl_link.php?fids=1" target="liwqbj2" class="STYLE3">管理</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>




<?php 
//广告图片管理的权限
if(strstr($admin->quanxian,"11")){?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="23" background="images/main_47.gif" id="imgmenu11" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(11)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" class="STYLE1">广告图片管理</td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td background="images/main_51.gif" id="submenu11" style="DISPLAY:none">
			  <div class="sec_menu" >
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="../jiaodian/gl_jiaodian.php" target="liwqbj2" class="STYLE3">管理</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
					<tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                            <td width="84%" height="23"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="20" style="cursor:pointer" onmouseover="this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#7bc4d3'; "onmouseout="this.style.borderStyle='none'"><a href="../jiaodian/tj_jiaodian.php" target="liwqbj2" class="STYLE3">添加</a></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                    </tr>
                  </table>
              </div>
			  </td>
            </tr>
          </table>
<?php }?>

<?php 
//当前网站基本信息的权限
if(strstr($admin->quanxian,"12")){?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="23" background="images/main_47.gif" id="imgmenu12" class="menu_title" onmouseover="this.className='menu_title2';" onclick="showsubmenu(12)" onmouseout="this.className='menu_title';" style="cursor:pointer"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="18%">&nbsp;</td>
                  <td width="82%" class="STYLE1">当前网站基本信息</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td background="images/main_51.gif" id="submenu12" style="DISPLAY:">
			<div class="sec_menu" >
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="16%" height="25"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                          <td width="84%" height="23" class="STYLE3">当前的IP</td>
                        </tr>
                        <tr>
                          <td height="23" colspan="2" class="STYLE3">&nbsp;IP:<?=$_SERVER['REMOTE_ADDR']?></td>
                          </tr>
                        <tr>
                          <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
                          <td height="23" class="STYLE3">PHP版本版本信息</td>
                        </tr>
						  <tr>
                            <td height="23" colspan="2">&nbsp;<span class="STYLE3">PHP版本版:<?=PHP_VERSION?></span></td>
                            </tr>
						  <tr>
						    <td height="23"><div align="center"><img src="images/left.gif" width="10" height="10" /></div></td>
						    <td height="23"><span class="STYLE3">当前域名</span></td>
						  </tr>
						  <tr>
						    <td height="23" colspan="2"><span class="STYLE3">&nbsp;<?=$_SERVER['SERVER_NAME']?></span></td>
						    </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="5"><img src="images/main_52.gif" width="151" height="5" /></td>
                  </tr>
                </table>
            </div>
			</td>
          </tr>
        </table>
 <?php }?>
 
 
 
		</td>
      </tr>
    </table>
</div>	
	</td>
  </tr>
  <tr>
    <td height="18" background="images/main_58.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="18" valign="bottom"><div align="center" class="STYLE3">版本：2010V4.0</div></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 
if($zhan == 6){
$js->gotoliwqbj("../product_pro/product_lei.php?fuid=$fuid&yuyan=$yuyan");
}elseif( $zhan == 2){
$js->gotoliwqbj("../news_row/news_lei.php?fuid=$fuid&yuyan=$yuyan");
}
?>