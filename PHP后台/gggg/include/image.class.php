<?php
class Image{
	var $allowType = array('.jpg','.png','.gif','.jpeg','.wmv','.avi','.mp4','.doc','.txt','.rar');  //允许上传的类型
	var $allowSize = 9000000000;				//允许上传的最大值
	var $img = null;	//图片属性
	var $uploadPath;	//上传地址
	var $imgType;		//上传图像的类型
	var $imgName;		//文件名称
	var $root = null;	//站点跟路径
	
	function Image( $input , $uploadPath){
		global $_SERVER,$_FILES;
		$this->img = $_FILES[$input];			//获取本地上传的信息
		$this->root = $_SERVER['DOCUMENT_ROOT']."/bwsx";
		//$this->roots = dirname(__FILE__);
		$this->uploadPath = $uploadPath;		//要存入的文件夹地址
		$this->imgType = strtolower(strrchr($this->img[name],".")); //上传文件的类型
		$this->imgName =rand(100000,999999).$this->imgType;		//上传文件的名字
	}
	
	function upload(){
		if(!$this->img[name]) return false; //判断是否有上传内容
		if(!in_array($this->imgType,$this->allowType))  $this->Err("您的类型不正确，请上穿'".implode(",",$this->allowType)."'");
		if($this->img[size] > $this->allowSize) 		$this->Err("上传的大小不应该超过500k");
		if(!is_dir($this->root."/".$this->uploadPath))	$this->CreateDir($this->root."/".$this->uploadPath );	//创建文件夹
		if( move_uploaded_file( $this->img[tmp_name] , $this->root."/".$this->uploadPath ."/".$this->imgName) ){
			return true;
		}else{
			$this->Err("上传失败请重试");
		}
	}
	function getImgPath(){
		//返回根其图片路径
		return "/bwsx/".$this->uploadPath."/".$this->imgName;
	}
	function CreateDir($dir, $mode = 0777)
	{
		if (is_dir($dir) || @mkdir($dir,$mode)) return TRUE;
		if (!$this->CreateDir(dirname($dir),$mode)) return FALSE;//用递归创建多层目录
		return mkdir($dir,$mode);
	}
	function Err( $msg ){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb3212\" />";
		echo "<script language='javascript'>"
			."\n alert(\"".$msg."\");"
			."\n window.history.go(-1);"
			."\n </script>";
		exit;	
	}
}
class CImage
{
    var $src_image;
    var $width;
    var $height;
    var $image_type;
    var $img;
    var $src_x;
    var $src_y;
    
    function __construct($image_file)
    {
        $info=GetImageSize($image_file);
        $this->src_image=$image_file;
        $this->width=$info[0];
        $this->height=$info[1];
        
        switch($info[2])
        {
            case 1:
                $this->image_type="gif";
                break;
            case 2:
                $this->image_type="jpeg";
                break;
            case 3:
                $this->image_type="png";
                break;
			case 4:
                $this->image_type="wmv";
                break;
            default:
                return false;
                echo("Unsurport Image type.");
                break;
        }    //swith end
        echo "ok";
        $new_function='ImageCreateFrom'.ucfirst($this->image_type);
        $this->img=$new_function($this->src_image);
        $this->src_x=ImageSX($this->img);
        $this->src_y=ImageSY($this->img);
    }
    function thumb($image_dist,$x)        //$x为新图的限制边的尺寸
    {        
        $src_x=ImageSX($this->img);
        $src_y=ImageSY($this->img);
        $scale=min($x/$src_x,$x/$src_y);
    
        if($scale<1)
        {
            $new_x=floor($scale*$src_x);
            $new_y=floor($scale*$src_y);
            $img_tmp=ImageCreateTrueColor($new_x,$new_y);    //set the size of Canvas for the new Image
            ImageCopyResampled($img_tmp,$this->img,0,0,0,0,$new_x,$new_y,$src_x,$src_y);    //Resampled
            ImageDestroy($this->img);
            $new_function="Image".ucfirst($this->image_type);

            return $new_function($img_tmp,$image_dist);
        }
    }    //  thumb end
    
    function image_press($image_dist,$str,$font="simkai.ttf")    //给图片生成文字水印
    {        
        $str=iconv("GB2312","utf-8",$str);            
        $blue=ImageColorAllocate($this->img,90,255,255);
        $white=ImageColorAllocate($this->img,255,0,0);
        ImageTTFText($this->img,20,0,$this->src_x/2/2,$this->src_y-80,$white,$font,$str);
        $new_function="Image".ucfirst($this->image_type);
        return $new_function($this->img,$image_dist);        
    }

    function rotate($image_dist,$angle)
    {
        $img_tmp=null;
        $new_function="Image".ucfirst($this->image_type);
        if(($angle!=90)&&($angle!=180)&&($angle!=270))
        {
            echo("Un-valid angle on calling CImage::rotate(\$image_dist,\$angle) .<p>The valid angle must be 90 or 180 or 270.");
            return false;
        }

        if(($angle==90)||($angle==270)) 
        {
            $img_tmp=ImageCreateTrueColor($this->src_y,$this->src_x);
        }
        else
        {
            $img_tmp=ImageCreateTrueColor($this->src_x,$this->src_y);
        }
        
        switch($angle)
        {
            case 90:
                for($i=0;$i<$this->src_x;$i++)
                {
                    for($j=0;$j<$this->src_y;$j++)
                    {
                        @ImageSetPixel($img_tmp,$this->src_y-$j-1,$i,ImageColorAt($this->img,$i,$j));    
                    }
                }    
                return $new_function($img_tmp,$image_dist);
                break;

            case 180:
                for($i=0;$i<$this->src_x;$i++)
                {
                    for($j=0;$j<$this->src_y;$j++)
                    {
                        ImageSetPixel($img_tmp,$this->src_x-$i-1,$this->src_y-$j-1,ImageColorAt($this->img,$i,$j));    
                    }
                }
                return $new_function($img_tmp,$image_dist);
                break;

            case 270:
                for($i=0;$i<$this->src_x;$i++)
                {
                    for($j=0;$j<$this->src_y;$j++)
                    {
                        ImageSetPixel($img_tmp,$j,$this->src_x-$i-1,ImageColorAt($this->img,$i,$j));    
                    }
                }
                return $new_function($img_tmp,$image_dist);
                break;
        }    //end switch
        
    }        //end rotate
    
   function rotate_h($image_dist)
    {
        $new_function="Image".ucfirst($this->image_type);
        $img_tmp=ImageCreateTrueColor($this->src_x,$this->src_y);
        ImageCopyResampled($img_tmp,$this->img,0,0,$this->src_x-1,0,$this->src_x,$this->src_y,-$this->src_x,$this->src_y);    //水平翻转
        return    $new_function($img_tmp,$image_dist);    
    }
    
    function rotate_v($image_dist)
    {
		$new_function="Image".ucfirst($this->image_type);
		$img_tmp=ImageCreateTrueColor($this->src_x,$this->src_y);
		ImageCopyResampled($img_tmp,$this->img,0,0,0,$this->src_y-1,$this->src_x,$this->src_y,$this->src_x,-$this->src_y);
		return $new_function($img_tmp,$image_dist);
    }    
}

?>
