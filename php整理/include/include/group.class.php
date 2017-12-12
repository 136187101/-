<?php
/**
 *38分小组，商铺ZJWLGR类
 *作者：zjwlgr
 *面向整站
*/
class GROUP
{
	var $db;
	var $js;
	function GROUP(){
		global $db;
		global $js;
		$this->db=$db;
		$this->js=$js;
	}
//---------------------------------引用DB类	
	function t2h($str){
		$str = htmlspecialchars($str);
		$str = str_replace(" ", "&nbsp;", $str);
		$str = str_replace("\r\n", "<br />", $str);
		$str = str_replace("\r", "<br />", $str);
		$str = str_replace("\n", "<br />", $str);
		$str = str_replace("&lt;", "<", $str); 
		$str = str_replace("&gt;", ">", $str);
		return $str;
	}
//-------------------------------------------------把字符串中的换为<br />&nbsp;等..
function SubTitle($String,$Length) {   
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
            $StringLast .= "";//...
        }   
        	return $StringLast;    
    	}    
	}
//----------------------------------------------------------------------截取字符串
	function cookie_tr($cookie_uid){
		if($cookie_uid=="" || $cookie_uid=="deleted"){
			$this->js->Goto("/user/login.php");
			die();
		}
	}
//-----------------------------------------------------------------如果用户没有登录，跳转到登录页面	
	function group_cookie($groupid){
		$rs=$this->db->get_one("select uid from group_list where id='$groupid'");
		$uid=$rs["uid"];
		return $uid;
	}
//-------------------------------------------------------------------判断是不是该用户所创建的组
	function thread_cookie($threadid){
		$rs=$this->db->get_one("select uid from group_thread where id='$threadid'");
		$uid=$rs["uid"];
		return $uid;
	}
//-----------------------------------------------------------------判断是不是该用户所发起的话题
	function lkd_cookie($hid){
		$rs=$this->db->get_one("select uid from lkd_list where id='$hid'");
		$uid=$rs["uid"];
		return $uid;
	}
