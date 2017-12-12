<?php
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
require_once ROOT."/Smarty/libs/smarty.class.php";
$Smarty	=	new Smarty();
$Smarty->compile_check = true;
$Smarty->cache_dir = ROOT."/cache";
$Smarty->caching = 0;
$Smarty->cache_lifetime = 300;
$Smarty->debuging	=	false;
$Smarty->template_dir	=	ROOT.'/templates_s';
$Smarty->compile_dir=	ROOT.'/templates_c';
//$Smarty->left_delimiter = "<%{";
//$Smarty->right_delimiter = "}%>";
?>
