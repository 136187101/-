<?php
require_once("../include/global.php");
$root=$_SERVER['DOCUMENT_ROOT'];
$sql=$db->query("select * from wlgr_content");//单一内容查询
$sqlt=$db->query("select * from wlgr_content where jing=1 order by id desc limit 10");//其它列表查询
while($rse=$db->fetch_array($sqlt)){$rst[]=$rse;}//转为数组
while($rs=$db->fetch_array($sql))
{
	$type=$db->get_one("select * from fptype where typeid=".$rs["typenameid"]);
	$rstype=$type["typename"];
	$filename=$root."/lianxi/sj.htm";
	if(!file_exists($filename)){$js->Alert("模板文件不存在");}
	$fp=fopen($filename,"r");
	$contents=fread($fp,filesize($filename));
	$contents=str_replace("{-标题-}",$rs["title"],$contents);
	$contents=str_replace("{-大类别-}",$rs["typename"],$contents);
	$contents=str_replace("{-类别-}",$rstype,$contents);
	$contents=str_replace("{-来源-}",$rs["itlai"],$contents);
	$contents=str_replace("{-时间-}",$rs["time_at"],$contents);
	$contents=str_replace("{-内容-}",$rs["content"],$contents);
	//其它列表生成法
	foreach($rst as $val)
	{
		$rstitle.="<li>&nbsp;·<a href=\"#\" style=\"color:#666666;\">".substr($val["title"],"0","26")."</a></li>";
		
	}
	$contents=str_replace("{-精彩文章-}",$rstitle,$contents);
	//
	fclose($fp);
	$date=date("Y-m-d",time());
	$thname=$root."/lianxi/newslist/$date/";
	if(!file_exists($thname)){mkdir($thname);}
	//$ilnamerand=rand("1000","9999").time();
	$ilnamerand=$rs["id"];
	$liname=$thname.$ilnamerand.".html";
	$fpp=fopen($liname,"w");
	fwrite($fpp,$contents);
	fclose($fpp);
}

?>