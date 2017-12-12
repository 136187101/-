<?php
//ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.SERVER_ROOT);
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set(PRC); 
define('ROOT',$_SERVER['DOCUMENT_ROOT']."/");//."/"
//echo dirname(__FILE__)."/";
//exit;
//$ROOT =  dirname(__FILE__)."/";
//echo ROOT; exit;
require_once ROOT."include/database.php";
require_once ROOT."include/config.inc.php";
require_once ROOT."include/js.php";
//require_once ROOT."/include/page.class.php";
require_once ROOT."include/page.class1.php";
require_once ROOT."include/image.class.php";
require_once ROOT."include/file.class.php";
require_once ROOT."include/index.class.php";
require_once ROOT."include/fso.class.php";
//require_once ROOT."/include/setSmarty.php";
require_once ROOT."include/email.class.php";
require_once ROOT."include/emailhtml.class.php";
require_once ROOT."include/gouwu.class.php";
require_once ROOT."include/liwqbj.class.php";

//实例化的class();
$db = new Database($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd,$cfg_dbname);
$js = new JS();
$liwqbj =  new liwqbjtt();
$lwq = new liwqbjindex();


//简便的调用get，post，cookie，session的值；
if($_REQUEST){
	foreach($_REQUEST as $key=>$val){
		@$$key = addslashes($val);
	}
}
//防止注入的方法；
$id = $liwqbj->liwqbj_check($_GET["id"]);
$zid = $liwqbj->liwqbj_check($_GET["zid"]);
$tid = $liwqbj->liwqbj_check($_GET["tid"]);
$fid = $liwqbj->liwqbj_check($_GET["fid"]);
$s = $liwqbj->liwqbj_check($_GET["s"]);
?>
