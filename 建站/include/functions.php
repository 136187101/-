<?php
    
	/**
	 * @ 得到用户的真实IP
	 * @ return IP
	 */
	function get_ip() {
		if ($_SERVER['REMOTE_ADDR']) {
			$ip = $_SERVER['REMOTE_ADDR'];
			return $ip;	
		} else if (getenv( "HTTP_CLIENT_IP" )) {
			$ip = getenv( "HTTP_CLIENT_IP" );
			return $ip;
		} else if (getenv( "HTTP_X_FORWARDED_FOR" )) {
			$ip = getenv( "HTTP_X_FORWARDED_FOR" );
			return $ip;
		} else if (getenv( "HTTP_X_FORWARDED" )) {
			$ip = getenv( "HTTP_X_FORWARDED" );
			return $ip;
		} else if (getenv( "HTTP_FORWARDED_FOR" )) {
			$ip = getenv( "HTTP_FORWARDED_FOR" );
			return $ip;
		} else if (getenv( "HTTP_FORWARDED" )) {
			$ip = getenv( "HTTP_FORWARDED" );
			return $ip;
		}
	}


	  /**
	   * @$message  string 提示消息
	   * @$url  string 跳转的URL 
	   * @$waitTime  int 跳转的时间
	   * @$type  int 图片显示的类型
	   */

	   function msg($message,$url,$waitTime,$type=1)
	   {
	       global $db;
		   global $smarty;
		   header('Content-type: text/html; charset=utf-8');
		   $msg="<a href=\"$url\">$message</a><script>setTimeout(\"window.location.href='$url'\",$waitTime*1000);</script>";
		   
		   $smarty->assign('type',$type);
		   $smarty->assign('message',$msg);
		   $smarty->assign('time',$waitTime);
		   $smarty->display('msg.html');
		   
	   }



     /**
	  *@param string 字符型
	  *@param string 字符型
	  *@ 功能:记录登录退出操作
	  */
      function admin_log($name,$action){
		$time =date("Y-m-d H:i:s",time());
		$fopen =fopen('log/log.txt','rb');
        if(false!=$fopen){
	      $txt =file_get_contents('log/log.txt');
		  $input_string = $txt.$name.' '.$time.' '.$action."\r\n";
		  file_put_contents('log/log.txt',$input_string);
       }else{
		  echo '打开文件失败!';
       }
     }


	 /**
	  * GPC过滤
	  * @param $gpc_data maix 混合类型
	  * @return array or String
	  */
	 function new_addslashes($gpc_data){
	     if(is_array($gpc_data)){
		     foreach($gpc_data as $key=>$val){
			     $gpc_data[$key] =addslashes($val);
			 }
			 return $gpc_data;
		 }else{
			 return $gpc_data =addslashes($gpc_data);
		 }
	 
	 }






?>