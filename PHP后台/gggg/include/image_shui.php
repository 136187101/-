<?php
	$imgi=$_GET["img"];
	$act=$_GET["act"];
	$title=$_GET["title"];
	if($act=="op"){
		$image="../$imgi";//图片路径
		$info=getimagesize($image);
        $width=$info[0];
        $height=$info[1];

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
		//$newim=imagecreatetruecolor(264,173); //剪切图片第一步，建立新图像 x就是宽 ，y就是高//图片大小
		//imagecopyresampled($newim,$im,0,0,0,0,264,173,264,173);//这个函数不失真
		$te=imagecolorallocatealpha($im,255,255,0,0);//颜色
		$str=iconv("UTF-8","UTF-8","$title");//确定要绘制的文字，，将gbk转换成UTF-8的编码
		imagettftext($im,30,0,$width/2,$height,$te,"simkai.ttf",$str);//绘制中文，，，绘制的图片，字大小，字角度，x轴，y轴，颜色，字体，内容
		header("Content-type: image/jpeg");//定义要输出的类型
		imagejpeg($im);//加个100可以更清晰
	}
?>
