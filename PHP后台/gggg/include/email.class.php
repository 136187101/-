<? 
/*
.html邮件代码
##########################################
$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "liwqbj@163.com";//SMTP服务器的用户邮箱
$smtpemailto = "$email";//发送给谁
$smtpuser = "liwqbj@163.com";//SMTP服务器的用户帐号
$smtppass = "liwqbj19880807";//SMTP服务器的用户密码
$mailsubject = "北京汽车修理美容装饰有限公司";//邮件主题
$mailbody = "邮件内容";//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
##########################################
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = true;//是否显示发送的调试信息
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
*/

/*   .txt邮件代码
$sm = new smail( "liwqbj@163.com", "liwqbj19880807", "smtp.163.com" );
$end = $sm->send( "$email", "liwqbj@163.com", "汽车网", "$neirong" );
if( $end ) echo $end;
else echo "<div style='text-align:center; color:#ff0000;'>发送成功！</div>";
*/
/* 
 * 邮件发送类
 */
class smail {
 //您的SMTP 服务器供应商，可以是域名或IP地址
 var $smtp = ""; 
 //SMTP需要要身份验证设值为 1 不需要身份验证值为 0，现在大多数的SMTP服务商都要验证，如不清楚请与你的smtp 服务商联系。
 var $check = 1;
 //您的email帐号名称
 var $username = "";
 //您的email密码
 var $password = "";
 //此email 必需是发信服务器上的email
 var $s_from = "";
 
 /* 
  * 功能：发信初始化设置
  * $from      你的发信服务器上的邮箱
  * $password  你的邮箱密码
  * $smtp      您的SMTP 服务器供应商，可以是域名或IP地址
  * $check     SMTP需要要身份验证设值为 1 不需要身份验证值为 0，现在大多数的SMTP服务商都要验证
  */
 function smail ( $from, $password, $smtp, $check = 1 ) {
  if( preg_match("/^[^\d\-_][\w\-]*[^\-_]@[^\-][a-zA-Z\d\-]+[^\-](\.[^\-][a-zA-Z\d\-]*[^\-])*\.[a-zA-Z]{2,3}/", $from ) ) {
   $this->username = substr( $from, 0, strpos( $from , "@" ) );
   $this->password = $password;
   $this->smtp = $smtp ? $smtp : $this->smtp;
   $this->check = $check;
   $this->s_from = $from;
  }
 }
 
 /* 
  * 功能：发送邮件
  * $to   目标邮箱
  * $from 来源邮箱
  * $subject 邮件标题
  * $message 邮件内容
  */
 function send ( $to, $from, $subject, $message ) { 
 
  //连接服务器 
  $fp = fsockopen ( $this->smtp, 25, $errno, $errstr, 60); 
  if (!$fp ) return "联接服务器失败".__LINE__;
  set_socket_blocking($fp, true ); 
  
  $lastmessage=fgets($fp,512);
  if ( substr($lastmessage,0,3) != 220 ) return "错误信息1:$lastmessage".__LINE__; 
  
  //HELO
  $yourname = "YOURNAME";
  if($this->check == "1") $lastact="EHLO ".$yourname."\r\n";
  else $lastact="HELO ".$yourname."\r\n";
  
  fputs($fp, $lastact);
  $lastmessage == fgets($fp,512);
  if (substr($lastmessage,0,3) != 220 ) return "错误信息2:$lastmessage".__LINE__; 
  while (true) {
   $lastmessage = fgets($fp,512);
   if ( (substr($lastmessage,3,1) != "-")  or  (empty($lastmessage)) )
    break;
  } 
    
  //身份验证
  if ($this->check=="1") {
   //验证开始
   $lastact="AUTH LOGIN"."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) return "错误信息3:$lastmessage".__LINE__; 
   //用户姓名
   $lastact=base64_encode($this->username)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != 334) return "错误信息4:$lastmessage".__LINE__;
   //用户密码
   $lastact=base64_encode($this->password)."\r\n";
   fputs( $fp, $lastact);
   $lastmessage = fgets ($fp,512);
   if (substr($lastmessage,0,3) != "235") return "错误信息5:$lastmessage".__LINE__;
  }
  
  //FROM:
  $lastact="MAIL FROM: <". $this->s_from . ">\r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) return "错误信息6:$lastmessage".__LINE__;
  
  //TO:
  $lastact="RCPT TO: <". $to ."> \r\n"; 
  fputs( $fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 250) return "错误信息7:$lastmessage".__LINE__;
   
  //DATA
  $lastact="DATA\r\n";
  fputs($fp, $lastact);
  $lastmessage = fgets ($fp,512);
  if (substr($lastmessage,0,3) != 354) return "错误信息8:$lastmessage".__LINE__;
  
   
  //处理Subject头
  $head="Subject: $subject\r\n"; 
  $message = $head."\r\n".$message; 
   
  
  //处理From头 
  $head="From: $from\r\n"; 
  $message = $head.$message; 
   
  //处理To头 
  $head="To: $to\r\n";
  $message = $head.$message;
   
  
  //加上结束串 
  $message .= "\r\n.\r\n";
  
  //发送信息 
  fputs($fp, $message); 
  $lastact="QUIT\r\n"; 
  
  fputs($fp,$lastace); 
  fclose($fp); 
  return 0;
 } 
}
/*发送示例
$sm = new smail( "用户名@163.com", "密码", "smtp.163.com" );
$end = $sm->send( "目标邮箱", "来源邮箱", "这是标题", "这是邮件内容" );
if( $end ) echo $end;
else echo "发送成功！";
*/
?> 