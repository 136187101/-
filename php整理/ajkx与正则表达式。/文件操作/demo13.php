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
	echo "ɾ���ɹ�";
?>