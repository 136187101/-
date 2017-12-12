<?php

/*******************************
 * @文件上传类
 * @author:jianghua
 * @date:2010-02-05
 *********************************
 */

 class upload
 {
	 /**
      * 文件的大小
	  */
     private $file_size;
	 /**
	  * 文件名
	  */
	 private $file_name;
	 /**
	  * 文件的后缀
	  */
	 private $file_suffix;
	 /**
	  * 文件的类型
	  */
	 private $file_type;
     /**
	  * 文件上传的错误类型
	  */
	 public  $upload_error;
	 /**
	  * 字段名
	  */
	 public $field;
	 /**
	  *@ 允许上传的文件类型
	  */
	 public $allow_type =array('gif','jpg','png');
	 /**
	  *@ 文件保存的路径
	  */
	 public $file_save_path;
     /**
	  * 文件上传后的保存路径
	  */
	 public $save_url; 


	 public function __construct()
	 {
        
	 }

	 /**
	  * @得到文件的类型
	  *
	  */
	 public function get_file_type()
	 {
		 return $_FILES[$this->field]['type'];
	 }
	 /**
	  * 得到文件上传中的错误
	  */
	 public function get_upload_error()
	 {
         return $this->upload_error;
	 }
	 /**
	  * @得到文件的大小
	  */
	 public function get_file_size()
	 {
		 return $_FILES[$this->field]['size'];
	 }
	 /**
	  * @得到文件的错误信息
	  */
	 public function get_file_error()
	 {
		 return $_FILES[$this->field]['error'];

	 }
	 /**
	  *@ 得到文件名
	  */
	 public function get_file_name()
	 {
		 return $_FILES[$this->field]['name'];
	 }
	 /**
	  *@设置字段的值
	  */
	 public function set_field_value($feild_value)
	 {
		 $this->field=$feild_value;
	 }
	 /**
	  *@ 得到文件上传前在服务器上的临时文件名
	  */
	 public function get_tmp()
	 {
		 return $_FILES[$this->field]['tmp_name'];
	 }

     /**
	  *
	  *@ 得到文件的后缀
	  */
	 public function get_file_suffix()
	 {
		 $temp= strrchr($this->get_file_name(),'.');
		 $file_suffix =strtolower(substr($temp,1,strlen($temp)));
		 return $file_suffix;
	 }

	 /**
	  *@ 检查文件是否符合要求
	  */
	 public function check_type()
	 {
		 if(!in_array($this->get_file_suffix(),$this->allow_type))
		 {
			 return false;
		 }
		 return true;
	 }

	 /**
	  *@ 检查文件的大小
	  */
	 public function check_file_size()
	 {
		 if(!$this->get_file_size>1024*1024*5)
		 {
              return false;
		 }
		 return true;
	 }

	 /**
	  * @得到文件上传时候的错误信息
	  *
	  */
	  function get_error()
	  {
		  $error =$_FILES[$this->field]['error'];
		  switch($error)
		  {
			  case UPLOAD_ERR_OK:
                  $this->upload_error =1;
				  break;
			  case UPLOAD_ERR_INI_SIZE:
				  $this->upload_error ='上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
				  break;
			  case UPLOAD_ERR_FORM_SIZE:
				  $this->upload_error ='上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
				  break;
			  case UPLOAD_ERR_PARTIAL:
				  $this->upload_error ='文件只有部分被上传';
				  break;
			  case UPLOAD_ERR_NO_FILE:
				  $this->upload_error='没有文件被上传';
				  break;
			  case UPLOAD_ERR_NO_TMP_DIR:
				  $this->upload_error ='找不到临时文件夹';
				  break;
			  case UPLOAD_ERR_CANT_WRITE:
				  $this->upload_error ='文件写入失败';
				  break;
			  default:
				  $this->upload_error ='未知的程序错误';

		  }

	  }
	 /**
	  *@ 上传文件
	  */
	 public function upload()
	 {
		 if(!$this->check_file_size())
		 {
			 $this->upload_error ='文件上传过大';
			 return false;
		 }
		 if(!$this->check_type())
		 {
			 $this->upload_error ='上传的文件不符合规定!';
			 return false;
		 }
		 $new_name =date('Ymd').rand(1000,9999).'.'.$this->get_file_suffix();
		// $file_name=date('Y-m-d');
		//$file_save_path=$this->file_save_path.$file_name.'/';
		 $file_save_path=$this->file_save_path;
		 $this->save_url =$file_save_path.$new_name;
		 if(!file_exists($file_save_path))
		 {
			 @mkdir($file_save_path,'0777');
			 @chmod($file_save_path,'0777');
		 }
		 if(!move_uploaded_file($this->get_tmp(),$file_save_path.$new_name))
		 {
			$this->upload_error = $this->get_file_error();
			return false;
		 }
		 return true;
		
	 }


     
 }



?>