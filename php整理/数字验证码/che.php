<?php 
	session_start();
	header("Content-type:image/png");
	$im=imagetype("2005617193712391.jpg");
	function imagetype($image){
		$img=getimagesize($image);
		
		switch ($img[2])
		{
			case 1;
			$im=imagecreatefromgif($image);
			break;
			case 2;
			$im=imagecreatefromjpeg($image);
			break;
			case 3;
			$im=imagecreatefrompng($image);
			break;
		}
		
		return $im;
		
	}
	$cheimg=imagecreatetruecolor(70, 25);
	imagecopyresized($cheimg, $im, 0, 0, rand(0,905), rand(0,738),1024,768,1024,768);
	
	for($i=0;$i<8;$i++)
	{
		$sjs=imagecolorallocate($cheimg,rand(0,255),rand(0,255), rand(0,255));
		imageline($cheimg, rand(0,50), rand(0,25),rand(0,70),rand(0,25),$sjs);
	}
	for($i=0;$i<250;$i++)
	{
		$sjs=imagecolorallocate($cheimg,rand(0,255),rand(0,255), rand(0,255));
		imagesetpixel($cheimg,rand(0,70), rand(0,25),$sjs);
	}
	
	$str="a|1|b|2|c|3|d|4|e|5|h|6|k|7|m|8|n|9|o|0|p|q|x|d|u|v|w|x|s|z";
	$strarr=explode("|",$str);
	for($i=0;$i<4;$i++)
	{
		$string.=$strarr[rand(0,count($strarr)-1)];
	}
	$_SESSION[authcode]=$string;
	$sjs=imagecolorallocate($cheimg,rand(0,255),rand(0,255), rand(0,255));
	imagettftext($cheimg, 18, 0,10,20,$sjs,'msyhf.ttf', $string);
	imagepng($cheimg);
?>