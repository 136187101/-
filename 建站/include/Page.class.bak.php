<?php

/***************************
 *@ 分页类
 *@ author:jianghua
 *@ version:2.0
 *@ date:2010-02-05
 ***************************
 *@使用方法:
 *    $page = new page(100,2);
 *    $page->set_header();
 *    $pageList = $page->pageNav();
 */
 
class page
{
    private $Now_page; //当前页
	
	private $show_nums; //每页要显示的记录数
	
	private $total_nums;//总记录数
	
	public $page_header; //页头的信息
	
	public $page; //当前页
	
	private $total_page;//总页数
	
	function __construct($_total_nums,$_show_nums)
	{
         $this->total_nums =$_total_nums;
		 $this->show_nums =$_show_nums;
		 $this->total_page =ceil($this->total_nums/$this->show_nums);
		 $this->get_page();
	}
	

	/*********判断当前页*********/
	 public function get_page()
	 {
		 $this->page=isset($_GET['page'])?$_GET['page']:1;
		 if($this->page<=0)
		 {
			 $this->page=1;
		 }
		 else if($this->page>=$this->total_page)
		 {
			 $this->page=$this->total_page;
		 }
	 }
	 
	 /**
	  *@ 设置页的头信息
	  *@ $info string 分页头的信息
	  */
	  public function set_header($info='')
	  {
		  if(empty($info))
		  {
			  $info ='条记录';
		  }
		  $this->page_header ='共有'.$this->total_nums.$info.'&nbsp'.'当前'.'<font color=red>'.$this->page.'</font>'.'/'.$this->total_page;
	  }



	  function get_url(){
			if(empty($_SERVER['REQUEST_URI'])){
				$url ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			}else{
				$url ='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			}
			if(false!=strpos($url,'?')){
			   $url= preg_replace('/\?page=[0-9]+/','',$url);
			}
			if(false!=strpos($url,'&page=')){
			    $url= preg_replace('/&page=[0-9]+/','',$url);
			}
			
			if(false!=strpos($url,'?')){
				$url =$url.'&page';
			}else{
				$url =$url.'?page';
			}
			return $url;

		}
	 
	 /**
	  * @ 生成分页的导航
	  * @ return $nav
	  *
	  */
	 
	 public function pageNav()
	 {
		 $nav.='<form action="">';
		 $nav.=$this->page_header.'&nbsp;&nbsp;'.'<a href="'.$this->get_url().'=1">首页</a>'.'&nbsp;'.'<a href="'.$this->get_url().'='.($this->page-1).'">上一页</a>';
		 if($this->total_page<=5)
		 {
			 for($i=1;$i<=$this->total_page;$i++)
			 {
				 $nav.="<a href='".$this->get_url()."=$i'>[$i]</a>";
			 }
		 }
		 else if($this->total_page>=5)
		 {
		    
			 if($this->page<=$this->total_page-4)
			 {
                 if($this->page<5)
				 {
                     for($i=1;$i<=5;$i++)
					 {
                         $nav.="<a href='".$this->get_url()."=$i'>[$i]</a>";
					 }
				 }
				 else if($this->page>=5)
				 {
                     for($i=$this->page-2;$i<=$this->page+2;$i++)
					 {
                         $nav.="<a href='".$this->get_url()."=$i'>[$i]</a>";
					 }
				 }

			 }
			 else if($this->page>=$this->total_page-4)
			 {
                 for($i=$this->total_page-4;$i<=$this->total_page;$i++)
				 {
                      $$nav.="<a href='".$this->get_url()."=$i'>[$i]</a>";
				 }
			 }

		 }
		 $nav.='<a href="'.$this->get_url().'='.($this->page+1).'">下一页</a>';
		 $nav.='&nbsp;'.'<a href="'.$this->get_url().'='.($this->total_page).'">尾页</a>';
		 $nav.='&nbsp;&nbsp;'.'<select name="page" onchange="submit();">';
		 for($i=1;$i<=$this->total_page;$i++)
		 {
			 if($this->page==$i)
			 {
			     $options_str.="<option selected='selected'>$i</option>";
			 }
			 else
			 {
                 $options_str.="<option >$i</option>";
			 }
		 }
		 $nav.=$options_str;
		 $nav.='</select>';
		 $nav.='</form>';
		 $nav=str_replace('['.$this->page.']','<font color="#009900">'.$this->page.'</font>',$nav);
		 
		 return $nav;
		 
	 }
	
	
}







?>
