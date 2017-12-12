//图片延迟加载插件
(function($){
	$.fn.lazyload=function(options){
		var settings = {
			threshold:0,
			failurelimit:0,
			event:"scroll",
			effect:"show",
			container:window
		};
		if(options){
			$.extend(settings,options);
		}
	var elements=this;
	
	if("scroll"==settings.event){
		$(settings.container).bind("scroll", function(event){
			var counter=0;
			elements.each(function(){
				if($.abovethetop(this,settings)||$.leftofbegin(this,settings))
				{}else if(!$.belowthefold(this,settings)&&!$.rightoffold(this,settings)){
					$(this).trigger("appear");
				}else{
					if(counter++ > settings.failurelimit){
						return false;
					}
				}
			});
			var temp = $.grep(elements,function(element){
				return !element.loaded;
			});
			elements = $(temp);
		});
	}

	this.each(function(){
	
		var self=this;
		
		if(undefined==$(self).attr("original")){
			$(self).attr("original", $(self).attr("src"));
		}if("scroll" != settings.event||undefined == $(self).attr("src")||"" == $(self).attr("src")||settings.placeholder == $(self).attr("src")||($.abovethetop(self,settings)||$.leftofbegin(self,settings)||$.belowthefold(self,settings)||$.rightoffold(self,settings))){
			if(settings.placeholder){
				$(self).attr("src", settings.placeholder);}else{$(self).removeAttr("src");
			}
			self.loaded=false;
		}else{
			self.loaded=true;
		}
		
		$(self).one("appear", function(){
			if(!this.loaded || 1 == 1){
				$("<img />").bind("load", function(){
					$(self).hide().attr("src", $(self).attr("original"))[settings.effect](settings.effectspeed);
					self.loaded=true;
				}).attr("src", $(self).attr("original"));
			};
		});
		
		if("scroll"!=settings.event){
			$(self).bind(settings.event, function(event){
			if(!self.loaded){
				$(self).trigger("appear");
			}
		}
		
		);}
	});

		$(settings.container).trigger(settings.event);
		return this;
	};
	
	$.belowthefold=function(element,settings){
		if(settings.container === undefined || settings.container === window){
			var fold = $(window).height() + $(window).scrollTop();
		}else{
			var fold = $(settings.container).offset().top + $(settings.container).height();
		}
		return fold <= $(element).offset().top - settings.threshold;
	};

	$.rightoffold=function(element,settings){
		if(settings.container === undefined || settings.container === window){
			var fold = $(window).width() + $(window).scrollLeft();
		}else{
			var fold = $(settings.container).offset().left + $(settings.container).width();
		}
		return fold <= $(element).offset().left - settings.threshold;
	};

	$.abovethetop=function(element,settings){
		if(settings.container === undefined || settings.container === window){
			var fold = $(window).scrollTop();
		}else{
			var fold = $(settings.container).offset().top;
		}
		return fold >= $(element).offset().top + settings.threshold  + $(element).height();
	};

	$.leftofbegin=function(element,settings){
		if(settings.container === undefined || settings.container === window){
			var fold = $(window).scrollLeft();
		}else{
			var fold = $(settings.container).offset().left;
		}
		return fold >= $(element).offset().left + settings.threshold + $(element).width();
	};

	$.extend(
		$.expr[':'],
		{
			"below-the-fold" : "$.belowthefold(a, {threshold : 0, container: window})",
			"above-the-fold" : "!$.belowthefold(a, {threshold : 0, container: window})",
			"right-of-fold"  : "$.rightoffold(a, {threshold : 0, container: window})",
			"left-of-fold"   : "!$.rightoffold(a, {threshold : 0, container: window})"
		}
	);
	
})(jQuery);

//选项卡与延迟插件结合
$(function(){
	$("img[original]").lazyload({ placeholder:"http://www.jsfoot.com/skinnew/images/color3.gif" });
});
function lazyloadForPart(container) {
    container.find('img').each(function () {
        var original = $(this).attr("original");
        if (original) {
            $(this).attr('src', original).removeAttr('original');
        }
    });
}
function setContentTab(name, curr, n) {
    for (i = 1; i <= n; i++) {
        var menu = document.getElementById(name + i);
        var cont = document.getElementById("con_" + name + "_" + i);
        menu.className = i == curr ? "current" : "";
        if (i == curr) {
            cont.style.display = "block";
            lazyloadForPart($(cont));
        } else {
            cont.style.display = "none";
        }
    }
}

