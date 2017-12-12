<?php
session_start();
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
$num_awt=$_SESSION['authcode'];//验证码

if($_POST["Submit"] == "提交"){

	$num_dcg=$_POST["num_dcg"];
	if($num_dcg!=$num_awt){
		echo "验证码输入错误!";
	}else{
		echo "正确";
	}

}


?>
<form action="" method="post" name="formreg" id="formreg">
<input type="text" maxlength="6" name="num_dcg" class="hei" id="num_dcg">
<img src="coedos_one.php" width="70" height="24" alt="" style="position:relative; top:4px; cursor:hand;" onClick="uiy.src='coedos_one.php?'+Math.random();" id="uiy" /><span  onClick="uiy.src='coedos_one.php?'+Math.random();" style="cursor:hand;">看不清，点一下！</span>
<input type="submit" name="Submit" value="提交" />
</form>