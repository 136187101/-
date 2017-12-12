<?php
/**
 *38分系统ZJWLGR类
 *作者：zjwlgr
 *面向整站
*/
class ZJWLGR
{
	var $db;
	function ZJWLGR(){
		global $db;
		$this->db=$db;
	}
//---------------------------------引用DB类
	function msubstr($str,$strlen) { 
		for($i=0;$i<$strlen;$i++)
		{ 
			if(ord(substr($str,$i,1))>0xa0){ 
			$tmpstr.=substr($str,$i,2); 
			$i++;
			} 
			else{ 
				$tmpstr.=substr($str,$i,1); 
			}
		} 
		return $tmpstr; 
		}
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
            $StringLast .= "";
        }   
        return $StringLast;    
    }    
}
//---------------------------------------------------------------------截取字符串
	function price_hko($price){
		 $email = $price;   
 		 $domain = strstr($email, '.');
		 $domain = substr($domain,0,1);
		 if($domain=="."){
		 	$price_retu=$price;
		 }else{
		 	$price_retu=$price.".00";
		 }
		 return $price_retu;
	}
//----------------------------------------------------------------如果是44输出44.00,如是44.5输出44.5
	function gr_num_duan($pid){
		$rs = $this->db->get_one("select gr_num,baodis,tqtgj from products where id='$pid'");
		if($rs["baodis"]==1 || $rs["tqtgj"]==1){
			$mssg = $rs["gr_num"]."千克";
		}else{
			$mssg = $rs["gr_num"]."件";
		}
		return $mssg;
	}
//----------------------------------------------------------------还得在加，判断此商品团购数量的单位是克，还是件
	function price_pr($prices){
		if($prices==0){
			$bianliang="";
		}else{
			$bianliang="<del>￥".$this->price_hko($prices)."元</del>";
		}
		return $bianliang;
	}
//-----------------------------------------------------------------------购物车页面,判断市场价是否添加，没有添加不显示
	function price_pr_list($prices){
		if($prices==0){
			$bianliang="";
		}else{
			$bianliang="&nbsp;&nbsp;&nbsp;<s style=\"color:#666666;\">￥".$this->price_hko($prices)."</s>";
		}
		return $bianliang;
	}
//-----------------------------------------------------------------------前台列表页，判断市场价是否添加，没有添加不显示
		function adistr($id){
		  $sql=$this->db->query("select * from adistr where id='$id'");
		  $sqlgn=$this->db->fetch_array($sql);
		  $houzui=$sqlgn["file"];
		  $path_parts = pathinfo($houzui); 
		  $rgxcc=$path_parts['extension'];
		  if($rgxcc=="jpg" || $rgxcc=="gif" || $rgxcc=="png"){
		  		echo "<a href=\"".$sqlgn["url"]."\"><img name=\"\" border=\"0\" src=\"".$sqlgn["file"]."\" width=\"".$sqlgn["width"]."\" height=\"".$sqlgn["height"]."\" alt=\"\" /></a>";
		  }else{
		  		echo "<embed src=\"".$sqlgn["file"]."\" width=\"".$sqlgn["width"]."\" height=\"".$sqlgn["height"]."\" wmode=\"opaque\"></embed>";
		  }
		}
//-----------------------------------------------------------------广告调用方法
	function sys_con($ziua,$num=1){
		$sql=$this->db->get_one("select * from sys_con");
		if($num==2){
			return $sql["$ziua"];
		}else{
			echo $sql["$ziua"];
		}
	}
//-----------------------------------调用系统设置方法
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
	function productx($pid,$item,$urlblak=1){
		if($urlblak==1){
			$url="/productx,".$pid.".html";//productx,384.html
			if($item==1){
				echo $url;
			}elseif($item==2){
				return $url;
			}
		}elseif($urlblak==2){
			$urlba="";// target=\"_blank\"
			if($item==1){
				echo $urlba;
			}elseif($item==2){
				return $urlba;
			}
		}
	}
//-------------------------------------------------商品详细页页面链接
	function url_name(){
		$url = $_SERVER['PHP_SELF']; 
		//$filename = end(explode('/',$url)); 
		//if($g!=""){
			return $url;
		//}else{
		//	return $filename;
		//}
	}
//-------------------------------------获取当前文件名称
	function url_css($urlname,$num){
		$d_name=substr($urlname,0,5);//得到  /flea  或  /inde   或   /acti
		
			if($d_name=="/flea"){
				$flea_url=" class=\"daonli_1\"";//跳蚤
			}elseif($d_name=="/acti"){
				$acti_url=" class=\"daonli_1\"";//活动
			}elseif($d_name=="/memb" || $d_name=="/user"){
				$memb_url=" class=\"daonli_1\"";//会员首页
			}elseif($d_name=="/fhvk"){
				$resi_url=" class=\"daonli_1\"";//活动
			}else{
				$qita_url=" class=\"daonli_1\"";//其它
			}
		
		if($num==1){
			return $flea_url;
		}elseif($num==2){
			return $acti_url;
		}elseif($num==3){
			return $memb_url;
		}elseif($num==4){
			return $resi_url;
		}else{
			return $qita_url;
		}
	}
//------------------------------------主导航css设置 
	function cookieuid($kieuid){
		if($kieuid=="" || $kieuid=="deleted"){
			echo "<a href=\"/user/retrieve.php\">[忘记密码]</a>，<a href=\"/user/login.php\">[请登录]</a>，<font class=\"top_huang\">新用户？</font><a href=\"/user/reg.php\" style=\"color:#FF6605;\">[免费注册]</a>";
		}else{
			$sql=$this->db->get_one("select username from reg where id='$kieuid'");
			echo "欢迎您，亲爱的<a href=\"/memb/index.php\" title=\"".$sql["username"]."\">".$this->SubTitle($sql["username"],8)."！</a>&nbsp;&nbsp;<a href=\"/user/deal.php?act=die\">[退出]</a>";
		}
	}
