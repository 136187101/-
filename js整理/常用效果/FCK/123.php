<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
$aa=$_POST[zhi];
if(isset($aa)){
	echo $aa;
}else{
	echo "123";
	}
?>
<form action="" method="post" name="xapmle">
<div style="border:1px #0FF solid; width:650px;" id="qw">
<?php
                           
						   require_once "fckeditor/fckeditor.php";//包含
						   $oFCKeditor = new FCKeditor ( 'zhi' );//调用id
                            $oFCKeditor->BasePath = "fckeditor/";
                            $oFCKeditor->Value = "sdgdgdrg";//值
							$FCKeditor->Width='100%';//宽
                            $oFCKeditor->Height = 350;//高
                            $oFCKeditor->Create (); 
                    ?>
                    </div>
                    <input type="submit" value="ok" />
                    </form>
</body>
</html>























首先FCKEditor不会给你做转义处理 
取转义的工作要由你自己进行 

当magic_quotes_gpc   =   1   时 
提交的数据可直接如库而不必做任何处理 

通常的做法是先根据magic_quotes_gpc状态做去转义处理，然后在入库时做转义处理 
即 
提交后 
$contetn   =$_POST[ 'content ']; 
if   (get_margic_quotes_gpc()   !=   0)   { 
    $content   =   stripslashes($content); 
} 

入库前 
$content   =   addslashes($content); 

这样当向数据库插入非提交的数据时也不会出现问题 

又 
既然你使用模板引擎，那么可把FCKEditor放在模板函数中 
以smarttemplate为例，可以 
smarttemplate_extension_editer.php 
<?php 
/** 
  *   功能函数 
  *   用于调用在线编辑器 
  *   引用格式   {editer: "编辑区变量名 ", "宽度 ", "高度 ", "样式 "} 
  *   样式可缺省，可以有Basic、Accessibility 
  **/ 
function   smarttemplate_extension_editer($submit,   $width,   $height,   $mode= " ")   { 
echo   ' <script   src= "fckeditor/tool.js "> </script> '; 
$oFCKeditor   =   new   FCKeditor   ; 
$oFCKeditor-> ToolbarSet   =   $mode   ; 
if(!   empty($GLOBALS[$submit])) 
$oFCKeditor-> Value   =   $GLOBALS[$submit]   ; 
else 
$oFCKeditor-> Value   =   $_POST[$submit]   ; 
$oFCKeditor-> CreateFCKeditor(   $submit,   $width,   $height   )   ; 
} 
?> 
模板中 
<form   method=post> 
{editer: "content ", "100% ", "350 "} 
<input   type=submit> 
</form>