<?php
class liwqbjtt{
	var $js;
	function liwqbjtt(){
	 global $js;
	 $this->js = $js;
	}
	function liwqbj_strlwq($string, $sublen, $start = 0, $code = 'UTF-8') 
	{ 
	if($code == 'UTF-8') 
	{ 
		   $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
		   preg_match_all($pa, $string, $t_string); 
		   if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."&nbsp;......";//."......" 
		   return join('', array_slice($t_string[0], $start, $sublen)); 
	} 
	else 
	{ 
		   $start = $start*2; 
		   $sublen = $sublen*2; 
		   $strlen = strlen($string); 
		   $tmpstr = ''; 
	
		   for($i=0; $i< $strlen; $i++) 
		   { 
			 if($i>=$start && $i< ($start+$sublen)) 
			 { 
				if(ord(substr($string, $i, 1))>129) 
				{ 
					   $tmpstr.= substr($string, $i, 2); 
				} 
				else 
				{ 
					   $tmpstr.= substr($string, $i, 1); 
				} 
			 } 
			 if(ord(substr($string, $i, 1))>129) $i++; 
		   } 
		   if(strlen($tmpstr)< $strlen ){ $tmpstr.= "";}else{ $tmpstr.= ""; } //"......."
		   return $tmpstr; //$str = "abcd需要截取的字符串"; echo cut_str($str, 5, 0, 'gb2312'); 
		} 
	}
	
	
	
	function liwqbj_str($string, $sublen, $start = 0, $code = 'UTF-8') 
	{ 
	if($code == 'UTF-8') 
	{ 
		   $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
		   preg_match_all($pa, $string, $t_string); 
		   if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."......";//."......" 
		   return join('', array_slice($t_string[0], $start, $sublen)); 
	} 
	else 
	{ 
		   $start = $start*2; 
		   $sublen = $sublen*2; 
		   $strlen = strlen($string); 
		   $tmpstr = ''; 
	
		   for($i=0; $i< $strlen; $i++) 
		   { 
			 if($i>=$start && $i< ($start+$sublen)) 
			 { 
				if(ord(substr($string, $i, 1))>129) 
				{ 
					   $tmpstr.= substr($string, $i, 2); 
				} 
				else 
				{ 
					   $tmpstr.= substr($string, $i, 1); 
				} 
			 } 
			 if(ord(substr($string, $i, 1))>129) $i++; 
		   } 
		   if(strlen($tmpstr)< $strlen ){ $tmpstr.= ".......";}else{ $tmpstr.= ""; } //"......."
		   return $tmpstr; //$str = "abcd需要截取的字符串"; echo cut_str($str, 5, 0, 'gb2312'); 
		} 
	}
function pregstring( $str ){
$strtemp = trim($str);
$search = array(
"|’|Uis",
"|<script[^>]*?>.*?</script>|Uis", // 去掉 javascript
"|<[\/\!]*?[^<>]*?>|Uis",    // 去掉 HTML 标记
"‘&(quot|#34);’i",      // 替换 HTML 实体
"‘&(amp|#38);’i",
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

	
/* 替换标签函数*/	
function liwqbj_shtml($str){
		$str = str_replace(" ", "&nbsp;",$str);
		$str = str_replace("\r\n", "<br />",$str);
		$str = str_replace("\r", "<br />",$str);
		$str = str_replace("\n", "<br />",$str);
		$str = str_replace("&lt;", "<",$str); 
		return $str;
}	
function liwqbj_html($str){   //清除HTML标签
	$st=-1; //开始
	$et=-1; //结束
	$stmp=array();
	$stmp[]="&nbsp;";
	$len=strlen($str);
	for($i=0;$i<$len;$i++){
	   $ss=substr($str,$i,1);
	   if(ord($ss)==60){ //ord("<")==60
		$st=$i;
	   }
	   if(ord($ss)==62){ //ord(">")==62
		$et=$i;
		if($st!=-1){
		 $stmp[]=substr($str,$st,$et-$st+1);
		}
	   }
	}
	$str=str_replace($stmp,"",$str);
	return $str;
	}

	function liwqbj_check($str){
	 $tmp=eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|and|or|\'|"', $str); // 进行过滤
	 if($tmp){
		$this->js->goto("/admin/index.html");
	 }else{
	  return $str;
	 }
	}
}
?>