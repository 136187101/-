<?php 
require_once("../inc/conn.php");
$dqysdz=$_GET["dqysdz"];
$id=$_GET["id"];
$sql="delete from books_xlb where xlb_id in ($id)";
mysql_query($sql);
header("location:gllb.php?dqy={$dqysdz}");
?>
