$(function () {
	var jianhei = 64;//减去头尾的像素
	var setint_time = 60000;//自动刷新好友在线列表的时间，毫秒
	var imlist_time = 10000;//自动刷新聊天框信息时间，毫秒
	
    $.fn.smartFloat = function () {
        var position = function (element) {
            var top = element.position().top,
                pos = element.css("position");
            $(window).scroll(function () {
                var scrolls = $(this).scrollTop();
                if (scrolls > top) {
                    if (window.XMLHttpRequest) {
                        element.css({
                            position: "fixed",
                            top: 0
                        });
                    } else {
                        element.css({
                            top: scrolls// 原来是  top: scrolls
                        });
                    }
                } else {
                    element.css({
                        position: pos,
                        top: 0// 原来是  top: top
                    });
                }
            });
        };
        return $(this).each(function () {
            position($(this));
        });
    };
    //绑定
    $("#float").smartFloat().height($(window).height() - 2);
	
	$(window).resize(function(){//当文档窗口改变大小时触发
	  $("#float").height($(window).height() - 2);
	  $("#scrollbar").height($(window).height() - jianhei).jscroll({W:"4px",Btn:{btn:false},Bg:"#DEDFE0",Bar:{Bd:{Out:"#6E737B",Hover:"#52932B"},Bg:{Out:"#6E737B",Hover:"#52932B",Focus:"#52932B"}}});//滚动条样
	});
//=======================================================================实现放IM的层智能浮动
	var zsdidfuck = $("#zsdidfuck").attr("_i");//获取知识点ID
	var loads = "<img src=\"/im/img/18.gif\" class=\"loadt\" />";//load图片
	var loads2 = "<img src=\"/im/img/18.gif\" class=\"loadt2\" />";//load图片2
	var dialogue = $.cookie('dialogue');//存判断打开哪个框的cookie
	var setint_178;
	var setint_64;
	var im_us_list;
	
	if(dialogue != null){
		$.get("/im/ajax/userjson.php?time="+(new Date()).getTime(),{xid:$.cookie('xuesheid')},function (data, textStatus){
					    var xname = data.xname;
						var user_file = data.user_file;
						var imtime = data.imtime;
					    $("#sag_user_file").attr("src",user_file).attr("alt",$.cookie('xuesheid'));
						$("#sag_xname").text(xname);
						$("#sag_maxio").text(xname);
						im_uid_euid_list10($.cookie('xuesheid'));//默认加载最近10条对话
						if(imtime == 1){$(".chat_box_tit > span:first").prepend("<font title=\"在线\"></font>");}else{}//是否加在线标记
						if(dialogue == 1){
							$(".chat_box").show();//打开对话框
							$(".chat_box_msg").scrollTop(99999);//滚动条最下面
							$(".chat_box_post_ta textarea").focus();//光标在里面
						}else if(dialogue == 3){
							$(".chat_box_ts").show();//打开最小化
						}
						im_us_list = setInterval(function(){imlisteuid_lod($.cookie('xuesheid'))},imlist_time);//定时刷新
					},"json");
	}
	//------------------------------------------------------------------------------------------默认加载对话框出现
	if($.cookie('name') == 2){//如果是展开的，刷新页面保持展开
		$("#chat_oc").attr("class","chat_oc2");
		$("#float").width(178);
		$("#tit_im_top").attr("class","im_top").html("<img src=\"/im/img/dvedsd_r3_c2.jpg\" />在线聊天");
		$("#tit_im_bottom").html("刷新聊天消息");
		imtimenew_178(loads,zsdidfuck,jianhei,1);
		clearInterval(setint_64);//移除64刷新
		setint_178 = setInterval(function(){imtimenew_178(loads,zsdidfuck,jianhei,2)},setint_time);//定时刷新
	}else{
		imtimenew_64(loads2,zsdidfuck,jianhei,1);
		clearInterval(setint_178);//移除178刷新
		setint_64 = setInterval(function(){imtimenew_64(loads2,zsdidfuck,jianhei,2)},setint_time);//定时刷新
	}
	//------------------------------------------------------------------------//默认加载头像列表
	$("#chat_oc a").click(function(){
		if($(this).parent().attr("class") == "chat_oc"){
			$("#chat_oc").attr("class","chat_oc2");
			$("#float").width(178);
			$("#tit_im_top").attr("class","im_top").html("<img src=\"/im/img/dvedsd_r3_c2.jpg\" />在线聊天");
			$("#tit_im_bottom").html("刷新聊天消息");
			imtimenew_178(loads,zsdidfuck,jianhei,1);
			$.cookie('name',2);//cookie给值
			clearInterval(setint_64);//移除64刷新
			setint_178 = setInterval(function(){imtimenew_178(loads,zsdidfuck,jianhei,2)},setint_time);//定时刷新
		}else{
			$(this).parent().attr("class","chat_oc");
			$(this).parent().parent().width(64);
			$("#tit_im_top").attr("class","chat_tit").html("聊天");
			$("#tit_im_bottom").html("刷新");
			imtimenew_64(loads2,zsdidfuck,jianhei,1);
			clearInterval(setint_178);//移除178刷新
			setint_64 = setInterval(function(){imtimenew_64(loads2,zsdidfuck,jianhei,2)},setint_time);//定时刷新
			$.cookie('name',1);//cookie给值
		}
		return false;
	});
	//------------------------------------------------------------------------点击展开IM
	$(".im_userlist > dl").live("click",function(){
		 if($(this).next().is(":visible")){
			$(this).next().hide();
			$(this).children("img").attr("src","/im/img/right.gif");
			//////////////////////////////展开的滚动条，不跟着列表关闭走///////////////////////////////控制滚动条部分
			var imuhei = $(this).parent().height();
			if(imuhei > $(window).height() - jianhei){imuhei = $(window).height() - jianhei;}else{
				imuhei = imuhei;
				$(".jscroll-e").hide();//滚动条的节点
				$sdfsdf = $(this).parent().remove();
				$sdfsdf.appendTo("#scrollbar");	
			}
			$("#scrollbar").height(imuhei);
			/////////////////////////////////////////////////////////////控制滚动条部分
		 }else{
			$(this).next().show();
			$(this).children("img").attr("src","/im/img/bottom.gif");
			/////////////////////////////////////////////////////////////控制滚动条部分
			var imuhei = $(this).parent().height();
			if(imuhei < $(window).height() - jianhei){}else{
				$(".jscroll-e").show();
				$sdfsdf2 = $(this).parent().remove();
				$sdfsdf2.appendTo(".jscroll-c");
			}
			$("#scrollbar").height($(window).height() - jianhei);
			/////////////////////////////////////////////////////////////控制滚动条部分
		 }
	});
	//-----------------------------------------------------------------------点击收起下面列表
	$(".chat_ico_x").click(function(){
		$(this).parent().parent().hide();
		$.cookie('dialogue',null);//删除cookie，表示对话框关闭
		clearInterval(im_us_list);//移除聊天信息列表刷新
		$(".chat_box_liaojlv").hide();//聊天记录框
		return false;
	});
	//-----------------------------------------------------------------------点击关闭聊天框
	$(".chat_ico_mini").click(function(){
		$(".chat_box").hide();//关闭对话框
		$(".chat_box_ts").show();//打开最小化
		$.cookie('dialogue',3);//cookie为3，表示对话框关闭，最小化出现
		return false;
	});
	//-----------------------------------------------------------------------点击变为最小化
	$(".chat_box_ts").click(function(){
		$(this).hide();//关闭最小化
		$(".chat_box").show();//打开对话框
		$(".chat_box_post_ta textarea").focus();//光标在里面
		$(".chat_box_msg").scrollTop(99999);//滚动条最下面
		$.cookie('dialogue',1);//cookie为1，表示对话框打开，最小化关闭
	});
	//-----------------------------------------------------------------------点击最小化后打开对话框，关闭最小化
	$(".chat_box_ts").hover(function(){
		$(this).css({border:"1px solid #343434"});
	},function(){
		$(this).css({border:"1px solid #BDBDBD"});
	});
	//-----------------------------------------------------------------------鼠标放上最小化框，边框变色
	$(".jqueryclick").live("click",function(){
		var xueid = $(this).attr("_i");
		$(".chat_box_liaojlv").hide();//聊天记录框
		$.cookie('xuesheid',xueid);//用cookie记录学生ID号
		$.get("/im/ajax/userjson.php?time="+(new Date()).getTime(),{xid:xueid},function (data, textStatus){
					    var xname = data.xname;
						var user_file = data.user_file;
						var imtime = data.imtime;
					    $("#sag_user_file").attr("src",user_file).attr("alt",xueid);
						$("#sag_xname").text(xname);
						$("#sag_maxio").text(xname);
						if(imtime == 1){//是否加在线标记
							if($(".chat_box_tit > span:first > font").length == 0){
								$(".chat_box_tit > span:first").prepend("<font title=\"在线\"></font>");
							}
						}else{
							$(".chat_box_tit > span:first > font").remove();
						}
						//--------------------------------------------------------//是否加在线标记
						$(".chat_box_msg").html("");//先清空，在加载
						im_uid_euid_list10(xueid);//默认加载最近10条对话
						
						$(".chat_box_ts").hide();//关闭最小化
						$(".chat_box").show();//打开框
						$(".chat_box_msg").scrollTop(99999);//滚动条最下面
						$(".chat_box_post_ta textarea").focus();//光标在里面
						
						im_us_list = setInterval(function(){imlisteuid_lod(xueid)},imlist_time);//定时刷新
						
					},"json");
		$.cookie('dialogue',1);//cookie为1，表示对话框打开
	});
	//-----------------------------------------------------------------------点击头像，打开对话框
	$(".chat_ico_emoji").click(function(){
		if($(".chat_box_post_feac").length == 0){
			$.getScript("/im/js/recon.js");
			$.get("/im/ajax/face.php",function (data, textStatus){
				$(".chat_box_post_tool").prepend(data);//添加节点到父元素第一个
			});
		}
		return false;
	});
	//-----------------------------------------------------------------------点击表情，出现表情框
	$("#chat_feac_2").live("click",function(){
		$(".chat_box_post_feac").remove();
		return false;
	});
	$("body").click(function(){
		$(".chat_box_post_feac").remove();
	});
	//-----------------------------------------------------------------------点击关闭表情框
	$(".chat_box_post_feac ul li a").live("click",function(){
		var $atitle = $(this).attr("title");
		$('#chat_content').setCaret();
		$('#chat_content').insertAtCaret($atitle);//插入 
		$(".chat_box_post_feac").remove();//关闭表情框
		$('#chat_content').focus();//光标到插入位置
		return false;
	});
	//-----------------------------------------------------------------------点击表情插入到文本框
	var wait = $("<img src=\"/im/img/11.gif\" id=\"xiaovsi\" />");
	$("#impic_upload").change(function () {
		if($("#imhiddenField").val() != ""){//如果上传了一张，不作操作，又上传一张（连续上传，删除上前上传的那张）
				$.get("/im/ajax/deleteimage.php",{imgroot:$("#imhiddenField").val()},function (data, textStatus){
				$("#impic_upload").val("");
				$("#imhiddenField").val("");
			});
		}
		//-----------------------------------------------------------------------连续上传，删除上前上传的那张
        $("#chat_form").ajaxSubmit({
            url: '/im/ajax/uploadimage.php',
            beforeSubmit: function () {
				if($(".chat_box_post_impic").length == 0){
					$(".chat_box_post_tool").prepend("<div class=\"chat_box_post_impic\"></div>");//添加节点到父元素第一个
				}
				$("#imupimgdell").remove();//移动删除字
                $(".chat_box_post_impic").append(wait);
				$("#xiaovsi").attr("src","/im/img/11.gif");
            },
            success: function (data) {
				if(data.length == 34){
					$("#xiaovsi").attr("src",data).hide().fadeIn(500).parent().prepend("<a href=\"#\" id=\"imupimgdell\">删除</a>");
					$("#imhiddenField").val(data);
				}else{
					$(".chat_box_post_impic").remove();//称除图片框
					$("#imupimgdell").remove();//移除删除字
					alert(data);
				}
            }
        });
    });
	//----------------------------------------------------------------自动上传图片
	$("#imupimgdell").live("click",function(){
		$.get("/im/ajax/deleteimage.php",{imgroot:$("#imhiddenField").val()},function (data, textStatus){
			$(".chat_box_post_impic").remove();//称除图片框
			$("#impic_upload").val("");//去掉type = file 的图片路径
			$("#imhiddenField").val("");//去掉隐藏域里面的路径
		});
		return false;
	});
	//----------------------------------------------------------------删除图片
	$("#imsubmit").click(function(){
		  var chat_content = $("#chat_content").val();
		  var imhiddenField = $("#imhiddenField").val();
		  if(chat_content == "" && imhiddenField == ""){//如果为空，框闪硕
		      $("#chat_content").css("background","#ddd").animate({opacity:0},100).animate({opacity:10},100,function(){$("#chat_content").css("background","#fff");});
			  $(".chat_box_post_ta").css("background","#ddd").animate({opacity:0},100).animate({opacity:10},100,function(){$(".chat_box_post_ta").css("background","#fff");});
			  $("#chat_content").focus();
		  }else if(chat_content.length > 500){
			  alert("单次聊天信息太多，须在500字内。");
		  }else{
			  $.post("/im/ajax/postlist.php?time="+(new Date()).getTime(),{image:imhiddenField,content:chat_content,zsdid:zsdidfuck,euid:$("#sag_user_file").attr("alt")},function(data, textStatus){
					
					var newarr=data.split('「IM」');//接收服务器信息，拆分数组
					$(".chat_box_msg").append(immsglist_2(newarr[1],newarr[0])).scrollTop(99999);//添加当事人发的那条
					
					imlisteuid_lod($("#sag_user_file").attr("alt"));//刷和当事人聊天人的未查看信息
					
					$(".chat_box_post_impic").remove();//称除图片框
					$("#impic_upload").val("");//去掉type = file 的图片路径
					$("#imhiddenField").val("");//去掉隐藏域里面的路径
					$("#chat_content").val("");//content里面的文字
					$("#chat_content").focus();//光标定位在框里面
			   });
		  }
	});
	//----------------------------------------------------------------提交聊天信息
	$(".image116 > img").live("click",function(){
		$("html").scrollTop(0);
		$("body").scrollTop(0);
		var $imgsrc = $(this).attr("src");  // /im/uploadimages/1336800345246.jpg
		$imgsrc = "/im/uploadimages/d"+$imgsrc.substr($imgsrc.length-17,$imgsrc.length);//得到大图片
		$("body").append("<div class=\"botyhtml_heip\"></div><div class=\"botyhei\"><table width=\"600\" height=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\" valign=\"middle\"><table width=\"33\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"right\"><img src=\"/im/img/xxx.png\" class=\"yuomeng\" /></td></tr><tr><td><img src=\""+$imgsrc+"\" id=\"botyimgg\" /></td></tr></table></td></tr></table></div>");
		$(".botyhtml_heip").height($(document).height());
		
		$(".botyhei").css({margin:"-300px 0 0 -470px"});
		$("#botyimgg").hide().fadeIn(300);
		$(".yuomeng").hide().fadeIn(500);
	});
	//------------------------------------------------------------点击小图，看大图
	$(".botyhei img").live("click",function(){
		$(".botyhtml_heip").remove();
		$(".botyhei").remove();
	});
	//------------------------------------------------------------点击大图，关闭大图
	$("#chat_content").keypress(function(e){
        if(e.ctrlKey && e.which == 13 || e.which == 10) { 
           $("#imsubmit").click();
        } else if (e.shiftKey && e.which==13 || e.which == 10) {
           $("#imsubmit").click();
        }          
 	});
	//---------------------------------------------------发布聊天信息支持ctrl+enter提交
	$("#tit_im_bottom").click(function(){
		imlist_foot();
	});
	//-----------------------------------------------------点击右下角刷新，消息图片
	$("#im_liaotjv").click(function(){
		$(".chat_box_liaojlv").show();
		$euid_lv = $("#sag_user_file").attr("alt");
		$.get("/im/ajax/userlist_lv.php?time="+(new Date()).getTime(),{euid:$euid_lv},function(data , textStatus){
			var lvarr = data.split('{[-IM]-}');
			$(".chat_box_msg_lv").html(lvarr[0]);
			$(".chat_box_post_tool_lv").html(lvarr[1]);
		});
		return false;
	});
	//--------------------------------------------------------------打开聊天记录
	$("a[name ='page_im']").live("click",function(){
		var $gangi = $(this).attr("_i");
		var arrv=$gangi.split(',');
		$.get("/im/ajax/userlist_lv.php?time="+(new Date()).getTime(),{euid:arrv[0],page:arrv[1]},function(data, textStatus){
			var lvarr = data.split('{[-IM]-}');
			$(".chat_box_msg_lv").html(lvarr[0]);
			$(".chat_box_post_tool_lv").html(lvarr[1]);
		});
		return false;
	});
	//-----------------------------------------聊天记录分页
	$(".chat_ico_x_lv").click(function(){
		$(".chat_box_liaojlv").hide();
		return false;
	});
	//-----------------------------------------聊天记录分页
	

});

