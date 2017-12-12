<?php 
session_start();
/********网站根目录**********/
@header('Content-type: text/html;charset=utf-8');

define('SITE_ROOT',str_replace('\\','/',dirname(__FILE__)));
error_reporting(E_ALL&~E_NOTICE);
/* 初始化设置 */
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);


/*******时间设置**********/
date_default_timezone_set('PRC');


/*********载入函数和类库***********/
//require(SITE_ROOT.'/include/functions.php');  //得到用户真是IP  跳转提示功能  记录登录退出操作  GPC过滤
require(SITE_ROOT.'/config.php');  		//包含数据库
require(SITE_ROOT.'/Mysql.class.php');  //数据库操作类
require(SITE_ROOT.'/cart.class.php');  //购物车
require(SITE_ROOT.'/Image.class.php');  //图片缩放\图片打水印类
require(SITE_ROOT.'/js.class.php');  // 常用JS
require(SITE_ROOT.'/Upload.class.php');  // 文件上传类
require(SITE_ROOT.'/uploadFiles.php');  // 上传文件大小类
require(SITE_ROOT.'/page.class.php');  // 分页类   
require(SITE_ROOT.'/lib_goods.php');  // 得到一个带缩进的分类树 返回一个分类树 检查分类是否存在子类 取得上级分id  得到品牌列表
require(SITE_ROOT.'/emailhtml.class.php'); //邮件发送类
require(SITE_ROOT.'/verifyImage.class.php');  // 验证码类
require(SITE_ROOT.'/lib_validate.php');  // 正则验证类
require(SITE_ROOT.'/liwqbj.class.php');  // 截取字符串和去掉HTML标签
require(SITE_ROOT.'/index.class.php');  // 前台调用的函数
require(SITE_ROOT.'/product.class.php');  // 前台调用的函数
require("hjdxx.class.php");
require("pageclass.php");
/**********对用户输入的变量进行转义**********/
if(!get_magic_quotes_gpc())
{
	$_GET =new_addslashes($_GET);
	$_POST =new_addslashes($_POST);
	$_COOKIE =new_addslashes($_COOKIE);
	
}

/*********定义各个文件目录************/

//define('Upload_PATH',SITE_ROOT.'/uploadfiles/');
//define('Core_Class',SITE_ROOT.'/core/lib/');
//define('Functions_PATH',SITE_ROOT.'core/common/');



/***********初始化数据库  和常用类*************/
$db = new mysql($CFG['host'],$CFG['user_name'],$CFG['user_password'],$CFG['dbname']);
$js = new JS();
$lwq=new liwqbjindex();
$hjd = new HJDXX();

$date=date("Y-m-d H:i:s");
$web_sz=$db->getOne("select * from site_info where id = '1'");

function upload($file_name,$path,$pub,$size=1048576){
	$type        = implode(",",$pub);
	$root        = $_SERVER['DOCUMENT_ROOT'];                //查找站点根路径
	$image       = $_FILES[$file_name];                      //接收文件域的值（一个数组）
	$upload_path = $root.$path;                              //设置上传文件位置
	$leixing     = strtolower(strrchr($image['name'],"."));  //把上传的文件名"."以后的部分全部小写（取得文件的扩展名）
	$suijishu    = rand(100,999);                            //取一个100--999的随机数；
	$server_file = time().$suijishu.$leixing;                //取得上传文件名(时间戳加随机数加扩展名)
	if (in_array($leixing,$pub))
	{                           //判断扩展名，（设置上传类型）
		 //计算上传文件的kb数
		 $sizelegth=substr($size,0,-3)."kb";
		 if ($image['size'] > $size){                            //比较上传文件大小和甚至的大小
			echo "<script language='javascript'>";
			echo "alert(\"你上传得文件太大，请不要超过{$sizelegth}\");";
			echo "window.history.go(-1);";
			echo "</script>";
			exit;
		 }
		$wenjia = 0;
		 if (file_exists($upload_path.$image[name]) && !$wenjia){  //判断文件名是否存在
			echo "<script language='javascript'>";
			echo "alert(\"存在相同文件名的文件\");";
			echo "window.history.go(-1);";
			echo "</script>";
			exit; 
		 }
		 $name=iconv("UTF-8","gb2312", $image[name]);     
		 if (!move_uploaded_file($image['tmp_name'],$upload_path.$name)){//上传文件
			echo "<script language='javascript'>";
			echo "alert('上传文件失败，请从新上传');";
			echo "window.history.go(-1);";
			echo "</script>";
			exit; 
		 }
	}else{
		echo "<script language='javascript'>";
		echo "alert(\"上传文件类型不支持，请上传'".$type."'类型的文件\");";
		echo "window.history.go(-1);";
		echo "</script>";
		exit; 
	}
	$name=iconv("gb2312","UTF-8", $name);
	return $path.$name;                 //返回文件名(含路径)
}

		

?>