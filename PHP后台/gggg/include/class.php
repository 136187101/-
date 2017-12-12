<?php
class ProductModel{
	var $database;
	function ProductModel(){
		global $database;
		$this->database = $database;
	}
	function masterParame(){
		global $_REQUEST;
		$parentId = $_REQUEST[parentId];
		$query = "SELECT * FROM masterProduct WHERE id=$parentId";
		$this->database->setQuery($query);
		return $this->database->loadObject();
	}
	function getSonTypeData(){
		$query = "SELECT * FROM sonProduct";
		$this->database->setQuery($query);
		return $this->database->loadObjectList();
	}
	function getQuery(){
		$query = "SELECT a.*,b.title as masterTitle,c.title AS sonTitle FROM product a "
				."\n LEFT JOIN masterProduct b ON a.masterId=b.id"
				."\n LEFT JOIN sonProduct c ON a.parentId=c.id"
				."\n ORDER BY a.created desc";
		return $query;		
	}
	function getProductData($pageSize){
		$this->database->setQuery($this->getQuery());
		$num = $this->database->num_rows();
		$page = new Page($pageSize,$num,"admin.product.php");
		$this->database->setQuery($this->getQuery(),$page->limitStart,$pageSize);
		return $this->database->loadObjectList();
	}
	function getPage( $pageSize ){
		$this->database->setQuery($this->getQuery());
		$num = $this->database->num_rows();
		$page = new Page($pageSize,$num,"admin.product.php");
		$page->setPageLaber(array("ҳ","ҳ","ҳ","ĩҳ"));
		return $page->showPage();
	}
	function getProductEditData($id){
		$query = "SELECT * FROM product WHERE id=$id";
		$this->database->setQuery($query);
		return $this->database->loadObject();
	}
	function getMasterId($id){
		$query = "SELECT parentId FROM sonProduct WHERE id=$id";
		$this->database->setQuery($query);
		return $this->database->loadResult();
	}
	function editPro(){
		global $_REQUEST,$_FILES;
		$id = $_REQUEST[id];
		$productTitle = $_REQUEST[productTitle];
		$productInfo  = $_REQUEST[productInfo];
		$price 	=	$_REQUEST[price];
		$sonId = $_REQUEST[sonId];
		$masterId = $this->getMasterId($sonId);
		if($_FILES[image][name]){
			$img = new Image("image","newspic");
			if($img->upload()){
				$image = $img->getImgPath();
			}
			$sqland = ",image='$image'";
		}else{
			$sqland = "";
		}
		$query = "UPDATE product SET productTitle='$productTitle',productInfo='$productInfo',price='$price'"
				.",masterId='$masterId',parentId='$sonId' $sqland "
				."WHERE id=$id";
		$this->database->setQuery($query);
		$this->database->query();
	}
	function saveNew(){
		global $_REQUEST;
		$productTitle = $_REQUEST[productTitle];
		$productInfo  = $_REQUEST[productInfo];
		$price 	=	$_REQUEST[price];
		$sonId = $_REQUEST[sonId];
		$masterId = $this->getMasterId($sonId);
		$created = time();
		$img = new Image("image","newspic");
		if($img->upload()){
			$image = $img->getImgPath();
		}
		$query = "INSERT INTO product"
				."\n (productTitle,image,productInfo,price,masterId,parentId,created)"
				."\n VALUES('$productTitle','$image','$productInfo','$price','$masterId','$sonId','$created')";
		$this->database->setQuery($query);
		$this->database->query();
	}
	function delData( $task ){
		global $_REQUEST;
		if($task=="master"){
			$table = "masterProduct";
		}elseif($task=="son"){
			$table = "sonProduct";
		}elseif($task=="product"){
			$table = "product";
		}
		$id = $_REQUEST[id];
		$query = "DELETE FROM {$table} WHERE id=$id";
		$this->database->setQuery($query);
		$this->database->query();
	}
	function masterData(){
		$query = "SELECT * FROM masterProduct";
		$this->database->setQuery($query);
		$result = $this->database->loadObjectList();
		return $result;
	}
	function sonData(){
		global $_REQUEST;
		$parentId = $_REQUEST[parentId];
		$query = "SELECT * FROM sonProduct WHERE parentId=$parentId";
		$this->database->setQuery($query);
		$result = $this->database->loadObjectList();
		return $result;
	}
	function inserMater(){
		global $_REQUEST;
		$title = $_REQUEST[title];
		$query = "INSERT INTO masterProduct(title) values('$title')";
		$this->database->setQuery($query);
		if($this->database->query()){
			return true;
		}
	}
	function insertSon(){
		global $_REQUEST;
		$title = $_REQUEST[title];
		$parentId = $_REQUEST[parentId];
		$query = "INSERT INTO sonProduct(title,parentId) values('$title','$parentId')";
		$this->database->setQuery($query);
		if($this->database->query()){
			return true;
		}
	}
	function getEditData($task){
		global $_REQUEST;
		$id = $_REQUEST[id];
		if($task=="master"){
			$query = "SELECT * FROM masterProduct WHERE id=$id";
		}
		elseif($task=="son"){
			$query = "SELECT * FROM sonProduct WHERE id=$id";
		}
		$this->database->setQuery($query);
		return $this->database->loadObject();
	}
	function editTypeContent(){
		global $_REQUEST;
		$task = $_REQUEST[task];
		$id = $_REQUEST[id];
		$title= $_REQUEST[title];
		if($task == "master"){
			$query = "UPDATE masterProduct SET title='$title' WHERE id=$id";
		}
		elseif($task == "son"){
			$query = "UPDATE sonProduct SET title='$title' WHERE id=$id";
		}
		$this->database->setQuery($query);
		if($this->database->query()) return true;
		return false;
	}
}
?>