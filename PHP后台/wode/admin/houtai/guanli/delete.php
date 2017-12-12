<?php 
require_once("../../inc/conn.php");
$dqysdz=$_GET["dqysdz"];
$id=$_GET["id"];
$sql="delete from admin_users where admin_id in ($id)";
mysql_query($sql);
header("location:ckadmin.php?dqy={$dqysdz}");
?>
