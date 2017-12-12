<?php 
require_once("../../include/global.php");
	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}


$sql = "select a.*,b.zititle,b.id as ids from news a left join news_zilei b on a.ziid = b.id where b.fuid = 2";
$query = mysql_query($sql);
$lwq=1;
while($rszjsl =  mysql_fetch_array($query)){

	$htmlurls = ROOT.$rszjsl['htmlurl'];
	$ids = $rszjsl['ids'];
	$ziid = $rszjsl['ziid'];
	$fp = fopen(ROOT."/admin/mod/index-1.htm","r");   
	$content = fread($fp,filesize (ROOT."/admin/mod/index-1.htm"));   
	$zititle = $rszjsl['zititle'];
	$title =  $rszjsl['title'];  
	$wztitle =  $rszjsl['author'];  
	$seo_title = $rszjsl['seo_title'];
	$seo_gjci =  $rszjsl['seo_gjci'];
	$seo_type =  $rszjsl['seo_type'];
	
	$contentss = stripslashes($rszjsl['content']);
	
	$content = str_replace ("{-zititle-}",$zititle,$content);   
	$content = str_replace ("{-title-}",$title,$content);
	$content = str_replace ("{-wztitle-}",$wztitle,$content);
	$content = str_replace ("{-seotitle-}",$seo_title,$content); 
	$content = str_replace ("{-seogjci-}",$seo_gjci,$content); 
	$content = str_replace ("{-seotype-}",$seo_type,$content); 
	$content = str_replace ("{-content-}",$contentss,$content); 
	
	
	
	$sql1 = "select * from news where ziid = 17 order by times desc limit 6";
	$query1 = mysql_query ($sql1);
			while($rs =  mysql_fetch_array($query1)){
				$titlebt .= "<li><a href=\"/news/news-".$rs['ziid']."_".$rs['id'].".html\">".$rs["title"]."</a></li>";
			}
	$content = str_replace ("{-最新文章标题-}",$titlebt,$content);   
	
	$sql2 = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = 19 and a.zhanshi = 1 order by a.px desc limit 7";
	$query2 = mysql_query($sql2);
			while($jiaru =  mysql_fetch_array($query2)){
				$jiarukh .= "<li><a href=\"/news/news-".$jiaru['ziid']."_".$jiaru['id'].".html\">".$jiaru["title"]."</a></li>";
			}
	$content = str_replace ("{-最新加入-}",$jiarukh,$content);

	$sql3 = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = $ids order by a.px desc";
	$query3 = mysql_query ($sql3);
		while($fuwus =  mysql_fetch_array($query3)){
			$fuwu .= "<li><a href=\"".$fuwus['htmlurl']."\">".$fuwus['zititle'].$fuwus["title"]."</a></li>";
		}
	$content = str_replace ("{-400dianhuafuwu-}",$fuwu,$content);
	
	$sql4 = "select * from news_zilei where fuid = 2 order by zileipx desc limit 35";
	$query4 = mysql_query ($sql4);
	
	while($rs = mysql_fetch_array($query4)){
		$sql1 = "select * from news where ziid = ".$rs['id'];
		$query1 = mysql_query($sql1);
		$rst = mysql_fetch_array($query1);
		$diqulei .= "<dl><a href=\"".$rst["htmlurl"]."\">".$rs['zititle']."</a>&nbsp;&nbsp;|</dl>";
	}
	$content = str_replace ("{-首页地区分类-}",$diqulei,$content);



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
		$error = "<span style='padding-left:10px; color:#009900;'>批量更新成功！</span>"; 


	echo $htmlurls."成功更新".$lwq."个<br />";
	//$js->goto("index.php");
	$lwq++;
	
	$titlebt="";
	$jiarukh="";
	$fuwu="";
	$diqulei="";
}
echo "<font color=red>$error</font>";
?>