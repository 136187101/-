<?php
require_once("../../include/global.php");
require_once("../session.php");
//echo $values; exit;
$sql = "update news_zilei set xiangmu='$values' where id = $id";
$db->setquery($sql);
if($db->query()){
echo "保存成功";
}else{
echo "出错啦！";
}
?>
