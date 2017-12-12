<?php
    
	/**
	 * @ �õ��û�����ʵIP
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
	   * @$message  string ��ʾ��Ϣ
	   * @$url  string ��ת��URL 
	   * @$waitTime  int ��ת��ʱ��
	   * @$type  int ͼƬ��ʾ������
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
	  *@param string �ַ���
	  *@param string �ַ���
	  *@ ����:��¼��¼�˳�����
	  */
      function admin_log($name,$action){
		$time =date("Y-m-d H:i:s",time());
		$fopen =fopen('log/log.txt','rb');
        if(false!=$fopen){
	      $txt =file_get_contents('log/log.txt');
		  $input_string = $txt.$name.' '.$time.' '.$action."\r\n";
		  file_put_contents('log/log.txt',$input_string);
       }else{
		  echo '���ļ�ʧ��!';
       }
     }


	 /**
	  * GPC����
	  * @param $gpc_data maix �������
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