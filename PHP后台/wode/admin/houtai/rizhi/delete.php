<?php 
require_once("../../inc/conn.php");
$dqysdz=$_GET["dqysdz"];
$id=$_GET["id"];
$sql="delete from rizhi where adminlogin_id in ($id)";
mysql_query($sql);
header("location:ckrizhi.php?dqy={$dqysdz}");
?>
