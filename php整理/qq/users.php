<?php 
  //应用的APPID
  $app_id = "101250577";
  //应用的APPKEY
  $app_secret = "30206bc239886bedb99c544ff51baf8f";
  //成功授权后的回调地址
  $my_url = "http://1zi.cc/users.php";
 
  //Step1：获取Authorization Code
  session_start();
  $code = $_REQUEST["code"];

  if(empty($code)) 
  {
     //state参数用于防止CSRF攻击，成功授权后回调时会原样带回
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); 
     //拼接URL     
     $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" 
        . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
        . $_SESSION['state'];
     echo("<script> top.location.href='" . $dialog_url . "'</script>");
  }
 

  //Step2：通过Authorization Code获取Access Token
  if($_REQUEST['state'] == $_SESSION['state']) 
  {
     //拼接URL   
     $token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
     . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
     . "&client_secret=" . $app_secret . "&code=" . $code;
     $response = file_get_contents($token_url);
     if (strpos($response, "callback") !== false)
     {
        $lpos = strpos($response, "(");
        $rpos = strrpos($response, ")");
        $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
        $msg = json_decode($response);
        if (isset($msg->error))
        {
           echo "<h3>error:</h3>" . $msg->error;
           echo "<h3>msg  :</h3>" . $msg->error_description;
           exit;
        }
     }
 
     //Step3：使用Access Token来获取用户的OpenID
     $params = array();
     parse_str($response, $params);
     $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$params['access_token'];
     $str  = file_get_contents($graph_url);
     if (strpos($str, "callback") !== false)
     {
        $lpos = strpos($str, "(");
        $rpos = strrpos($str, ")");
        $str  = substr($str, $lpos + 1, $rpos - $lpos -1);
     }
     $user = json_decode($str);
     if (isset($user->error))
     {
        echo "<h3>error:</h3>" . $user->error;
        echo "<h3>msg  :</h3>" . $user->error_description;
        exit;
     }
   //  echo("Hello " . $user->openid);
	 $infourl="https://graph.qq.com/user/get_user_info?access_token={$params['access_token']}&oauth_consumer_key={$app_id}&openid={$user->openid}";
  	 $infoarr=json_decode(file_get_contents($infourl));
	 //会员信息
	 $infourlvap="https://graph.qq.com/user/get_vip_info?access_token={$params['access_token']}&oauth_consumer_key={$app_id}&openid={$user->openid}&format=json";
  	 $infovip=json_decode(file_get_contents($infourlvap));
	 

	 //将获取到的QQ信息写入session
	 $_SESSION["qq_name"]=$infoarr->nickname;
	 $_SESSION["qq_touxiang"]=$infoarr->figureurl_qq_2;
	 $_SESSION["qq_gender"]=$infoarr->gender;
	 $_SESSION["qq_vip"]=$infovip->is_qq_vip;//标识是否QQ会员（0：不是； 1：是）。
	 header("location:index.php");
  }
  else 
  {
     echo("The state does not match. You may be a victim of CSRF.");
  }
?>