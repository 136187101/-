<?php 
require_once("../../include/global.php");
require_once("../session.php");
if($_GET[act] == "sheng"){
	$fp = fopen ("index.html","r");   
	$content = fread ($fp,filesize ("index.html"));   
//首页基本信息生成开始
	$title = $lwq->dibuxinxi(title);   
	$sou_url = "http://".$_SERVER['SERVER_NAME'];
	$seo_title = $lwq->dibuxinxi(seo_title);
	$seo_gjci = $lwq->dibuxinxi(seo_gjci);
	$seo_type = $lwq->dibuxinxi(seo_type);
	$rexian = $lwq->dibuxinxi(rexian);
	$dibu = $lwq->dibuxinxi(dibu);
	$content = str_replace ("{首页标题}",$title,$content);   
	$content = str_replace ("{首页收藏地址}",$sou_url,$content);
	$content = str_replace ("{首页优化标题}",$seo_title,$content); 
	$content = str_replace ("{首页优化关键词}",$seo_gjci,$content); 
	$content = str_replace ("{首页优化关详细}",$seo_type,$content); 
	$content = str_replace ("{首页热线电话}",$rexian,$content); 
	$content = str_replace ("{首页底部信息}",$dibu,$content); 
//首页基本信息生成结束


// 首页地区分类生成开始   
	$sql = "select * from news_zilei where fuid = 2 order by zileipx desc limit 35";
	$query = mysql_query ($sql);
	while($rs = mysql_fetch_array($query)){
		$sql1 = "select * from news where ziid = ".$rs['id'];
		$query1 = mysql_query ($sql1);
		$rst = mysql_fetch_array($query1);
		$diqu .= "<dl><a href=\"".$rst['htmlurl']."\">".$rs['zititle']."</a>&nbsp;&nbsp;|</dl>";
	}
	$content = str_replace ("{-首页地区分类-}",$diqu,$content);   
// 首页地区分类生成结束

// 首页地区分类生成开始   
	$sql = "select * from news_zilei where fuid = 2 order by zileipx desc";
	$query = mysql_query ($sql);
	while($rs = mysql_fetch_array($query)){
		$sql1 = "select * from news where ziid = ".$rs['id'];
		$query1 = mysql_query ($sql1);
		$rst = mysql_fetch_array($query1);
		$diqu .= "<dl><a href=\"".$rst['htmlurl']."\">".$rs['zititle']."</a>&nbsp;&nbsp;|</dl>";
	}
	$content = str_replace ("{-首页地区分类二-}",$diqu,$content);   
// 首页地区分类生成结束

	

// 首页焦点图片生成开始   
	$sql = "select * from jiaodian order by px desc";
	$query = mysql_query ($sql);
	$num = mysql_num_rows($query); 
	$i=1;
	while($rs = mysql_fetch_array($query)){
	$s=$i-1;
		$list .= "<li><a href=\"".$rs["url"]."\" target=\"_blank\"><img src=\"".$rs["image"]."\" border=\"0\" /></a></li>";
		$shu .="<li id=".$s.">&nbsp;".$i."&nbsp;</li>";
	$i++;
	}
	$content = str_replace ("{-首页焦点图-}",$list,$content);   
	$content = str_replace ("{-首页焦点数量-}",$shu,$content); 
	$content = str_replace ("{-首页焦点总数-}",$num,$content);  
// 首页焦点图片生成结束


//首页4006电话生成开始
	$sql = "select type1 from news where id = 1";
	$query = mysql_query($sql);
	$nows = mysql_fetch_array($query); 
	$type = $liwqbj->liwqbj_str($nows['type1'],75,0,'UTF-8');
	$content = str_replace ("{-首页4006简介-}",$type,$content);   
//首页4006电话生成结束	


//首页4000电话生成开始
	$sql = "select type1 from news where id = 2";
	$query = mysql_query($sql);
	$nows = mysql_fetch_array($query); 
	$type = $liwqbj->liwqbj_str($nows['type1'],75,0,'UTF-8');
	$content = str_replace ("{-首页4000简介-}",$type,$content);   
//首页4000电话生成结束	


//首页4008电话生成开始
	$sql = "select type1 from news where id = 3";
	$query = mysql_query($sql);
	$nows = mysql_fetch_array($query); 
	$type = $liwqbj->liwqbj_str($nows['type1'],75,0,'UTF-8');
	$content = str_replace ("{-首页4008简介-}",$type,$content);   
//首页4008电话生成结束	


//首页4001电话生成开始
	$sql = "select type1 from news where id = 21";
	$query = mysql_query($sql);
	$nows = mysql_fetch_array($query); 
	$type = $liwqbj->liwqbj_str($nows['type1'],75,0,'UTF-8');
	$content = str_replace ("{-首页4001简介-}",$type,$content);   
//首页4001电话生成结束	

// 首页为什么使用4000电话生成开始   
	$sql = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = 18 and a.zhanshi = 1 order by a.px desc limit 7";
	$query = mysql_query ($sql);
	while($rst = mysql_fetch_array($query)){
		$titles = $liwqbj->liwqbj_str($rst["title"],25,0,'UTF-8');
		$newssy_title .= "<li><a href=\"/news/news-".$rst['ziid']."_".$rst['id'].".html\">".$titles."</a></li>";
	}
	$content = str_replace ("{-首页为什么使用4000电话列表-}",$newssy_title,$content);   
// 首页为什么使用4000电话生成结束	


// 首页400电话客户生成开始   
	$sql = "select * from news where ziid = 21 order by px desc limit 6";
	$query = mysql_query ($sql);
	while($rst = mysql_fetch_array($query)){
		$newskh_title .= "<dd><a href=\"#\"><img src=\"".$rst['image']."\" width=\"103\" height=\"51\" class=\"bk\"/></a><br />".$rst['title']."</dd>";
	}
	$content = str_replace ("{-首页400电话客户-}",$newskh_title,$content);   
// 首页400电话客户生成结束	



// 首页新闻动态生成开始   
	$sql = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = 17 and a.zhanshi = 1 order by a.px desc limit 7";
	$query = mysql_query ($sql);
	while($rst = mysql_fetch_array($query)){
		$titles = $liwqbj->liwqbj_str($rst["title"],25,0,'UTF-8');
		$news_title .= "<li><a href=\"/news/news-".$rst['ziid']."_".$rst['id'].".html\">".$titles."</a></li>";
	}
	$content = str_replace ("{-首页新闻动态列表-}",$news_title,$content);   
// 首页新闻动态生成结束	


// 首页最新加入客户生成开始   
	$sql = "select a.*,b.zititle from news a left join news_zilei b on a.ziid = b.id where a.ziid = 19 and a.zhanshi = 1 order by a.px desc limit 7";
	$query = mysql_query ($sql);
	while($rst = mysql_fetch_array($query)){
		$titles = $liwqbj->liwqbj_str($rst["title"],25,0,'UTF-8');
		$newsjr_title .= "<li><a href=\"/news/news-".$rst['ziid']."_".$rst['id'].".html\">".$titles."</a></li>";
	}
	$content = str_replace ("{-首页最新加入客户生成列表-}",$newsjr_title,$content);   
// 首页最新加入客户生成结束	


// 首页友情链接生成开始   
	$sql = "select * from link where fid = 1 limit 27";
	$query = mysql_query ($sql);
	while($link = mysql_fetch_array($query)){
		$link_list .= "<li><a href=\"".$link["http"]."\" target=\"_blank\">".$link["title"]."</a></li>";
	}
	$content = str_replace ("{-首页友情链接-}",$link_list,$content);   
// 首页友情链接生成结束


//$filename = "text/".date("y-m-d-h-i-s",time())."lwq.html";  
$filename = "../../index.html";  
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
	$error = "<span style='padding-left:10px; color:#009900;'>创建文件".$filename."成功！</span>"; 
}
?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
body { background-color: #fff; font-size:12px;}
</style>
</head>
<body>
<a href="?act=sheng">生成首页</a><?=$error?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="diqu.php">批量生成地区内容页 </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="map.php">网站地图生成 </a>
</body>
</html>
