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
	function page_wlgr($shuliang,$pageshulian,$pageno_ajax)//构造函数
	{
		if(!isset($totalpage)){
		$totalpage=($shuliang-1)/$pageshulian+1;
		$totalpage=(int)$totalpage;}
		$pageno=$pageno_ajax;
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
		if((int)$pageno>2)
		{
			$js=(int)$pageno+3;
			$ks=(int)$pageno-3;
			if($ks<1){$ks=1;$js=$ks+2;}
			if($js>(int)$totalpage){$js=(int)$totalpage;$ks=$js-2;}
		}
		else
		{
			if((int)$totalpage>3){$ks=1;$js=3;}else{$ks=1;$js=(int)$totalpage;}
		}
		if($pageno!=1){
		$echo_o .= "<a href=\"#\" _i=\"".$canshu.",1\" name=\"page_im\">首页</a>";
		$echo_o .= "<a href=\"#\" _i=\"".$canshu.",".($pageno-1)."\" name=\"page_im\">上一页</a>";}
		else{
		$echo_o .= "<span>首页</span>";
		$echo_o .= "<span>上一页</span>";
		}
		for($n=$ks; $n<=$js;$n++)
		{
			if(strlen($n)==1){
				if($n==$pageno){$echo_o .= " <span>0".$n."</span>";}else
				{$echo_o .= "<a href=\"#\" _i=\"".$canshu.",".$n."\" name=\"page_im\">0".$n."</a>";}
			}
			else
			{
				if($n==$pageno){$echo_o .= " <span>".$n."</span>";}else
				{$echo_o .= "<a href=\"#\" _i=\"".$canshu.",".$n."\" name=\"page_im\">".$n."</a>";}
			}
		}
		if($pageno!=$totalpage){
		$echo_o .= "<a href=\"#\" _i=\"".$canshu.",".($pageno+1)."\" name=\"page_im\">下一页</a>";
		$echo_o .= "<a href=\"#\" _i=\"".$canshu.",".$totalpage."\" name=\"page_im\">尾页</a>";}else{
		$echo_o .= "<span>下一页</span>";
		$echo_o .= "<span>尾页</span>";
		}
		if($totalpage <= 1){
			return $this->ye();
		}else{
			$echo_o .= $this->ye();
			return $echo_o;
		}
		
		
	}
	function ye()
	{
		$pageno=$this->pageno;
		$totalpage=$this->zongji;
		$shuliang=$this->shuliang;
		$yel="<span>&nbsp;&nbsp;页次:".$pageno."/".$totalpage."&nbsp;&nbsp;共".$shuliang."条</span>";
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
?>