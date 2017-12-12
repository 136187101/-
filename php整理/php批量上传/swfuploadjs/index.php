<html>
<head>
<title>SWFUpload 实例</title>
<style>
body{
	margin:0px;
	padding:0px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
}
#fileList {
	width:600px;
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
	width:200px;
}
span{
	float:left;
}
</style>
<script language="javascript" src="jquery.js"></script>
<script language="javascript" src="swfupload.js"></script>
<script language="javascript">
//	alert(Math.floor(1260/1260*100));
	var swfu;
	window.onload=function()
	{
		swfu=new SWFUpload({
			upload_url:'upload.php',
			flash_url:'swfupload.swf',
			file_size_limit:'15MB',
			file_types:"*.jpg;*.gif",
			
			/* 按钮的设置 */
			button_image_url: "b.gif", // Relative to the Flash file
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
		
		/*
			这个方法作用： 就是选择完图片后关闭时执行。
			参数：numFilesQueued 就是先择图片的数量
		*/
		function fileDialogComplete(numFilesSelected, numFilesQueued){
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
		//	alert(serverData);
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
			alert(file.name);
		}
		
			
	}
	
	</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div style="float:left;" id="spanButtonPlaceholder1"></div>
<a href="javascript:swfu.startUpload();">开始上传</a> <span id="comp"></span>
<div id="fileList"></div>
</body>
</html>