//------------------------------------------------------------------判断是不是该用户回复的
	function join_group_cookie($gid,$cookie_uid){
		$sql=$this->db->query("select id from group_join where gid='$gid' and uid='$cookie_uid' and duan<>'1'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-----------------------------------------------------------------判断该用户有没有加入这个组
	function join_act_cookie($aid,$cookie_uid){
		$sql=$this->db->query("select id from act_join where aid='$aid' and uid='$cookie_uid'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-----------------------------------------------------------------//判断该用户有没有参加该活动
	function join_act_tp($aid,$cookie_uid){
		$sql=$this->db->query("select id from act_tp_join where aid='$aid' and uid='$cookie_uid'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//---------------------------------------------------------------//判断该用户有没有投票该活动地址的票
	function join_act_num($aid){
		$sql=$this->db->query("select id from act_join where aid='$aid'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-----------------------------------------------------------------//报名人数查询
	function join_grou_shenpi($gid,$cookie_uid){
		$sql=$this->db->query("select id from group_join where gid='$gid' and uid='$cookie_uid' and duan='1'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-----------------------------------------------------------------判断该用户是不是待审核的
	function user($id,$keyname){
		$rs=$this->db->get_one("select ".$keyname." from reg where id='$id'");
		$key_name=$rs[$keyname];
		return $key_name;
	}
//-------------------------------------------------------------------根据会员ID和字段名称，查出对应内容	
	function user_group_num($group_id){
		$sql=$this->db->query("select id from group_join where gid='$group_id'");
		$num=$this->db->num_rows($sql);
		if($num==0){$num=1;}else{$num=$num+1;}
		return $num;
	}
//--------------------------------------------------------------------查出小组成员数
	function user_thread_num($group_id){
		$sql=$this->db->query("select id from group_thread where gid='$group_id'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-------------------------------------------------------------------查出小组话题数
	function group_admin_pt($group_id,$gad,$duan=2){
		$sql=$this->db->query("select id from group_join where gid='$group_id' and gad='$gad' and duan='$duan'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-------------------------------------------------------------------查出小组普通成员数，管理员数
	function group_fensha_pt($groupid){
		$sql=$this->db->query("select id from fesha_user where gid='$groupid'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//--------------------------------------------------------------------查出被封杀成员数
	function lkd_list_num($tid){
		$sql=$this->db->query("select id from lkd_list where tid='$tid'");
		$num=$this->db->num_rows($sql);
		
		$rs_two_li = $this->db->get_one("select count(id) as two_list_num from thr_two_lkd_list where tid='$tid'");
		$num_two_li = $rs_two_li["two_list_num"];
		$num_two_li += $num;
		return $num_two_li;
	}
//-------------------------------------------------------------------查出话题的回复数
	function group_set($joinid,$cookie_uid){
		$rs=$this->db->get_one("select gad,gid,duan from group_join where id='$joinid'");
		
		if($this->group_cookie($rs["gid"])==$cookie_uid || $this->group_admin_ur($rs["gid"],$cookie_uid)==1){//如是组长或管理员可见
			if($rs["gad"]==1){
				$url="<a href=\"user/deal.php?act=gad_group_j&id=".$joinid."\" title=\"降为普通成员\">降</a>";
			}else{
				if($rs["duan"]==1){
					$url="<a href=\"user/deal.php?act=gad_group_p&id=".$joinid."\" title=\"审核通过\">批</a>";
				}elseif($rs["duan"]==2){
					$url="<a href=\"user/deal.php?act=gad_group_s&id=".$joinid."\" title=\"升级为管理员\">升</a>";
				}
				$url.="<a href=\"user/deal.php?act=join_del&id=".$joinid."\" onclick=\"return ConfirmDelBig_join_s()\" title=\"踢出该组\">踢</a><a href=\"user/deal.php?act=join_fsha&id=".$joinid."\" onclick=\"return ConfirmDelBig_join_f()\" title=\"封杀该成员，以后不能加入该组\">封</a>";
			}
		}
		return $url;
	}
//-------------------------------------------------------------------设置成员的操作
	function group_admin_ur($groupid,$cookie_uid){
		$rs=$this->db->get_one("select gad from group_join where gid='$groupid' and uid='$cookie_uid'");
		$gad=$rs["gad"];
		return $gad;//==1就是管理员
	}
//-------------------------------------------------------------------判断一个成员是不是一个组内的管理员
	function thread_djs($tid){
		$this->db->update("update group_thread set djs=djs+1 where id='$tid'");
	}
//--------------------------------------------------------------------增加话题点击数
	function thread_zd($zd){
		if($zd==1){
			$msg="<span class=\"grp_thr_li_1_span\">置顶</span>";
		}else{
			$msg="";
		}
		return $msg;
	}
//---------------------------------------------------------------------设题的置顶	
	function group_type_o($type,$jointype){
		if($type==1){
			if($jointype==1){
				$msg = "需要小组管理员批准后才能加入小组";
			}else{
				$msg = "允许任何人加入小组";	
			}
		}elseif($type==2){
			$msg = "私密小组";
		}
		return $msg;
	}
//---------------------------------------------------------------------显示小组的类型，私密 还是 公开
	function group_or_sm($gid){
		$rs_grp=$this->db->get_one("select grp_join_type from group_list where id='$gid'");
		$rs_join_type=$rs_grp["grp_join_type"];
		return $rs_join_type;
	}
//---------------------------------------------------------------------判断小组是不是私密的
	function group_thread_c($g_t,$id,$text){
		if($g_t=="g"){
			$rs=$this->db->get_one("select $text from group_list where id='$id'");
		}elseif($g_t=="t"){
			$rs=$this->db->get_one("select $text from group_thread where id='$id'");
		}
		return $rs[$text];
	}
//---------------------------------------------------------------------通过小组或话题的ID查出对应字段的信息
	function group_user_file($user_file){
		if($user_file==""){
			$user_filef="/img/ff_r2_c2.jpg";
		}else{
			$user_filef=$user_file;
		}
		return $user_filef;
	}
//---------------------------------------------------------------------判断会员有没有小头像
	function chediqu_file($user_file){
		if($user_file==""){
			$user_filef="/newimg/mche.jpg";
		}else{
			$user_filef=$user_file;
		}
		return $user_filef;
	}
//---------------------------------------------------------------------判断会员有没有小头像
	function group_user_filed($user_file){
		if($user_file==""){
			$user_filef="/img/d.jpg";
		}else{
			$user_filef=$user_file;
		}
		return $user_filef;
	}
//---------------------------------------------------------------------判断会员有没有大头像
	function group_qg_user($gid,$cookie_uid){
		$sql=$this->db->query("select id from group_qg where uid='$cookie_uid' and gid='$gid'");
		$num=$this->db->num_rows($sql);
		if($num==0){
			$this->db->update("INSERT INTO `group_qg` (`id` ,`gid` ,`uid` ,`num` ,`time_at` )VALUES (NULL , '$gid', '$cookie_uid', '1', NOW( ) );");
		}else{
			$this->db->update("update group_qg set num=num+1 where uid='$cookie_uid' and gid='$gid'");
		}
	}
//---------------------------------------------------------------------设置会员去过的小组
	function act_baoming_g($rbo){
		$now=date("Y-m-d",strtotime("+8 hours"));
		$last=$rbo;
		$diff=strtotime($now)-strtotime($last);
		return $diff;
	}
//---------------------------------------------------------------------//判断报名有没有过期
	function act_time_all_g($diff_1,$hm_1,$diff_2,$hm_2){
		$diff1=substr($diff_1,0,10)." ".$hm_1.":00";
		$diff2=substr($diff_2,0,10)." ".$hm_2.":00";
		$diff=strtotime($diff2)-strtotime($diff1);
		$diff=$diff/3600;
		/*if($diff>=24){
			$diff=$diff/86400;//计算天的，暂停先
		}*/
		return "共".$diff."小时";
	}
//---------------------------------------------------------------------//算出活动中间共有多长时间
	function act_jinxinz($diff_1,$hm_1){
		$diff1=substr($diff_1,0,10)." ".$hm_1.":00";
		$now_1=date("Y-m-d",strtotime("+8 hours"));//年月日
		$now_2=date("H",strtotime("+8 hours"));//小时
		$now_3=date(":i:s",time());//分秒
		$now=$now_1." ".$now_2.$now_3;
		
		$diff=strtotime($now)-strtotime($diff1);
		return $diff;
	}
//---------------------------------------------------------------------//判断活动正在进行中
/*======================================================================================================     
*  无话可说                          楚河 | 汉界            是不是简单的和玄，就不能写出动听的歌
======================================================================================================	*/

	function grp_admin_list($cookie_uid){
		$sql_grp=$this->db->query("select a.id,a.grp_name,a.grp_file,count(b.id) as join_zong from group_list a left join group_join b on a.id=b.gid where a.uid='$cookie_uid' group by a.id limit 6");
		$num_grp=$this->db->num_rows($sql_grp);
		while($rs_grp=$this->db->fetch_array($sql_grp)){
			$join_zong=$rs_grp["join_zong"]+1;
			$msg.="<li><a href=\"/grp/group_index.php?gid=".$rs_grp["id"]."\" title=\"".$rs_grp["grp_name"]."\"><img src=\"".$rs_grp["grp_file"]."\" height=\"58\" width=\"58\" /></a><a href=\"/grp/group_index.php?gid=".$rs_grp["id"]."\" title=\"".$rs_grp["grp_name"]."\">".$this->SubTitle($rs_grp["grp_name"],10)."</a><span>(".$join_zong.")</span></li>";
		}
		if($num_grp==0){return "<br />&nbsp;&nbsp;暂无信息";}else{return $msg;}
	}
//------------------------------------------------------------------------------------列出我管理的小组
	function grp_canjia_list($cookie_uid){
		$sql_grp=$this->db->query("select a.time_at,b.id,b.grp_name,b.grp_file from group_join a left join group_list b on a.gid=b.id where a.uid='$cookie_uid' order by a.time_at desc limit 9");
		$num_grp=$this->db->num_rows($sql_grp);
		while($rs_grp=$this->db->fetch_array($sql_grp)){
			$join_zong=$rs_grp["join_zong"]+1;
			$msg.="<li><a href=\"/grp/group_index.php?gid=".$rs_grp["id"]."\" title=\"".$rs_grp["grp_name"]."\"><img src=\"".$rs_grp["grp_file"]."\" height=\"58\" width=\"58\" /></a><a href=\"/grp/group_index.php?gid=".$rs_grp["id"]."\" title=\"".$rs_grp["grp_name"]."\">".$this->SubTitle($rs_grp["grp_name"],10)."</a><span>(".$this->user_group_num($rs_grp["id"]).")</span></li>";
		}
		if($num_grp==0){return "<br />&nbsp;&nbsp;暂无信息";}else{return $msg;}
	}
//------------------------------------------------------------------------------------列出我参加的小组
	function grp_new_juser($gid){
		$sql=$this->db->query("select a.id,a.uid,b.username,b.user_file from group_join a left join reg b on a.uid=b.id where a.gid='$gid' limit 9");
		$num=$this->db->num_rows($sql);
		while($rs=$this->db->fetch_array($sql)){
			$msg .= "<li><a href=\"/users.php?uid=".$rs["uid"]."\" target=\"_blank\"><img src=\"".$this->group_user_file($rs["user_file"])."\" height=\"50\" width=\"50\" /></a><a href=\"/users.php?uid=".$rs["uid"]."\" target=\"_blank\" class=\"huihui\">".$this->SubTitle($rs["username"],8)."</a></li>";
		}
		if($num==0){return "<br />&nbsp;&nbsp;暂无信息";}else{return $msg;}
	}
//-------------------------------------------------------------------------------------最新加入的会员
	function join_act_userlist($aid){
		$sql=$this->db->query("select a.id,a.uid,b.username,b.user_file from act_join a left join reg b on a.uid=b.id where a.aid='$aid' limit 16");
		$num=$this->db->num_rows($sql);
		while($rs=$this->db->fetch_array($sql)){
			$msg .= "<li><a href=\"/users.php?uid=".$rs["uid"]."\" target=\"_blank\"><img src=\"".$this->group_user_file($rs["user_file"])."\" height=\"50\" width=\"50\" /></a><a href=\"/users.php?uid=".$rs["uid"]."\" target=\"_blank\">".$this->SubTitle($rs["username"],8)."</a></li>";
		}
		if($num==0){return "<br />&nbsp;&nbsp;暂无信息";}else{return $msg;}
	}
//-------------------------------------------------------------------------------------参加活动的成员
	function grp_thr_remen(){
		  $sql_th=$this->db->query("select a.id,a.zd,a.title,a.djs,a.gid,a.zd,a.time_at,a.uid as tuid,b.grp_name,c.username,count(d.id) as lkd_num from group_thread a left join group_list b on a.gid=b.id left join reg c on a.uid=c.id left join lkd_list d on a.id=d.tid where b.grp_join_type<>'0' and TO_DAYS(now())-TO_DAYS(a.time_at)<=1 or a.zd='1' group by a.id order by a.zd desc,lkd_num desc,a.djs desc,a.time_at desc limit 13");
		  $num_th=$this->db->num_rows($sql_th);
		  while($rs_th=$this->db->fetch_array($sql_th)){
				$rs_lkd=$this->db->get_one("select a.uid,a.time_at,b.username from lkd_list a left join reg b on a.uid=b.id where a.tid='".$rs_th["id"]."' order by a.id desc");
				if($rs_lkd["uid"]==""){$hui_username = "<a href=\"/users.php?uid=".$rs_th["tuid"]."\" target=\"_blank\">".$rs_th["username"]."</a>";}else{$hui_username = "<a href=\"/users.php?uid=".$rs_lkd["uid"]."\" target=\"_blank\">".$rs_lkd["username"]."</a>";}
				if($rs_lkd["time_at"]==""){$hui_time = $rs_th["time_at"];}else{$hui_time = $rs_lkd["time_at"];}
				$msg.="<ul>
						<li class=\"grp_thr_li_1\">".$this->thread_zd($rs_th["zd"])."<a href=\"/grp/thread_index.php?tid=".$rs_th["id"]."\">".$this->SubTitle($rs_th["title"],40)."</a></li><li class=\"grp_thr_li_2\"><a href=\"/users.php?uid=".$rs_th["tuid"]."\" target=\"_blank\">".$rs_th["username"]."</a></li><li class=\"grp_thr_li_3\">".$rs_th["lkd_num"]."/".$rs_th["djs"]."</li><li class=\"grp_thr_li_4\">".$hui_username."<br /><span>".$hui_time."</span></li>
					  </ul>";
		   }
		   if($num_th==0){return "<ul>&nbsp;&nbsp;暂无信息</ul>";}else{return $msg;}
	   
	}
//-------------------------------------------------------------------------------------一天热们话题
	function grp_usercookie_thr($cookie_uid){
		$sql=$this->db->query("select id,title from group_thread where uid='$cookie_uid' order by id desc limit 6");
		$num=$this->db->num_rows($sql);
		while($rs=$this->db->fetch_array($sql)){
			$msg.="<li><a href=\"/grp/thread_index.php?tid=".$rs["id"]."\">".$this->SubTitle($rs["title"],40)."</a></li>";
		}
		if($num==0){return "<li>&nbsp;&nbsp;暂无信息</li>";}else{return $msg;}
	}
//-------------------------------------------------------------------------------------我发起的话题
	function grp_usergqita_thr($gid){	
		$sql=$this->db->query("select a.id,a.title,a.uid,b.username from group_thread a left join reg b on a.uid=b.id where a.gid='$gid' order by rand() limit 8");
		$num=$this->db->num_rows($sql);
		while($rs=$this->db->fetch_array($sql)){
			$msg.="<li><span class=\"wgle\"><a href=\"thread_index.php?tid=".$rs["id"]."\" class=\"huihui\">".$this->SubTitle($rs["title"],26)."</a></span><span class=\"wgri\"><a href=\"/users.php?uid=".$rs["uid"]."\" target=\"_blank\">".$this->SubTitle($rs["username"],8)."</a></span></li>";
		}
		if($num==0){return "<li>&nbsp;&nbsp;暂无信息</li>";}else{return $msg;}
	}
//-------------------------------------------------------------------------------------话题首页的其它话题
	function grp_userhuifu_trh($cookie_uid){
		$sql=$this->db->query("select a.id,a.title,b.tid from group_thread a left join lkd_list b on a.id=b.tid where b.uid='$cookie_uid' group by a.id order by b.id desc limit 6");
		$num=$this->db->num_rows($sql);
		while($rs=$this->db->fetch_array($sql)){
			$msg.="<li><a href=\"/grp/thread_index.php?tid=".$rs["id"]."\">".$this->SubTitle($rs["title"],40)."</a></li>";
		}
		if($num==0){return "<li>&nbsp;&nbsp;暂无信息</li>";}else{return $msg;}
	}
//-------------------------------------------------------------------------------------我回复的话题
	function grp_sodk_thr($cookie_uid){
		$sql_th=$this->db->query("select a.id,a.zd,a.title,a.djs,a.gid,a.uid as tuid,a.time_at,b.grp_name,c.username,d.uid,count(e.id) as lkd_num from group_thread a left join group_list b on a.gid=b.id left join reg c on a.uid=c.id left join group_join d on a.gid=d.gid left join lkd_list e on a.id=e.tid where d.uid='$cookie_uid' group by a.id order by a.zd desc,a.id desc limit 13");
		$num_th=$this->db->num_rows($sql_th);
	  	while($rs_th=$this->db->fetch_array($sql_th)){
				$rs_lkd=$this->db->get_one("select a.uid,a.time_at,b.username from lkd_list a left join reg b on a.uid=b.id where a.tid='".$rs_th["id"]."' order by a.id desc");
				if($rs_lkd["uid"]==""){$hui_username = "<a href=\"/users.php?uid=".$rs_th["tuid"]."\" target=\"_blank\">".$rs_th["username"]."</a>";}else{$hui_username = "<a href=\"/users.php?uid=".$rs_lkd["uid"]."\" target=\"_blank\">".$rs_lkd["username"]."</a>";}
				if($rs_lkd["time_at"]==""){$hui_time = $rs_th["time_at"];}else{$hui_time = $rs_lkd["time_at"];}
	  		 $msg.="<ul>
						<li class=\"grp_thr_li_1\">".$this->thread_zd($rs_th["zd"])."<a href=\"/grp/thread_index.php?tid=".$rs_th["id"]."\">".$this->SubTitle($rs_th["title"],40)."</a></li><li class=\"grp_thr_li_2\"><a href=\"/users.php?uid=".$rs_th["tuid"]."\" target=\"_blank\">".$rs_th["username"]."</a></li><li class=\"grp_thr_li_3\">".$rs_th["lkd_num"]."/".$rs_th["djs"]."</li><li class=\"grp_thr_li_4\">".$hui_username."<br /><span>".$hui_time."</span></li>
					</ul>";
		   }
		   if($num_th==0){return "<ul>&nbsp;&nbsp;暂无信息</ul>";}else{return $msg;}
	  
	}
//-------------------------------------------------------------------------------------我所在小组的话题更新
	function grp_now_qg_grp($gid){
		$sql_join=$this->db->query("select uid from group_join where gid='$gid'");
		$num_join=$this->db->num_rows($sql_join);
		if($num_join!=0){
			while($rs_join=$this->db->fetch_array($sql_join)){
				$msg_uid.=$rs_join["uid"].",";
			}
			$join_uid=substr($msg_uid,0,-1);
			//..............................
			$sql=$this->db->query("select a.gid,b.grp_file,b.grp_name,b.id from group_qg a left join group_list b on a.gid=b.id where a.uid in($join_uid) and a.gid<>$gid group by a.gid limit 6");
			$num=$this->db->num_rows($sql);
			while($rs=$this->db->fetch_array($sql)){
				//$join_zong=$rs["join_zong"]+1;
				$msg.="<li><a href=\"group_index.php?gid=".$rs["id"]."\" title=\"".$rs["grp_name"]."\"><img src=\"".$rs["grp_file"]."\" height=\"58\" width=\"58\" /></a><a href=\"group_index.php?gid=".$rs["id"]."\" title=\"".$rs["grp_name"]."\">".$this->SubTitle($rs["grp_name"],10)."</a><span>(".$this->user_group_num($rs["gid"]).")</span></li>";
				
			}
		}
		if($num_join==0 || $num==0){return "<br />&nbsp;&nbsp;暂无信息";}else{return $msg;}
	}
//-------------------------------------------------------------------------------------这个小组的成员还去过的小组
	function group_seahi_list(){
		$sql_searh=$this->db->query("select a.rong,b.username from serh_grp_list a left join reg b on a.uid=b.id order by a.ci desc limit 12");
		while($rs_searh=$this->db->fetch_array($sql_searh)){
			$msg.="<li><a href=\"/grp/search_g.php?rong=".rawurlencode($rs_searh["rong"])."\">".$this->SubTitle($rs_searh["rong"],8)."</a></li>";
		}
		return $msg;
	}
//-------------------------------------------------------------------------------------热门搜索


//===========================================================================================会员个人中心

	function beigzu_num($uid,$bg){
		if($bg=="b"){
			$sql_zuid=$this->db->query("select id from user_gz where zuid='$uid'");
			$num_zuid=$this->db->num_rows($sql_zuid);
			return $num_zuid;
		}else{
			$sql_zuid=$this->db->query("select id from user_gz where uid='$uid'");
			$num_zuid=$this->db->num_rows($sql_zuid);
			return $num_zuid;
		}
	}
//--------------------------------------------------------------------------------查出某个会员被关注的人数，或，某个会员关注了多少人
	function guanbo_num($uid){
		$sql=$this->db->query("select id from t_main where uid='$uid'");
		$num=$this->db->num_rows($sql);
		return $num;
	}
//-------------------------------------------------------------------------------查出某个会员发了多少广播
	function wei_bo_time($time_idk){
		$diff1=$time_idk;
		$now_1=date("Y-m-d ",strtotime("+8 hours"));//年月日
		$now_2=date("H",strtotime("+8 hours"));//小时
		$now_3=date(":i:s",time());//分秒
		$now=$now_1." ".$now_2.$now_3;
		$diff=strtotime($now)-strtotime($diff1);
		if($diff==0){$diff=1;}
		
		if($diff>=259200){
			$mssg=$time_idk;
		}elseif($diff>=86400){
			$tian=round($diff/60/60/60);
			if($tian==0){$tian=1;}
			$mssg = $tian."天前";
		}elseif($diff>=3600){
			$shi=round($diff/60/60);
			//$f=round(($diff-($shi*3600))/60);
			$mssg = $shi."小时前";
		}elseif($diff>=60){
			$fen=round($diff/60);
			$mssg = $fen."分钟前";
		}elseif($diff<60){
			$mssg = $diff."秒前";  
		}
		return $mssg;
	}
//==-----------------------------------------------------------------------------查出微博发表时间，如5分钟以前
	function to_information_fast($info_time){
		$wutime=$info_time;
		$now_1=date("Y-m-d ",strtotime("+8 hours"));//年月日
		$now_2=date("H",strtotime("+8 hours"));//小时
		$now_3=date(":i:s",time());//分秒
		$nowtime=$now_1." ".$now_2.$now_3;
		$diff=strtotime($nowtime)-strtotime($wutime);
		return $diff;
	}
//-------------------------------------------------------------------------------判断是否发信息过快，参数为：最后发5条中的最后一条信息的时间
	function cat_type_paly($cookie_uid,$ipyocjg,$comm=""){
			if($cookie_uid!=""){
				$sql=$this->db->query("select catname,catid from cattype where uid='$cookie_uid'");
				$num=$this->db->num_rows($sql);
				$rs=$this->db->fetch_array($sql);
				if($num==0){
					$rs_reg_cat=$this->db->get_one("select a.id,b.cat3_name,b.id as catid from reg a left join cat3 b on a.cat3_id=b.id where a.id='$cookie_uid'");
					$mssg=$rs_reg_cat["cat3_name"];
					$mssg_id=$rs_reg_cat["catid"];
				}else{
					$mssg=$rs["catname"];
					$mssg_id=$rs["catid"];
				}
			}else{
					$sql=$this->db->query("select catname,catid from cattype where ipyocjg='$ipyocjg'");
					$num=$this->db->num_rows($sql);
					$rs=$this->db->fetch_array($sql);
					if($num==0){
						$mssg="全国";
					}else{
						$mssg=$rs["catname"];
						$mssg_id=$rs["catid"];
					}
			}
		if($comm == "comm"){
			return $mssg_id;
		}else{
			return "<font title=\"".$mssg."\">".$this->SubTitle($mssg,12)."</font>";
		}
	}
//---------------------------------------------------------------------------------------//输出当前城市名称
	function hui_me_cat($cookie_uid){
		if($cookie_uid==""){
			$mssg = "";
		}else{
			$sql_cat=$this->db->query("select catid from cattype where uid='$cookie_uid'");
			$num_cat=$this->db->num_rows($sql_cat);
			$rs_cat=$this->db->fetch_array($sql_cat);
			//-----------------------------------------------------------------------
			$sql_reg=$this->db->query("select cat3_id from reg where id='$cookie_uid'");
			$rs_reg=$this->db->fetch_array($sql_reg);
			
			if($rs_cat["catid"]==$rs_reg["cat3_id"] || $num_cat==0){
				$mssg = "";
			}else{
				$mssg = "<a href=\"/user/deal.php?act=cat_delete\" class=\"wg_chei1\">回到我的社区</a>";
			}
		}
		return $mssg;
	}
//----------------------------------------------------------------------------------判断什么时候显示，回到我的城市	
	function wg_top_user($cookie_uid,$foob){
		$rs = $this->db->get_one("select a.username,a.user_file,b.content from reg a left join user_data b on a.id=b.uid where a.id='$cookie_uid'");
		if($foob==1){
			$fss = "<ul><img src=\"".$this->group_user_file($rs["user_file"])."\" /></ul>";
		}else{
			$fss = "";
		}
		$msg = "<div class=\"wg_minbo\">
			".$fss."
			<ul>
				<li class=\"wg_minbo_1\">Hi，".$this->SubTitle($rs["username"],16)."</li>
				<li class=\"wg_minbo_2\">".$this->SubTitle($rs["content"],100)."</li>
			</ul>
		</div>";
		if($cookie_uid != ""){
			return $msg;
		}
	}
//-------------------------------------------------------头上的Hi,面包设置





} 
?>