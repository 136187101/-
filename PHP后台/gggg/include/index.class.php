<?php
class liwqbjindex{
	var $db;
	var $js;
	var $liwqbj;
	function liwqbjindex(){
		global $db; 
		global $js;
		global $liwqbj; 
		global $_REQUEST;
		$this->db = $db;
		$this->js = $js;
		$this->liwqbj = $liwqbj;
	}
	//读取网站信息；底部，关于我们....；
	function jibenxinxi($ttslwq){
		$query = "SELECT * FROM lwq_xinxi";
		$this->db->setQuery($query);
		$xinxi = $this->db->loadObject();
		return stripslashes($xinxi->$ttslwq);
	}
	//读取网站信息；底部，关于我们....；
	function dibuxinxi($ttslwq){
		$query = "SELECT * FROM lwq_xinxi";
		$this->db->setQuery($query);
		$xinxi = $this->db->loadObject();
		return stripslashes($xinxi->$ttslwq);
	}
	function about($ttslwq,$ids){
		$query = "SELECT * FROM news where id = $ids";
		$this->db->setQuery($query);
		$xinxi = $this->db->loadObject();
		return $this->liwqbj->liwqbj_str($xinxi->$ttslwq,190,0,'UTF-8');
	}
	function guanyuwom($ttslwq,$ids,$num){
		$query = "SELECT * FROM news where id = $ids";
		$this->db->setQuery($query);
		$xinxi = $this->db->loadObject();
		return $this->liwqbj->liwqbj_str($xinxi->$ttslwq,$num,0,'UTF-8');
	
	
	}
	//读取大类别标题
	function fujilanmu($fuji,$ids,$ttsl){
		if($fuji == ""){
			$query = "SELECT * FROM news_zilei where fuid = $ids";
			$this->db->setQuery($query);
			$fid = $this->db->loadObject();
			$fuji = $fid->id;
		}
		$sql = "select * from news_zilei where id = $fuji";
		$this->db->setquery($sql);
		$funews = $this->db->loadobject();
		return $funews->$ttsl;
	}
	//读取自动跟新的zid；
	function kj_ziid($fuji){
		$sql = "select id from news_zilei where fuid = $fuji";
		$this->db->setquery($sql);
		$funews = $this->db->loadResult();
		return $funews;
	}
	//读取大类别的栏目；
	function fujilanmufor($fuji){
		$sql = "select * from news_zilei where fuid = $fuji";
		$this->db->setquery($sql);
		$futitle = $this->db->loadobjectlist();
		foreach($futitle as $rs){
		$body .= "<tr>
                <td height='30' bgcolor='#eeeeee' style='border-bottom:#FFFFFF solid 1px; padding-left:20px;'><a href='".$this->weijintai(2,$rs->fuid,$rs->id)."' style='color:#000'>".$this->liwqbj->liwqbj_strlwq($rs->zititle,10,0,'UTF-8')."</a></td>
              	</tr>";
		}
		return $body;
	}
	//读取小类别的栏目；
	function zijilanmufor($ziji){
		$sql = "select * from news where ziid = $ziji";
		$this->db->setquery($sql);
		$zjtitle = $this->db->loadobjectlist();
		foreach($zjtitle as $rs){
		$body .= "<tr>
                <td height='30' bgcolor='#eeeeee' style='border-bottom:#FFFFFF solid 1px; padding-left:20px;'><a href='".$this->weijintai($ziji,$rs->ziid,$rs->id)."' style='color:#000'>".$this->liwqbj->liwqbj_strlwq($rs->title,10,0,'UTF-8')."</a></td>
              	</tr>";
		}
		return $body;
	}
	function huoban($ziji){
		$sql = "select * from news where tuijian = 1 and ziid = $ziji";
		$this->db->setquery($sql);
		$huo = $this->db->loadobjectlist();
		foreach($huo as $rs){
		$body .= "<td align=\"center\" style='padding:5px 10px;'><img src=\"".$rs->image."\" width=\"144\"  /></td>";
		}
		return $body;
		//$body = "<a href='#' style='color:#000000;'>".$."</a>&nbsp;&nbsp; &nbsp;";
	
	}
	function youlink(){
		$sql = "select * from link where fid=1";
		$this->db->setquery($sql);
		$link = $this->db->loadobjectlist();
		foreach($link as $rs){
		$body .= "<a href='".$rs->http."' style='color:#000000;' target='_blank'>".$rs->title."</a>&nbsp;&nbsp; &nbsp;";
		}
		return $body;
	}
	
