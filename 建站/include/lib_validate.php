<?php
 /*************
 /*
 /* @��֤������
 /* @author:jianghua
 /*
 /
 
  
  /**
   * @ ����:��֤email��ַ
   * @ param $_email string 
   * @ return bool value
   */

   
  function check_email($_email)
  {
	  $pattern ="/([0-9a-zA-Z_-])+@+([0-9a-zA-Z_-])+\.[0-9a-zA-Z_-]+/";
	  if(preg_match($pattern,$_email))
	  {
		  return true;
	  }else{
	      return false;

	  }
  }

  /**
   * @ ����:��֤QQ
   * @ param $_qq int 
   * @ return bool value
   */
   function check_qq($_qq)
   {
	   $pattern ="/[0-9]{3,}/";
	   if(preg_match($pattern,$_qq))
	   {
		   return true;
	   }else{
	      return false;
	   }
   }

   /**
    * @ ����:��֤���ڵĸ�ʽ
    * @ param $_date string
	* @ return bool value
	*/
   function check_date($_date)
   {
	   $pattern ="/[1-9][0-9]{3}-[0-1][0-9]-\d{2}/";
	   if(preg_match($pattern,$_date))
	   {
		   return true;
	   }else{
		   return false;
	   }
   }

   /**
    * @ ����:ƥ����ʽ�� 0511-4405222 �� 021-87888822
	* @ param $_number int 
	* @ return bool value
	*/
   function check_telphoto($_number)
   {
	   $pattern ="/\d{3}-\d{8}|\d{4}-\d{7}/";
	   if(preg_match($pattern,$_number))
	   {
		   return true;
	   }else{
		   return false;
	   }
   }

    /**
    * @ ����:ƥ�����֤����
	* @ param $_number int 
	* @ return bool value
	*/
   function check_telephoto($_number)
   {
	   $pattern ="/\d{15}|\d{18}/";
	   if(preg_match($pattern,$_number))
	   {
		   return true;
	   }else{
		   return false;
	   }
   }



?>