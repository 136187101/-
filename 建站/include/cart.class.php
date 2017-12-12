<?php


class cart1{
	
	private $items;     //商品项目
	public $total_price;  //购物车中总价格
	public $total_nums;   //购物车总商品数

	public function __construct(){
	
	    $this->items =array();
		$this->total_price=0;
	
	}

   /*添加商品*/
    function add($pid){

		if(isset($this->items[$pid])){
			
			$this->items[$pid]++;
		}
		else{
			$this->items[$pid]=1;
		}
	}
   /*清空购物车总的所有商品*/
   public function remove_all(){
   
       unset($this->items);
	   $this->total_price=0;
	   $this->total_nums=0;
	  
   }

   /*通过ID删除商品信息*/
   public function deleteById($pid){
   
       if(isset($this->items[$pid])){
	   
	       unset($this->items[$pid]);
	   }
   }

   /*得到总价格数*/
   public function get_total(){
   
       return $this->total_price;
   }
   /*得到购物车总的商品数*/
   public function get_product_nums(){
   
       return $this->total_nums;
   }

  /*得到商品数*/
   public function get_product_list(){
   
      $product =new product();

	 if(isset($_SESSION['cart']))
	 {
		$cart_data=array();
		$this->total_price =0;
		$this->total_nums =0;
        if(is_array($this->items)){
		foreach($this->items as $key=>$nums)
		{
			$pro=$product->get_productById($key);
			$cart_data[$key]['info'] =$pro;
			$cart_data[$key]['nums'] =$nums;
			$this->total_nums+=$nums;
			$this->total_price+=($pro['now_price']*$nums);
			
		}
		}

	}
	return $cart_data;
   
   }
   /*更新购物车总的信息*/
   public function update($post){
   
       if(isset($post)){
	   
	       foreach($this->items as $pid=>$nums)
		   {
			   if($post[$pid]<=0){
			       unset($this->items[$pid]);
			   }
			   else{
				   $this->items[$pid]=$post[$pid];
			   }
		   }
	   }
   
   
   }
		
    
	
	
	
	
	
}



?>