//----------------------------------------------------判断用户是否登录
	function n_cookieuid($kieuid){
		if($kieuid=="" || $kieuid=="deleted"){
			echo "<a href=\"/user/retrieve.php\" class=\"huihui\">忘记密码</a><a href=\"/user/login.php\">+请登录</a><font class=\"top_huang\" class=\"huihui\">新用户？</font><a href=\"/user/reg.php\" class=\"huihui\">免费注册</a>";
		}else{
			$sql=$this->db->get_one("select username from reg where id='$kieuid'");
			echo "欢迎您，亲爱的<a href=\"/memb/index.php\" title=\"".$sql["username"]."\">".$this->SubTitle($sql["username"],8)."！</a><a href=\"/user/deal.php?act=die\" style=\"padding-left:0px;\">退出</a>";
		}
	}
//----------------------------------------------------判断用户是否登录_新
	 function url_name_uii(){
		$url = $_SERVER['PHP_SELF']; 
		$filename = end(explode('/',$url)); 
			return $filename;
	}
//-------------------------------------获取当前文件名称
function user_fn_xtwvf($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="udiy" || $user_filename=="b_udiy"){
			$udiy="_f";
		}elseif($user_filename=="b_udiy"){
			$b_udiy="_f";
		}elseif($user_filename=="index" || $user_filename=="index_liju"){
			$index="_f";
		}elseif($user_filename=="act_cj" || $user_filename=="act_canj"){
			$act_cj="_f";
		}elseif($user_filename=="grp_cj_list" || $user_filename=="grp_jr_list" || $user_filename=="grp_ju_list" || $user_filename=="grp_gzj_list" || $user_filename=="grp_gzr_list" || $user_filename=="grp_qt_list"){
			$grp_cj_list="_f";
		}elseif($user_filename=="flea_usf_list" || $user_filename=="flea_ush_list" || $user_filename=="thr_usf_list" || $user_filename=="thr_ush_list"){
			$flea_usf_list="_f";
		}elseif($user_filename=="user_zl" || $user_filename=="user_pw" || $user_filename=="user_pic" || $user_filename=="user_rsr"){
			$user_zl="_f";
		}elseif($user_filename=="shop_nha" || $user_filename=="t_nha" || $user_filename=="flea_nha"){
			$shop_nha="_f";
		}elseif($user_filename=="album_index" || $user_filename=="album_oup" || $user_filename=="album_add"  || $user_filename=="album_list" || $user_filename=="album_pic"){
			$album_index="_f";
		}elseif($user_filename=="user_che_gz"){
			$user_che_gz="_f";
		}elseif($user_filename=="user_fen_g"){
			$user_fen_g="_f";
		}elseif($user_filename=="user_shop_list" || $user_filename=="user_shop_addr" || $user_filename=="user_shop_list_k"){
			$user_shop_list="_f";
		}elseif($user_filename=="s_tp_cous"){
			$s_tp_cous="_f";
		}
		
		
		if($num==2){
			echo $udiy;
		}elseif($num==3){
			echo $b_udiy;
		}elseif($num==1){
			echo $index;
		}elseif($num==4){
			echo $act_cj;
		}elseif($num==5){
			echo $grp_cj_list;
		}elseif($num==6){
			echo $flea_usf_list;
		}elseif($num==7){
			echo $user_zl;
		}elseif($num==8){
			echo $shop_nha;
		}elseif($num==9){
			echo $album_index;
		}elseif($num==10){
			echo $user_che_gz;
		}elseif($num==11){
			echo $user_fen_g;
		}elseif($num==12){
			echo $user_shop_list;
		}elseif($num==13){
			echo $s_tp_cous;
		}
	}
//----------------------------------------------------------会员右侧导航css设置
function user_fn_xtwvf_new($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="udiy" || $user_filename=="b_udiy"){
			$udiy=" class=\"m_righ_li\"";
		}elseif($user_filename=="b_udiy"){
			$b_udiy=" class=\"m_righ_li\"";
		}elseif($user_filename=="index" || $user_filename=="index_liju"){
			$index=" class=\"m_righ_li\"";
		}elseif($user_filename=="act_cj" || $user_filename=="act_canj"){
			$act_cj=" class=\"m_righ_li\"";
		}elseif($user_filename=="grp_cj_list" || $user_filename=="grp_jr_list" || $user_filename=="grp_ju_list" || $user_filename=="grp_gzj_list" || $user_filename=="grp_gzr_list" || $user_filename=="grp_qt_list"){
			$grp_cj_list=" class=\"m_righ_li\"";
		}elseif($user_filename=="flea_usf_list" || $user_filename=="flea_ush_list" || $user_filename=="thr_usf_list" || $user_filename=="thr_ush_list"){
			$flea_usf_list=" class=\"m_righ_li\"";
		}elseif($user_filename=="user_zl" || $user_filename=="user_pw" || $user_filename=="user_pic" || $user_filename=="user_rsr"){
			$user_zl=" class=\"m_righ_li\"";
		}elseif($user_filename=="shop_nha" || $user_filename=="t_nha" || $user_filename=="flea_nha"){
			$shop_nha=" class=\"m_righ_li\"";
		}elseif($user_filename=="album_index" || $user_filename=="album_oup" || $user_filename=="album_add"  || $user_filename=="album_list" || $user_filename=="album_pic"){
			$album_index=" class=\"m_righ_li\"";
		}elseif($user_filename=="user_che_gz"){
			$user_che_gz=" class=\"m_righ_li\"";
		}elseif($user_filename=="user_fen_g"){
			$user_fen_g=" class=\"m_righ_li\"";
		}elseif($user_filename=="user_shop_list" || $user_filename=="user_shop_addr" || $user_filename=="user_shop_list_k"){
			$user_shop_list=" class=\"m_righ_li\"";
		}elseif($user_filename=="s_tp_cous"){
			$s_tp_cous=" class=\"m_righ_li\"";
		}
		
		
		if($num==2){
			echo $udiy;
		}elseif($num==3){
			echo $b_udiy;
		}elseif($num==1){
			echo $index;
		}elseif($num==4){
			echo $act_cj;
		}elseif($num==5){
			echo $grp_cj_list;
		}elseif($num==6){
			echo $flea_usf_list;
		}elseif($num==7){
			echo $user_zl;
		}elseif($num==8){
			echo $shop_nha;
		}elseif($num==9){
			echo $album_index;
		}elseif($num==10){
			echo $user_che_gz;
		}elseif($num==11){
			echo $user_fen_g;
		}elseif($num==12){
			echo $user_shop_list;
		}elseif($num==13){
			echo $s_tp_cous;
		}
	}
