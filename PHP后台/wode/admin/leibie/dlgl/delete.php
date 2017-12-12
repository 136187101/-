<?php 
require_once("../../inc/conn.php");
$dqysdz=$_GET["dqysdz"];
$id=$_GET["id"];
$sql="delete from boods_dl where dl_id in ($id)";
$sql2="delete from books_xlb where xlb_dydl = $id";
mysql_query($sql);
mysql_query($sql2);
header("location:dlgl.php?dqy={$dqysdz}");
?>
