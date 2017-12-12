<?php
class zjwlgr{
	function wlgr_index($url,$mulu,$filename){
		$html=file($url);
		$page=implode("",$html);
		$root=$_SERVER['DOCUMENT_ROOT'];
		$root.="$mulu";
		if(!file_exists($root)){mkdir($root);}
		$root.="$filename";
		$fp=fopen($root,"w");
		if(fwrite($fp,$page)){
		echo "<script language=javascript> alert('操作成功'); window.back(-1); </script>";
		}
	}
	/*
$wlgr=new zjwlgr();
$df="http://localhost/product/index.php";
$sd="/indelsle/";
$ds="sdfsdfsdf.html";
$resu=$wlgr->wlgr_index($df,$sd,$ds);
*/
//_+_+)+_()(**(&^&*%^&%&*(&)(&*()&%^&#@#%&*^(*&(*&()*_)*_)(+(+_)+|_++_)_)*(+|+_)|+)_)()(&*&^&*^	
function wlgr_one($sql,$urll,$mulu,$file_q,$update){
$wlgr_sql=$sql;
while($wlgr_rs=mysql_fetch_array($wlgr_sql)){
$toid=$wlgr_rs["id"];
$url="$urll";
$url.="$toid";
$wlgr_file=file($url);
$wlgr_implode=implode("",$wlgr_file);
$root=$_SERVER['DOCUMENT_ROOT'];
$root.="$mulu";
if(!file_exists($root)){mkdir($root);}
$root.="$file_q".$toid.".html";
$filename=$file_q.$toid.".html";
mysql_query("update $update set filename='$filename' where id='$toid'");
$wlgr_fp=fopen($root,"w");
if(fwrite($wlgr_fp,$wlgr_implode)){
echo "<font style=font-size:12px; color:#333333;>".$root."&nbsp;&nbsp;成功</font><br>";
}
}
echo "<div align=center><a href=#>返&nbsp;&nbsp;&nbsp;回</a></div>";
}
}
/*
$rr1="/gggggg/";
$rr2="product_";
$rr3="http://localhost/product/sj.php?id=";
$ss=$db->query("select * from product");
$kk="product";
$inde=new zjwlgr();
$kkk=$inde->wlgr_one($ss,$rr3,$rr1,$rr2,$kk);
*/
?>