<?php header("Content-Type:text/html; charset=utf-8");
require_once("../../include/global.php");
require_once("../include/function.php");
$xid = $_GET["xid"];
$imweb_time = 61;//大于这个秒数，判断不在线

$rs = $db->get_one("select xname,user_file,imtime from xues_main where id='$xid'");
if(web_im_time_act($rs["imtime"],$imweb_time) < $imweb_time){$imtime = 1;}else{$imtime = 0;}

echo "{ xname : \"".$rs['xname']."\" , user_file : \"".user_file_all($rs["user_file"])."\" , imtime : \"".$imtime."\"}" 
?>
