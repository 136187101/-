<?php
//定义日期函数

function getdatetime()
{
 $datetime=getdate();
 $strReturn=$datetime["year"]."-";
 $strReturn=$strReturn.$datetime["mon"]."-";
 $strReturn=$strReturn.$datetime["mday"];
 return $strReturn;
}

//定义时间函数（文件名)
function gettime()
{
 $times=getdate();
 $strtime=$times["year"];
 $strtime=$strtime.$times["mon"];
 $strtime=$strtime.$times["mday"];
 $strtime=$strtime.$times["minutes"];
 $strtime=$strtime.$times["seconds"];
 return $strtime;
}
?>
<?php


//判断提交值是否为空
$submit=$_POST["submit"];
//定义文件头部信息
$htmltitle=$_POST["htmltitle"];
//定义文件内容
$htmlbody=$_POST["content"];
$htmlbody=stripslashes($htmlbody);
if ($submit) {
//定义html文件标签
$html1=$html1."<html>";
$html1=$html1."<head>";
$html1=$html1."<title>";
$html1=$html1.$htmltitle;
$html1=$html1."</title>";
$html1=$html1."<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$html1=$html1."</head>";
$html1=$html1."<body>";
$html1=$html1."<table border='1' width='740' cellpadding='2' cellspacing='0' bordercolordark='#f7f7f7' bordercolorlight='#cccccc'><tr><td align='center' bgcolor='#f7f7f7' height='30'><font size='3'><b>";
$html1=$html1.$htmltitle;
$html1=$html1."</b></font></td></tr>";
$html1=$html1."<tr><td><font size='2'>";
$html1=$html1.$htmlbody;
$html1=$html1."</font></td></tr></table>";
$html1=$html1."</body>";
$html1=$html1."</html>";

//判断今天的文件夹是否存在
if (!is_dir(getdatetime())) {
 //如果不存在就建立
 mkdir(getdatetime(),0777);
}

//写成html文件
$filedir=getdatetime();
$filename=gettime();
$filename=$filename.".html";
$fp=fopen("$filedir/$filename","w");
fwrite($fp,$html1);
fclose($fp);
echo "<script>alert('文件写入成功');location.href='111.php';</script>";
}
?>

