<?php
class page{
	/**
	 * 每页显示的记录数
	 * */
	var $pageSize = null;
	/**
	 * 总页数
	 * */
	var $pageCount = null;
	/**
	 * 最大记录数 
	 * */
	var $maxContentNum = null;
	/**
	 * 当前页的页码
	 * */
	var $pageNo = null;
	/**
	 * 分页前的地址
	 * */
	var $pageUrl = null;
	/**
	 * 分页的地址栏名称
	 * */
	var $pageTags = 'page';
	/**
	 * 分页链接副
	 * */
	var $pageJoin = null;
	/**
	 * 首页标签
	 * */
	var $pageFirst = '|<';
	/**
	 * 上页标签
	 * */
	var $pageUp = '<';
	/**
	 * 下页标签
	 * */
	var $pageDown = '>';
	/**
	 * 末页
	 * */
	var $pageLast = '>|';
	/**
	 * 是否使用数字分页
	 * */
	var $isNumPage = true;
	/**
	 * 数据起始记录
	 * */
	var $limitStart = null;	
	/**
	 * 构造方法
	 * */
	function liwqpage($pagesize , $num , $url){
		$this->pageSize = $pagesize;
		$this->maxContentNum = $num;
		$this->pageUrl = $url;		
		$this->pageJoin = strstr($url,"?") ? "&" : "?";
		$this->pageCount = $this->getPageCount();
		$this->pageNo = $this->getPageNo();
		$this->limitStart = $this->getLimitStart();
	}
	/**
	 * 获得当前页的页码
	 * */
	function getPageNo(){
		global $_GET;
		if(!isset($_GET[$this->pageTags]) || $_GET[$this->pageTags]<1 ) return 1;
		if($_GET[$this->pageTags] > $this->pageCount) return $this->pageCount;
		return $_GET[$this->pageTags];
	}
	/**
	 * 获取总页数
	 * */
	function getPageCount(){
		return ceil($this->maxContentNum / $this->pageSize);
	}
	/**
	 * 设置分页Laber
	 * @param array('','','','')
	 * */
	function setPageLaber( $array ){
		$this->pageFirst = $array[0];
		$this->pageUp 	 = $array[1];
		$this->pageDown  = $array[2];
		$this->pageLast  = $array[3];
	}
	/**
	 * 获取首记录
	 * */
	function getLimitStart(){
		return ($this->pageNo - 1) * $this->pageSize;
	}
	/**
	 * 数字分页
	 * */
	function getNumericPage(){
		for($i = 1;$i <= $this->pageCount; $i++){
			@$pageStr .= $i==$this->pageNo ? "&nbsp;<strong>$i</strong>" : "&nbsp;<a href=".$this->pageUrl.$this->pageJoin.$this->pageTags."=".$i.">$i</a>";
		}
		return @$pageStr;
	}
	/**
	 * 展现分页
	 * */
	function showPage(){
		if($this->pageNo ==1 && $this->pageNo != $this->pageCount){
			@$pageStr .= "$this->pageFirst&nbsp;$this->pageUp&nbsp; &nbsp;<a href=\"".$this->pageUrl.$this->pageJoin.$this->pageTags."=".($this->pageNo+1)."\">$this->pageDown</a>&nbsp;<a href=\"".$this->pageUrl.$this->pageJoin.$this->pageTags."=".$this->pageCount."\">$this->pageLast</a>";
		}elseif($this->pageCount==1){
			@$pageStr .= "$this->pageFirst&nbsp;$this->pageUp&nbsp; &nbsp;$this->pageDown&nbsp;$this->pageLast";
		}elseif($this->pageNo == $this->pageCount && $this->pageNo > 1){
			@$pageStr .= "<a href='".$this->pageUrl.$this->pageJoin.$this->pageTags."=1'>$this->pageFirst</a>&nbsp;<a href='".$this->pageUrl.$this->pageJoin.$this->pageTags."=".($this->pageNo-1)."'>$this->pageUp</a>&nbsp; &nbsp;$this->pageDown&nbsp;$this->pageLast";
		}else{
			@$pageStr .= "<a href='".$this->pageUrl.$this->pageJoin.$this->pageTags."=1'>$this->pageFirst</a>&nbsp;<a href='".$this->pageUrl.$this->pageJoin.$this->pageTags."=".($this->pageNo-1)."'>$this->pageUp</a>&nbsp; &nbsp;<a href=\"".$this->pageUrl.$this->pageJoin.$this->pageTags."=".($this->pageNo+1)."\">$this->pageDown</a>&nbsp;<a href=\"".$this->pageUrl.$this->pageJoin.$this->pageTags."=".$this->pageCount."\">$this->pageLast</a>";
		}
		return $pageStr;
	}
}
?>
