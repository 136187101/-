<?php
//require_once("include/global.php");
class page_wlgr
{
	var $pageno;
	var $zongji;
	var $pageshulian;
	var $jsq;
	var $ksq;
	var $shuliang;
	function page_wlgr($shuliang,$pageshulian)//构造函数
	{
		if(!isset($totalpage)){
		$totalpage=($shuliang-1)/$pageshulian+1;
		$totalpage=(int)$totalpage;}
		$pageno=$_GET["pageno"];
		$pageno=(int)$pageno;
		if($pageno<1){$pageno=1;}elseif($pageno>$totalpage){$pageno=$totalpage;}
		$this->pageno=$pageno;
		$this->zongji=$totalpage;
		$this->pageshulian=$pageshulian;
		$this->shuliang=$shuliang;
	}
	function totoo()//开始的条数
	{
		$pageno=$this->pageno;
		$pageshulian=$this->pageshulian;
		$toto=($pageno-1)*$pageshulian;
		return $toto;
	}
	function jks($canshu="")
	{
		$pageno=$this->pageno;
		$totalpage=$this->zongji;
		$url=$_SERVER['REQUEST_URI'];
		$urlw=strstr($url,'?');
		
		if($urlw)
			{
				$url=$url;	
			}
		else
			{
				$url=$url."?";	
			}
		$pagew=strstr($url,'&pageno');
		$len=strlen($pagew);
		if($pagew)
			{
				$url=substr($url,0,-$len);
				
			}
		if((int)$pageno>7)
		{
			$js=(int)$pageno+3;
			$ks=(int)$pageno-3;
			if($ks<1){$ks=1;$js=$ks+7;}
			if($js>(int)$totalpage){$js=(int)$totalpage;$ks=$js-7;}
		}
		else
		{
			if((int)$totalpage>8){$ks=1;$js=8;}else{$ks=1;$js=(int)$totalpage;}
		}
		if($pageno!=1){
		echo "<a href=\"".$url."&pageno=1\" class=\"fenyecs\">首页</a>&nbsp;&nbsp;";
		echo "<a href=\"".$url."&pageno=".($pageno-1)."\" class=\"fenyecs\">上一页</a>&nbsp;&nbsp;";}
		for($n=$ks; $n<=$js;$n++)
		{
			if(strlen($n)==1){
				if($n==$pageno){echo "<a class=\"fenyecs1\">0".$n."</a>";}else
				{echo "<a href=\"".$url."&pageno=".$n."\" class=\"fenyecs\">[0".$n."]</a>&nbsp;&nbsp;";}
			}
			else
			{
				if($n==$pageno){echo "<a class=\"fenyecs1\">".$n."&nbsp;&nbsp;</a>&nbsp;";}else
				{echo "<a href=\"".$url."&pageno=".$n."\" class=\"fenyecs\">[".$n."]</a>&nbsp;";}
			}
		}
		if($pageno!=$totalpage){
		echo "<a href=\"".$url."&pageno=".($pageno+1)."\" class=\"fenyecs\">下一页</a>&nbsp;&nbsp;";
		echo "<a href=\"".$url."&pageno=".$totalpage."\" class=\"fenyecs\">尾页</a>";}
		$url="";
		echo $this->ye();
		
	}
	
	function ye()
	{
		$pageno=$this->pageno;
		$totalpage=$this->zongji;
		$shuliang=$this->shuliang;
		$yel="<p class=\"yeci\">页次:".$pageno."/".$totalpage."共".$shuliang."条</p>";
		return $yel;
	}
}

//$pagesize=13;//每页多少条
//$sql=$db->query("select * from wlgr_content");
//$numn=$db->num_rows($sql);//得到总条数
//$pa=new page_wlgr($numn,$pagesize);//实例化
//$toto=$pa->totoo();//开始的条数
//$sql2=$db->query("select * from wlgr_content limit ".$toto.",".$pagesize);//要输出的查询
//while($rs=$db->fetch_array($sql2))
//{
//	echo $rs["title"]."<p>";
//}
//echo $pa->jks();

//css
/*分页*/
/*
.fenye{ width:710px; height:70px;}
.fenye .yeci{ float:left; margin-left:10px; padding-top:25px;}
.fenye .fenyex{ height:30px; float:left; margin-top:20px; padding-bottom:20px;}
.fenye .fenyecs{float:left; padding:5px 8px 5px 8px; border:1px #ccc solid; margin-left:5px; color:#575757; display:inline-block; float:left;}
.fenye .fenyecs1{float:left; padding:5px 8px 5px 8px; border:1px #ccc solid; margin-left:5px; color:#000; display:inline-block; float:left;}
.fenye .yes_nr{ float:left; margin-top:25px; margin-left:8px;}
.fenye .zhuanye{ width:34px; height:20px; border:1px #7f9db9 solid; margin-top:20px; line-height:20px; margin-left:5px; margin-right:5px; float:left; }
.fenye .queding{ margin-top:20px; float:left;  margin-left:5px;}
                <div class="fenye">
                <p class="fenyex">
                <?php 
                                echo $pa->jks();
    
                ?>
                </p>    
              </div>

*/


?>