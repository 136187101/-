<?php
	$str="AAAbcdefg";
	if(ereg("a+",$str))
		echo "��a";
	else
		echo "û��a";
	echo "<br><br>";
	$str="AAAAAAAAbcdefg";
	if(eregi("a+",$str))
		echo "��a";
	else
		echo "û��a";
?>