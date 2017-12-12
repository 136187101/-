<?php

/**
 * @得到一个带缩进的分类树
 */
function get_productCat_tree($cat_id,$level)
{
	global $productCat_tree;
	global $product_cat;
	if(is_array($product_cat))
	{
		foreach($product_cat as $cat)
		{
			if($cat['parent_id']==$cat_id)
			{
				for($i=1;$i<$level;$i++)
				{
					$str.='&nbsp;&nbsp;&nbsp;';
				}
				$cat['cat_name']=$str.$cat['cat_name'];
				$productCat_tree[] =$cat;
				$str ='';
                get_productCat_tree($cat['cat_id'],++$i);

			}
		}
	}
}
/**
 * 返回一个分类树
 * @param int $cat_id 分类ID
 * @param int $level 分类级别
 * @ return tree array
 */
function get_tree($cat_id,$level)
{
	global $cat_list;
	global $cat_tree;
	if(is_array($cat_list))
	{
		foreach($cat_list as $val)
		{
			if($val['parent_id']==$cat_id)
			{
				for($i=1;$i<$level;$i++)
				{
                     $str.='&nbsp;&nbsp;';
				}
				if(empty($str)){
				    $str='';
				}else{
                    $str.=$str.'|-';
				}
				$val['level'] =$level;
				$val['cat_name'] =$str.$val['cat_name'];
				$str ='';
				$cat_tree[]=$val;
				get_tree($val['cat_id'],$level+1);
			}			
			

		}
		
	}
	return $cat_tree;
}

    /**
	 * @检查分类是否存在子类
	 */

	 function is_hasChildren($cat_id)
	 {
        global $db;
		$sql ="SELECT `parent_id` FROM `product_cat`";
		$info =$db->getAll($sql);
		if(is_array($info))
		{
            foreach($info as $val)
			{
				if($cat_id==$val['parent_id'])
				{
					return true;
				}
			}
		}
		return false;
		

	 }

  //取得上级分id
  function get_parent_id($cat_id)
  {
	  global $db;
	  $sql ="SELECT * FROM `product_cat` WHERE `cat_id`='$cat_id'";
	  $info =$db->getOne($sql);
	  if(!empty($info))
	  {
		  return $info['parent_id'];
	  }
	  return 0;

  }

  //得到品牌列表
  function get_brand_list()
  {
	  global $db;
	  $sql ="SELECT * FROM `brand`";
	  $brand=$db->getAll($sql);
	  if(is_array($brand)){
	  
	      return $brand;
	  }
	  return $brand =array();
  }


?>