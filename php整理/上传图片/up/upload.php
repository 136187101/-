<?

if($_POST["Submit"] == "提交"){
	
	$file = $_POST["file"];
	
	if($_FILES["file"]["name"]==""){
		$file1="";
	}else{
		$file1=upload("file","/up/pic/",array(".gif",".jpg",".jpeg",".png"),"200000");
	}
	
	echo "<img src=".$file1." />";
}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <input type="file" name="file" />
  <input type="submit" name="Submit" value="提交" />
</form>
</body>
</html>
