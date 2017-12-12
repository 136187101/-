<?php

    class product{
	
	    private $price;

		private $name;

		private $image;

	   public function __construct(){
	   
	   }

	   public function get_productById($pid){
	       global $db;
	       $sql="SELECT * FROM `news` WHERE `id`='$pid'";
		   $data= $db->getOne($sql);
		   return $data;
	   
	   }

	
	}


?>