<?php
	if(file_exists("news.txt"))
	{
		$fp=fopen("news.txt","r");
		$str="";
		$n=0;
		while(!feof($fp))
		{
			$str.=fgets($fp)."<br>";
			$n++;
			if($n%20==0)
				$str.="|||||||";
		}
		$array=split("\|{7}",$str);
		$pageno=$_GET["pageno"];
		if($pageno==""||$pageno<1)
			$pageno=1;
		if($pageno>count($array))
			$pageno=count($array);
		echo $array[$pageno-1];
		for($i=1;$i<=count($array);$i++)
			echo "<a href='?pageno={$i}'>{$i}</a> ";
	}
?>