//----------------------------------------------------------会员右侧导航css设置-----新的

function comm_fn_xtwvf($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="community"){
			$community="_2";
		}elseif($user_filename=="comm_resi"){
			$comm_resi="_2";
		}elseif($user_filename=="comm_grp"){
			$comm_grp="_2";
		}elseif($user_filename=="comm_sf"){
			$comm_sf="_2";
		}elseif($user_filename=="comm_shop"){
			$comm_shop="_2";
		}
		
		
		if($num==1){
			echo $community;
		}elseif($num==2){
			echo $comm_resi;
		}elseif($num==4){
			echo $comm_grp;
		}elseif($num==3){
			echo $comm_sf;
		}elseif($num==5){
			echo $comm_shop;
		}
	}
//----------------------------------------------------------社区中心，社区居民等css设置
function grpthr_fn_xtwvf($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="group_index"){
			$group_index="_f";
		}elseif($user_filename=="thread_add"){
			$thread_add="_f";
		}elseif($user_filename=="thread_list"){
			$thread_list="_f";
		}elseif($user_filename=="group_duan"){
			$group_duan="_f";
		}elseif($user_filename=="group_pic"){
			$group_pic="_f";
		}elseif($user_filename=="group_up"){
			$group_up="_f";
		}
		
		if($num==1){
			echo $group_index;
		}elseif($num==2){
			echo $thread_add;
		}elseif($num==3){
			echo $thread_list;
		}elseif($num==4){
			echo $group_duan;
		}elseif($num==5){
			echo $group_pic;
		}elseif($num==6){
			echo $group_up;
		}
	}
//----------------------------------------------------------小组话题右侧导航css设置
function act_fn_xtwvf($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="act_add"){
			$act_add="_f";
		}elseif($user_filename=="act_new_list"){
			$act_new_list="_f";
		}elseif($user_filename=="act_wq_list"){
			$act_wq_list="_f";
		}
		
		if($num==1){
			echo $act_add;
		}elseif($num==2){
			echo $act_new_list;
		}elseif($num==3){
			echo $act_wq_list;
		}
	}
//----------------------------------------------------------小组活动右侧导航css设置
	function user_f_n($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="user_pw"){
			$user_pw=" class=\"select\"";
		}elseif($user_filename=="user_cart"){
			$user_cart=" class=\"select\"";
		}elseif($user_filename=="user_data"){
			$user_data=" class=\"select\"";
		}elseif($user_filename=="user_addr"){
			$user_addr=" class=\"select\"";
		}elseif($user_filename=="user_record"){
			$user_record=" class=\"select\"";
		}elseif($user_filename=="user_price"){
			$user_price=" class=\"select\"";
		}elseif($user_filename=="yudi_user_cart"){
			$yudi_user_cart=" class=\"select\"";
		}elseif($user_filename=="yudi_user_record"){
			$yudi_user_record=" class=\"select\"";
		}elseif($user_filename=="user_chycong"){
			$user_chycong=" class=\"select\"";
		}elseif($user_filename=="user_file"){
			$user_file=" class=\"select\"";
		}
		
		if($num==5){
			echo $user_pw;
		}elseif($num==1){
			echo $user_cart;
		}elseif($num==4){
			echo $user_data;
		}elseif($num==3){
			echo $user_addr;
		}elseif($num==2){
			echo $user_record;
		}elseif($num==6){
			echo $user_price;
		}elseif($num==7){
			echo $yudi_user_cart;
		}elseif($num==8){
			echo $yudi_user_record;
		}elseif($num==9){
			echo $user_chycong;
		}elseif($num==10){
			echo $user_file;
		}
	}
//----------------------------------------------------------会员右侧导航css设置
	function bk_f_n($filename,$num){
		$user_filename=substr($filename,0,-4);
		if($user_filename=="index"){
			$index=" class=\"th_inkba\"";
		}elseif($user_filename=="gr_list"){
			$gr_list=" class=\"th_inkba\"";
		}elseif($user_filename=="bk_list"){
			$bk_list=" class=\"th_inkba\"";
		}elseif($user_filename=="thread_list"){
			$thread_list=" class=\"th_inkba\"";
		}elseif($user_filename=="th_list"){
			$th_list=" class=\"th_inkba\"";
		}
		
		if($num==1){
			echo $index;
		}elseif($num==2){
			echo $gr_list;
		}elseif($num==3){
			echo $bk_list;
		}elseif($num==4){
			echo $thread_list;
		}elseif($num==5){
			echo $th_list;
		}
	}
//----------------------------------------------------------百科右侧导航css设置
	function user_data_select($inname,$mm,$cookie_uid){
		$sql_rs=$this->db->get_one("select * from user_data where uid='$cookie_uid'");
		if($sql_rs["$inname"]=="$mm"){echo " selected=\"selected\"";}
	}
