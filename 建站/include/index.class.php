<?php

class liwqbjindex{
	var $db;
	var $js;
	function liwqbjindex(){
		global $db; 
		global $js;
		global $liwqbj; 
		global $_REQUEST;
		$this->db = $db;
		$this->js = $js;
		$this->liwqbj = $liwqbj;
	}	
	

  function site_info(){
  $sql="select * from site_info where id=1";
  return $this->db->fetch_object($this->db->query($sql));
  }
  
  function essay_zhu($id,$title){
  $sql="select * from essay_zilei where id=$id";
  $rows1=$this->db->getOne($sql);
  return $rows1[$title];
  }
  
  function essay_ziid($id,$biaoti){
  $sql="SELECT * FROM `essay` WHERE id =$id";
  $rows=$this->db->getOne($sql);
  return $rows[$biaoti];
  }
  
  function essay_wfy($zid,$px,$limit)
  {
  	$rs=mysql_query("select * from essay where  ziid ='$zid' order by '$px' desc limit 0,$limit");
  	while ($rows=mysql_fetch_array($rs))
  	{
  		$row[]=$rows;
  	}
  	return $row;
  }
  //焦点图
  function jiaodian($px,$limit){
	  $rs=$this->db->query("select * from jiaodian order by $px desc limit 0,$limit");
	  while($rows=mysql_fetch_array($rs))
	  	{
			$jiao[]=$rows;
		}
	  return $jiao;
	  }
  
  
  function essay_zilei($id){
  $sql="select * from essay_zilei where fuid=$id";
  return $this->db->getAll($sql);
  }
  
  
  function essay_ziid2($id,$biaoti){
  $sql="SELECT * FROM `essay` WHERE ziid =$id";
  $rows=$this->db->getOne($sql);
  return $rows[$biaoti];
  }  
  
  function essay_referrals(){
  $sql="select a.id,a.title,a.image,b.fuid from essay as a,essay_zilei as b where b.fuid=3 and b.id=a.ziid and a.tuijian=1";
  return $this->db->getAll($sql);
  }
  
  function essay_id($id){
  $sql="SELECT * FROM `essay` WHERE id =$id";
  return $this->db->fetch_object($this->db->query($sql));
  }
  
  
  function essay_xinxi($id){
  $sql="SELECT * FROM `essay` WHERE id =$id";
  return $this->db->fetch_object($this->db->query($sql));
  }
	
  function link_list(){
  $sql="SELECT * FROM `link` ORDER BY `link`.`px` ASC ";
  return  $this->db->getAll($sql);
  }	
  
