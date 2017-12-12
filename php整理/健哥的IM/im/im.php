<div class="chat_list_box" id="float">
	<span style="display:none;" id="zsdidfuck" _i="<?=$zsd?>"></span>
	<div class="chat_tit" id="tit_im_top">聊天</div>
    <div id="scrollbar"></div>
    <div class="chat_bottom">
    	<span class="left_sh" id="tit_im_bottom">刷新</span>
        <span class="right_sh"><img src="/im/img/bbx.gif" id="wangtao_1" /></span>
    </div>
    
    <!--以下漂浮不定-->
    <div class="chat_oc" id="chat_oc"><a href="#"></a></div>
    
    <div class="chat_box">
    	<div class="chat_box_tit">
        	<span><img src="/im/img/1.gif" id="sag_user_file" alt="" /></span>
            <span class="fontz" id="sag_xname"><!--zjwlgr--></span>
            <a href="#" class="chat_ico_x" title="关闭"></a>
            <a href="#" class="chat_ico_mini" title="最小化"></a>
        </div>
        <div class="chat_box_msg">
            <!--聊天信息-->
        </div>
        <div class="chat_box_post">
        	<div class="chat_box_post_ta">
				<textarea name="chat_content" id="chat_content"></textarea>
				<input name="imhiddenField" type="hidden" id="imhiddenField" value="" />
       	    </div>
            <div class="chat_box_post_tool">
            	<a href="#" class="chat_ico_emoji" title="表情"></a><!--图片在admin/face/下-->
                <a href="#" class="chat_ico_photo" title="图片">
					<form method="post" enctype="multipart/form-data" name="chat_form" id="chat_form" runat="server">
               			<input name="impic_upload" type="file" id="impic_upload" class="upload_image" />
               	    </form>
				</a>
                <span><img src="/im/img/sub.gif" id="imsubmit" title="快捷方式：Ctrl+Enter" /></span>
                <span><a href="#" id="im_liaotjv">聊天记录</a></span>
            </div>
        </div>
    </div>
    
    <div class="chat_box_ts" id="sag_maxio"><!--最小化--></div>
	
	<div class="chat_box_liaojlv">
		<div class="chat_box_titlv">
            <span class="fontz_lv" id="sag_xname_lv">聊天记录</span>
            <a href="#" class="chat_ico_x_lv" title="关闭"></a>
		</div>
		<div class="chat_box_msg_lv">
            <!--聊天信息-->
        </div>
		<div class="chat_box_post_tool_lv">
			
        </div>
	</div>
    
</div>