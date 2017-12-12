// JavaScript Document
     /**
	  * 产品图片放大展示程序
	  *
	  */
	  $(document).ready(function(){
	    var x=10;
		var y=20;
	    $(".pro").mouseover(function(e){
		     this.tmp =this.src;
			 //this.title="";
		    
			var tips ="<div id='product_tips'><img src='" +this.tmp+ "'/ height=355 width=260><\/div>";
			$('body').append(tips);
			$("#product_tips").css({
			   "top" :(y+e.pageY) +"px",
			   "left" :(x+e.pageX) +"px"
			  		
			}).show();
		
		
		}).mouseout(function(){
		
		    $("#product_tips").remove();
			this.src=this.tmp;
		}).mousemove(function(e){
		
		       $("#product_tips").css({
			   "top" :(y+e.pageY) +"px",
			   "left" :(x+e.pageX) +"px"
			  		
			}).show();
		
		
		})
	  
	  });


/*

<script src="../js/jquery-1.3.2.min.js"></script>
  //必用CSS
<style type="text/css">
#product_tips{
	position:absolute;
	padding:2px;
	display:none;
	color:#fff;
	height:355px;
	width:260px;
}
</style>












*/