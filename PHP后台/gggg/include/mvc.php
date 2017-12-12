<?php
require_once "../../global.php";
require_once "admin.product.html.php";
require_once "admin.product.class.php";
/**
	C
*/
$productAction = new ProductAction();
switch( $act ){
	case "insertmaster":
		$productAction->insertMaster();
		break;
	case "insertson":
		$productAction->insertson();
		break;	
	case "addmaster":
		$productAction->addmaster();
		break;
	case "addson" :
		$productAction->addson();
		break;
	case "save":
		$productAction->save();
		break;	
	case "del":	
		$productAction->del();
	case "edit" :	
		$productAction->edit();
		break;
	case "editTypeContent":
		$productAction->editTypeContent();
		break;
	case "addproduct":
		$productAction->addProduct();
		break;
	default : 
		$productAction->_default();
		break;
}
class ProductAction{
	var $productModel;
	
	function ProductAction(){
		$this->productModel = new ProductModel();
	}
	
	function _default(){
		//产品展示部分
		$pagesize = 10;
		$rows = $this->productModel->getProductData( $pagesize );
		$page = $this->productModel->getPage( $pagesize );
		ProductHtml::_default($rows,$page);
	}
	function addProduct(){
		//添加产品
		$rows = $this->productModel->getSonTypeData();
		ProductHtml::addProduct( $rows );
	}
	
	function addmaster(){
		//添父类展现
		$row = $this->productModel->masterData();
		ProductHtml::addMarster( $row );//控制V层动作
	}
	function save(){
		//保存
		global $_REQUEST;
		if($_REQUEST[task]=="new"){
			 $this->productModel->saveNew();
			 $this->printMsg("admin.product.php?","添加成功");
		}elseif($_REQUEST[task]=="edit"){
			$this->productModel->editPro();
			 $this->printMsg("admin.product.php?","修改成功");
		}
	}
	function insertMaster(){
		//插数据父类
		if($this->productModel->inserMater()){
			$this->printMsg("admin.product.php?act=addmaster","添加成功");
		}
	}
	function insertson(){
	//插数据子类
		if($this->productModel->insertSon()){
			$this->printMsg("admin.product.php?act=addson&parentId=".$_REQUEST['parentId'],"添加成功");
		}
	}
	function edit(){
	//修改
		global $_REQUEST;
		if( $_REQUEST[task] =="master"){
			$row = $this->productModel->getEditData("master");
			ProductHtml::edit( $row , "master" );
		}
		elseif($_REQUEST[task]=="son"){
			$row = $this->productModel->getEditData("son");
			ProductHtml::edit( $row , "son" );
		}
		else if($_REQUEST[task]=="product"){
			$marterData = $this->productModel->getSonTypeData();
			$row = $this->productModel->getProductEditData( $_REQUEST['id'] );
			ProductHtml::editProduct($marterData , $row);
		}
	}
	function editTypeContent(){
	//修改类别
		global $_REQUEST;
		if($_REQUEST[task]=="master"){
			if($this->productModel->editTypeContent()){
				$this->printMsg("admin.product.php?act=addmaster","修改成功");
			}
		}elseif($_REQUEST[task]=="son"){
			if($this->productModel->editTypeContent()){
				$this->printMsg("admin.product.php?act=addson&parentId=".$_REQUEST[parentId],"修改成功");
			}
		}
		
	}
	function del(){
	//删除操作
		global $_REQUEST;
		if($_REQUEST[task]=="master"){
			$this->productModel->delData("master");
			$act = "addmaster";
		}
		elseif($_REQUEST[task]=="son"){
			$this->productModel->delData("son");
			$act = "addson&parentId=".$_REQUEST[parentId];
		}
		elseif($_REQUEST[task]=="product"){
			$this->productModel->delData("product");
			$act = "";
		}
		$this->printMsg("admin.product.php?act=$act","删除成功");
	}
	function addson(){
	//添加子类
		$masterParame = $this->productModel->masterParame();
		$sonData =  $this->productModel->sonData();
		ProductHtml::addson( $masterParame,  $sonData );
	}
	function printMsg($url,$msg){
	//跳转的
		global $js;
		$js->Goto($url."&msg=".urlencode($msg));
	}
}
?>