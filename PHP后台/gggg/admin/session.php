<?php
session_start(); 
if($_SESSION["user_name"]==""){
$js->alert("对不起您还没有登陆！");
$js->goto("/admin/liwqbj/login.php");
}
//setcookie(name,value,expire,path,domain,secure)
?>