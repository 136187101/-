<?php
session_start();
require_once("../../include/global.php");
@header('Content-type: text/html;charset=utf-8');
$num_awt=$_SESSION['authcode'];//验证码
$act=$_GET["act"];
$ipp=$_SERVER["REMOTE_ADDR"];
function fileimage($filelj){
	$xfilej=substr($filelj,17,200);
	$fileljp="../..".$filelj;
	$image=$fileljp;//图片路径
		$img=getimagesize($image);//载入图片的函数   得到图片的信息
		//var_dump($img);//可以打印出数组，查看载入图片的信息
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
		$width_y_y=$img[0];
		$height_y_y=$img[1];
		//得出高的比例   原图高\(原图宽\要求宽)
		if($width_y_y>600){
			$width=600;
			$height=round($height_y_y/($width_y_y/600));
		}else if($height_y_y>600){
			$width=round($width_y_y/($height_y_y/600));
			$height=600;
		}
		if($width_y_y>600 || $height_y_y>600){//如果图片宽度大于600或高度大于600才执行以下程序
		$newim=imagecreatetruecolor($width,$height); //剪切图片第一步，建立新图像 x就是宽 ，y就是高//图片大小
		imagecopyresampled($newim,$im,0,0,0,0,$width,$height,$width_y_y,$height_y_y);//这个函数不失真
		//剪切图片第二步，开始，，，新图像，原始图像，x-y剪切的时候从什么地方开始对齐，x-y从什么地方开始缩略，宽-高新图片的宽和高,宽-高旧图片的宽和高
		//imagecopy($newim,$in,100,175,0,0,100,25);
		//header("Content-type: image/jpeg");//定义要输出的类型
		imagejpeg($newim, "../../admin/thr_plpic/".$xfilej, 100);//加个100可以更清晰
		}
}
function file_group($filelj,$width,$height){
	$xfilej=substr($filelj,16,200);
	$fileljp="../..".$filelj;
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
	imagejpeg($newim, "../../admin/grouppic/".$xfilej, 100);//加个100可以更清晰
}
switch($act){

	case "group"://创建小组
		$grp_name=$_POST["grp_name"];
		$big=$_POST["big"];
		$bigg=$_POST["bigg"];
		$grp_intro=$_POST["grp_intro"];
		$grp_tags=$_POST["grp_tags"];
		$grp_join_type=$_POST["grp_join_type"];
		$grp_type=$_POST["grp_type"];
		$grp_file=$_POST["grp_file"];
		$keyword=$_POST["keyword"];
		$hidde=$_POST["hidde"];
		$data_ymd=date("Ymd",time());
		if($_FILES["grp_file"]["name"]==""){
			$grp_file="/img/moo.jpg";
		}else{
			$grp_file=upload("grp_file","/admin/grouppic/",array(".gif",".jpg",".jpeg",".png"),"200000");
			file_group($grp_file,58,58);//剪切图片
		}
		//================================================以上接收字段
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			$db->update("INSERT INTO `group_list` (`id` ,`uid` ,`bigid` ,`biggid` ,`grp_name` ,`grp_intro` ,`grp_tags` ,`grp_join_type` ,`grp_type` ,`grp_file` ,`ip` ,`keyword` ,`time_at` )VALUES (NULL , '$cookie_uid', '$big', '$bigg', '$grp_name', '$grp_intro', '$grp_tags', '$grp_join_type', '$grp_type', '$grp_file', '$ipp', '$keyword', NOW( ) );");
			$gid=$db->insert_id();
			$zj->key_word_my($keyword);//-------------------打标签插入到标签表
			//------------------------------------------------添加到微博
			 $content = "我<b>创建</b>了小组>><b>".$grp_name."</b><br />".$gr->SubTitle($grp_intro,200)."...<a href=\"/grp/group_index.php?gid=".$gid."\" target=\"_blank\">[查看该组]</a>";
			 $db->update("INSERT INTO `t_main` (`id` ,`uid` ,`content` ,`ip` ,`wszn` ,`gid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$content', '$ipp', '2', '$gid', now());");
			 //------------------------------------------------添加到微博
			$js->Goto("../group_index.php?gid=".$gid);
		}
	break;
	
	case "thread"://提交话题
		$title=$_POST["title"];
		$zd=$_POST["zd"];
		$content=$gr->t2h($_POST["content"]);
		$gid=$_POST["gid"];
		$keyword=$_POST["keyword"];
		$hidde=$_POST["hidde"];
		$grp_file=$_POST["grp_file"];
		$data_ymd=date("Ymd",time());
		
		require_once("../../memb/inc/face_mo_php.php");//表情，图片，视频，flash游戏设置文件
		//$js->Alert($content);
		//=================================================以上接收字段
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			if($gr->group_cookie($gid)==$cookie_uid || $gr->join_group_cookie($gid,$cookie_uid)!=0){
			
			$db->update("INSERT INTO `group_thread` (`id` ,`uid` ,`gid` ,`title` ,`zd` ,`content` ,`ip` ,`keyword` ,`time_at` )VALUES (NULL , '$cookie_uid', '$gid', '$title', '$zd', '$content', '$ipp', '$keyword', NOW( ) );");
			$tid=$db->insert_id();
			$zj->key_word_my($keyword);//-------------------打标签插入到标签表
			
			$db->update("INSERT INTO `img_mov_fla_id` (`id` ,`qid` ,`type` ,`images` ,`movie` ,`flash` ,`content` ,`time_at` )VALUES (NULL , '$tid', 'thread', '$pic', '$movie', '$flash', '".stripslashes($_POST["content"])."', NOW( ) );");//把图片，视频，flash的地址加入到独立表
			
			//------------------------------------------------添加到微博
			$rs_grplist=$db->get_one("select grp_join_type from group_list where id='$gid'");
			if($rs_grplist["grp_join_type"]!=0){
			 $t_content = "我<b>发起</b>了话题>><b>".$title."</b><br />".$gr->SubTitle(strip_tags($content),200)."...<a href=\"/grp/thread_index.php?tid=".$tid."\" target=\"_blank\">[查看该话题]</a>";
			 $db->update("INSERT INTO `t_main` (`id` ,`uid` ,`content` ,`ip` ,`wszn` ,`gid` ,`tid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$t_content', '$ipp', '1', '$gid', '$tid', now());");
			 }
			 //------------------------------------------------添加到微博
			
			//=======================================================批量上传图片
			$dest_folder="../../admin/thr_plpic/";  
			foreach ($_FILES["grp_file"]["error"] as $key => $error){
			
				$pub=array(".gif",".jpg",".jpeg",".png");
				$type        = implode(",",$pub);
				
				if($error == UPLOAD_ERR_OK){
					$tmp_name=$_FILES["grp_file"]["tmp_name"][$key];           
					$name=$_FILES["grp_file"]["name"][$key];
					$leixing     = strtolower(strrchr($name,"."));
					$suijishu    = rand(100,999);
					$server_file = time().$suijishu.$leixing;     
					$uploadfile = $dest_folder.$server_file; 
					
					if (in_array($leixing,$pub)){
						if(!move_uploaded_file($tmp_name, $uploadfile)){
							$js->Alert("上传图片失败，请重新上传！");
							$js->Back();
						}
					}else{
						$js->Alert("上传文件类型不支持,请上传".$type."类型的文件！");
						$js->Back();
					}
					$uploadfile=substr($uploadfile,5,40);
					$db->update("INSERT INTO `grp_thr_pic` (`id` ,`gid` ,`tid` ,`uid` ,`file_pic` ,`time_at` )VALUES (NULL , '$gid', '$tid', '$cookie_uid', '$uploadfile', NOW( ) );");
					fileimage($uploadfile);//自动剪切图片
				}
			}
			//=======================================================批量上传图片
			//--------------------------------------------------------------------过滤图片src
			  $content=stripslashes($content);
			  $test = $content;
			  preg_match_all('/<img.*src="(.*)"\\s*.*>/iU',$test,$match);
  			  $imgarr=$match[1];
  
			  foreach($imgarr as $key => $val){
				  if(substr($val,0,4)=="http"){
					  $image=$val;
				  }else{
				  	  $image="../..".$val;
				  }
				  //$image="../..".$val;
				  $img=getimagesize($image);
				  if($img[0]>80 && $img[1]>80 && $val!="/newimg/flash.jpg" && $val!="/newimg/movie.jpg"){//如果宽高都大于50，在添加到表中
				  	$db->update("INSERT INTO `grp_thr_pic` (`id` ,`gid` ,`tid` ,`uid` ,`file_pic` ,`duan` ,`time_at` )VALUES (NULL , '$gid', '$tid', '$cookie_uid', '$val', '1', NOW( ) );");
				  }
			  }
			//--------------------------------------------------------------------过滤图片src
			
				
				$js->Goto("../thread_index.php?tid=".$tid);
			}else{
				$js->Alert("你没有此操作权限");
				$js->Back();
			}
		}
	break;
	
	case "thread_up"://编辑话题
		$title=$_POST["title"];
		$zd=$_POST["zd"];
		$content=$_POST["content"];
		$tid=$_POST["tid"];
		$gid=$_POST["gid"];
		$keyword=$_POST["keyword"];
		$hidde=$_POST["hidde"];
		$grp_file=$_POST["grp_file"];
		$data_ymd=date("Ymd",time());
		//=================================================以上接收字段
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			if($gr->group_cookie($gid)==$cookie_uid || $gr->thread_cookie($tid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果组是我的，或话题是我，或我是管理员，可有些权限
				$db->update("update group_thread set title='$title', zd='$zd', keyword='$keyword', content='$content' where id='$tid'");
				$zj->key_word_my($keyword);//-------------------打标签插入到标签表
				
			//=======================================================批量上传图片
			$dest_folder="../../admin/thr_plpic/";  
			foreach ($_FILES["grp_file"]["error"] as $key => $error){
			
				$pub=array(".gif",".jpg",".jpeg",".png");
				$type        = implode(",",$pub);
				
				if($error == UPLOAD_ERR_OK){
					$tmp_name=$_FILES["grp_file"]["tmp_name"][$key];           
					$name=$_FILES["grp_file"]["name"][$key];
					$leixing     = strtolower(strrchr($name,"."));  
					$suijishu    = rand(100,999);
					$server_file = time().$suijishu.$leixing;     
					$uploadfile = $dest_folder.$server_file; 
					
					if (in_array($leixing,$pub)){
						if(!move_uploaded_file($tmp_name, $uploadfile)){
							$js->Alert("上传图片失败，请重新上传！");
							$js->Back();
						}
					}else{
						$js->Alert("上传文件类型不支持,请上传".$type."类型的文件！");
						$js->Back();
					}
					$uploadfile=substr($uploadfile,5,40);
					$db->update("INSERT INTO `grp_thr_pic` (`id` ,`gid` ,`tid` ,`uid` ,`file_pic` ,`time_at` )VALUES (NULL , '$gid', '$tid', '$cookie_uid', '$uploadfile', NOW( ) );");
					fileimage($uploadfile);//剪切图片
				}
			}
			//=======================================================批量上传图片
			
			//--------------------------------------------------------------------过滤图片src
			  $db->update("delete from grp_thr_pic where tid='$tid' and duan='1' and lid='0'");
			  $content=stripslashes($content);
			  $test = $content;
			  //preg_match_all("/src=\"([^^]*?)\"/",$test,$match);
			  preg_match_all('/<img.*src="(.*)"\\s*.*>/iU',$test,$match);
  			  $imgarr=$match[1];
  
			  foreach($imgarr as $key => $val){
				  if(substr($val,0,4)=="http"){
					  $image=$val;
				  }else{
				  	  $image="../..".$val;
				  }
				 // $image="../..".$val;
				  $img=getimagesize($image);
				  if($img[0]>80 && $img[1]>80){//如果宽高都大于50，在添加到表中
				  	$db->update("INSERT INTO `grp_thr_pic` (`id` ,`gid` ,`tid` ,`uid` ,`file_pic` ,`duan` ,`time_at` )VALUES (NULL , '$gid', '$tid', '$cookie_uid', '$val', '1', NOW( ) );");
				  }
			  }
			//--------------------------------------------------------------------过滤图片src
			
				
				
				$js->Goto("../thread_index.php?tid=".$tid);
			}else{
				$js->Alert("你没有此操作权限");
				$js->Back();
			}
		}
	break;
	
	case "thread_zd_z"://置顶话题
		$tid=$_GET["tid"];
		$rs=$db->get_one("select gid from group_thread where id='$tid'");
		$gid=$rs["gid"];
		//==============================================字段接收与设置
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)){
			$db->update("update group_thread set zd='1' where id='$tid'");
			$js->Goto("../thread_index.php?tid=".$tid);
		}else{
			$js->Alert("你没有此操作权限");
			$js->Back();
		}
	break;
	
	case "thread_zd_q"://取消置顶话题
		$tid=$_GET["tid"];
		$rs=$db->get_one("select gid from group_thread where id='$tid'");
		$gid=$rs["gid"];
		//==============================================字段接收与设置
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)){
			$db->update("update group_thread set zd='0' where id='$tid'");
			$js->Goto("../thread_index.php?tid=".$tid);
		}else{
			$js->Alert("你没有此操作权限");
			$js->Back();
		}
	break;
	
	case "thread_del"://删除话题
		$tid=$_GET["tid"];
		$rs=$db->get_one("select gid from group_thread where id='$tid'");
		$gid=$rs["gid"];
		//==============================================字段接收与设置
		if($gr->group_cookie($gid)==$cookie_uid || $gr->thread_cookie($tid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果组是我的，或话题是我，或我是管理员，可有些权限
			
			$sql_pic=$db->query("select file_pic from grp_thr_pic where tid='$tid'");
			while($rs_pic=$db->fetch_array($sql_pic)){
				$newslist=$rs_pic["file_pic"];
				$root=$_SERVER['DOCUMENT_ROOT'];
				$root.=$newslist;
				@unlink($root);//删除文件夹里的图片
			}
			$db->update("delete from img_mov_fla_id where qid='$tid' and type='thread'");//删除存放独立出来的图片，视频，flash地址
			$db->update("delete from t_plun where tid='$tid'");//删除微博评论信息
			$db->update("delete from t_main where tid='$tid'");//删除微博信息
			$db->update("delete from grp_thr_pic where tid='$tid'");//删除图片表里的信息
			$db->update("delete from thr_two_lkd_list where tid='$tid'");//删除二级回复
			$db->update("delete from lkd_list where tid='$tid'");//删除改话题内的回复
			$db->update("delete from group_thread where id='$tid'");//删除该会题话本身
			$js->Goto("../group_index.php?gid=".$gid);
		}else{
			$js->Alert("您没有删除该组的权限");
			$js->Back();
		}
	break;
	
	case "join"://加入这个组
		$gr->cookie_tr($cookie_uid);
		$laiurl=$_SERVER['HTTP_REFERER'];
		$gid=$_GET["gid"];
		$ruid=$gr->group_cookie($gid);
		$rs=$db->get_one("select grp_join_type,grp_name,grp_intro from group_list where id='$gid'");//查出是公开的还是不公开的
		$duan=$rs["grp_join_type"];
		//==============================================字段接收与设置
		if($duan==0){//如果是私密小组，不能通过此方式加入该组
			$js->Alert("非法操作！");
			$js->Back();
			die();
		}
		$sql_fesha=$db->query("select id from fesha_user where gid='$gid' and uid='$cookie_uid'");
		$num_fesha=$db->num_rows($sql_fesha);
		if($num_fesha!=0){//如果被封杀了，就不能加入该组
			$js->Alert("您被该组组长封杀了，不能加入该组！");
			$js->Goto($laiurl);
			die();
		}
		$sql_join=$db->query("select id from group_join where gid='$gid' and uid='$cookie_uid'");
		$num_join=$db->num_rows($sql_join);
		if($num_join==0){//如果加入了，就不置信加入了
			$db->update("INSERT INTO `group_join` (`id` ,`uid` ,`ruid` ,`gid` ,`duan` ,`time_at` )VALUES (NULL , '$cookie_uid', '$ruid', '$gid', '$duan', NOW( ) );");//提交加入信息
			//------------------------------------------------添加到微博
			 $content = "我<b>加入</b>了小组>><b>".$rs["grp_name"]."</b><br />".$gr->SubTitle($rs["grp_intro"],200)."...<a href=\"/grp/group_index.php?gid=".$gid."\" target=\"_blank\">[查看该组]</a>";
			 $sql_min=$db->query("select id from t_main where gid='$gid' and uid='$cookie_uid'");
			 $num_min=$db->num_rows($sql_min);
			 if($num_min==0){
			 	$db->update("INSERT INTO `t_main` (`id` ,`uid` ,`content` ,`ip` ,`wszn` ,`gid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$content', '$ipp', '2', '$gid', now());");
			 }else{
			 	$db->update("update t_main set content='$content',wszn='2',time_at=now() where gid='$gid' and uid='$cookie_uid'");
			 }
			 //------------------------------------------------添加到微博
		}
		if($duan==1){//$js->Alert("已加入请等待组长审核");
			$js->Goto($laiurl);
		}
		$js->Goto($laiurl);//如果为不公开小组，还要设置一下
	break;
	
	case "die_join"://退出这个组
		$gid=$_GET["gid"];
		$rs=$db->get_one("select grp_name,grp_intro from group_list where id='$gid'");
		//==============================================字段接收与设置
		$db->update("delete from group_join where gid='$gid' and uid='$cookie_uid'");
		//------------------------------------------------添加到微博
			 $content = "我<b>退出</b>了小组>><b>".$rs["grp_name"]."</b><br />".$gr->SubTitle($rs["grp_intro"],200)."...<a href=\"/grp/group_index.php?gid=".$gid."\" target=\"_blank\">[查看该组]</a>";
			 $db->update("update t_main set content='$content',time_at=now() where gid='$gid' and uid='$cookie_uid'");
		//------------------------------------------------添加到微博
		$js->Goto("../group_index.php?gid=".$gid);
	break;
	
	case "del_group"://解散该组
		$gid=$_GET["gid"];
		//==============================================字段接收与设置
		if($gr->group_cookie($gid)==$cookie_uid){
		
			$sql_pic=$db->query("select file_pic from grp_thr_pic where gid='$gid'");
			while($rs_pic=$db->fetch_array($sql_pic)){
				$newslistf=$rs_pic["file_pic"];
				$rootf=$_SERVER['DOCUMENT_ROOT'];
				$rootf.=$newslistf;
				@unlink($rootf);//删除文件夹里的图片
			}
			
			$sqlu=$db->get_one("select grp_file from group_list where id='$gid'");
			$newslist=$sqlu["grp_file"];
			if($newslist!="/img/moo.jpg"){
				$root=$_SERVER['DOCUMENT_ROOT'];
				$root.=$newslist;
				@unlink($root);
			}
			
			$sql_fipic=$db->query("select file_pic from act_pic where gid='$gid'");
			while($rs_fipic=$db->fetch_array($sql_fipic)){
				$newslist=$rs_fipic["file_pic"];
				$root=$_SERVER['DOCUMENT_ROOT'];
				$root.=$newslist;
				@unlink($root);
			}
			
			
			$db->update("delete from t_plun where gid='$gid'");//删除微博评论信息
			$db->update("delete from t_main where gid='$gid'");//删除微博信息
			
			$db->update("delete from act_pic_lks_list where gid='$gid'");//活动图片评论表
			$db->update("delete from act_pic where gid='$gid'");//活动图片
			$db->update("delete from act_lkd_list where gid='$gid'");//活动留言表
			$db->update("delete from act_tp_join where gid='$gid'");//会员投票记录表
			$db->update("delete from act_addr_tp where gid='$gid'");//活动地址投票表
			$db->update("delete from act_join where gid='$gid'");//会员报名表
			$db->update("delete from act_main where gid='$gid'");//活动主表
			
			$db->update("delete from grp_thr_pic where gid='$gid'");//删除图片表里的信息
			$db->update("delete from group_qg where gid='$gid'");//会员去过的小组，的小组信息
			$db->update("delete from act_two_lkd_list where gid='$gid'");//活动留言的二级回复
			$db->update("delete from thr_two_lkd_list where gid='$gid'");//删除二级回复
			$db->update("delete from lkd_list where gid='$gid'");//小组内话题内的回复
			$db->update("delete from group_thread where gid='$gid'");//小组内的话题
			$db->update("delete from group_join where gid='$gid'");//加入小组的记录信息
			$db->update("delete from fesha_user where gid='$gid'");//被该组封杀的记录信息
			$db->update("delete from group_list where id='$gid'");//小组本体
			$js->Goto("../group_tp_all.php");
		}
	break;
	
	case "up_group"://修改小组
		$gid=$_POST["gid"];
		$grp_name=$_POST["grp_name"];
		$big=$_POST["big"];
		$bigg=$_POST["bigg"];
		$grp_intro=$_POST["grp_intro"];
		$grp_tags=$_POST["grp_tags"];
		$grp_join_type=$_POST["grp_join_type"];
		$keyword=$_POST["keyword"];
		$grp_file=$_POST["grp_file"];
		$hidde=$_POST["hidde"];
		$data_ymd=date("Ymd",time());
		$rs_grp=$db->get_one("select grp_file from group_list where id='$gid'");
		if($_FILES["grp_file"]["name"]==""){
			$grp_file=$rs_grp["grp_file"];
		}else{
			$grp_file=upload("grp_file","/admin/grouppic/",array(".gif",".jpg",".jpeg",".png"),"200000");
			file_group($grp_file,58,58);//剪切图片		
			$newslist=$rs_grp["grp_file"];
			if($newslist!="/img/moo.jpg"){
				$root=$_SERVER['DOCUMENT_ROOT'];
				$root.=$newslist;
				@unlink($root);
			}
		}
		//================================================以上接收字段
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			$db->update("update group_list set grp_name='$grp_name', bigid='$big', biggid='$bigg', grp_intro='$grp_intro', grp_tags='$grp_tags', grp_join_type='$grp_join_type', grp_file='$grp_file', keyword='$keyword' where id='$gid'");
			$zj->key_word_my($keyword);//-------------------打标签插入到标签表
			$js->Goto("../group_index.php?gid=".$gid);
		}
	break;
	
	case "gad_group_p"://批准加入该组
		$id=$_GET["id"];
		$rs=$db->get_one("select gid from group_join where id='$id'");
		$gid=$rs["gid"];
		//================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果这个组是他建的，可以操作升为管理员，是否管理员也可以此操作？？？？
			$db->update("update group_join set duan='2' where id='$id'");
			$js->Goto("../group_duan.php?gid=".$gid);
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "gad_group_s"://升为管理员
		$id=$_GET["id"];
		$rs=$db->get_one("select gid,uid from group_join where id='$id'");
		$gid=$rs["gid"];
		$uid=$rs["uid"];
		//================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果这个组是他建的，可以操作升为管理员，是否管理员也可以此操作？？？？
			$db->update("update group_join set gad='1' where id='$id'");
			$db->update("INSERT INTO `tzhi` (`id` ,`uid` ,`buid` ,`url` ,`gid_tid` ,`content` ,`duan` ,`time_at` )VALUES (NULL , '$cookie_uid', '$uid', '3', '$gid', '您被".$gr->group_thread_c("g",$gid,"grp_name")."小组升级为管理员', '0', NOW( ) );");//提交通知信息
			$js->Goto("../group_duan.php?gid=".$gid);
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "gad_group_j"://降为普通成员
		$id=$_GET["id"];
		$rs=$db->get_one("select gid,uid from group_join where id='$id'");
		$gid=$rs["gid"];
		$uid=$rs["uid"];
		//================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果这个组是他建的，可以操作降为普通成员，是否管理员也可以此操作？？？？
			$db->update("update group_join set gad='0' where id='$id'");
			$db->update("INSERT INTO `tzhi` (`id` ,`uid` ,`buid` ,`url` ,`gid_tid` ,`content` ,`duan` ,`time_at` )VALUES (NULL , '$cookie_uid', '$uid', '5', '$gid', '您被".$gr->group_thread_c("g",$gid,"grp_name")."降级为普通成员', '0', NOW( ) );");//提交通知信息
			$js->Goto("../group_duan.php?gid=".$gid."&gad=1");
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "join_del"://删除成员
		$id=$_GET["id"];
		$rs=$db->get_one("select gid,gad,uid from group_join where id='$id'");
		$gid=$rs["gid"];
		$gad=$rs["gad"];
		$uid=$rs["uid"];
		//================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果这个组是他建的，可以操作删除成员，是否管理员也可以此操作？？？？
			$db->update("delete from group_join where id='$id'");
			$db->update("INSERT INTO `tzhi` (`id` ,`uid` ,`buid` ,`url` ,`gid_tid` ,`content` ,`duan` ,`time_at` )VALUES (NULL , '$cookie_uid', '$uid', '4', '$gid', '您被".$gr->group_thread_c("g",$gid,"grp_name")."小组升踢出来了', '0', NOW( ) );");//提交通知信息
			$js->Goto("../group_duan.php?gid=".$gid."&gad=".$gad);
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "join_fsha"://封杀该成员，以后不能加入该组
		$id=$_GET["id"];
		$rs=$db->get_one("select gid,gad,uid,ruid from group_join where id='$id'");
		$gid=$rs["gid"];
		$gad=$rs["gad"];
		$uid=$rs["uid"];
		$ruid=$rs["ruid"];
		//================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $gr->group_admin_ur($gid,$cookie_uid)==1){//如果这个组是他建的，可以操作删除成员，是否管理员也可以此操作？？？？
			$db->update("INSERT INTO `fesha_user` (`id` ,`uid` ,`ruid` ,`gid` ,`time_at` )VALUES (NULL , '$uid', '$ruid', '$gid', NOW( ) );");//记录封杀会员的信息
			$db->update("delete from group_join where id='$id'");//删除该成员
			$db->update("INSERT INTO `tzhi` (`id` ,`uid` ,`buid` ,`url` ,`gid_tid` ,`content` ,`duan` ,`time_at` )VALUES (NULL , '$cookie_uid', '$uid', '7', '$gid', '您被".$gr->group_thread_c("g",$gid,"grp_name")."小组封杀了，以后不能加入该组', '0', NOW( ) );");//提交通知信息
			$js->Goto("../group_duan.php?gid=".$gid."&gad=".$gad);
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "acthd":
		$title=$_POST["title"];
		$act_big=$_POST["tz_big"];
		$act_bigg=$_POST["tz_bigg"];
		//--------------------------------------得到一级二级分类
		$rs_abig = $db->get_one("select act_big from act_big where id='$act_big'");
		$rs_abigg = $db->get_one("select act_bigg from act_bigg where id='$act_bigg'");
		
		$act_type=$rs_abig["act_big"]." - ".$rs_abigg["act_bigg"];
		//-----------------------------------------得到一级二级分类
		$act_timek=$_POST["act_timek"];
		$act_timek_s=$_POST["act_timek_s"];
		$act_timek2=$_POST["act_timek2"];
		$act_timek2_s=$_POST["act_timek2_s"];
		$province=$_POST["province"];
		$city=$_POST["city"];
		$act_ist=$_POST["act_ist"];
		$act_addr1=$_POST["act_addr1"];
		$act_addr2=$_POST["act_addr2"];
		$act_addr3=$_POST["act_addr3"];
		$act_addr4=$_POST["act_addr4"];
		$act_time_jz=$_POST["act_time_jz"];
		$act_rsx=$_POST["act_rsx"];
		$act_reshu=$_POST["act_reshu"];
		$gid=$_POST["gid"];
		//-------------------------------------------------------//得到分类图片
		$sql_act_bigg = $db->get_one("select file from act_bigg where id='$act_bigg'");
		$act_file=$sql_act_bigg["file"];
		//---------------------------------------------------------//得到分类图片
		//$act_file=$_POST["act_file"];
		$content=$_POST["content"];
		$hidde=$_POST["hidde"];
		$data_ymd=date("Ymd",time());
		$ipp=$_SERVER["REMOTE_ADDR"];
		$simi=0;
		if($gr->group_or_sm($gid)==0){
			$simi=1;
		}
		//=================================================以上接收字段
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			if($gr->group_cookie($gid)==$cookie_uid || $gr->join_group_cookie($gid,$cookie_uid)!=0){
				
				$db->update("INSERT INTO `act_main` (`id` ,`uid` ,`gid` ,`title` ,`act_file` ,`act_type` ,`act_bigid` ,`act_biggid` ,`act_timek` ,`act_timek_s` ,`act_timek2` ,`act_timek2_s` ,`province` ,`city` ,`act_ist` ,`act_addr1` ,`act_addr2` ,`act_addr3` ,`act_addr4` ,`act_time_jz` ,`act_rsx` ,
`act_reshu` ,`content` ,`ip` ,`simi` ,`time_at` )VALUES (NULL , '$cookie_uid', '$gid', '$title', '$act_file', '$act_type', '$act_big', '$act_bigg', '$act_timek', '$act_timek_s', '$act_timek2', '$act_timek2_s', '$province', '$city', '$act_ist', '$act_addr1', '$act_addr2', '$act_addr3', '$act_addr4', '$act_time_jz', '$act_rsx', '$act_reshu', '$content', '$ipp', '$simi', NOW( ) );");
				$aid=$db->insert_id();
				$db->update("INSERT INTO `act_join` (`id` ,`uid` ,`zuid` ,`gid` ,`aid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$cookie_uid', '$gid', '$aid', NOW( ) );");//自动为创建都报名
				
			//------------------------------------------------添加到微博
			$rs_grplist=$db->get_one("select grp_join_type from group_list where id='$gid'");
			if($rs_grplist["grp_join_type"]!=0){
			
			 $t_content = "我<b>发起</b>了活动>><b>".$title."</b><br />".$gr->SubTitle(strip_tags($content),200)."...<a href=\"/grp/act_index.php?aid=".$aid."\" target=\"_blank\">[查看该活动]</a>";
			 $db->update("INSERT INTO `t_main` (`id` ,`uid` ,`content` ,`ip` ,`wszn` ,`gid` ,`aid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$t_content', '$ipp', '1', '$gid', '$aid', now());");
			 
			}
			 //------------------------------------------------添加到微博
				
				//----------------------------------------投票添加
				if($act_ist==1){
					for($addi=1;$addi<=4;$addi++){
						$$address="act_addr".$addi;
							$db->update("INSERT INTO `act_addr_tp` (`id` ,`addr` ,`pnum` ,`aid` ,`gid` ,`uid` )VALUES (NULL , '".$$$address."', '0', '$aid', '$gid', '$cookie_uid');");
					}
				}
				//----------------------------------------投票添加
				$js->Goto("../act_index.php?aid=$aid");
			}else{
				$js->Alert("您没有权限执行此操作");
				$js->Back();
			}
		}
	break;
	
	case "acthd_up":
		$title=$_POST["title"];
		$act_big=$_POST["tz_big"];
		$act_bigg=$_POST["tz_bigg"];
		//--------------------------------------得到一级二级分类
		$rs_abig = $db->get_one("select act_big from act_big where id='$act_big'");
		$rs_abigg = $db->get_one("select act_bigg from act_bigg where id='$act_bigg'");
		
		$act_type=$rs_abig["act_big"]." - ".$rs_abigg["act_bigg"];
		//-----------------------------------------得到一级二级分类
		$act_timek=$_POST["act_timek"];
		$act_timek_s=$_POST["act_timek_s"];
		$act_timek2=$_POST["act_timek2"];
		$act_timek2_s=$_POST["act_timek2_s"];
		$province=$_POST["province"];
		$city=$_POST["city"];
		$act_ist=$_POST["act_ist"];
		$act_addr1=$_POST["act_addr1"];
		$act_addr2=$_POST["act_addr2"];
		$act_addr3=$_POST["act_addr3"];
		$act_addr4=$_POST["act_addr4"];
		$act_time_jz=$_POST["act_time_jz"];
		$act_rsx=$_POST["act_rsx"];
		$act_reshu=$_POST["act_reshu"];
		$gid=$_POST["gid"];
		$aid=$_POST["aid"];
		//-------------------------------------------------------//得到分类图片
		$sql_act_bigg = $db->get_one("select file from act_bigg where id='$act_bigg'");
		$act_file=$sql_act_bigg["file"];
		//---------------------------------------------------------//得到分类图片
		$content=$_POST["content"];
		$hidde=$_POST["hidde"];
		$data_ymd=date("Ymd",time());
		//=================================================以上接收字段
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			$rsact_uid=$db->get_one("select uid from act_main where id='$aid'");
			if($gr->group_cookie($gid)==$cookie_uid || $rsact_uid["uid"]==$cookie_uid){//如果此活动是我发起的，此组是我建的我可以这样做
				
				$db->update("update act_main set title='$title', act_file='$act_file', act_type='$act_type', act_bigid='$act_big', act_biggid ='$act_bigg', act_timek='$act_timek', act_timek_s='$act_timek_s', act_timek2='$act_timek2', act_timek2_s='$act_timek2_s', province='$province', city='$city', act_ist='$act_ist', act_addr1='$act_addr1', act_addr2='$act_addr2', act_addr3='$act_addr3', act_addr4='$act_addr4', act_time_jz='$act_time_jz', act_rsx='$act_rsx', act_reshu='$act_reshu', content='$content' where id='$aid'");
				//----------------------------------------投票添加
				if($act_ist==1){
					$sql_dei=$db->query("select * from act_addr_tp where aid='$aid'");
					$num_dei=$db->num_rows($sql_dei);
					if($num_dei==0){
						for($addi=1;$addi<=4;$addi++){
						$$address="act_addr".$addi;
							$db->update("INSERT INTO `act_addr_tp` (`id` ,`addr` ,`pnum` ,`aid` ,`gid` ,`uid` )VALUES (NULL , '".$$$address."', '0', '$aid', '$gid', '$cookie_uid');");
						}
					}else{
						$addi=1;
						while($rs_dei=$db->fetch_array($sql_dei)){
							$$address="act_addr".$addi;
								$db->update("update act_addr_tp set addr='".$$$address."' where id='".$rs_dei["id"]."'");
							$addi++;
						}
					}
				}
				//----------------------------------------投票添加
				$js->Goto("../act_index.php?aid=$aid");
			}else{
				$js->Alert("您没有权限执行此操作");
				$js->Back();
			}
		}
	break;
	
	case "act_delete":
		$f=$_GET["f"];
		$aid=$_GET["aid"];
		$rsact_uid=$db->get_one("select uid,gid,gorg from act_main where id='$aid'");
		if($rsact_uid["gorg"]==1){$js->Goto("/acti/user/deal.php?act=act_delete&aid=$aid&f=1");die();}
		$gid=$rsact_uid["gid"];
		$uid=$rsact_uid["uid"];
		//=================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $rsact_uid["uid"]==$cookie_uid){//如果此活动是我发起的，此组是我建的我可以这样做
			$sql_fipic=$db->query("select file_pic from act_pic where aid='$aid'");
			while($rs_fipic=$db->fetch_array($sql_fipic)){
				$newslist=$rs_fipic["file_pic"];
				$root=$_SERVER['DOCUMENT_ROOT'];
				$root.=$newslist;
				@unlink($root);
			}
			
			$db->update("delete from t_main where aid='$aid'");//微博信息
			$db->update("delete from t_plun where aid='$aid'");//微博评论信息
			
			$db->update("delete from act_two_lkd_list where aid='$aid'");//活动留言的二级回复
			$db->update("delete from act_pic_lks_list where aid='$aid'");//活动图片评论表
			$db->update("delete from act_pic where aid='$aid'");//活动图片
			$db->update("delete from act_lkd_list where aid='$aid'");//活动留言表
			$db->update("delete from act_tp_join where aid='$aid'");//会员投票记录表
			$db->update("delete from act_addr_tp where aid='$aid'");//活动地址投票表
			$db->update("delete from act_join where aid='$aid'");//会员报名表
			$db->update("delete from act_main where id='$aid'");//活动主表
			//一定会删除其它的，比如该组的图片信息，投票信息，会员加入信息，回复信息
			if($f==1){
				$js->Goto("/memb/act_cj.php");
			}else{
				$js->Goto("../act_new_list.php?gid=".$rsact_uid["gid"]);
			}
			
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "act_join":
		if($cookie_uid==""){$js->Goto("/user/login.php");die();}
		$aid=$_GET["aid"];
		$rsact_uid=$db->get_one("select uid,gid,gorg from act_main where id='$aid'");
		if($rsact_uid["gorg"]==1){$js->Goto("/acti/user/deal.php?act=act_join&aid=$aid");die();}
		$gid=$rsact_uid["gid"];
		$uid=$rsact_uid["uid"];
		//=================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $rsact_uid["uid"]==$cookie_uid || $gr->join_group_cookie($gid,$cookie_uid)!=0){//如果此活动是我发起的，此组是我建的,我是此组成员 可以这样做
		
			$sql_dua=$db->get_one("select count(id) as zong from act_join where aid='$aid' and uid='$cookie_uid'");
			if($sql_dua["zong"]==0){
				$db->update("INSERT INTO `act_join` (`id` ,`uid` ,`zuid` ,`gid` ,`aid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$uid', '$gid', '$aid', NOW( ) );");
				
			//------------------------------------------------添加到微博
			$rs_grplist=$db->get_one("select grp_join_type from group_list where id='$gid'");
			if($rs_grplist["grp_join_type"]!=0){
			
			 $rs_min=$db->get_one("select title,content from act_main where id='$aid'");	
			 $t_content = "我<b>参加</b>了活动>><b>".$rs_min["title"]."</b><br />".$gr->SubTitle(strip_tags($rs_min["content"]),200)."...<a href=\"/grp/act_index.php?aid=".$aid."\" target=\"_blank\">[查看该活动]</a>";
			 $db->update("INSERT INTO `t_main` (`id` ,`uid` ,`content` ,`ip` ,`wszn` ,`time_at` )VALUES (NULL , '$cookie_uid', '$t_content', '$ipp', '2', now());");
			 
			 }
			 //------------------------------------------------添加到微博
				
			}
			$js->Goto("../act_index.php?aid=$aid");
		}else{
			$js->Alert("请先加入该组在进行报名！");
			//$js->Back();
			$js->Goto("/grp/group_index.php?gid=$gid");
		}
	break;
	
	case "act_quxiao":
		$aid=$_GET["aid"];
		$rsact_uid=$db->get_one("select uid,gid,gorg from act_main where id='$aid'");
		if($rsact_uid["gorg"]==1){$js->Goto("/acti/user/deal.php?act=act_quxiao&aid=$aid");die();}
		$gid=$rsact_uid["gid"];
		$uid=$rsact_uid["uid"];
		//=================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $rsact_uid["uid"]==$cookie_uid){//如果此活动是我发起的，此组是我建的我可以这样做
			$db->update("update act_main set duan=1 where id='$aid'");
			$js->Goto("../act_index.php?aid=$aid");
		}else{
			$js->Alert("您没有权限执行此操作");
			$js->Back();
		}
	break;
	
	case "acttp":
		$aid=$_GET["aid"];
		$rsact_uid=$db->get_one("select uid,gid from act_main where id='$aid'");
		$gid=$rsact_uid["gid"];
		$act_tp=$_POST["act_tp"];
		//=================================================以上接收字段
		if($gr->group_cookie($gid)==$cookie_uid || $rsact_uid["uid"]==$cookie_uid || $gr->join_act_cookie($aid,$cookie_uid)!=0){//如果此活动是我发起的，此组是我建的,我是此组成员 可以这样做
			if($gr->join_act_tp($aid,$cookie_uid)==0){
				$db->update("update act_addr_tp set pnum=pnum+1 where id='$act_tp'");
				$db->update("INSERT INTO `act_tp_join` (`id` ,`uid` ,`aid` ,`gid` ,`pid` ,`time_at` )VALUES (NULL , '$cookie_uid', '$aid', '$gid', '$act_tp', NOW( ) );");//记录一下此会员投过票了
				$js->Goto("../act_index.php?aid=$aid");
			}else{
				$js->Goto("../act_index.php?aid=$aid");
			}
			
		}else{
			$js->Alert("只有参加此活动的人才能投票");
			$js->Back();
		}
	break;
	
	case "act_filepic":
		$gid=$_POST["gid"];
		$aid=$_POST["aid"];
		$hidde=$_POST["hidde"];
		$grp_file=$_POST["grp_file"];
		$data_ymd=date("Ymd",time());
		$rsact_uid=$db->get_one("select uid from act_main where id='$aid'");
		//=======================================================批量上传图片
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			if($rsact_uid["uid"]==$cookie_uid || $gr->group_cookie($gid)==$cookie_uid || $gr->join_act_cookie($aid,$cookie_uid)!=0){// 我是组长，我发起的活动，我参加了此活动
				$dest_folder="../../admin/thr_plpic/";
				foreach($_FILES["grp_file"]["name"] as $keyy => $vall){
					$valll.=$vall;
				}
				if($valll!=""){
					foreach ($_FILES["grp_file"]["error"] as $key => $error){
					
						$pub=array(".gif",".jpg",".jpeg",".png");
						$type        = implode(",",$pub);
						
						if($error == UPLOAD_ERR_OK){
							$tmp_name=$_FILES["grp_file"]["tmp_name"][$key];           
							$name=$_FILES["grp_file"]["name"][$key];
							$leixing     = strtolower(strrchr($name,"."));  
							$suijishu    = rand(100,999);
							$server_file = time().$suijishu.$leixing;     
							$uploadfile = $dest_folder.$server_file; 
							
							if (in_array($leixing,$pub)){
								if(!move_uploaded_file($tmp_name, $uploadfile)){
									$js->Alert("上传图片失败，请重新上传！");
									$js->Back();
								}
							}else{
								$js->Alert("上传文件类型不支持,请上传".$type."类型的文件！");
								$js->Back();
							}
							$uploadfile=substr($uploadfile,5,40);
							$db->update("INSERT INTO `act_pic` (`id` ,`gid` ,`aid` ,`uid` ,`file_pic` ,`file_name` ,`file_content` ,`time_at` )VALUES (NULL , '$gid', '$aid', '$cookie_uid', '$uploadfile', '', '', NOW( ) );");
							fileimage($uploadfile);//剪切图片
						}
					}
				}else{
					$js->Alert("请至少上传一张图片在进行提交！");
					$js->Back();
				}
				$js->Goto("../act_addfile_con.php?aid=$aid");
			}else{
				$js->Alert("您没有权限上传图片");
				$js->Back();
			}
		}
		//=======================================================批量上传图片
	break;
	
	case "act_filepic_con":
		foreach($_POST as $key => $val)
		{
			$$key=$val;		
		}
		//=====================================
		$sql_filec=$db->query("select id from act_pic where aid='$aid' and uid='$cookie_uid' and TO_DAYS(now())-TO_DAYS(time_at)<1 order by id desc");
	    while($rs_filec=$db->fetch_array($sql_filec)){
			$filec_id=$rs_filec["id"];
			$file_name="pictitle_".$filec_id;
			$filecontent="piccontent_".$filec_id;
			if($$file_name=="输入标题"){
				$$file_name="";
			}
			if($$filecontent=="对图片进行描述"){
				$$filecontent="";
			}
			$db->update("update act_pic set file_name='".$$file_name."',file_content='".$$filecontent."' where id='".$filec_id."'");
		}
		$js->Goto("../act_index.php?aid=$aid");
	break;
	
	case "del_picall":
		$aid=$_GET["aid"];
		$picid=$_GET["picid"];
		$rsact_uid=$db->get_one("select uid,gid from act_main where id='$aid'");
		$gid=$rsact_uid["gid"];
		//===========================================================================
		if($gr->group_cookie($gid)==$cookie_uid || $rsact_uid["uid"]==$cookie_uid){
			
			$sql_fipic=$db->get_one("select file_pic from act_pic where id='$picid'");
				$newslist=$sql_fipic["file_pic"];
				$root=$_SERVER['DOCUMENT_ROOT'];
				$root.=$newslist;
				@unlink($root);

			$db->update("delete from act_pic where id='$picid'");
			$js->Goto("../act_pic_all.php?aid=$aid");
			
		}else{
			$js->Alert("您没有权限删除图片");
			$js->Back();
		}
		
	break;
	
	case "rppic":
		$grp_file=$_POST["grp_file"];
		$hidde=$_POST["hidde"];
		$gid=$_POST["gid"];
		$data_ymd=date("Ymd",time());
		
		if($hidde!=$data_ymd){
			$js->Alert("请通过本站地址进行提交");
			$js->Back();
		}else{
			
			if($gr->group_cookie($gid)==$cookie_uid || $gr->join_group_cookie($gid,$cookie_uid)!=0){
			//=======================================================批量上传图片
			$dest_folder="../../admin/thr_plpic/";  
			foreach ($_FILES["grp_file"]["error"] as $key => $error){
			
				$pub=array(".gif",".jpg",".jpeg",".png");
				$type        = implode(",",$pub);
				
				if($error == UPLOAD_ERR_OK){
					$tmp_name=$_FILES["grp_file"]["tmp_name"][$key];           
					$name=$_FILES["grp_file"]["name"][$key];
					$leixing     = strtolower(strrchr($name,"."));  
					$suijishu    = rand(100,999);
					$server_file = time().$suijishu.$leixing;     
					$uploadfile = $dest_folder.$server_file; 
					
					if (in_array($leixing,$pub)){
						if(!move_uploaded_file($tmp_name, $uploadfile)){
							$js->Alert("上传图片失败，请重新上传！");
							$js->Back();
						}
					}else{
						$js->Alert("上传文件类型不支持,请上传".$type."类型的文件！");
						$js->Back();
					}
					$uploadfile=substr($uploadfile,5,40);
					$db->update("INSERT INTO `grp_thr_pic` (`id` ,`gid` ,`tid` ,`uid` ,`file_pic` ,`time_at` )VALUES (NULL , '$gid', '0', '$cookie_uid', '$uploadfile', NOW( ) );");
					fileimage($uploadfile);//剪切图片
				}
			}
			//=======================================================批量上传图片
			$js->Goto("../group_pic.php?gid=$gid");
			}else{
				$js->Alert("您没有权限执行此操作");
				$js->Back();
			}
		}
	break;
}
?>