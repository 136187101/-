<?php
	if(file_exists("admin/text.txt"))
		unlink("admin/text.txt");
	if(file_exists("admin"))
		rmdir("admin");
	echo "ɾ���ɹ�";
?>