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
		echo "<a href=?".$canshu."pageno=1 class=\"p_redirect_l\">首页</a>";
		echo "<a href=?".$canshu."pageno=".($pageno-1)." class=\"p_redirect_l\">上一页</a>";}
		else{
		echo "<a class=\"p_num p_curpage\">首页</a>";
		echo "<a class=\"p_num p_curpage\">上一页</a>";
		}
		for($n=$ks; $n<=$js;$n++)
		{
			if(strlen($n)==1){
				if($n==$pageno){echo " <a class=\"p_num p_curpage\">0".$n."</a>";}else
				{echo "<a href=?".$canshu."pageno=".$n." class=\"p_num\">0".$n."</a>";}
			}
			else
			{
				if($n==$pageno){echo " <a class=\"p_num p_curpage\">".$n."</a>";}else
				{echo "<a href=?".$canshu."pageno=".$n." class=\"p_num\">".$n."</a>";}
			}
		}
		if($pageno!=$totalpage){
		echo "<a href=?".$canshu."pageno=".($pageno+1)." class=\"p_redirect_l\">下一页</a>";
		echo "<a href=?".$canshu."pageno=".$totalpage." class=\"p_redirect_l\">尾页</a>";}else{
		echo "<a class=\"p_num p_curpage\">下一页</a>";
		echo "<a class=\"p_num p_curpage\">尾页</a>";
		}
		//echo $this->ye();
		
	}
	//<a href="#" class="p_redirect_l">上一页</a> <a class="p_num p_curpage">1</a><a class="p_num" href="#">2</a><a class="p_num" href="#">3</a><a class="p_num" href="#">4</a><a class="p_num" href="#">5</a><a class="p_num" href="#">6</a><a class="p_num" href="#">7</a><a class="p_num" href="#">8</a><a class="p_num" href="#">…</a> <a href="#" class="p_redirect_l">下一页</a> <span>(第1页)</span>
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