<?php
  ///////////购物函数
function insertbag($id) {/////////////////////添加商品
$ses_bag=$_SESSION["ses_bag"]; ///数组结构
$p_id=$id;
$num=(int)$num;
$ses_bag_len=count($ses_bag);
$p=true;
if ($ses_bag_len>0) {
	foreach ($ses_bag as $key=>$val) {
		if ($ses_bag[$key][0]==$p_id) {
			//$ses_bag[$key][1]=(int)$ses_bag[$key][1]+$num;  //////////如果存在则增加数量
			$p=false;
		}
	} 
}
if($p){
$ses_bag[$ses_bag_len][0]=$p_id;
//$ses_bag[$ses_bag_len][1]=$num;
//$ses_bag[$ses_bag_len][2]=$vsize;
//$ses_bag[$ses_bag_len][3]=$color;
//$ses_bag[$ses_bag_len][4]=$price;
}
$_SESSION["ses_bag"]=$ses_bag;
//totalbag();
}


function delbag($did) {/////////////////////////////删除商品
$ses_bag=$_SESSION["ses_bag"]; ///数组结构
$ses_bag_len=count($ses_bag);
if ($ses_bag_len>0) {
foreach ($ses_bag as $key=>$val) {
   if ($ses_bag[$key][0]==$did) {
       unset($ses_bag[$key]);  //////////找到后删除
	   }
}
}
$_SESSION["ses_bag"]=$ses_bag;
/*totalbag();*/
}
function delqk() {/////////////////////////////清空商品
$ses_bag=$_SESSION["ses_bag"]; ///数组结构
$ses_bag_len=count($ses_bag);
if ($ses_bag_len>0) {
foreach ($ses_bag as $key=>$val) {
       unset($ses_bag[$key]);  //////////找到后删除
}
}
$_SESSION["ses_bag"]=$ses_bag;
/*totalbag();*/
}
/*function updatebag($id,$num) {/////////////////////更新商品
session_start();
$ses_bag=$_SESSION["ses_bag"]; ///数组结构
$p_id=$id;
$num=(int)$num;
$ses_bag_len=count($ses_bag);
if ($ses_bag_len>0) {
foreach ($ses_bag as $key=>$val) {
   if ($ses_bag[$key][0]==$p_id) {
       $ses_bag[$key][1]=(int)$num;  //////////如果存在则更新数量
	   }
} }
$_SESSION["ses_bag"]=$ses_bag;
totalbag();
}*/


/*function totalbag() {/////////////////////计算总数
session_start();
$ses_bag=$_SESSION["ses_bag"]; ///数组结构
$cost=0;
$goods_num=0;
$ses_bag_len=count($ses_bag);
if ($ses_bag_len>0) {
foreach ($ses_bag as $key=>$val) {
        $cost=$cost+($ses_bag[$key][1]*$ses_bag[$key][4]);
		$goods_num=$goods_num+$ses_bag[$key][1];
} }
$_SESSION["ses_cost"]=$cost;
$_SESSION["ses_goods_num"]=$goods_num;
}
*/////////////////////////////////////////////////////////
?>
