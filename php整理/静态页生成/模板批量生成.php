<?php
require_once("../../include/global.php");
$newssql=$db->query("select * from news");
		$newsr=$db->query("select * from news order by id desc limit 0,10");
while($rsnewsr=$db->fetch_array($newsr)){$rsn[]=$rsnewsr;}
	while($rsnews=$db->fetch_array($newssql))
	{
	$news_id=$rsnews["id"];
	$roote=$_SERVER['DOCUMENT_ROOT'];
$roote.="/admin/news/moban/mo.htm";
$fpe=fopen($roote,"r");
$contentse=fread($fpe,filesize($roote));
	$resulte=$db->query("select * from news where id='$news_id'");
$rse=$db->fetch_array($resulte);
	$titlee=$rse["title"];
	$laie=$rse["lai"];
	$time_ate=$rse["time_at"];
	$contente=$rse["content"];
	$newsliste=$rse["newslist"];
	$contentse=str_replace("{-���ű���-}",$titlee,$contentse);
	$contentse=str_replace("{-������Դ-}",$laie,$contentse);
	$contentse=str_replace("{-����ʱ��-}",$time_ate,$contentse);
	$contentse=str_replace("{-��������-}",$contente,$contentse);
	$i=1;
		foreach($rsn as $kk){
			$kkbig_id=$kk["id"];
			$wlgr=$db->query("select * from news where id='$kkbig_id'");
			$wlgrfetch=$db->fetch_array($wlgr);
			$titlee=$kk["title"];
			$titlel=substr($titlee,0,26);
			$titt="<a href=".$wlgrfetch["newslist"].">".$titlel."</a>";
			$contentse=str_replace("{-��������".$i."-}",$titt,$contentse);
			$i++;
		}
	$rooe=$_SERVER['DOCUMENT_ROOT'];
	$rooe.=$newsliste;
	$fppe=fopen($rooe,"w");
	if(fwrite($fppe,$contentse)){
	echo $newsliste."&nbsp;&nbsp;&nbsp;&nbsp;�ɹ�<br>";
	}
	else	{
	echo $newsliste."&nbsp;&nbsp;&nbsp;&nbsp;ʧ��<br>";
	}
	}
echo "<a href=add_news.php?all=tp>����</a>";
?>