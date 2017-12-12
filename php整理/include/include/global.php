<?php
$cookie_uid=$_COOKIE["uidd"];
require_once("sql_config.php");
require_once("db_mysql.php");
require_once("js.class.php");
require_once("zjwlgr.class.php");
require_once("group.class.php");
$db = new DB($dbhost, $dbuser, $dbpw, $dbname, $pconnect);
$js	= new JS();
$zj	= new ZJWLGR();
$gr = new GROUP();
$zj->set_get_post();//防注入函数过滤掉了get.post里面的非法字符




function Char_cv($msg){
	$msg = str_replace('&amp;','&',$msg);
	$msg = str_replace('&nbsp;',' ',$msg);
	$msg = str_replace('"','&quot;',$msg);
	$msg = str_replace("'",'&#39;',$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);
	$msg = str_replace("\t"," &nbsp; &nbsp;",$msg);
	$msg = str_replace("\r","",$msg);
	$msg = str_replace("   "," &nbsp; ",$msg);
	return $msg;
}
function Upload($file_name,$path,$pub,$size=1048576){
	$type        = implode(",",$pub);
	$root        = $_SERVER['DOCUMENT_ROOT'];                //查找站点根路径
	$image       = $_FILES[$file_name];                      //接收文件域的值（一个数组）
	$upload_path = $root.$path;                              //设置上传文件位置
	$leixing     = strtolower(strrchr($image['name'],"."));  //把上传的文件名“.”以后的部分全部小写（取得文件的扩展名）
	$suijishu    = rand(100,999);                            //取一个100--999的随机数；
	$server_file = time().$suijishu.$leixing;                //取得上传文件名(时间戳加随机数加扩展名)
	if (in_array($leixing,$pub))
	{                           //判断扩展名，（设置上传类型）
		 if ($image['size'] > $size){                            //比较上传文件大小和甚至的大小
			echo "<script language='javascript'>";
			echo "alert(\"你上传得文件太大，请不要超过200K\");";
			echo "window.history.go(-1);";
			echo "</script>";
			exit;
		 }
		$wenjia = 0;               
		 if (file_exists($upload_path.$server_file) && !$wenjia){  //判断文件名是否存在
			echo "<script language='javascript'>";
			echo "alert(\"存在相同文件名的文件\");";
			echo "window.history.go(-1);";
			echo "</script>";
			exit; 
		 }
		 if (!move_uploaded_file($image['tmp_name'],$upload_path.$server_file)){//上传文件
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
	return $path.$server_file;                 //返回文件名(含路径)
}

//========================================================================
//========================================================================
function SubTitle($String,$Length) {  //截取字符串 
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
        /* raywang edit it for dirk for (es/index.php)*/   
        if (is_array($StringLast) && !empty($StringLast)){   
            $StringLast = implode("",$StringLast);   
            $StringLast .= "...";
        }   
        return $StringLast;
    }    
}
function img_mov_fla($db,$gr,$th_id){//提取话题中的视频
	$rs = $db->get_one("select images,movie,flash,content from img_mov_fla_id where qid='$th_id' and type='thread'");
	if(strlen($rs["movie"])>0){
		$strsub_movie = "<div class=\"movie_zong\"><div class=\"movie_xmtz_1\">
<dl class=\"movie_xmtz_1_dl\"><a href=\"javascript:void(0);\" class=\"movie_xmtz_1_a\"><img src=\"/newimg/sww4.gif\" /></a><embed src=\"".$rs["movie"]."\" type=\"application/x-shockwave-flash\" id=\"sd\" width=\"500\" height=\"380\" wmode=\"opaque\" autostart=\"false\" loop=\"true\" /></dl>
</div><div class=\"movie_xmtz_2\"><a href=\"javascript:void(0);\" class=\"movie_xmtz_2_a\"></a><img src=\"/newimg/movie.jpg\" /></div></div>";
	}
	if(strlen($rs["flash"])>0){
		$strsub_flash = "<div class=\"movie_zong\"><div class=\"movie_xmtz_1\">
	<dl class=\"movie_xmtz_1_dl\"><a href=\"javascript:void(0);\" class=\"movie_xmtz_1_a\"><img src=\"/newimg/sww4.gif\" /></a><embed src=\"".$rs["flash"]."\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"380\" wmode=\"opaque\" quality=\"high\" /></dl>
	</div><div class=\"movie_xmtz_2\"><a href=\"javascript:void(0);\" class=\"movie_xmtz_2_a\"></a><img src=\"/newimg/flash.jpg\" /></div></div>";
	}
	$zhong_he = $strsub_movie.$strsub_flash;
	return $zhong_he;
}
//----------------------------------------------------------创建cookie------------------------------------------------------------------
if($_COOKIE["ipnnk"]==""){//如果coolie为空，执行以下，否则加到ip后
	$suijishu=rand(100,999);//三位随机数
	$typeid_ja=$suijishu.time();//当前时间
	setcookie("ipnnk",$typeid_ja,time()+3600*9999,"/");//给cookie赋值
}
$typeid_jifud=$_COOKIE["ipnnk"];//读取cookie
$ipyocjg=$_SERVER["REMOTE_ADDR"].$typeid_jifud;
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++地区条件设置++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


function where_cat123($db,$ipyocjg,$cookie_uid,$abc,$w=0){//$abc是，看reg在多表的时候是a表还是b表还是c表

	if($w==1){
		$set_w_a = "where";
	}else{
		$set_w_a = "and";
	}
	
	if($cookie_uid=="" || $cookie_uid=="deleted"){//如果cookie等于空，查自建的ip+cookie
		$sql_cattype=$db->query("select cattype,catid from cattype where ipyocjg='$ipyocjg'");
		$num_cattype=$db->num_rows($sql_cattype);
		$rs_cattype=$db->fetch_array($sql_cattype);
			if($num_cattype==0){
				$where_cat = "";
			}else{
				$cattype = $rs_cattype["cattype"];
				$catid = $rs_cattype["catid"];
				if($cattype==1){
					$where_cat = " $set_w_a $abc.cat1_id='$catid'";
				}elseif($cattype==2){
					$where_cat = " $set_w_a $abc.cat2_id='$catid'";
				}elseif($cattype==3){
					$where_cat = " $set_w_a $abc.cat3_id='$catid'";
				}
			}
	}else{//否则会员登陆了，查会员ID得出地区ID
		$sql_cattype=$db->query("select cattype,catid from cattype where uid='$cookie_uid'");
		$num_cattype=$db->num_rows($sql_cattype);
		$rs_cattype=$db->fetch_array($sql_cattype);
		if($num_cattype==0){
			$rs_reg = $db->get_one("select cat3_id from reg where id='$cookie_uid'");
			$rs_cat3 = $rs_reg["cat3_id"];
			//----------------------------查出该会员所在区域的最后一级的ID号
			$where_cat = " $set_w_a $abc.cat3_id='$rs_cat3'";  // 注：如果母sql没有where，做完加表后，要做判断
		}else{
			$cattype = $rs_cattype["cattype"];
			$catid = $rs_cattype["catid"];
			if($cattype==1){
				$where_cat = " $set_w_a $abc.cat1_id='$catid'";
			}elseif($cattype==2){
				$where_cat = " $set_w_a $abc.cat2_id='$catid'";
			}elseif($cattype==3){
				$where_cat = " $set_w_a $abc.cat3_id='$catid'";
			}
		}
		
	}
	return $where_cat;
	
}
//--   初期用法 where_cat123($db,$ipyocjg,$cookie_uid,"b",1)


function where_cat_user($db,$cookie_uid,$abc,$w=0){//只直查用户表中的地区ID，不查地区临时表ID
	if($w==1){
		$set_w_a = "where";
	}else{
		$set_w_a = "and";
	}
	$rs_reg = $db->get_one("select cat3_id from reg where id='$cookie_uid'");
	$rs_cat3 = $rs_reg["cat3_id"];
	//----------------------------查出该会员所在区域的最后一级的ID号
	$where_cat = " $set_w_a $abc.cat3_id='$rs_cat3'";  // 注：如果母sql没有where，做完加表后，要做判断
	return $where_cat;
}
//-- 初期用法 where_cat_user($db,$cookie_uid,"b",1)

?>