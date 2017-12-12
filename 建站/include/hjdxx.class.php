<?php
	class HJDXX
	{
	//hjdxx类开始		

		//截取字符串
	function SubTitle($String,$Length) { 
      if (mb_strwidth($String, 'UTF8') <= $Length ){ 
          return $String; 
      }else{ 
          $I = 0; 
          $len_word = 0; 
          while ($len_word < $Length){ 
              $StringTMP = substr($String,$I,1); 
              if ( ord($StringTMP) >=224 ){ 
                  $StringTMP = substr($String,$I,3); 
                  $I = $I + 3; 
                  $len_word = $len_word + 2; 
              }elseif( ord($StringTMP) >=192 ){ 
                  $StringTMP = substr($String,$I,2); 
                  $I = $I + 2; 
                  $len_word = $len_word + 2; 
              }else{ 
                  $I = $I + 1; 
                  $len_word = $len_word + 1; 
              } 
              $StringLast[] = $StringTMP; 
          } 

          if (is_array($StringLast) && !empty($StringLast)){ 
              $StringLast = implode("",$StringLast); 
              $StringLast .= "..."; 
          } 
          return $StringLast;   
      }   
}   
//-	---------------------------------------------------------------如果是44输出44.00,如是44.5输出44.50,如是44.53输出44.53
		
		function price_hko($price){
		 $email = round($price,2); 
		 $domain_p = strstr($email, '.');
		 $domain = substr($domain_p,0,1);
		 if($domain=="." && strlen($domain_p) == 3){
		 	$price_retu=$price;
		 }else if($domain=="." && strlen($domain_p) == 2){
		 	$price_retu=$price."0";
		 }else{
		 	$price_retu=$price.".00";
		 }
		 return $price_retu;
		}
//等比例切图
function file_group($filelj,$width,$height){
 $suijishu = rand(100,999);                            //取一个100--999的随机数；
 $xfilej=time().$suijishu.substr($filelj,7,200);
 $fileljp=$filelj;//图片路径，根据实际情况修改，要相对路径!!!!!!!!!!!!!
 $image=$fileljp;//图片路径 
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
 imagejpeg($newim, "../grouppic/".$xfilej, 100);//加个100可以更清晰
	//截取图片       此处为调用页面的grouppic文件的相对路径
	return "/admin/grouppic/".$xfilej;//返回因为绝对路径
}
//简单分页	
function fenye($cxsql,$mys)		
		{
		
				$mys=$mys;
				$rs=mysql_query($cxsql);
				$zts=mysql_num_rows($rs);
				if($zts==0)
				{
					$zts=1;	
				}		
				
				$zys=ceil($zts/$mys);

				$dqy=$_GET[dqy];
				if($dqy=="" || $dqy<1)
				{
					$dqy=1;	
				}
				if($dqy>$zys)
				{
					$dqy=$zys;	
				}
				$myys=($dqy-1)*$mys;
				$fenye=array("mys"=>"$mys","zys"=>"$zys","zts"=>"$zts","dqy"=>"$dqy","myys"=>"$myys");
				return $fenye;
							
		}
//过滤		
function pregstring( $str ){
$strtemp = trim($str);
$search = array(
"|'|Uis",
"|<script[^>]*?>.*?</script>|Uis", // 去掉 javascript
"|<[\/\!]*?[^<>]*?>|Uis",    // 去掉 HTML 标记
"'&(quot|#34);'i",      // 替换 HTML 实体
"'&(amp|#38);'i",
"|,|Uis",
"|[\s]{2,}|is",
"[&nbsp;]isu",
"|[$]|Uis",
);
$replace = array(
"`",
"",
"",
"",
"",
"",
" ",
" ",
" dollar ",
);
$text = @preg_replace($search, $replace, $strtemp);
return $text;
}		
		
//广告
function Adver($id,$title)
	{
		$rs=mysql_query("select * from advertising where id = '$id'");
		$rows=mysql_fetch_array($rs);
		return $rows[$title];
	}
//db 之mysql_fetch_array()
function fetch_array($rs)
	{
			//$rows=mysql_fethc_array($rs)
			$riws=mysql_fetch_array($rs);
			
			return $riws;
	}
//db 之get_one()
function get_one($rs)
	{
		$rs=mysql_query($rs);
		$retur=mysql_fetch_array($rs);
		return $retur;	
	}
//db 之 num_rows
function num_rows($sql){
			return mysql_num_rows($sql);
	}
//
	

//url 加密
function jiami($str)
	{
		$str=urlencode($str);
		return $str;
		
	}




		
		
		
		
		
//hjdxx类结束		
}
	
	
	

?>