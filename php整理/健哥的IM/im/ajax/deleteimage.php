<?php header('Content-type: text/html;charset=utf-8');
require_once("../../include/global.php");
require_once("../include/function.php");
$imgroot = $_GET["imgroot"];  //\im\uploadimages\1336619145633.jpg

$newslist=$imgroot;
$root=$_SERVER['DOCUMENT_ROOT'];
$root.=$newslist;
@unlink($root);


$newslist2="/im/uploadimages/d".substr($imgroot,17,40);
$root2=$_SERVER['DOCUMENT_ROOT'];
$root2.=$newslist2;
@unlink($root2);

?>