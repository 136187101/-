<?php
if(file_exists("shige.txt"))
{
	$fp=fopen("shige.txt","r");
	$str="";
	while(!feof($fp))
	{
		$temp=fgets($fp);
		if(ereg("-+",$temp))
			$str.=$temp;
		else
			$str.=$temp."<br>";
	}
	fclose($fp);
	$array=split("-+",$str);
	$pageno=$_GET["pageno"];
	if($pageno=="" || $pageno<1)
		$pageno=1;
	if($pageno>count($array))
		$pageno=count($array);
	echo $array[$pageno-1];
	for($i=1;$i<=count($array);$i++)
		echo "<a href='?pageno={$i}'>{$i}</a>&nbsp;";
}
?>