//---------------------------------------------------------会员个人资料的下拉菜单修改值的显示
	function user_address($cookieuid){
		$sql=$this->db->query("select * from user_addr where uid='$cookieuid'");
		$num=$this->db->num_rows($sql);
		$i=1;
		while($rs=$this->db->fetch_array($sql)){
			echo "<li>
                    	<div class=\"addr_list\">
                        	<h5>".$i.".".$rs["addusername"]."".$this->user_more($rs["mm"])."</h5>
                            <p>".$this->user_chen($rs["city1"])."&nbsp;".$this->user_chen($rs["city2"])."&nbsp;".$this->user_chen($rs["city3"])." </p>
							<p>".$rs["address"]."</p>
                            <p>手机: ".$rs["stel"]." </p>
                            <p>电话: ".$rs["tel"]."  </p>
                            <p class=\"hand\"><a href=\"?action=up&id=".$rs["id"]."#f2\">编辑</a> <a href=\"?action=del&id=".$rs["id"]."\" onclick=\"return ConfirmDelBig();\">删除</a></p>
                        </div>
                    </li>";
					$i++;
		}
		if($num==0){echo "&nbsp;&nbsp;&nbsp;&nbsp;暂无收货地址";}
	}
//--------------------------------------------------------------会员收货地址的显示管理
	function user_chen($whiere){
		$sql_rs=$this->db->get_one("select * from user_chen where chid='$whiere'");
		return $sql_rs["ch"];
	}
//----------------------------------------------------------------城市的查询输出
	function user_more($mm){
		if($mm==1){
			$msg="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>默认地址</font>";
		}else{
			$msg="";
		}
		return $msg;
	}
//----------------------------------------------------------------查出默认地址
	function user_inde_list($bigtype){
		$sql=$this->db->query("select * from add_bottom where bigtype='$bigtype' order by orderid desc limit 0,4");
		while($rs=$this->db->fetch_array($sql)){
			echo "<li><a href=\"/complex,".$rs["id"].".html\">".$rs["title"]."</a></li>";
		}
	}
//---------------------------------------------------------------首页38分快报信息
	function two_bigtype($bigtype){
		$sql=$this->db->query("select typename,typeid from fptype where typenameid='$bigtype' order by orderid desc,id desc");
		if($bigtype=="1151278662875"){$url="chann_list.php";}//1、农副食品
		if($bigtype=="5471278662956"){$url="gklwv_list.php";}//2、粮油调味
		if($bigtype=="3801278662979"){$url="impor_list.php";}//3、休闲食品
		if($bigtype=="5221280112475"){$url="odisg_list.php";}//4、酒水饮料
		if($bigtype=="5741282733600"){$url="whwry_list.php";}//5、宠物用品 
		if($bigtype=="3851282804559"){$url="ukhym_list.php";}//6、家居百货
		if($bigtype=="5631283414561"){$url="penfd_list.php";}//7、礼盒专区 
		while($rs=$this->db->fetch_array($sql)){
			echo "<dt>".$rs["typename"]."</dt>";
			$sql_one=$this->db->query("select typename,typeid from fptype where typenameid='".$rs["typeid"]."' order by orderid desc");
			while($rs_one=$this->db->fetch_array($sql_one)){
				echo "<dd><a href=\"".$url."?typeid=".$rs_one["typeid"]."&t=".$this->dsi_shreypeid($rs_one["typeid"])."&x=1\">".$rs_one["typename"]."</a>|</dd>";
			}
		}
	}
//-------------------------------------------------------------产品二级首页的左侧栏目列表
	function index_bigtype($bigtype,$tj=""){
		if($tj==1){$where_tj="";}else{$where_tj=" and tj='1'";}
		$sql=$this->db->query("select typename,typeid,typenameid from fptype where typenameid in($bigtype)".$where_tj." order by orderid desc,id desc");
		while($rs=$this->db->fetch_array($sql)){
			echo "<dl><a href=\"shops_list1.php?b1=".$rs["typenameid"]."&b2=".$rs["typeid"]."\"  style=\"color:#CC3300;\">".$rs["typename"]."</a></dl>";
			$sql_one=$this->db->query("select typename,typeid from fptype where typenameid='".$rs["typeid"]."' order by orderid desc");
			echo "<ul>";
			while($rs_one=$this->db->fetch_array($sql_one)){
				/*if($this->two_bigtypeid($rs_one["typeid"])=="1151278662875"){$url="chann_list.php";}
				if($this->two_bigtypeid($rs_one["typeid"])=="5471278662956"){$url="gklwv_list.php";}
				if($this->two_bigtypeid($rs_one["typeid"])=="3801278662979"){$url="impor_list.php";}
				if($this->two_bigtypeid($rs_one["typeid"])=="5221280112475"){$url="odisg_list.php";}
				if($this->two_bigtypeid($rs_one["typeid"])=="5741282733600"){$url="whwry_list.php";}
				if($this->two_bigtypeid($rs_one["typeid"])=="3851282804559"){$url="ukhym_list.php";}
				if($this->two_bigtypeid($rs_one["typeid"])=="5631283414561"){$url="penfd_list.php";}*/
				echo "<li><a href=\"shops_list1.php?b1=".$rs["typenameid"]."&b2=".$rs["typeid"]."&b3=".$rs_one["typeid"]."\" class=\"huihui\">".$rs_one["typename"]."</a></li>";
			}
			echo "</ul>";
		}
	}
