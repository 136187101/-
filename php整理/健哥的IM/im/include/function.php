<?php

if($cookie_xsuid == ""){die("请重新登录");}
//=============================================
function user_file_all($user_file){
		$root=$_SERVER['DOCUMENT_ROOT'];
		if(strlen($user_file) <= 0 || file_exists($root.$user_file) != 1){
			$msgimg = "/im/img/1.gif";
		}else{
			$msgimg = $user_file;
		}
		return $msgimg;
	}
//-----------------------------------------------------------------------得到好友的头像
function delEmpty($v){
	global $cookie_xsuid;
	if ($v=="" || $v==$cookie_xsuid){
		return false;   
	}   
	return true;   
} 
//---------------------------------------------------------------------的第二个参数
function web_im_time($db,$uid){
	if($uid != ""){
		$db->update("update xues_main set imtime='".time()."' where id='$uid'");
	}
}
//-------------------------------------------------更新用户在线最后的时间
function web_im_time_act($imtime,$webtime){
	if($imtime == 0){
		return $webtime;
	}else{
		$act_time = time() - $imtime;
		return $act_time;
	}
}
//---------------------------------------返加一个秒数，，判断用户是否在，如。。如果大于60就不在线
function IM_Upload($file_name,$path,$pub,$size=1048576){
	$type        = implode(",",$pub);
	$root        = $_SERVER['DOCUMENT_ROOT'];                //查找站点根路径
	$image       = $_FILES[$file_name];                      //接收文件域的值（一个数组）
	$upload_path = $root.$path;                              //设置上传文件位置
	$leixing     = strtolower(strrchr($image['name'],"."));  //把上传的文件名“.”以后的部分全部小写（取得文件的扩展名）
	$suijishu    = rand(100,999);                            //取一个100--999的随机数；
	$server_file = time().$suijishu.$leixing;   //取得上传文件名(时间戳加随机数加扩展名)
	$size_alert = $size / 1000;
	if (in_array($leixing,$pub)){                           //判断扩展名，（设置上传类型）
		 if ($image['size'] > $size){                            //比较上传文件大小和甚至的大小
			return "你上传得文件太大，请不要超过".$size_alert."K";
			exit;
		 }elseif (!move_uploaded_file($image['tmp_name'],$upload_path.$server_file)){//上传文件
			return "上传文件失败，请从新上传";
			exit;
		 }
	}else{
		return "上传文件类型不支持，请上传'".$type."'类型的文件";
		exit;
	}
	return $path.$server_file;                 //返回文件名(含路径)
}
//---------------------------------------------------------------------------------------IM 上传图片
function IM_file_group($filelj,$width,$height){
	$xfilej=substr($filelj,17,40);
	$fileljp=$filelj;
	$image="..".substr($fileljp,3,40);//图片路径
	$img=getimagesize($image);//载入图片的函数   得到图片的信息
	switch($img[2]){//判断图片的类型
		case 1:
			$im=@imagecreatefromgif($image);//载入图片，创建新图片
		break;
		case 2:
			$im=@imagecreatefromjpeg($image);
		break;
		case 3:
			$im=@imagecreatefrompng($image);
		break;
	}
	$width_y=$img[0];
	$height_y=$img[1];
	if($width_y>$height_y){//如果宽大于高
		$width_y_y=$height_y;
		$height_y_y=$height_y;
		$jq_x=($width_y-$height_y)/2;
		$jq_y=0;
	}else if($width_y<$height_y){//如果宽小于高
		$height_y_y=$width_y;
		$width_y_y=$width_y;
		$jq_x=0;
		$jq_y=($height_y-$width_y)/2;
	}else if($width_y=$height_y){//如果宽小于高
		$width_y_y=$width_y;
		$height_y_y=$height_y;
		$jq_x=0;
		$jq_y=0;
	}
	$newim=imagecreatetruecolor($width,$height); //剪切图片第一步，建立新图像 x就是宽 ，y就是高//图片大小
	imagecopyresampled($newim,$im,0,0,$jq_x,$jq_y,$width,$height,$width_y_y,$height_y_y);//这个函数不失真
	imagejpeg($newim, "../uploadimages/".$xfilej, 100);//加个100可以更清晰
}
//-----------------------------------------------------------------------------------------------------------------正方形的图片
function IM_fileimage($filelj){
	$xfilej="d".substr($filelj,17,40);
	$fileljp=$filelj;
	$image="..".substr($fileljp,3,40);//图片路径
		$img=getimagesize($image);//载入图片的函数   得到图片的信息
		//var_dump($img);//可以打印出数组，查看载入图片的信息
		switch($img[2]){//判断图片的类型
			case 1:
				$im=@imagecreatefromgif($image);//载入图片，创建新图片
			break;
			case 2:
				$im=@imagecreatefromjpeg($image);
			break;
			case 3:
				$im=@imagecreatefrompng($image);
			break;
		}
		$width_y_y=$img[0];
		$height_y_y=$img[1];
		if($width_y_y>600 || $height_y_y>600){
		//得出高的比例   原图高\(原图宽\要求宽)
			if($height_y_y>600){
				$width=round($width_y_y/($height_y_y/600));
				$height=600;
			}
			if($width_y_y>600){
				$width=600;
				$height=round($height_y_y/($width_y_y/600));
			}
		}else{
			$width = $width_y_y;
			$height = $height_y_y;
		}
		//如果图片宽度大于600或高度大于600才执行以下程序
		$newim=imagecreatetruecolor($width,$height); //剪切图片第一步，建立新图像 x就是宽 ，y就是高//图片大小
		imagecopyresampled($newim,$im,0,0,0,0,$width,$height,$width_y_y,$height_y_y);//这个函数不失真
		//剪切图片第二步，开始，，，新图像，原始图像，x-y剪切的时候从什么地方开始对齐，x-y从什么地方开始缩略，宽-高新图片的宽和高,宽-高旧图片的宽和高
		imagejpeg($newim, "../uploadimages/".$xfilej, 100);//加个100可以更清晰
		
}
//----------------------------------------------------------------------------------------------宽高小于600的图片
function IM_t2h($str){
	$str = htmlspecialchars($str);
	$str = str_replace(" ", "&nbsp;", $str);
	$str = str_replace("\r\n", "<br />", $str);
	$str = str_replace("\r", "<br />", $str);
	$str = str_replace("\n", "<br />", $str);
	return $str;
}
//---------------------------------------------------------转换可输出的

?>