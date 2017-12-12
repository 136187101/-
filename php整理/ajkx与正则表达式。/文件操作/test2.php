<?php
	$str="AAAbcdefg";
	if(ereg("a+",$str))
		echo "有a";
	else
		echo "没有a";
	echo "<br><br>";
	$str="AAAAAAAAbcdefg";
	if(eregi("a+",$str))
		echo "有a";
	else
		echo "没有a";
?>