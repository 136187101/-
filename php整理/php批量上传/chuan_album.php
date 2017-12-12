<?php 
@header('Content-type: text/html;charset=utf-8');
require_once("../include/init.php");
require_once("../inc/anquan.php");
$xcfid=$_GET["xcfid"];

//查询相册
$albumfl=$hjd->get_one("select * from albumfl where id = '$xcfid' and uid ='$_SESSION[seid_q]'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/css.css"/>
<title>个人中心</title>
<meta name="Keywords" content="培训|写实|超写实|极致写实|细节|100|细节100|微距|触摸|触摸式|触摸式素描|细致|深入|入微|特写|亮面|灰面|反光|投影||交界线石膏|静物|人物|写实精品|色彩|素描|色彩|速写|插画|商业绘画|创意素描|创意速写|摄影|油画|水粉|平面构成|色彩构成|立体构成|修片|创意思维|图形创意|三维动画|三维特效|动画后期|MAYA|maya|Maya|mentalray|3S|PS|玛雅|光线追踪|全局光|建模|渲染|细分|高考|高考班|数字艺术|摹|写生|默写|明度|纯度|色相|冷暖|罗汉|余接斌|刘洋|陈泰伊|吴新贺|李华琪|石有强|应丽|任玉奎|徐婧|中央美院|清华美院|北京服装学院|考题|美院|美术|黑白灰|左中右|前中后|虚实|景深|强弱|主次|深浅|曲直|黑白|" />
<style>
body{
	margin:0px;
	padding:0px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
}
#fileList {
	width:700px;
	border:1px solid #CCCCCC;
	padding:3px 0px 30px 0px;
	font-size:12px;
	margin:5px;
	float:left;
}
#fileList div{
	border-bottom:1px solid #EEEEEE;
	padding:3px 0px;
	float:left;
	width:100%;
}
span.fileName{
	width:300px;
}
span{
	float:left; 
}
</style>
<script language="javascript" src="../swfuploadjs/jquery.js"></script>
<script language="javascript" src="../swfuploadjs/swfupload.js"></script>
<script language="javascript">
	
	var swfu;
	window.onload=function()
	{
		swfu=new SWFUpload({
			upload_url:'../swfuploadjs/upload.php?xcfid=<?php echo $xcfid?>',
			flash_url:'../swfuploadjs/swfupload.swf',
			file_size_limit:'15MB',
			file_types:"*.jpg;*.gif;*.png",
			
			/* 按钮的设置 */
			button_image_url: "../swfuploadjs/b.gif", // Relative to the Flash file
			button_placeholder_id : "spanButtonPlaceholder1",
			button_width: 100,
			button_height: 30,
			button_text_top_padding: 0,
			button_text_left_padding: 0,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			/* 选择完图片后执行。 */
			file_dialog_complete_handler:fileDialogComplete,
			/* 上传成功后执行。 */
			upload_success_handler:uploadSuccess,
			/* 主要是进度条 */
			upload_progress_handler:uploadProgress,
			/* 循环队列里的图片上传 */
			upload_complete_handler: uploadComplete,
			/* 主要是把图片加入队列 */
			file_queued_handler:fileQueued,
			
			debug: false
		});
		
		var i=0;//上传成功图片
		var zong=0;//上传图片总数

		
		/*
			这个方法作用： 就是选择完图片后关闭时执行。
			参数：numFilesQueued 就是先择图片的数量
		*/
		function fileDialogComplete(numFilesSelected, numFilesQueued){
		zong=numFilesSelected;
			if(numFilesQueued>0){
				try{
					/* 开始上传方法 */
					//this.startUpload();
				}
				catch(ex){
					this.debug(ex);
				}
			}
		}
		/*
			这个方法作用： 就是上传成功后执行,这里上传成功不是说真的把图片上传成功了，只是把数据提交到服务器成功了。
			参数：(file object, server data)
		*/
		
		function uploadSuccess(file,serverData){
			
			if(serverData=="t")
			{
				i++;
			}
			if(i==zong)	
			{
				
				document.location.href='album_cg.php?xcfid=<?php echo $xcfid?>';
			}
			else
			{
				alert("上传失败，请重新上传");
			}
		
		}
		/*
			作用：主要是进度条
			参数：uploadProgress(file object, bytes complete, total bytes)
			     bytes 上传字节数 ，total 总字节数
		*/
		function uploadProgress(file, bytesLoaded,total ){
			var c=Math.floor((bytesLoaded/total)*100);
			$("#SWFBorder_"+file.id).css({'margin-left':'10px','width':'100px',height:'6px',border:'1px solid #333333'});
			$("#SWF_"+file.id).css({height:'6px','background-color':'#060','padding-right':c+'px'});
			
		}
		
		/*
			作用：就是循环上传队列的图片
			参数：file Object
		*/
		function uploadComplete(file){
			
			if(this.getStats().files_queued > 0)
				this.startUpload();
				
				
		}
		/*
			作用： 把所选的图片入列。
			参数： file Object.
		*/
		function fileQueued(file){
			var fileSize=Math.floor(file.size/1024)+"kb";
			
			$("#fileList").append("<div><span class='fileName'>"+file.name+"</span><span class='fileSize'>"+fileSize+"</span><span id='SWFBorder_"+file.id+"'><span id='SWF_"+file.id+"'></span></span></div>");
			;
			
		}
		
			
	}
	</script>

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?php require_once("../inc/top.php");?>
<table width="580"  border="0" align="center">
  <tr>
    <td width="100" align="left">相册&nbsp;：<?php echo $albumfl[title]?></td>
  </tr>
   <tr>
    <td align="left">

    <div style="float:left;" id="spanButtonPlaceholder1"></div>
<a href="javascript:swfu.startUpload();">开始上传</a> <span id="comp"></span>
<div id="fileList"></div>
    
    </td>
  </tr>
   <tr>
     <td align="center">&nbsp;</td>
   </tr>
	
</table> 

</body>
</html>