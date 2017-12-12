<?php 
require_once("../../include/global.php");

	$htmlurls = ROOT."/map.html";
	$fp = fopen(ROOT."/admin/mod/map.htm","r");   
	$content = fread($fp,filesize (ROOT."/admin/mod/map.htm"));   
	
	
	
	$sql1 = "select * from news_zilei where fuid = 6";
	$query1 = mysql_query ($sql1);
			while($rs =  mysql_fetch_array($query1)){
				$titlebt .= "<div class=\"map_center\">";
				$titlebt .= "<h1>".$rs['zititle']."</h1>";
					$sql2 = "select * from news where ziid = ".$rs['id'];
					$query2 = mysql_query ($sql2);
					
					while($rst =  mysql_fetch_array($query2)){
					$titlebt .= "<ul><li><a href=\"/news/news-".$rst['ziid']."_".$rst['id'].".html\">".$rst['title']."</a></li></ul>";
					}
				$titlebt .= "</div>";
			}
	$content = str_replace ("{-新闻类别-}",$titlebt,$content);   
	
	$sql3 = "select * from news_zilei where fuid = 2";
	$query3 = mysql_query ($sql3);
			while($rs =  mysql_fetch_array($query3)){
				$diqu .= "<div class=\"map_center\">";
				$diqu .= "<h1>".$rs['zititle']."</h1>";
					$sql4 = "select * from news where ziid = ".$rs['id'];
					$query4 = mysql_query ($sql4);
					
					while($rst =  mysql_fetch_array($query4)){
					$diqu .= "<ul><li><a href=\"".$rst['htmlurl']."\">".$rst['title']."</a></li></ul>";
					}
				$diqu .= "</div>";
			}
	$content = str_replace ("{-地区分类-}",$diqu,$content);   


	$filename = "$htmlurls";
	$handle = fopen ($filename,"w"); //打开文件指针，创建文件   
	/*  
	检查文件是否被创建且可写  
	*/  

	if (!is_writable ($filename)){
		$error = "<span style='padding-left:10px; color:red;'>文件：".$filename."不可写，请检查其属性后重试！</span>";   
	}   
	if (!fwrite ($handle,$content)){ //将信息写入文件   
		$error = "<span style='padding-left:10px; color:red;'>生成文件".$filename."失败！</span>";   
	}    
	fclose ($handle); //关闭指针    
		$error = "<span style='padding-left:10px; color:#009900;'>成功生成！</span>"; 
	//$js->goto("index.php");
echo "<font color=red>$error</font>";
?>