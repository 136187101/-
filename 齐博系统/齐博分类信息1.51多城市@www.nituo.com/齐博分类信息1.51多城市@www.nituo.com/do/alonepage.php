<?php
require(dirname(__FILE__)."/"."global.php");

$rsdb=$db->get_one("SELECT * FROM {$pre}alonepage WHERE id='$id'");
$db->query("UPDATE {$pre}alonepage SET hits=hits+1 WHERE id='$id' ");

if(!$rsdb)
{
	showerr("内容不存在");
}

if($job=='makehtml'){
	unset($lfjuid,$web_admin,$lfjid,$lfjdb,$groupdb);
	$groupdb=@include( ROOT_PATH."data/group/2.php");		//以游客身份处理
}

//SEO
$titleDB[title]		= $rsdb[title];
$titleDB[keywords]	= $rsdb[keywords];
$titleDB[description] = $rsdb[descrip];
//模板
$head_tpl=$rsdb['tpl_head'];
$main_tpl=$rsdb['tpl_main'];
$foot_tpl=$rsdb['tpl_foot'];


//获取标签内容
$template_file=html("alonepage",$main_tpl);
fetch_label_value(array('pagetype'=>'4','file'=>$template_file,'module'=>$webdb['module_id']));


if(!$rsdb[ishtml]){
	require_once(ROOT_PATH."inc/encode.php");
	$rsdb[content]=format_text($rsdb[content]);
}else{
	$rsdb[content] = En_TruePath($rsdb[content],0);
}

$rsdb[posttime]=date("Y-m-d H:i:s",$rsdb[posttime]);


require(ROOT_PATH."inc/head.php");
require($template_file);
require(ROOT_PATH."inc/foot.php");

if($job=='makehtml'&&$rsdb[filename]){
	$content=ob_get_contents();
	$path=dirname(ROOT_PATH.$rsdb[filename]);
	if(!is_dir($path)){
		makepath($path);
	}
	write_file(ROOT_PATH."$rsdb[filename]",$content);
	ob_end_clean();
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$webdb[www_url]/$rsdb[filename]'>";
	exit;
}
?>