/*************************************************
*js函数区
*/

function animateIt_1(){
	$(function(){
		$("#wangtao").animate({opacity:0},100).animate({opacity:1},300,animateIt_1);
	});
}
//------------------------------------------------------------------------------右下角闪烁图标动画
function imlist_foot(){
	$(function(){
		$.get("/im/ajax/list_foot.php?time="+(new Date()).getTime(),function(data, textStatus){
			if(data != 0){
				var nowarr = data.split('}');
				$(".right_sh img").attr("src",nowarr[1]).attr("_i",nowarr[0]).attr("id","wangtao").attr("class","jqueryclick").css("cursor","pointer");
				animateIt_1();
			}else{
				$(".right_sh img").attr("src","/im/img/bbx.gif").attr("_i","").attr("id","wangtao_1").attr("class","jqueryclick_p").css("cursor","");
			}
		});
	});
}
//-------------------------------------------------------------------自动刷新IM右下角信息通知
function imtimenew_178(loads,zsdidfuck,jianhei,isload){
	$(function(){
		if(isload == 1){
			$("#scrollbar").html(loads).load("/im/ajax/userlist.php?time="+(new Date()).getTime(),{imlidt:178,zsd:zsdidfuck},function(){
				$("#scrollbar").height($(window).height() - jianhei).jscroll({W:"4px",Btn:{btn:false},Bg:"#DEDFE0",Bar:{Bd:{Out:"#6E737B",Hover:"#52932B"},Bg:{Out:"#6E737B",Hover:"#52932B",Focus:"#52932B"}}});//滚动条样式																						
			});
		}else if(isload == 2){//2为自动刷新，不需要load图片
			$("#scrollbar").load("/im/ajax/userlist.php?time="+(new Date()).getTime(),{imlidt:178,zsd:zsdidfuck},function(){
				$("#scrollbar").height($(window).height() - jianhei).jscroll({W:"4px",Btn:{btn:false},Bg:"#DEDFE0",Bar:{Bd:{Out:"#6E737B",Hover:"#52932B"},Bg:{Out:"#6E737B",Hover:"#52932B",Focus:"#52932B"}}});//滚动条样式																						
			});
		}
	});
	imlist_foot();//刷新右下角信息通知图标
}
//-----------------------------------------------------------展开178 函数
function imtimenew_64(loads2,zsdidfuck,jianhei,isload){
	$(function(){
		if(isload == 1){
			$("#scrollbar").html(loads2).load("/im/ajax/userlist.php?time="+(new Date()).getTime(),{imlidt:64,zsd:zsdidfuck},function(){
				$("#scrollbar").height($(window).height() - jianhei).jscroll({W:"4px",Btn:{btn:false},Bg:"#DEDFE0",Bar:{Bd:{Out:"#6E737B",Hover:"#52932B"},Bg:{Out:"#6E737B",Hover:"#52932B",Focus:"#52932B"}}});//滚动条样式																						
			});
		}else if(isload == 2){//2为自动刷新，不需要load图片
			$("#scrollbar").load("/im/ajax/userlist.php?time="+(new Date()).getTime(),{imlidt:64,zsd:zsdidfuck},function(){
				$("#scrollbar").height($(window).height() - jianhei).jscroll({W:"4px",Btn:{btn:false},Bg:"#DEDFE0",Bar:{Bd:{Out:"#6E737B",Hover:"#52932B"},Bg:{Out:"#6E737B",Hover:"#52932B",Focus:"#52932B"}}});//滚动条样式																						
			});
		}
	});
	imlist_foot();//刷新右下角信息通知图标
}
//-----------------------------------------------------------合并64 函数
function immsglist_1(imtime1,imcontent1){
	var funmeib1 = "<div class=\"chat_msg_list1\"><div class=\"chat_l1_time\">"+imtime1+"</div><div class=\"chat_qp1\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r2_c2.gif\" width=\"3\" height=\"3\" /></td><td height=\"3\" background=\"/im/img/bgv_r2_c6.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r2_c8.gif\" width=\"3\" height=\"3\" /></td></tr><tr><td background=\"/im/img/bgv_r4_c2.gif\"></td><td class=\"tdfuck\">"+imcontent1+"</td><td background=\"/im/img/bgv_r6_c8.gif\"></td></tr><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r8_c2.gif\" width=\"3\" height=\"3\" /><img src=\"/im/img/bgt3.gif\" class=\"chat_xxj\" width=\"9\" height=\"13\" /></td><td height=\"3\" background=\"/im/img/bgv_r8_c4.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv_r8_c8.gif\" width=\"3\" height=\"3\" /></td></tr></table></div></div>";
	return funmeib1;
}
//................................................屏风
function immsglist_2(imtime2,imcontent2){
	var funmeib2 = "<div class=\"chat_msg_list2\"><div class=\"chat_l1_time\">"+imtime2+"</div><div class=\"chat_qp1\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgvf_r2_c2.gif\" width=\"3\" height=\"3\" /></td><td height=\"3\" background=\"/im/img/bgvf_r2_c6.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgvf_r2_c8.gif\" width=\"3\" height=\"3\" /></td></tr><tr><td background=\"/im/img/bgvf_r6_c2.gif\"></td><td class=\"tdfuck\">"+imcontent2+"</td><td background=\"/im/img/bgvf_r4_c8.gif\"></td></tr><tr><td width=\"3\" height=\"3\"><img src=\"/im/img/bgvf_r8_c2.gif\" width=\"3\" height=\"3\" /></td><td height=\"3\" background=\"/im/img/bgvf_r8_c4.gif\"></td><td width=\"3\" height=\"3\"><img src=\"/im/img/bgv3.gif\" class=\"chat_xxj\" width=\"9\" height=\"13\" /><img src=\"/im/img/bgvf_r8_c8.gif\" width=\"3\" height=\"3\" /></td></tr></table></div></div>";
	return funmeib2;
}
//----------------------------------------------------Jquery append 的html代码，1和2，，别人发和自己发的
function imlisteuid_lod(fnxuid){
	$(function(){
		$.get("/im/ajax/listeuid_load.php?time="+(new Date()).getTime(),{euid:fnxuid},function(data, textStatus){
			if(data != 0){
				var totalarr = data.split(']IM[');
				for(var I=0;I<totalarr.length;I++){
					var danarr = totalarr[I].split('}IM{');
					$(".chat_box_msg").append(immsglist_1(danarr[0],danarr[1])).scrollTop(99999);
				}
			}else{
					
			}
			imlist_foot();//刷新右下角信息通知图标
		});
	});
}
//----------------------------------------------------------------自动刷新对方发来的信息
function im_uid_euid_list10(fnxuid){
	$(function(){
		$.get("/im/ajax/list_load10.php?time="+(new Date()).getTime(),{euid:fnxuid},function(data, textStatus){
			$(".chat_box_msg").append(data).scrollTop(99999);
			imlist_foot();//刷新右下角信息通知图标
		});
	});
}
//---------------------------------------------------------默认加载与当前人聊天的前10条信息