//-------------------------------------------------------------首页的左侧栏目推荐列表
	function index_new_pro($where_big="",$where_order=1,$userx=1,$num=8){
		if($where_big!=""){//判断栏目页
			$fp_typeid_bb=$this->di_bigtypeid($where_big);
			$sql_where=" where zhcx=0 and bigtype in($fp_typeid_bb)";
		}
		if($where_order==1){//判断是热销还是最新
			$where_order=" order by id desc";
		}else{
			$where_order=" order by rexiao desc,rx desc,id desc";
		}
		if($userx==1){//判断是会员中心推荐
			$sql=$this->db->query("select proname,price2,price,id,file from products".$sql_where.$where_order." limit 0,$num");
		}else{
			$sql=$this->db->query("select proname,price2,price,id,file from products where zhcx=0 and xh='1' order by orderid desc,id desc limit 0,$num");

		}
		
		while($rs=$this->db->fetch_array($sql)){
			echo "<li>
                      <div class=\"shop_forth\">
                          <div class=\"show_img\"><a href=\"".$this->productx($rs["id"],2)."\" class=\"proxm_i\"".$this->productx($rs["id"],2,2)."><img src=\"".$this->images($rs["file"])."\" alt=\"".$rs["proname"]."\"/></a></div>
                          <p class=\"name\"><a href=\"".$this->productx($rs["id"],2)."\" class=\"proxxm\"".$this->productx($rs["id"],2,2).">".$rs["proname"]."</a></p>
                          <p class=\"cost\">￥".$this->price_hko($rs["price2"]).$this->price_pr_list($rs["price"])."</p>
                          <p class=\"bag\">".$this->jerysw_return($rs["id"])."</p>
                      </div>
                 </li>";
		}
	}
//-----------------------------------------------------------------新品上市、热销展示

	function newweb_keyword($num){
		$sql2=$this->db->query("select id,uid,count(rong) as zong,rong,time_at from search_list where duan='1' group by rong order by zong desc,id desc limit $num");
		while($rs2=$this->db->fetch_array($sql2)){
			echo "<a href=\"?rong=".rawurlencode($rs2["rong"])."\">".$rs2["rong"]."</a>";
		}
	}

//------------------------------------------------------------------热门关键词排列
		function images($img){
			$i=$img;
			$y=substr($i,0,-17);
			$d=substr($i,15,400);
			$d=$y."x".$d;
			return $d;
		}
//---------------------------------------------------------------得到产品自动生成的小图片
	function di_bigtypeid($where_big){
		$sql_fp=$this->db->query("select typeid from fptype where typenameid='$where_big'");
		while($rs_fp=$this->db->fetch_array($sql_fp)){
			$fp_typeid.=$rs_fp["typeid"].",";
		}
		$fp_typeid=substr($fp_typeid,0,-1);
		$sql_fp_bb=$this->db->query("select typeid from fptype where typenameid in($fp_typeid)");
		while($rs_fp_bb=$this->db->fetch_array($sql_fp_bb)){
			$fp_typeid_bb.=$rs_fp_bb["typeid"].",";
		}
		$fp_typeid_bb=substr($fp_typeid_bb,0,-1);
		return $fp_typeid_bb;
	}
//--------------------------------------------------------------得知二级分类，查出底层栏目ID
	function two_bigtypeid($where_big){
		$sql_fp=$this->db->get_one("select typenameid from fptype where typeid='$where_big'");
		$sql_fp_typenameid=$sql_fp["typenameid"];
		$sql_fp_t=$this->db->get_one("select typenameid from fptype where typeid='$sql_fp_typenameid'");
		$sql_fp_typenameid_t=$sql_fp_t["typenameid"];
		return $sql_fp_typenameid_t;
	}
//--------------------------------------------------------------得知底层栏目，查出二级栏目ID
	function dsi_bigtypeid($where_big){
		$sql_fp_bb=$this->db->query("select typeid from fptype where typenameid='$where_big'");
		while($rs_fp_bb=$this->db->fetch_array($sql_fp_bb)){
			$fp_typeid_bb.=$rs_fp_bb["typeid"].",";
		}
		$fp_typeid_bb=substr($fp_typeid_bb,0,-1);
		return $fp_typeid_bb;
	}
//--------------------------------------------------------------得知三级分类，查出底层栏
	function dsi_shreypeid($where_big){
		$sql_fp_bb=$this->db->get_one("select typenameid from fptype where typeid='$where_big'");
		$fp_typeid_bb=$sql_fp_bb["typenameid"];
		return $fp_typeid_bb;
	}
//--------------------------------------------------------------得知底层，查三级
	function typename($typeid,$t=""){
		if($t!=""){
			$typeid=$t;
		}
		$sql=$this->db->get_one("select typename from fptype where typeid='$typeid'");
		echo $sql["typename"];
	}
//---------------------------------------------------知道栏目ID，查出栏目名称
	function pinpai($typeid,$canshu,$p){//三级分类的时候
		$sql=$this->db->query("select * from products_pai where bigtype='$typeid' group by pinpai desc");
		while($rs=@$this->db->fetch_array($sql)){
		$sql_count=$this->db->get_one("select count(*) as zong from products_pai where pinpai='".$rs["pinpai"]."' and bigtype='$typeid'");//查出此栏目且此品牌下产品数量
		$sql_p=$this->db->get_one("select typename from fptype where typeid='".$rs["pinpai"]."'");
			echo "<dd><a href=\"?".$canshu."pinpai=".$rs["pinpai"]."\"".$this->pinpai_jiacu($rs["pinpai"],$p).">".$sql_p["typename"]."</a>(".$sql_count["zong"].")</dd>";
		}
	}
	function pinpai_two($t,$canshu,$p){//二级分类的时候
		$sqlt=$this->db->query("select typeid from fptype where typenameid='$t'");
		while($rst=$this->db->fetch_array($sqlt)){$ttyyppee.=$rst["typeid"].",";}
		$ttyep=substr($ttyyppee,0,-1);
		$sql=$this->db->query("select * from products_pai where bigtype in($ttyep) group by pinpai desc");
		while($rs=@$this->db->fetch_array($sql)){
		$sql_count=$this->db->get_one("select count(*) as zong from products_pai where pinpai='".$rs["pinpai"]."' and bigtype in($ttyep)");//查出此栏目且此品牌下产品数量
		$sql_p=$this->db->get_one("select typename from fptype where typeid='".$rs["pinpai"]."'");
			echo "<dd><a href=\"?".$canshu."pinpai=".$rs["pinpai"]."\"".$this->pinpai_jiacu($rs["pinpai"],$p).">".$sql_p["typename"]."</a>(".$sql_count["zong"].")</dd>";
		}
	}
	function pinpai_jiacu($pinpai_sql,$pinpai_get){//加粗设置
		if($pinpai_sql==$pinpai_get){
			$fwrite=" style=\"font-weight:bold;\"";
		}else{
			$fwrite="";
		}
		return $fwrite;
	}
