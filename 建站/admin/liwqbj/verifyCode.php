<?php
session_start();
require_once('../../include/verifyImage.class.php');
$image = new ValidationCode('60','20','4');    //ͼƬ���ȡ���ȡ��ַ�����
$image->outImg();
$_SESSION['code'] = $image->checkcode; //������֤�뵽 $_SESSION ��
?>