// 加入收藏
function AddFavorite(sURL, sTitle){
	try{
        window.external.addFavorite(sURL, sTitle);
    }catch(e){
	try{
		window.sidebar.addPanel(sTitle, sURL, "");
	}catch(e){
		alert("加入收藏失败，请使用Ctrl+D进行添加");
		}
    }
}
// 分享代码
var shareid = "fenxiang";
(function() {
    var a = {
        url:function() {
            return encodeURIComponent(window.location.href)
        },title:function() {
            return encodeURIComponent(window.document.title)
        },content:function(b) {
            if (b) {
                return encodeURIComponent($("#" + b).html())
            } else {
                return""
            }
        },setid:function() {
            if (typeof(shareid) == "undefined") {
                return null
            } else {
                return shareid
            }
        },kaixin:function() {
            window.open("http://www.kaixin001.com/repaste/share.php?rtitle=" + this.title() + "&rurl=" + this.url() + "&rcontent=" + this.content(this.setid()))
        },renren:function() {
            window.open("http://share.renren.com/share/buttonshare.do?link=" + this.url() + "&title=" + this.title())
        },sinaminiblog:function() {
            window.open("http://v.t.sina.com.cn/share/share.php?url=" + this.url() + "&title=" + this.title() + "&content=utf-8&source=&sourceUrl=&pic=")
        },baidusoucang:function() {
            window.open("http://cang.baidu.com/do/add?it=" + this.title() + "&iu=" + this.url() + "&dc=" + this.content(this.setid()) + "&fr=ien#nw=1")
        },taojianghu:function() {
            window.open("http://share.jianghu.taobao.com/share/addShare.htm?title=" + this.title() + "&url=" + this.url() + "&content=" + this.content(this.setid()))
        },wangyi:function() {
            window.open("http://t.163.com/article/user/checkLogin.do?source=%E7%BD%91%E6%98%93%E6%96%B0%E9%97%BB%20%20%20&link=" + this.url() + "&info=" + this.content(this.setid()))
        },qqzone:function() {
            window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + encodeURIComponent(location.href) + '&title=' + encodeURIComponent(document.title))
        },txwb:function() {
            var _t = encodeURI(document.title);
			var _url = encodeURI(document.location);
			var _appkey = encodeURI("appkey");
			var _u = 'http://v.t.qq.com/share/share.php?title=' + _t + '&url=' + _url + '&appkey=' + _appkey;
			window.open(_u);
        },douban:function() {
            window.open("http://www.douban.com/recommend/?url=" + this.url() + "&title=" + this.title() + "&v=1")
        }};
    window.share = a
})();


function postToWb2(classid,id,type) {
	$.ajax({
		   type: "POST",
		   url: "/e/public/share/index.php",
		   data: "classid="+classid+"&id="+id,
		   success: function(msg){
			   if(msg ==2)
			   {
				   if(type =='txwb')
				   {
					    var _t = encodeURI(document.title);
						var _url = encodeURI(document.location);
						var _appkey = encodeURI("appkey");
						var _u = 'http://v.t.qq.com/share/share.php?title=' + _t + '&url=' + _url + '&appkey=' + _appkey;
						window.open(_u);
				   }
				   else if(type =='xlwb')
				   {
					   share.sinaminiblog();
				   }
				   else if(type =='wywb')
				   {
					   share.wangyi();
				   }
				   else if(type =='qqzone')
				   {
					   share.qqzone();
				   }
				   else if(type =='qqpengyou')
				   {
					   window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?to=pengyou&url='+encodeURIComponent(document.location.href));return false;
				   }
				   else if(type =='renren')
				   {
					   share.renren();
				   }
				   else if(type =='kaixin')
				   {
					   share.kaixin();
				   }
				   else if(type =='tjh')
				   {
					   share.taojianghu();
				   }
				   else if(type =='douban')
				   {
					   share.douban();
				   }
				   
				   else if(type =='baidusoucang')
				   {
					   share.baidusoucang();
				   }
			   }
			   else{
				   alert('你还未登录，登录后才能分享，请登录.')
			   }
		   }
		});
}

function searchkey(name) {
	$('#keybord').attr("value", name);
	$('#searchform').submit();       
}

(function(a){a.fn.hoverClass=function(b){var a=this;a.each(function(c){a.eq(c).hover(function(){$(this).addClass(b)},function(){$(this).removeClass(b)})});return a};})(jQuery);

$(function(){
	
	//导航
	$(".nav li").hoverClass("hover");
	
	//选项卡图片
	$(".piclist li").hoverClass("hover");
	
	//keywords text
	var keyword = "请输入关键词";
	$(".birds").val(keyword).bind("focus",function(){
		if(this.value == keyword){
			this.value = "";
			this.className = "focus_text"
		}
	}).bind("blur",function(){
		if(this.value == ""){
			this.value = keyword;
			this.className = "blur_text"
		}
	});
	
	//返回顶部
    $('<a href="#" class="retop">返回顶部</a>').appendTo('body').hide().click(function() {
        $(document).scrollTop(0);
        $(this).hide();
        return false
    });
    var $retop = $('.retop');

    function backTopLeft() {
        var btLeft = $(window).width() / 2 + 395;
        if (btLeft >= 0) {
            $retop.css({ 'left': $(".container").offset().left + $(".container").width() + 15 })
        } else {
            $retop.css({ 'right': btLeft })
        }
    }

    backTopLeft();
    $(window).resize(backTopLeft);
    $(window).scroll(function() {
        if ($(document).scrollTop() === 0) {
            $retop.hide()
        } else {
            $retop.show()
        }
        if ($.browser.msie && $.browser.version == 6.0 && $(document).scrollTop() !== 0) {
            $retop.css({ 'opacity': 1 })
        }
    });
	
});