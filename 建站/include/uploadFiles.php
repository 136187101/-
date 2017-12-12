<?php
class uploadMulit extends upload{

     function upload()
	 {
		 $field =$this->field;
		 $uploads =$_FILES[$field];
		  
		  foreach($uploads['error'] as $key=>$val)
		  {
		
			  if($val==0)
			  {
				 $temp= strrchr($uploads['name'][$key],'.');
				 $file_suffix =strtolower(substr($temp,1,strlen($temp)));
				 if(!in_array($file_suffix,$this->allow_type))
				 {
					 $this->uplaod_error ='文件格式不符合规范!';
					 return false;
				 }
				 if($uploads['size'][$key]>1024*1024*2)
				 {
					 $this->uplaod_error ='上传的文件过大!';
					 return false;

				 }
				 $new_name =date('Ymd').rand(1000,9999).'.'.$file_suffix;
				 $file_name=date('Y-m-d');
				 $this->file_save_path;
				 $file_save_path=$this->file_save_path.$file_name.'/';
				 if(!file_exists($file_save_path))
				 {
					 @mkdir($file_save_path,'0777');
					 @chmod($file_save_path,'0777');
				 }
				 if(!move_uploaded_file($uploads['tmp_name'][$key],$file_save_path.$new_name))
				 {
					$this->uplaod_error ='文件上传失败!';
					return false;
				 }
				  $save_path .=$file_save_path.$new_name.'@';
				  
			 }
			
		 }
		 $this->save_url =serialize($save_path);
		 return true;

	 }


}



?>