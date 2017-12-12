<?php  
session_start();
@header('Content-type: text/html;charset=utf-8');
include '../../include/init.php';

if(empty($_SESSION['adminname'])){
     header("Location:login.php");

  }
//msg('登录成功!','index.html',2);

$js->Alert("登录成功!");
$js->Goto('menu.php');

?>