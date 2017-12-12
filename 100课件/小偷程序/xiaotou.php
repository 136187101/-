<?php
$url="http://tq121.weather.com.cn/icbc/detail.php";//目标站
$fp=@fopen($url,"r") or die("超时");
$focontent=file_get_contents($url);//获取某个URL的内容
eregi("ottom\"><img src=\"images/shenghuo.gif(.*)src=\"images/jibing.gif",$focontent,$ar);
$ar[0]=str_replace("src=\"images/","src=\"http://tq121.weather.com.cn/icbc/images/",$ar[0]);
echo $ar[0];
?>