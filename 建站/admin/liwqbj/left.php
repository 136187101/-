<?php 
require '../../include/init.php';
require_once("../session.php");
//读取管理员权限
$quanxian=$hjd->get_one("select * from admin_user where username = '$_SESSION[adminname]'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head id="Head1" runat="server">
<link rel="stylesheet" href="css/jquery.treeview.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#browser3").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});

});
</script>
</head>
<style type="text/css">
*{ padding:0px; margin:0px;}
body{ font-size:12px;}
.menulist
		{
		COLOR: #384F67; 
		TEXT-DECORATION: none;
		font-size:12px;
		}
	
.menuq {
	background:url(images/menu_bg_01.gif) repeat-x;
	margin: 0px;
	padding: 0px;
	position:absolute;
	top:0px;
	text-align:center;
}		
.Lion_menu_2 {
	text-decoration: none;
	font-size: 12px;
	font-weight: bold;
	color: #4B6888;
	text-align:center;
	
}		
</style>
<body >
<table width="100%" height="29" border="0" cellpadding="0" cellspacing="0" class="menuq">
   <tr>
    <td width="100%" align="left" class="Lion_menu_2" style="cursor:pointer;">菜单管理</td>
  </tr>
  
</table>
<table>
<tr><td height="25"></td></tr>
</table>
<ul id="browser3" class="filetree treeview-famfamfam" >

  <!--  <li><span class="folder">商品管理</span>
    <ul>
      <li><span class="file"><a href="../news/news_gl.php"   target='sys_main' class='menulist'>商品列表</a></span></li>
	  <li><span class="file"><a href="../news/news_tj.php"   target='sys_main' class='menulist'>添加新商品</a></span></li>
	  <li><span class="file"><a href="../news/news_lei.php?fuid=0"   target='sys_main' class='menulist'>商品分类</a></span></li>
	  <li><span class="file"><a href="../brand/brand_gl.php"  target='sys_main' class='menulist'>商品品牌</a></span></li>
    </ul>
  </li> -->
  
 <!--  <li><span class="folder">订单管理</span>
    <ul>
      <li><span class="file"><a href="../order/order_gl.php"   target='sys_main' class='menulist'>订单列表</a></span></li>
	  <li><span class="file"><a href="?2.1">订单打印</a></span></li>
    </ul>
  </li>--> 
  
  
 <!--    <li><span class="folder">报表统计</span>
    <ul>
      <li><span class="file"><a href="?2.1">流量分析</a></span></li>
	  <li><span class="file"><a href="?2.1">订单统计会员排行</a></span></li>
	  <li><span class="file"><a href="?2.1">销售排行</a></span></li>
    </ul>
  </li>-->
<?php if($quanxian["quanxian"]==0)
{?>
   <li><span class="folder">权限管理</span>
    <ul>
      <li><span class="file"><a href="../xitong/admin_user.php"  target='sys_main' class='menulist'>管理员列表</a></span></li> 
      <li><span class="file"><a href="../xitong/add_admin.php"  target='sys_main' class='menulist'>添加字管理员</a></span></li>
    <!--   <li><span class="file"><a href="?2.1">管理员日志</a></span></li>
	  <li><span class="file"><a href="?2.1">订单统计会员排行</a></span></lii>
	  <li><span class="file"><a href="?2.1">供货商列表</a></span></li>-->
    </ul>
  </li>
<?php
}
?>
   <li><span class="folder">系统设置</span>
    <ul>
      <li><span class="file"><a href="../xitong/sys.php" target='sys_main' class='menulist'>网站设置</a></span></li>
	<!--  <li><span class="file"><a href="?2.1">支付方式</a></span></li>
 <li><span class="file"><a href="?2.1">配送方式</a></span></li>--> 
	  <li><span class="file"><a href="../link/link_gl.php" target='sys_main' class='menulist'>友情链接</a></span></li>
	  <li><span class="file"><a href="../poster/poster_gl.php" target='sys_main' class='menulist'>焦点图管理</a></span></li>
<!--	  <li><span class="file"><a href="../Advertising/poster_gl.php" target='sys_main' class='menulist'>广告管理</a></span></li>
-->    </ul>
  </li>
  
  
  
  
   <!--  <li><span class="folder">数据库管理</span>
    <ul>
      <li><span class="file"><a href="../xitong/data"  target='sys_main' class='menulist'>数据备份</a></span></li> 
    </ul>
  </li> -->

  
    <li><span class="folder">留言管理</span>
    <ul>
      <li><span class="file"><a href="../liuyan/liuyan.php"  target='sys_main' class='menulist'>留言管理</a></span></li> 
    </ul>
  </li>
<!--    <li><span class="folder">文书下载管理</span>
		<ul>
		  <li><span class="file"><a href="../ziliao/zlfl_gl.php"   target='sys_main' class='menulist'>文书下载管理</a></span></li>
		</ul>
	</li>
-->    <li><span class="folder">栏目管理</span>
		<ul>
		  <li><span class="file"><a href="../essay/essay_lei.php?fuid=0"   target='sys_main' class='menulist'>栏目分类</a></span></li>
		</ul>
	</li>
	  
	  
	  <li><span class="folder">信息列表</span>
            <ul>
				 <?php
                $query = "SELECT * FROM essay_zilei where fuid = 0 order by zileipx desc";
                $arr=$db->getAll($query);
                   if(!empty($arr)){
                foreach($arr as $row){
                $sql="select * from essay_zilei where fuid=$row[id]";		
                $nem=$db->query($sql);	
                $nums=$db->fetch_nums($nem);	
                         if($nums){?>
                         
                <li><span class="file"><?=$row["zititle"]?></span><?php news_list($row[id])?></li>
                    <?php }else{?>
                <li><span class="file"><a href='../essay/essay_gl.php?zid=<?=$row["id"]?>&gid=<?=$row["gid"]?>&tid=<?=$row["fuid"]?>'  target='sys_main' class='menulist'><?=$row["zititle"]?></a></span></li>
                        <?php } } }?>

   			 </ul>
  </li>
	   <?php
  function news_list($id){
  $sele="select * from essay_zilei where fuid=$id";
 	echo "<ul>"; 	
		  $ppt = mysql_query($sele);
		while($v = @mysql_fetch_array($ppt)){
		 $quer="select * from essay_zilei where fuid=$v[id]";
		 	$ne=mysql_query($quer);
			 $num=mysql_num_rows($ne);
		 if(!empty($num)){ 
		echo  "<li><span class='file'>$v[zititle]</span>";
			news_list($v[id]);			
		 echo 	"</li>";
		  }else{
		 echo "<li><span class='file'>";
echo "<a href='../essay/essay_gl.php?zid=$v[id]&gid=$v[gid]&tid=$v[fuid]'  target='sys_main' class='menulist'>$v[zititle]</a></span></li>";
		 } }		
echo "</ul>";  
  }
  ?>
    </ul>
</body>
</html>
