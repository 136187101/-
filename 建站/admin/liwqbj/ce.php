<?php require '../../include/init.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" href="css/jquery.treeview.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>

</head>
<script type="text/javascript">
$(document).ready(function(){
	$("#browser3").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});

});
</script>
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
<body>
<ul id="browser3" class="filetree treeview-famfamfam">
<li><span  class="folder">栏目管理</span>
    <ul>
			<?php
                $rs=$db->query("select * from essay_zilei where fuid='0'");
                while($rows=mysql_fetch_array($rs))
                {
            ?>
                
                <li><span class="file"><a href='../xitong/sys.php' target='sys_main' class='menulist'><?php echo $rows[zititle]?></a></span><?php   fenlei($rows[id]);?></li>
            <?php	
               
                }
            ?>
   </ul>
    
</li>
 <?php
 function fenlei($fu_id){
		$rs_l=mysql_query("select * from essay_zilei where fuid='$fu_id'");
		echo "<ul>"; 
		while($rows_l=mysql_fetch_array($rs_l))
			{
				echo  "<li><span class='file'><a href='../xitong/sys.php' target='sys_main' class='menulist'>$rows_l[zititle]</a></span>";
				fenlei($rows_l[id]);
				 echo 	"</li>";
			}
		echo "</ul>";  
	}
 ?> 
      <li><span class="folder">系统设置</span>
    <ul>
      <li><span class="file"><a href="../xitong/sys.php" target='sys_main' class='menulist'>网站设置</a></span></li>
	<!--  <li><span class="file"><a href="?2.1">支付方式</a></span></li>
 <li><span class="file"><a href="?2.1">配送方式</a></span></li>--> 
	  <li><span class="file"><a href="../link/link_gl.php" target='sys_main' class='menulist'>友情链接</a></span></li>
	  <li><span class="file"><a href="../poster/poster_gl.php" target='sys_main' class='menulist'>广告管理</a></span></li>
    </ul>
  </li>                      

</ul>
</body>
</html>