<?php
session_start();
require_once('../../include/verifyImage.class.php');
$image = new ValidationCode('60','20','4');    //图片长度、宽度、字符个数
$image->outImg();
$_SESSION['code'] = $image->checkcode; //存贮验证码到 $_SESSION 中
?>