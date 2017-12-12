<?php 
define('HJD_SHOW', true);
require('../../hjd_include/init.php');
require('../../hjd_include/smtp.php');
$mailbody="我啊啊";
//$mailbody= iconv("UTF-8","GB2312", "$mailbody");
##########################################
$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = '15110024648@163.com'; //SMTP服务器的用户邮箱
$smtpemailto = '136187101@qq.com';//发送给谁
$fromname= "=?UTF-8?B?".base64_encode("黑武士")."?=";//自定义发件人，靠
$smtpuser = "hjdxx136@163.com";//SMTP服务器的用户帐号
$smtppass = "136187101";//SMTP服务器的用户密码
$mailsubject = "=?UTF-8?B?".base64_encode("邮件确认")."?=";//邮件主题
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
##########################################
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//TRUE;//是否显示发送的调试信息
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype, $fromname);
?>