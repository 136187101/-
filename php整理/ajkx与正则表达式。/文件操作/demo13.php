<?php
	$folder=opendir("admin");
	while($f=readdir($folder))
	{
		if($f!="." && $f!="..")
		{
			unlink("admin/{$f}");
		}
	}
	closedir();
	rmdir("admin");
	echo "É¾³ý³É¹¦";
?>