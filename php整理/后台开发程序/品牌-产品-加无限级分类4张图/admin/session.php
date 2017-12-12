<?php @session_start();
if(empty($_SESSION['adminname'])){
echo "<script>alert('对不起您还没有登陆');location.href ='../xcty.html'</script>";
}
?>