<?php
session_start();
Header("Content-type: image/PNG");
$str = "a1b2c3d4e5h6k7m8n9o0pqxduvwxsz";
$imgWidth = 70;
$imgHeight = 24;
$authimg = imagecreate($imgWidth,$imgHeight);
$bgColor = ImageColorAllocate($authimg,250,255,255);
$fontfile = "fonts/msyhf.ttf";
$white=imagecolorallocate($authimg,234,185,95);
/*imagearc($authimg, 150, 8, 20, 20, 75, 170, $white);
imagearc($authimg, 180, 7,50, 30, 75, 175, $white);
imageline($authimg,20,20,180,30,$white);
imageline($authimg,20,18,170,50,$white);
imageline($authimg,25,50,80,50,$white);
*/$noise_num = 40;
$line_num = 20;
//imagecolorallocate($authimg,0xcc,0xcc,0xcc);
$rectangle_color=imagecolorallocate($authimg,0xcc,0xAA,0xAA);
$noise_color=imagecolorallocate($authimg,0x00,0x00,0x00);
$font_color=imagecolorallocate($authimg,mt_rand(0,120),mt_rand(0,120),mt_rand(0,120));//杂点
$line_color=imagecolorallocate($authimg,0x00,0x00,0x00);
for($i=0;$i<$noise_num;$i++){
    imagesetpixel($authimg,mt_rand(0,$imgWidth),mt_rand(0,$imgHeight),$noise_color);
}
$randnum=rand(0,strlen($str)-5);
if($randnum%2)$randnum+=1;
$str = substr($str,$randnum,5);
$str = iconv("GB2312","UTF-8",$str);
ImageTTFText($authimg, 14, 0, 6, 19, $font_color, $fontfile, $str);
ImagePNG($authimg);
ImageDestroy($authimg);
$_SESSION['authcode'] = $str;
?>
