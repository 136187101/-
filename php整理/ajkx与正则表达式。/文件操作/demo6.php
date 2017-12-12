<?php
	$fp=fopen("temp.txt","r");
	while(!feof($fp))
	{
		echo fgets($fp)."<br>";
	}
?>