<?php
$url="http://new.5jjkk.com/sears/search.php?g_big=1&keyword=%E5%92%B3%E5%97%BD";
@fopen($url,"r")or die ("超时");
$cont=file_get_contents($url);
$cont=str_replace("href=\"/css/newzjwlgr.css","href=\"http://new.5jjkk.com/css/newzjwlgr.css",$cont);
$cont=str_replace("img src=\"/img","img src=\"http://new.5jjkk.com/img",$cont);
eregi("div class=\"center_left_3(.*)v class=\"center_left_3_3",$cont,$as);

echo $as[1];
?>