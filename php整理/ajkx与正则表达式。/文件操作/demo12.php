<?php
	if(file_exists("admin/text.txt"))
		unlink("admin/text.txt");
	if(file_exists("admin"))
		rmdir("admin");
	echo "É¾³ý³É¹¦";
?>