//------------------------------------------------------产品列表页查出品牌列表
	function list_type($typeid,$canshu,$tjt){
		$two_typeid=$this->two_bigtypeid($typeid);
		$sql=$this->db->query("select typeid,typename from fptype where typenameid='$two_typeid' order by orderid desc,id desc");
		while($rs=$this->db->fetch_array($sql)){
			echo "<dd><a href=\"?".$canshu."t=".$rs["typeid"]."\"".$this->pinpai_jiacu($rs["typeid"],$tjt).">".$rs["typename"]."</a>(".$this->list_type_count($rs["typeid"]).")</dd>";
		}
	}
	function list_type_count($typ){//查出二级分类下产品的总数
		$sql_ty=$this->db->query("select * from fptype where typenameid='$typ'");
		while($rs_ty=$this->db->fetch_array($sql_ty)){
			$type_id.=$rs_ty["typeid"].",";
		}
		$type_id=substr($type_id,0,-1);
		$sql_pro=$this->db->get_one("select count(*) as zong from products where bigtype in($type_id) or bigtype_f in($type_id)");
		$pro_zong=$sql_pro["zong"];
		return $pro_zong;
	}
//---------------------------------------------------产品列表页面，按分类查询的二级分类列表
	function list_type_b($typeid,$canshu,$ty,$x=""){
		$sql=$this->db->query("select typeid,typename from fptype where typenameid='$typeid' order by orderid desc,id desc");
		while($rs=$this->db->fetch_array($sql)){
		$sql_pro=$this->db->get_one("select count(*) as zong from products where bigtype='".$rs["typeid"]."' or bigtype_f='".$rs["typeid"]."'");
			if($x==1){$jia_cu=$this->pinpai_jiacu($rs["typeid"],$ty);}
			echo "<dd><a href=\"?".$canshu."typeid=".$rs["typeid"]."&t=".$typeid."&x=1\"".$jia_cu.">".$rs["typename"]."</a>(".$sql_pro["zong"].")</dd>";
		}
	}	
//-----------------------------------------------产品列表页面，查出二级分类下的三级分类
	function bigtype_1($typenameid,$canshu,$bb,$numnone=1){
		$sql=$this->db->query("select * from fptype where typenameid='$typenameid' order by orderid desc,id desc");
		while($rs=$this->db->fetch_array($sql)){
			$in_bigtype=$this->di_bigtypeid($rs["typeid"]);
			$sql_count=$this->db->get_one("select count(*) as zong from products where bigtype in($in_bigtype)");
			if($numnone==1){
			$cout_cong="(".$sql_count["zong"].")";
			}
			echo "<dd><a href=\"?".$canshu."b1=".$rs["typeid"]."\"".$this->pinpai_jiacu($rs["typeid"],$bb).">".$rs["typename"]."</a>".$cout_cong."</dd>";
		}
	}
//-------------------------------------------------热销，最新上架产品---查出产品一级类列表和产品总数
	function bigtype_2($typenameid,$canshu,$bb,$numnone=1){
		$sql=$this->db->query("select * from fptype where typenameid='$typenameid' order by orderid desc,id desc");
		echo "<br />";
		while($rs=$this->db->fetch_array($sql)){
			if($numnone==1){
			$cout_cong="(".$this->list_type_count($rs["typeid"]).")";
			}
			echo "<dd><a href=\"?".$canshu."b2=".$rs["typeid"]."\"".$this->pinpai_jiacu($rs["typeid"],$bb).">".$rs["typename"]."</a>".$cout_cong."</dd>";
		}
	}
//-------------------------------------------------热销，最新上架产品---查出产品二级类列表和产品总数
	function bigtype_3($typenameid,$canshu,$bb,$numnone=1){
		$sql=$this->db->query("select * from fptype where typenameid='$typenameid' order by orderid desc,id desc");
		echo "<br />";
		while($rs=$this->db->fetch_array($sql)){
		$sql_count=$this->db->get_one("select count(*) as zong from products where bigtype='".$rs["typeid"]."' or bigtype_f='".$rs["typeid"]."'");
			if($numnone==1){
				$cout_cong="(".$sql_count["zong"].")";
			}
			echo "<dd><a href=\"?".$canshu."b3=".$rs["typeid"]."\"".$this->pinpai_jiacu($rs["typeid"],$bb).">".$rs["typename"]."</a>".$cout_cong."</dd>";
		}
	}
//-------------------------------------------------热销，最新上架产品---查出产品三级类列表和产品
	function shopcar_num($retu=1,$ipyocjg){
		$ip=$ipyocjg;
		$sql=$this->db->get_one("select count(*) as zong from shopcar where ip='$ip'");
		$pronum=$sql["zong"];
		if($retu==1){echo $pronum;}else{return $pronum;}
	}
//----------------------------------------------------查出购物车共有多少商品
	function shopcar_num_yudi($retu=1,$ipyocjg){
		$ip=$ipyocjg;
		$sql=$this->db->get_one("select count(*) as zong from yudi_shopcar where ip='$ip'");
		$pronum=$sql["zong"];
		if($retu==1){echo $pronum;}else{return $pronum;}
	}
//----------------------------------------------------
	function shopcar_none($ipyocjg){
		$ip=$ipyocjg;
		$sql=$this->db->get_one("select count(*) as zong from shopcar where ip='$ip'");
		$pronum=$sql["zong"];
		if($pronum==0){
			echo " style=\"position:absolute; top:-1888px; left:-900px;\"";
		}else{
			echo "";
		}
	}
