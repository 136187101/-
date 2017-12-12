<?php
//会员信息
@header('Content-type: text/html;charset=utf-8');
require('include/init.php');
session_start();
$num_awt=$_SESSION['authcode'];//验证码
$usid=$_COOKIE["uid"];
//发表帖子
if($_POST["tsubmit"])
{
	foreach($_POST as $key=>$val)
	{
		$$key=$val;	
	}	
	if($num_awt!=$num_dcg)
	{
		$js->Alert("验证码输入错误");
		$js->Goto("bbs.php");
	}
	//$sql="INSERT INTO `bbs` (`uid`, `title`, `content`, `usname`, `times`, `dianji`) VALUES ('$usid', '$title', '$content', '$usname', '$times', '0');";
	if($db->query($sql))
	{
		$js->Alert("发表成功");
		$js->Goto("bbs.php");	
	}	
	else{ $js->Alert("发表失败");}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>张家麟个人网站</title>
<link href="css/zhangjl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/webjs.js"></script>
		<script charset="utf-8" src="hubb/kindeditor-min.js"></script>
		<script charset="utf-8" src="hubb/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					themeType : 'simple',
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
		</script>

<script language="javascript">
//验证发表
function tiefn(){
		var title=document.addtiefor.title.value;
		var dcg=document.addtiefor.num_dcg.value;
		if(title=="")
		{
			alert("请填写标题");
			document.addtiefor.title.focus();
			return false;	
		}
		else if(dcg=="")
		{
			alert("请输入验证码");
			document.addtiefor.num_dcg.focus();
			return false;
		}
		if(document.all("duicuo").value=="1")
		{
			alert("验证码错误");
			document.addtiefor.num_dcg.select();
			return false;
		}	
/*		else
		{
			//验证码
			$(document).ready(function(e) {
                $.get("yan_dcg.php?"+new Date(),{value:dcg},function(date){
						alert(date)
						if(date=="f")
						{
							(".duicuo").val="1";
						}
						else
						{
							(".duicuo").val="0";
							
						}
					})
					
            });	
		}
		if(document.all("duicuo").value=="1")
		{
			
			document.addtiefor.num_dcg.select();
			return false;
		}
		else
		{
			alert("正确");	
		}

*/	}
$(document).ready(function(e) {
    $("#num_dcg").blur(function(){
				var dcg=document.addtiefor.num_dcg.value;
                $.get("yan_dcg.php?"+new Date(),{value:dcg},function(date){
						if(date=="f")
						{
							document.all("duicuo").value="1";
						}
						else
						{
							document.all("duicuo").value="0";
						}
					})
		})
});
</script>
</head>
<body>
<!---->
<div class="Overall">
<!--头部-->
<?php require("inc/top.php");
?>


<div class="about_an">
      <!--案例介绍-->
      <div class="aboutleft">
        <div class="about_ad"><img src="images/contbottom.jpg" /></div>
  </div>
      <div class="abcont">
        <div class="abcont_top">
          <h2>博客交流</h2>
          <p>当前位置： <a href="index.php">首页</a> &gt; 博客交流</p>
        </div>
        <div class="abcont_zh">
          <div class="abcontent">
          	<div class="bbs">
          	  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="bbs_t">
          	    <tr>
          	      <td align="left" valign="top">&nbsp;</td>
          	      <td height="43" align="left" valign="top">&nbsp;</td>
          	      <td>
                  <?php if($_COOKIE["uid"]){?>
                  <a href="#addtie"><img src="images/fatie_03.jpg" width="91" height="25" /></a>
                  <?php }else{?>
                  <a onclick="alert('登录后才可发表帖子')" style="cursor:pointer;" ><img src="images/fatie_03.jpg" width="91" height="25" /></a>
				  <?php }?>
                  </td>
       	        </tr>
             	<?php
                	//全部贴子
					$rs_tie=$db->query("select * from bbs order by times desc");
					while($rows_bbs=$hjd->fetch_array($rs_tie))
					{
				?>   
          	    <tr>
          	      <td width="80" align="left" valign="top"><p class="dianjs"><?php echo $rows_bbs["dianji"];?></p></td>
          	      <td width="490" height="43" align="left" valign="top"><p class="title"><a href="#"><?php echo $rows_bbs["title"];?></a></p>
                  <p class="content"><?php echo $hjd->SubTitle($hjd->pregstring($rows_bbs["content"]),100);?></p>
                  </td>
          	      <td><p class="name"><img src="images/xiaoren_06.jpg" width="10" height="10" />&nbsp;&nbsp;<?php echo $rows_bbs["usname"]?></p></td>
       	        </tr>
       	     	<?php
					}
				?>
              </table>
				<div class="add_bbs"  id="addtie">
                <?php if($_COOKIE["uid"]){?>
				  <form id="addtiefor" name="addtiefor" method="post" action="" onsubmit="return tiefn()" >
                  <input name="tsubmit" type="hidden" value="1" />
                  <input name="duicuo" id="duicuo" type="hidden" value="0"  />
				    <table width="100%" border="0" cellspacing="0" cellpadding="0">
				      <tr>
				        <td width="59" align="right" valign="top"><strong>发表新帖</strong></td>
				        <td height="33">&nbsp;</td>
			          </tr>
				      <tr>
				        <td align="right">标题：</td>
				        <td height="32"><input type="text" name="title" id="title" class="f_bbs_k" /></td>
			          </tr>
				      <tr>
				        <td height="10" colspan="2" align="right"></td>
			          </tr>
				      <tr>
				        <td align="right" valign="top">内容：</td>
				        <td height="246" align="left" valign="top">
							<textarea name="content" style="width:600px;height:227px;visibility:hidden;"></textarea>
                        </td>
			          </tr>
				      <tr>
				        <td align="right">用户名：</td>
				        <td height="32"><input name="usname" type="radio" id="radio" value="<?php echo $_COOKIE["usersname"];?>" checked="checked" />
			            <?php echo $_COOKIE["usersname"];?>
		                <input name="usname" type="radio" id="radio2" value="匿名用户" />
		                匿名用户</td>
			          </tr>
				      <tr>
				        <td align="right">验证码：</td>
				        <td height="22"><input type="text" name="num_dcg" id="num_dcg" class="yanzm" /><img src="coedos/coedos_one.php" width="70" height="24" alt="" style="position:relative; top:4px; cursor:hand;" onClick="uiy.src='coedos/coedos_one.php?'+Math.random();" id="uiy" /><span  onClick="uiy.src='coedos/coedos_one.php?'+Math.random();" style="cursor:hand;">看不清，点一下！</span></td>
			          </tr>
				      <tr>
				        <td height="15" colspan="2" align="right"></td>
			          </tr>
				      <tr>
				        <td align="right">&nbsp;</td>
				        <td><input type="image" name="xxx" id="imageField" src="images/fabiao_03.jpg" /></td>
			          </tr>
			        </table>
			      </form>
                  <?php }?>
                  	<br />
                    <br />
                    <br />

				</div>
          	</div>
          </div>
		  <div class="contbottom"><img src="images/reiye_15.jpg" /></div>
        </div>
      </div>
</div>
<?php require("inc/bottom.php")?>

</body>
</html>
