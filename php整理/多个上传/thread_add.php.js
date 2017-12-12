function checkthread(){
	var title = document.formthread.title.value;
	var content = document.formthread.content.value;
	var movie = document.formthread.movie.value;
	var flash = document.formthread.flash.value;
	var imgduanl = document.formthread.imgduanl.value;

	if(title=="") {
		document.getElementById("lop").className="error_tips";
		document.getElementById("lop").innerHTML="请输入话题的标题";
		document.formthread.title.focus();
		return false;
	}else if(content=="" && movie=="" && flash=="" && imgduanl==0){
		document.getElementById("lop").className="error_tips";
		document.getElementById("lop").innerHTML="请输入话题的内容";
		document.formthread.content.focus();
		return false;
	}else{
		/*document.formthread.content.value="";
		document.formthread.flash.value="";
		document.formthread.movie.value="";
		document.formthread.imgduanl.value=0;
		window.top.frame_content.location.href=('/memb/inc/t_main_ltu.php?xtwvf=formthread');
		colse_kimf();//关闭所有框*/
		document.getElementById("sub_zsh").innerHTML="<br /><img src=/img/load.gif />提交中请稍后...";
	}
	
}

$(function(){
  
	 $("#zeng_jia_e").click(function(){
	     var $li_1 = $("<li class='xwvf_tex_1'><input name='grp_file[]' onkeydown='return false' type='file' id='inp1' class='grp_adding' /></li>");
		 var $two_li = $(".grp_thread ul .xwvf_tex");
		 $li_1.insertAfter($two_li);
		 return false;
	 });
	 $("#zeng_jia_ef").click(function(){
	 	 $(".grp_thread ul .xwvf_tex_1:eq(0):not(#bubu)").remove();
		 return false;
	 });
	 $("#zeng_jia_e").trigger("click");
  });