//------------------------------------------------------如果购物车有商品，显示下方小层层
	function shopcar_none_yudi($ipyocjg){
		$ip=$ipyocjg;
		$sql=$this->db->get_one("select count(*) as zong from yudi_shopcar where ip='$ip'");
		$pronum=$sql["zong"];
		if($pronum==0){
			echo " style=\"position:absolute; top:-1888px; left:-900px;\"";
		}else{
			echo "";
		}
	}
//------------------------------------------------------如果购物车有商品，显示下方小层层
	function shopcar_price($ipyocjg){
		$ip=$ipyocjg;
		$sql_price_num=$this->db->query("select a.pid,a.num,b.price2,b.tqtgj,b.yudi from shopcar a left join products b on a.pid=b.id where ip='$ip'");
		while($rs_price_num=$this->db->fetch_array($sql_price_num)){
			if($rs_price_num["tqtgj"]==1){$dan_f=$rs_price_num["num"]/500;}else{$dan_f=$rs_price_num["num"];}//如果购买称重商品
			$price_num+=$rs_price_num["price2"]*$dan_f;
		}
		if($price_num==""){$price_num=0;}
		if($price_num==0){
			$price_num=0;
		}else{
			if($price_num<0.01){$price_num=$price_num+2;}
		}
		echo round($price_num,2);
	}
	//-----------------------------------------------------------订单总价格
		function shopcar_price_yudi($ipyocjg){
		$ip=$ipyocjg;
		$sql_price_num=$this->db->query("select a.pid,a.num,b.price2,b.tqtgj,b.yudi from yudi_shopcar a left join products b on a.pid=b.id where ip='$ip'");
		while($rs_price_num=$this->db->fetch_array($sql_price_num)){
			if($rs_price_num["tqtgj"]==1){$danwei_p=$rs_price_num["num"]/500;}else{$danwei_p=$rs_price_num["num"];}
			$price_num+=$rs_price_num["price2"]*$danwei_p;
		}
		if($price_num==""){$price_num=0;}
		if($price_num==0){
			$price_num=0;
		}else{
			if($price_num<0.01){$price_num=$price_num+2;}
		}
		echo round($price_num,2);
	}
	//-----------------------------------------预订总价格
	//-----------------------------------------------------网页右上角的，下面的是
	function ggrrl_get($contentii){
		$ArrFiltrate=array("'",";","union","select","update","and","create","drop","char","insert","(",")","[","]","where","{","}");
		foreach($ArrFiltrate as $keyf => $valf){
			$contentii=str_replace("$valf","",$contentii);
		}
		return $contentii;
}
	function gguuoo_get(){
		foreach($_GET as $key => $val){
			$_GET["$key"]=$this->ggrrl_get($val);
		}
	}
	function ggrrl_post($contentii){
		$ArrFiltrate=array("'",";","union","select","update","and","create","drop","char","insert","where");
		foreach($ArrFiltrate as $keyf => $valf){
			$contentii=str_replace("$valf","",$contentii);
		}
		return $contentii;
}
	function gguuoo_post(){
		foreach($_POST as $key => $val){
			$_POST["$key"]=$this->ggrrl_post($val);
		}
	}
	function set_get_post(){
		$this->gguuoo_get();
		$this->gguuoo_post();
	}
//-----------------------------------------------------防sql注入，过滤GET,POST的值
	function fuuserip(){
		$ip=$_SERVER["REMOTE_ADDR"];
		$sql=$this->db->query("select * from fuserip where ip='$ip'");
		$num=$this->db->num_rows($sql);
		if($num!=0){
			echo "您的电脑提交了恶意订单，请在24小时后在进行提交订单";
			die();
		}
	}
//-----------------------------------------------------------------订单详细页面添加IP，封一天的设置
	function admin_jcpro($proid){
		$sql_rs=$this->db->get_one("select baodis,tqtgj from products where id='$proid'");
		if($sql_rs["baodis"]==1 || $sql_rs["tqtgj"]==1){
			echo "千克";
		}else{
			echo "件";
		}
	}
//-----------------------------------------------------------后台进货纱统的商品单位判断
	function shopcar_price_dkgh($ipyocjg){
		$ip=$ipyocjg;
		$sql_price_num=$this->db->query("select a.pid,a.num,b.price2,b.tqtgj,b.yudi from shopcar a left join products b on a.pid=b.id where ip='$ip'");
		while($rs_price_num=$this->db->fetch_array($sql_price_num)){
		
			if($rs_price_num["tqtgj"]==1){$dan_f=$rs_price_num["num"]/500;}else{$dan_f=$rs_price_num["num"];}//如果购买称重商品
			$price_num+=$rs_price_num["price2"]*$dan_f;
		}
		if($price_num==""){$price_num=0;}
		
		echo round($price_num,2);
	}	
//----------------------------------------------------查出购物车商品共多少钱

