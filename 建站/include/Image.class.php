<?php
 
  /***************************
   * @ͼƬ����\ͼƬ��ˮӡ��
   * @author:jianghua
   * @version0.1
   ******************************
   */
	class Image{
	    

		public $file_save_path; //�ļ������·��

		public $thumb_width;  //����ͼ�Ŀ�

		public $thumb_height;	//����ͼ�ĸ�

		public $resource_path;  //ԴͼƬ·��

		public $watermark_dir; //ˮӡͼƬ��·��

		public $position_num =1; //ϵͳ������Ϣ��ͼƬ״̬��

		public $thumb_save_path; //����ͼ�����·��


		public function __construct(){
		
		}

		/**
		*@ access public 
		*@ return ͼƬ����Ϣ����
		*/
		public function get_image_info($image_dir){

			$res = getimagesize($image_dir);
			
			return $image_info =array(
					'width'=>$res[0],
					'height'=>$res[1],
					'type'=>$res[2],
					'MIME'=>$res['mime']
		
			);
		
		}

		/**
		*@ access public 
		*@ return ����һ��ͼƬ������ʶ
		*
		*/

		public function get_image_mark($_image_dir){
		
			$info =$this->get_image_info($_image_dir);
			$type_number = $info['type'];
			switch($type_number){
				case '1':
					$res =imagecreatefromgif($_image_dir);
				    break;

				case '2':
					$res =imagecreatefromjpeg($_image_dir);
					break;
				case '3':
					$res =imagecreatefrompng($_image_dir);
					break;
					
			}
			return $res;
		
		
		}

		/**
		*@ access public 
		*@ return �������ͷ
		*/

		public function get_input_header($image_path){
		
			$info =$this->get_image_info($image_path);
			$MIME =$info['mime'];
			return $MIME;
		
		}

	   /**
		*@ $thumb_width int ����ͼ�Ŀ�
		*@ $thumb_height int ����ͼ�ĸ�
		*@ return 
		*@ ����:��������ͼ
		*/

		 public function make_thumb($thumb_width,$thumb_height){

			$image_res =$this->get_image_mark($this->resource_path);
			$res_image=$this->get_image_info($this->resource_path);

		    //����������
			if($res_image['width']>$res_image['height']){
				$less_width =$thumb_width;
			    $less_height =floor($thumb_width*$res_image['height']/$res_image['width']);
			}else if($res_image['height']>$res_image['width']){
				$less_height = $thumb_height;
				$less_width = floor(($thumb_height*$res_image['width'])/$res_image['height']);
			}else{
				$less_width = $thumb_width;
				$less_height = $thumb_height;
			}

		       $pos_x =($thumb_width-$less_width)/2;
			   $pos_y =($thumb_height-$less_height)/2;

			$thumb =imagecreatetruecolor($thumb_width,$thumb_height);
			$bakcground =imagecolorallocate($thumb,253,253,253);
			imagefill($thumb,0,0,$bakcground);
			imagecopyresampled($thumb,$image_res,$pos_x,$pos_y,0,0,$less_width,$less_height,$res_image['width'],$res_image['height']);
			$mime =$res_image['MIME'];
			$number =rand(10000,99999);
			//header("Content-Type:$mime");
			if($mime=='image/jpeg'){
			 
			     imagejpeg($thumb,$this->file_save_path."thumb_$number.jpg");
				 $this->thumb_save_path =$this->file_save_path."thumb_$number.jpg";
			
			}else if($mime=='image/gif'){
			
				 imagegif($thumb,$this->file_save_path."thumb_$number.gif");
				 $this->thumb_save_path =$this->file_save_path."thumb_$number.gif";

			}else if($mime=='image/png'){
			
				 imagepng($thumb,$this->file_save_path."thumb_$number.png");
				 $this->thumb_save_path =$this->file_save_path."thumb_$number.png";
			}
			
				
		
		}

	 
	       
	   //����ˮӡͼƬ

	   function make_watermark($save_path)
	   {
		   $pos =$this->position_num;

		   $target_image_info =$this->get_image_info($this->resource_path);

		   $water_image_info =$this->get_image_info($this->watermark_dir);

		   $position =$this->get_position($pos,$target_image_info,$water_image_info);

		   $water_mark = $this->get_image_mark($this->watermark_dir);  //�õ�ˮӡͼƬ�ı�ʶ

		   $target_mark =$this->get_image_mark($this->resource_path);

		   imagecopy($target_mark,$water_mark,$position['width'],$position['height'],0,0,$water_image_info['width'],$water_image_info['height']);

		   $filename =mt_rand(1000,9999);
		   $mime =$target_image_info['MIME'];
		   header("Content-Type:$mime");

		   if($mime=='image/jpeg'){
			 
			     imagejpeg($target_mark,$save_path."w_$filename.jpg");
			
			}else if($mime=='image/gif'){
			
				 imagegif($target_mark,$save_path."w_$filename.gif");

			}else if($mime=='image/png'){
			
				 imagepng($target_mark,$save_path."w_$number.png");
			}

		  imagedestroy($target_mark);

            
	   }


	   /**
	    * @param $pos int λ��״̬��ʶ
		* @param $target_img array Ŀ��ͼƬ�Ĵ�С��Ϣ
		* @param $water_img array ˮӡͼƬ�Ĵ�С��Ϣ
		* @ return ����ˮƽͼƬ��λ������
		*/

	 function get_position($pos,$target_img,$water_img)
	 {
		$position =array();
		switch($pos)
		{
			case '1':    //���Ͻ�
                $position['width'] =0;
				$position['height']=0;
				break;

		  case '2':  //�����м�λ��
              $position['width'] =($target_img['width']-$water_img['width'])/2;
			  $position['height'] =0;
			  break;

		  case '3': //���Ͻ�
              $position['width']=$target_img['width']-$water_img['width'];
			  $position['height']=0;
			  break; 

		  case '4':  //�м�ƫ��
              $position['width']=0;
			  $position['height']=($target_img['height']-$water_img['height'])/2;
			  break;
		  
		 case '5'; //�м�λ��
		     $position['width'] =($target_img['width']-$water_img['width'])/2;
			 $position['height']=($target_img['height']-$water_img['height'])/2;
		   break;

		  case '6':  //�м�ƫ��
			  $position['width']=$target_img['width']-$water_img['width'];
		      $position['height']=($target_img['height']-$water_img['height'])/2;
			  break;

		  case '7':  //���½�
			  $position['width'] =0;
		      $position['height']=$target_img['height']-$water_img['height'];
			  break;

		  case '8';  //�����м�λ��
		     $position['width']=($target_img['width']-$water_img['width'])/2;
			 $position['height']=$target_img['height']-$water_img['height'];
		     break;
		  case '9':
			  $position['width']=$target_img['width']-$water_img['width'];
		      $position['height']=$target_img['height']-$water_img['height'];
			  break;
		   default:
			     $position['width']=0;
		         $position['height']=0;
		}

		 return $position;
	}
	
	
	}




?>