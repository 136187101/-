<?php
require_once("../include/global.php");
$root=$_SERVER['DOCUMENT_ROOT'];
$sql=$db->query("select * from wlgr_content");//��һ���ݲ�ѯ
$sqlt=$db->query("select * from wlgr_content where jing=1 order by id desc limit 10");//�����б��ѯ
while($rse=$db->fetch_array($sqlt)){$rst[]=$rse;}//תΪ����
while($rs=$db->fetch_array($sql))
{
	$type=$db->get_one("select * from fptype where typeid=".$rs["typenameid"]);
	$rstype=$type["typename"];
	$filename=$root."/lianxi/sj.htm";
	if(!file_exists($filename)){$js->Alert("ģ���ļ�������");}
	$fp=fopen($filename,"r");
	$contents=fread($fp,filesize($filename));
	$contents=str_replace("{-����-}",$rs["title"],$contents);
	$contents=str_replace("{-�����-}",$rs["typename"],$contents);
	$contents=str_replace("{-���-}",$rstype,$contents);
	$contents=str_replace("{-��Դ-}",$rs["itlai"],$contents);
	$contents=str_replace("{-ʱ��-}",$rs["time_at"],$contents);
	$contents=str_replace("{-����-}",$rs["content"],$contents);
	//�����б����ɷ�
	foreach($rst as $val)
	{
		$rstitle.="<li>&nbsp;��<a href=\"#\" style=\"color:#666666;\">".substr($val["title"],"0","26")."</a></li>";
		
	}
	$contents=str_replace("{-��������-}",$rstitle,$contents);
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