function jerysw($rsid){
		$sql=$this->db->get_one("select projnums,tqtgj,yudi,bigtype,price2 from products where id='$rsid'");
		$rsid_projnums=$sql["projnums"];
		$sql_pro_tqtgj=$sql["tqtgj"];
		$sql_pro_yudi=$sql["yudi"];
		$sql_pro_bigtype=$sql["bigtype"];
		$sql_pro_price2=$sql["price2"];
		$time=date("H",time())+8;
		if($sql_pro_tqtgj==1){$calss_css="gou_15";}else{$calss_css="gou_1";}
		
		if($this->dsi_shreypeid($sql_pro_bigtype)=="5551280116413" && $sql_pro_yudi==1 && $sql_pro_tqtgj==1){
			if($time<24 || $time>=1){
				$idkdk="<input name=\"yudip_".$rsid."\" type=\"text\" id=\"yudip_".$rsid."\" onmouseover=\"this.focus();\" onfocus=\"this.select();\" onclick=\"if(this.value=='输入重量') this.value=''\" value=\"输入重量\" class=\"inuyudi\" maxlength=\"8\" onpaste=\"return false;\" onKeyPress=\"keyPressf(event)\" /><span class=\"yug_q\">g</span><a href=\"javascript:proflodk(".$rsid.",".$sql_pro_price2.")\" class=\"yudi_x\"></a>";
			}else{
				$idkdk="<input name=\"yudip_".$rsid."\" type=\"text\" id=\"yudip_".$rsid."\" onmouseover=\"this.focus();\" onfocus=\"this.select();\" onclick=\"if(this.value=='输入重量') this.value=''\" value=\"输入重量\" class=\"inuyudi\" maxlength=\"8\" onpaste=\"return false;\" onKeyPress=\"keyPressf(event)\" style=\"display:none\" /><a href=\"javascript:shop_proflodk(".$rsid.",".$sql_pro_price2.")\" class=\"".$calss_css."\">加入购物车</a><a href=\"javascript:proflodk(".$rsid.",".$sql_pro_price2.")\" class=\"yudi_q\"></a>";
			}
		}elseif($sql_pro_yudi==1 && $sql_pro_tqtgj==1){
		
			$idkdk="<input name=\"yudis_".$rsid."\" type=\"text\" id=\"yudis_".$rsid."\" onmouseover=\"this.focus();\" onfocus=\"this.select();\" onclick=\"if(this.value=='输入重量') this.value=''\" value=\"输入重量\" class=\"inuyudi\" maxlength=\"8\" onpaste=\"return false;\" onKeyPress=\"keyPressf(event)\" /><span class=\"yug_q\">g</span><a href=\"javascript:checkshop_yudi_g(".$rsid.")\" class=\"yudi_x\"></a>";
			
		}elseif($this->two_bigtypeid($sql_pro_bigtype)=="4531288934120" && $sql_pro_yudi==1 && $sql_pro_tqtgj==0){
		
			if($time<24 || $time>=1){
				$idkdk="<a href=\"javascript:checkshop_yudi(".$rsid.")\" class=\"yudi_z\"></a>";
			}else{
				$idkdk="<a href=\"javascript:checkshop(".$rsid.")\" class=\"".$calss_css."\">加入购物车</a><a href=\"javascript:checkshop_yudi(".$rsid.")\" class=\"yudi_q\"></a>";
			}

		}elseif($sql_pro_yudi==1 && $sql_pro_tqtgj==0){
		
			$idkdk="<a href=\"javascript:checkshop_yudi(".$rsid.")\" class=\"yudi_z\"></a>";
			
		}else{
		
			if($time<24 || $time>=1){
				$idkdk="<a href=\"javascript:checkshop_yudi(".$rsid.")\" class=\"yudi_z\"></a>";
			}else{
		
				if($rsid_projnums>0){
					$idkdk="<a href=\"javascript:checkshop(".$rsid.")\" class=\"".$calss_css."\">加入购物车</a><a href=\"javascript:checkshop_yudi(".$rsid.")\" class=\"yudi_q\"></a>";
				}else{
					$idkdk="<a style=\"background:url(/img/ded.jpg); display:block; height:18px; width:60px; text-indent:-9999; float:left;\"></a><a href=\"javascript:checkshop_yudi(".$rsid.")\" class=\"yudi_q\"></a>";
				}
			
			}
		
		}
		echo $idkdk;
	}
//--------------------------------------------------------------------今日已售完 直接输出
	function nnnmqcwc($pid,$qubie,$dateC=1){
		if($dateC != 1){
			$mintian=$dateC;
		}else{
			$mintian=date("Y-m-d",strtotime("+1 day"));
		}
		$sql_shopdan = $this->db->get_one("select a.ymddate,sum(b.num) as jizon from shopaddr a left join shopdan b on a.dingid=b.dingid where b.pid='$pid' and a.ymddate='$mintian' group by b.pid");
		$num_shopdan = $sql_shopdan["jizon"];//得到数量
			//-------------------------------------------------------------------------------------------
			$sql_jnum = $this->db->get_one("select gr_num,tqtgj,baodis,baokenum from products where id='$pid'");
			
			if($sql_jnum["tqtgj"] == 1){//如果 - 称重
				$pro_jnums_2 = $num_shopdan/1000;
				$danwei = "千克";
			}else{//正常
				$pro_jnums_2 = $num_shopdan;
				$danwei = "件";
			}
			//-------------------------------------------------------------------------------------------
		if($qubie == 1){
			if($num_shopdan == ""){$pro_jnums_2=0;}
			return $pro_jnums_2.$danwei;
		}elseif($qubie == 2){
			
			$jinakdu = $sql_jnum["gr_num"] - $pro_jnums_2;
			if($jinakdu <= 0){
				return "<font color=red>已成功</font>";
			}else{
				return "还差".$jinakdu.$danwei."成团";
			}
		}
		
	}
//--------------------------------------------------------------------此函数，计算出当天以送货时间为单位的已购买数量，计算还有多少件就成团了
	function igepw_gr_order(){
		$mintian=date("Y-m-d",strtotime("+8 hours"));
		$this->db->update("update products set gr_order='0' where gr_time<>'$mintian'");
	}
//-------------------------------------------------------------------清空过时的团购排序
	function key_word_my($wordkey,$gid=0){
		//$wordkey = "柜橱，花样,百出，楱，花,样，百出，博，顶,戴，枯干，，，，，";
		$pattern = '/[，|,]/is';
		$keyword_new_array = preg_split($pattern,$wordkey);
		foreach($keyword_new_array as $key => $val){
			if(strlen(strip_tags($val)) > 0){
				$sql_k = $this->db->query("select * from sfi_twg where `key`='$val'");
				$num_k = $this->db->num_rows($sql_k);
				if($num_k == 0){
					$this->db->update("INSERT INTO `sfi_twg` (`id` ,`key` ,`gid` ,`num` )VALUES (NULL , '$val', '$gid', '0');");//插入到标签库
				}else{
					$this->db->update("update sfi_twg set num=num+1 where `key`='$val'");
				}
			}
		}
	}
//-------------------------------------------------------------------//打标签插入到标签表
} 
?>