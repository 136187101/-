<?php


class cart1{
	
	private $items;     //��Ʒ��Ŀ
	public $total_price;  //���ﳵ���ܼ۸�
	public $total_nums;   //���ﳵ����Ʒ��

	public function __construct(){
	
	    $this->items =array();
		$this->total_price=0;
	
	}

   /*�����Ʒ*/
    function add($pid){

		if(isset($this->items[$pid])){
			
			$this->items[$pid]++;
		}
		else{
			$this->items[$pid]=1;
		}
	}
   /*��չ��ﳵ�ܵ�������Ʒ*/
   public function remove_all(){
   
       unset($this->items);
	   $this->total_price=0;
	   $this->total_nums=0;
	  
   }

   /*ͨ��IDɾ����Ʒ��Ϣ*/
   public function deleteById($pid){
   
       if(isset($this->items[$pid])){
	   
	       unset($this->items[$pid]);
	   }
   }

   /*�õ��ܼ۸���*/
   public function get_total(){
   
       return $this->total_price;
   }
   /*�õ����ﳵ�ܵ���Ʒ��*/
   public function get_product_nums(){
   
       return $this->total_nums;
   }

  /*�õ���Ʒ��*/
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
   /*���¹��ﳵ�ܵ���Ϣ*/
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