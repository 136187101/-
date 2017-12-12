<?php
	// Work-around for setting up a session because Flash Player doesn't send the cookies
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}
	session_start();
	//以下为upload
	$updir="../album/";//上传目录
	$upload_file=$_FILES["Filedata"];
	//中文转换编码
	$file_name = $upload_file['name'];
	//$file_name=iconv("UTF-8","GB2312",$file_name);
	
	//时间戳加随机数
	$suijishu    = time().rand(100,999); 
	$leixing     = strtolower(strrchr($file_name,".")); 
	$upload_file['filename']=$updir.$suijishu.$leixing;

	//取得原来图片名称并去掉类型
	$imgname=substr($file_name,0,-strlen($leixing));
if(@move_uploaded_file($upload_file["tmp_name"],$upload_file["filename"])){
	//图片入库
		//图片为相对路径
		
		$sql="INSERT INTO `album` ( `uid`, `fuid`, `title`, `url`, `fengmian`, `times`, `piliang`) VALUES ('$uid', '$xcfid', '$imgname', '$upload_file[filename]', '0', '$date', '1')";
		//等比例压缩图片，多余用白色背景
		imagezoom($upload_file[filename], $upload_file[filename], 320, 478, '#ffffff');
	//上传成功返回真
	$db->query($sql);

}else{
	//上传失败返回假

	return false;
}
	// The Demos don't save files
	
	exit(0);
?>