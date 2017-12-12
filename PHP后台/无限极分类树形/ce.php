<?php require_once("include/init.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
@charset "utf-8";
*{font-size:12px;}
body{padding:0px; margin:0px; font-size:12px; font-family:Arial, Helvetica, sans-serif; word-break:break-all;}
dl{padding:0px; margin:0px;}
dd{padding:0px; margin:0px;}
dt{padding:0px; margin:0px;}
li{padding:0px; margin:0px; list-style-type:none;}
h1,h2,h3,h4,h5,h6{ margin:0px; padding:0px;}
ul{padding:0px; margin:0px; list-style:none; margin-left:20px;}
form{padding:0px; margin:0px;}
img{border:0px; margin:0px; padding:0px;}
p{ margin:0px; padding:0px;}
a:link {color: #0d2b59;text-decoration: none;}
a:visited {text-decoration: none;color: #0d2b59;}
a:hover {text-decoration: none; color: #0d2b59;}
a:active {text-decoration: none;color: #0d2b59;}
a {outline: none; text-decoration:none; color:#0d2b59;}
a:active {star:expression(this.onFocus=this.blur());}
area{star:expression(this.onFocus=this.blur());}
:focus { outline:0; }
.hand{ CURSOR:pointer;}
/******以上是全局的样式*******/

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
                
                <li><span class="file"><?php echo $rows[zititle]?></span><?php   fenlei($rows[id]);?></li>
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
				echo  "<li><span class='file'>$rows_l[zititle]</span>";
				fenlei($rows_l[id]);
				 echo 	"</li>";
			}
		echo "</ul>";  
	}
 ?> 
                         

</ul>
</body>
</html>