	function news($zid,$num){
		$sql = "select * from news where ziid = $zid and tuijian = 1 order by px desc limit $num";
		$this->db->setquery($sql);
		$now = $this->db->loadobjectlist();
		foreach($now as $rs){
		$body .= " <tr>
                      <td width='7%' height='25' align='center'><img src='images/heidian.jpg' width='3' height='3' /></td>
                      <td width='93%' align='left'><a href='".$this->weijintai($zid,$rs->ziid,$rs->id)."'>".$this->liwqbj->liwqbj_str($rs->title,15,0,'UTF-8')."</a></td>
                    </tr>
";
		}
		return $body;
	}
	
	
	function news_fenlei($zid){
		$sql = "select * from news where ziid = $zid and tuijian = 1 order by px desc";
		$this->db->setquery($sql);
		$now = $this->db->loadobjectlist();
		foreach($now as $rs){
		$body .= " <tr>
                      <td width='7%' height='25' align='center' style='border-bottom:#CCCCCC dashed 1px;'><img src='images/heidian.jpg' width='3' height='3' /></td>
                      <td width='93%' align='left' style='border-bottom:#CCCCCC dashed 1px;'><a href='".$this->weijintai($zid,$rs->ziid,$rs->id)."'>".$this->liwqbj->liwqbj_str($rs->title,15,0,'UTF-8')."</a></td>
                    </tr>
";
		}
		return $body;
	}
	
	
	function news_y($zid,$num){
		$sql = "select * from news where ziid = $zid and tuijian = 1 limit $num";
		$this->db->setquery($sql);
		$now = $this->db->loadobjectlist();
		foreach($now as $rs){
		$body .= " <tr>
                      <td width='7%' height='25' align='center'></td>
                      <td width='93%' align='left'><a href='".$this->weijintai($zid,$rs->ziid,$rs->id)."'>".$this->liwqbj->liwqbj_str($rs->title,15,0,'UTF-8')."</a></td>
                    </tr>
";
		}
		return $body;
	}
	function soulei($ids){
		$sql = "select title from news_zilei where id = $ids";
		$this->db->setquery($sql);
		$now = $this->db->loadResult();
		return $now;
	}
	
	//关于首页为静态连接问题；
	function weijintai($act="",$fid="",$zid=""){
		$sql = "select * from weijingtai where id = 1";
		$this->db->setquery($sql);
		$now = $this->db->loadobject();
		switch ($act){
			case "1":
				if($now->shou){
					return "index.html";
				}else{
					return "index.php";
				}
			break;
			case "2":
				if($now->gongsi){
					return "register".$fid."_".$zid.".html";
				}else{
					return "register_news.php?fid=".$fid."&zid=".$zid."";
				}
			break;
			case "3":
				if($now->kaihu){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "4":
				if($now->fuwu){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "5":
				if($now->zounian){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "6":
				if($now->shuiwu){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "7":
				if($now->renzhen){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "8":
				if($now->zhuanli){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "9":
				if($now->liuxue){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "10":
				if($now->qita){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "11":
				if($now->xinwen){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "12":
				if($now->huoban){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_hzhb".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_hzhb.php?zid=".$fid.$ids."";
				}
			break;
			case "16":
				if($now->dantiao){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "17":
				if($now->dantiao){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "18":
				if($now->dantiao){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;
			case "19":
				if($now->dantiao){
					if($zid == ""){
						$zid = "";
					}else{
						$zid = "_".$zid;
					}
					return "kj_news".$fid.$zid.".html";
				}else{
					if($zid == ""){
						$ids = "";
					}else{
						$ids = "&id=".$zid;
					}
					return "kj_news.php?zid=".$fid.$ids."";
				}
			break;

		}
	}
	
	//关于多级为静态连接问题；
	function weijintaizi($act="",$fid="",$zid="",$ids=""){
		$sql = "select * from weijingtai where id = 1";
		$this->db->setquery($sql);
		$now = $this->db->loadobject();
		switch ($act){
			case "1":
				if($now->shou){
					return "index.html";
				}else{
					return "index.php";
				}
			break;
			case "2":
				if($now->gongsi){
					return "register".$fid."_".$zid."_".$ids.".html";
				}else{
					return "register_news.php?fid=".$fid."&zid=".$zid."&id=".$ids;
				}
			break;
		}
	}
	//读取seo信息内容；
	function seo_news($ttslwq,$ids="",$zid=""){
		if($ids == ""){
			$query = "SELECT * FROM news where ziid = $zid";
		}else{
			$query = "SELECT * FROM news where id = $ids";
		}
			$this->db->setQuery($query);
			$xinxi = $this->db->loadObject();
			return stripslashes($xinxi->$ttslwq);
	}

}
?>