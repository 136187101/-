<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>SWFUpload Demos - Simple Demo</title>
<link href="../css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">

        var swfu;
        window.onload = function() {

            var settings = {
                flash_url : "../swfupload/swfupload.swf", //flash路径
               　　　　　　　　　upload_url: "upload.php",　　　　　　　　　　//要提交处理的页面

                post_params: {"PHPSESSID" : ""},　　　　　　//上传过程中SESSION_ID丢失的话 可以在这传进去

                file_size_limit : "100 MB",　　　　　　　　 //文件上传大小

                file_types : "*.*",　　　　　　　　　　　　　　//上传文件类型

                file_types_description : "All Files",　　　　//弹出windows对话框 选择时候的文件类型

                file_upload_limit : 100,　　　　　　　　　　//每次上传限制个数

                file_queue_limit : 0,                    //列队个数限制

                custom_settings : {

                    progressTarget : "fsUploadProgress",

                    cancelButtonId : "btnCancel"

                },

                debug: false,　　　　　　　　　　　　　　　　　　//开启调试



                // Button settings

                button_image_url: "images/TestImageNoText_65x29.png", //上传按钮图片

                button_width: "65",

                button_height: "29",

                button_placeholder_id: "spanButtonPlaceHolder",        //上传标记的ID值

                button_text: '<span class="theFont">Hello</span>',

                button_text_style: ".theFont { font-size: 16; }",

                button_text_left_padding: 12,

                button_text_top_padding: 3,

                

                //以下都是上传事件的处理在handlers.js里
                file_queued_handler : fileQueued,
                file_queue_error_handler : fileQueueError,

               file_dialog_complete_handler : fileDialogComplete, //列队完成后由fileDialogComplete方法上传,如果注视点将不会自动上传

                upload_start_handler : uploadStart, 

                upload_progress_handler : uploadProgress,

                upload_error_handler : uploadError,

                upload_success_handler : uploadSuccess,

                upload_complete_handler : uploadComplete,

                queue_complete_handler : queueComplete    //上传完成后的回显
				
            };
            swfu = new SWFUpload(settings);

         };

    </script>
</head>
<body>
<div id="header">
	<h1 id="logo"><a href="../">SWFUpload</a></h1>
	<div id="version">v2.2.0</div>
</div>

<div id="content">
	<h2>Simple Demo</h2>
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
		<p>This page demonstrates a simple usage of SWFUpload.  It uses the Queue Plugin to simplify uploading or cancelling all queued files.</p>

			<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload Queue</span>
			</div>
		<div id="divStatus">0 Files Uploaded</div>
			<div>
				<span id="spanButtonPlaceHolder"></span>
				<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
			</div>

	</form>
</div>
</body>
</html>