  function jiaodian_list($id){
  $sql="select * from jiaodian where id=$id";
  return $this->db->fetch_object($this->db->query($sql));
  }
	
/*	
	function liulan($id){  //储存浏览记录的id
	
	if(!empty($_COOKIE['seen'])){
	$history_look = explode('|',$_COOKIE['seen']);
	
		 if(!in_array($id,$history_look)){
		setcookie('seen',$_COOKIE['seen'].'|'.$id,time()+3600);
											}
	}else{
	
	setcookie('seen',$id,time()+3600);//有效时间1个小时
	}
	}
	
	
	function jilu(){  //输出浏览记录
		$pid_array = explode('|',$_COOKIE['seen']);
	$pid_array =array_reverse($pid_array);  //逆序,保证显示最后浏览的5个商品
		foreach($pid_array as $key=>$id){
	if(is_numeric($id)){
		if($key<10){
		$sql="select * from news where id=$id";
		$query=$this->db->query($sql);
		$array[]=$this->db->fetch_array($query);
				}
						}
	
										} 
			return $array;							
										
					}
	
	
	
    function sorts(){  //输出 一级分类和二级分类
   $sql ="SELECT * FROM `news_zilei`";
   $cat_info =$this->db->getAll($sql);
   foreach($cat_info as $v){
       $cat_dh[$v['fuid']][]=$v;
   }
   return $cat_dh;
   }
	
	

  
  function brand_click($id,$sale){//添加点击率
	$sq="UPDATE brand SET sale =($sale+1) WHERE brand_id ='$id' ";
	$this->db->query($sq);
	$sql="select * from brand where brand_id=$id";	
	return $this->db->fetch_object($this->db->query($sql));
  
  }
  

  
  function calendar($id){  //输出星期几

  $week=date('w', strtotime("+$id day"));
 

   if($week=="0"){
   
    return "Sun";
	
   }elseif($week=="1"){
   
   return "Mon";
   
   }elseif($week=="2"){
   
   return "Tue";
   
   }elseif($week=="3"){
   
   return "Wed";
   
   }elseif($week=="4"){
   
   return "Thu";
   
   }elseif($week=="5"){
   
   return "Fri";
   
   }elseif($week=="6"){
   
   return "Sat";
   
   }
   }
  

  function collect($user_id,$news_id){ //添加收藏
   $sq="SELECT * FROM `collect` WHERE `user_id` =$user_id AND `news_id` =$news_id";
    $win=$this->db->query($sq);
	$succeed=$this->db->fetch_nums($win);
	 if($succeed){ 
	   return false;
	 }else{
  $sql="INSERT INTO `collect` (`id` ,`user_id` ,`news_id` )VALUES (NULL , '$user_id', '$news_id')";
   $this->db->query($sql);
    return true;
          }
  }
  
  
   function  collect_list($id){ //输出收藏
   $sql="SELECT * FROM `collect` WHERE `user_id` =$id";
   $user_list=$this->db->getAll($sql);
      if(!empty($user_list)){
    foreach($user_list as $v){
	$sq="select * from news where id=$v[news_id]";
	 $collect[]=$this->db->getOne($sq);
	
	 }
        return $collect;
		
		}
     }
  
    function collect_delete($user_id,$news_id){//删除收藏
	$sql="delete from collect where user_id=$user_id and  news_id=$news_id";
	 $this->db->query($sql);
	 return true;
	}
  
 
 
  function user_judgment($name,$email){  //判断用户姓名和邮箱是服相同和一样  存在
  $sql="select * from user where user_name=$name and email=$email";
  $nums=$this->db-query($sql);
   return $this->db-fetch_nums($nums);
   }
  
  function user_review($id){
  $sql="select a.title,b.* from news as a ,comment as b where b.user_id=$id and a.id=b.product_id";
  return $this->db->getAll($sql);
  
  }
  
   function user_datum($id){
  $sql="select * from user where user_id=$id";
 return  $this->db->getOne($sql);
  }
  
  
  function brand_datum($id){
  $sql="select * from brand where brand_id=$id";
 return  $this->db->getOne($sql);
  }
  
  
  function genera(){
  $sql="SELECT * FROM `brand` ORDER BY 	`order_number` ASC ";
  return  $this->db->getAll($sql);  
  }
	
  function product_list($id){
  $sql="select * from news where brand_id=$id";
  return  $this->db->getAll($sql);  
  }	
  
  function product_detail($id){
  $sql="select * from news where id=$id";
  return  $this->db->getOne($sql);
  }	
  
		
  function comment_list($id){
  $sql="select * from comment where state=1 and product_id=$id";
  return  $this->db->getAll($sql);
  }					
				
  function user_list($id){
  $sql="select * from user where user_id=$id";
  return $this->db->fetch_object($this->db->query($sql));
  }					
	
 
  
  function product_sirelist($id){
  $sql="select * from news where ziid=$id";
  return  $this->db->getAll($sql);
  }
  
  function host_sirelist($id){
  $sql="select news_zilei.*,news.* from news_zilei,news where news_zilei.fuid=$id and  news_zilei.id=news.ziid";
  return  $this->db->getAll($sql);
  }
  
  function seek($id){
  $sql="SELECT * FROM `news` WHERE `title` LIKE '%$id%'";
  return  $this->db->getAll($sql);
  }
  
  
  function random(){
  $sql="select * from  brand order by rand() limit 1,10";
  return $this->db->getAll($sql);
  }
  
  
  function shopping($id){
  $sql="select * from shopping where product=$id";
  return $this->db->fetch_object($this->db->query($sql));
  }
  
  function address_list($id){
   $sql="select * from address where user_id =$id";
	return $this->db->getAll($sql);
    }
  
  function address_alter($id){
  $sql="select * from address where id =$id";
  return  $this->db->getOne($sql);
  }
 
 
 
 
 //所有主类下的子类的文章
$sql3="select a.*,b.*  from news_zilei as a,news as b where a.fuid in (select id from news_zilei where fuid in (select id from news_zilei where id=3)) and  a.id=b.ziid"; 
 
  
 */ 
  
  }
?>