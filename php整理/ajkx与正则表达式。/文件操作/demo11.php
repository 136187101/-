<?php
if(file_exists("admin/text.txt")&&is_file("admin/text.txt"))
{
	$fp=fopen("admin/text.txt","r");
	while(!feof($fp))
	{
		echo fgets($fp)."<br>";
	}
}
?>