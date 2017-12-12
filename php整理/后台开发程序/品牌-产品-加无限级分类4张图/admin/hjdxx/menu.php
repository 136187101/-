<?php 
require '../../include/init.php';
require_once("../session.php");
//读取管理员权限
$quanxian=$hjd->get_one("select * from admin_user where username = '$_SESSION[adminname]'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/css.css"/>
<link rel="stylesheet" href="css/jquery.treeview.css" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#browser3").treeview({
		persist: "location",
		collapsed: true,
		unique: true
	});

});
</script>
<script language="javascript">

function killerrors() {

return true;

}

window.onerror = killerrors;
</script>
<style type="text/css">
body {
  background: #448300;
  margin:0;
  padding:0;
}
#tabbar-div {
background:url(images/guanli_12.jpg) no-repeat;
margin-left:0px;
  height: 28px;
  padding-top: 0px;
  
}
#tabbar-div p {
  margin: 0px 0 0 0;
}
.tab-front {
  background: #80BDCB;
  line-height: 20px;
  font-weight: bold;
  padding: 4px 15px 4px 18px;
  border-right: 2px solid #335b64;
  cursor: hand;
  cursor: pointer;
}
.tab-back {
  color: #F4FAFB;
  line-height: 20px;
  padding: 4px 15px 4px 18px;
  cursor: hand;
  cursor: pointer;
}
.tab-hover {
  color: #F4FAFB;
  line-height: 20px;
  padding: 4px 15px 4px 18px;
  cursor: hand;
  cursor: pointer;
  background: #2F9DB5;
}
#top-div
{
  padding: 3px 0 2px;
  background: #448300;
  margin: 5px;
  text-align: center;
}
#main-div {
  border: 0px solid #345C65;
  padding: 0px;
  margin-left:10px;
  background:#ebf9e1;
  
}
#menu-list {
  padding: 0;
  margin:0px;
}
#menu-list ul {
  padding: 0;
  margin: 0;
  list-style-type: none;
  color: #335B64;
}
#menu-list li {
  padding-left: 36px;
  line-height: 28px;
  padding-top:2px;
  cursor: hand;
  cursor: pointer;
}
#menu-list li li{
  padding-left: 16px;
  line-height: 22px;
  padding-top:0px;
  
  cursor: hand;
  cursor: pointer;
}
#main-div a:visited, #menu-list a:link, #menu-list a:hover {
  color: #335B64
  text-decoration: none;
}
#menu-list a:active {
  color: #EB8A3D;
}
.explode {
  background: url(images/bca_17.jpg) no-repeat 0px 0px;
  font-weight: bold;
}
.explode1 {
  background: url(images/guanli_121.jpg) no-repeat 10px 3px;
  font-weight: bold;
}

.collapse {
  background: url(images/bca_17.jpg) no-repeat 0px 0px;
  font-weight: bold;
}
.menu-item {
  background: url(images/xiaoben_21.jpg) no-repeat 0px 3px;
  font-weight: normal;
}
#help-title {
  font-size: 14px;
  color: #000080;
  margin: 5px 0;
  padding: 0px;
}
#help-content {
  margin: 0;
  padding: 0;
}
.tips {
  color: #CC0000;
}
.link {
  color: #000099;
}
.menulist
		{
		COLOR: #384F67; 
		TEXT-DECORATION: none;
		font-size:12px;
		}
	
.menuq {
	background:url(images/menu_bg_01.gif) repeat-x;
	margin: 0px;
	padding: 0px;
	position:absolute;
	top:0px;
	text-align:center;
}		
.Lion_menu_2 {
	text-decoration: none;
	font-size: 12px;
	font-weight: bold;
	color: #4B6888;
	text-align:center;
	
}		
</style>

</head>
<body>
<div id="tabbar-div">
<p>
<span style="float:left; padding: 0px 10px;" >
<a href="javascript:toggleCollapse();"><img id="toggleImg" src="images/guanli_121.jpg" border="0" alt="闭合" /></a>
</span>
  
</p>
</div>
<div id="main-div">
<div id="menu-list">
<ul>
<?php if($quanxian["quanxian"]==0)
{?>
   <li  class="explode" >权限管理
    <ul>
      <li class="menu-item"><a href="../xitong/admin_user.php"  target='main-frame' class='menulist'>管理员列表</a></li> 
      <li class="menu-item"><a href="../xitong/add_admin.php"  target='main-frame' class='menulist'>添加子管理员</a></li>
    <!--   <li><span class="file"><a href="?2.1">管理员日志</a></span></li>
	  <li><span class="file"><a href="?2.1">订单统计会员排行</a></span></lii>
	  <li><span class="file"><a href="?2.1">供货商列表</a></span></li>-->
    </ul>
  </li>
<?php
}
?>


  <li class="explode" key="02_cat_and_goods" name="menu">
    系统设置<ul>
      <li class="menu-item"><a href="../xitong/sys.php" target='main-frame' class='menulist'>网站设置</a></li>
<!--	  <li class="menu-item"><a href="../zhifu/zhifugl.php"target='main-frame' class='menulist'>支付方式</a></li>
	  <li class="menu-item"><a href="../link/link_gl.php" target='main-frame' class='menulist'>友情链接</a></li>-->
	  <li class="menu-item"><a href="../poster/poster_gl.php" target='main-frame' class='menulist'>焦点图管理</a></li>
	 <!-- <li class="menu-item"><a href="../Advertising/poster_gl.php" target='main-frame' class='menulist'>广告管理</a></li>-->
    </ul>
  </li>
  <li class="explode">体验管理
    <ul>
      <li class="menu-item"><a href="../liuyan/liuyan.php?type=0"  target='main-frame' class='menulist'>查看申请</a></li> 
    </ul>
  </li>
  <li class="explode">品牌分类
    <ul>
      <li class="menu-item"><a href="../pinpai/pinpai.php?fuid=0"  target='main-frame' class='menulist'>品牌分类</a></li> 
    </ul>
  </li>
  <li class="explode">品牌分类列表
    <ul>
    	<?php 
		$rs_pp=$db->query("select * from bandrfl where fuid ='0' order by px desc");
		while($rpws_pp=$wy->fetch_array($rs_pp)){
		?>
      <li class="menu-item"><a href="../pinpai/bandrgl.php?fuid=<?php echo $rpws_pp["id"]?>"  target='main-frame' class='menulist'><?php echo $rpws_pp["title"]?></a></li> 
    	<?php }?>
    </ul>
  </li>

<li class="explode">栏目管理
		<ul>
		  <li  class="menu-item"><a href="../essay/essay_lei.php?fuid=0"   target='main-frame' class='menulist'>栏目分类</a></li>
		</ul>
	</li>
</ul>
<ul id="browser3" class="filetree treeview-famfamfam" >
<li style="margin:0; padding:0;"><span class="folder" style=" background:url(images/bca_17.jpg) no-repeat; margin:0; padding-left:35px; font-weight:700;">信息列表</span>
            <ul style="padding-left:10px;">
				 <?php
                $query = "SELECT * FROM essay_zilei where fuid = 0 order by zileipx desc";
                $arr=$db->getAll($query);
                   if(!empty($arr)){
                foreach($arr as $row){
                $sql="select * from essay_zilei where fuid=$row[id]";		
                $nem=$db->query($sql);	
                $nums=$db->fetch_nums($nem);	
                         if($nums){?>
                <li><span class="file"><?=$row["zititle"]?></span><?php news_list($row[id])?></li>
                    <?php }else{?>
                <li><span class="file"><a href='../essay/essay_gl.php?zid=<?=$row["id"]?>&gid=<?=$row["gid"]?>&tid=<?=$row["fuid"]?>'  target='main-frame' class='menulist'><?=$row["zititle"]?></a></span></li>
                        <?php } } }?>

   			 </ul>
  </li>
	   <?php
  function news_list($id){
  $sele="select * from essay_zilei where fuid=$id";
 	echo "<ul>"; 	
		  $ppt = mysql_query($sele);
		while($v = @mysql_fetch_array($ppt)){
		 $quer="select * from essay_zilei where fuid=$v[id]";
		 	$ne=mysql_query($quer);
			 $num=mysql_num_rows($ne);
		 if(!empty($num)){ 
		echo  "<li><span class='file'>$v[zititle]</span>";
			news_list($v[id]);			
		 echo 	"</li>";
		  }else{
		 echo "<li><span class='file'>";
echo "<a href='../essay/essay_gl.php?zid=$v[id]&gid=$v[gid]&tid=$v[fuid]'  target='main-frame' class='menulist'>$v[zititle]</a></span></li>";
		 } }		
echo "</ul>";  
  }
  ?>  
</ul>
<br />
<br />

</div>
<div id="help-div" style="display:none">
<h1 id="help-title"></h1>
<div id="help-content"></div>
</div>
</div>
<script type="text/javascript" src="js/utils.js"></script>
<script language="JavaScript">
<!--
var collapse_all = "闭合";
var expand_all = "展开";
var collapse = true;

function toggleCollapse()
{
  var items = document.getElementsByTagName('LI');
  for (i = 0; i < items.length; i++)
  {
    if (collapse)
    {
      if (items[i].className == "explode1")
      {
        toggleCollapseExpand(items[i], "collapse");
      }
    }
    else
    {
      if ( items[i].className == "collapse")
      {
        toggleCollapseExpand(items[i], "explode");
        ToggleHanlder.Reset();
      }
    }
  }

  collapse = !collapse;
  document.getElementById('toggleImg').src = collapse ? 'images/guanli_121.jpg' : 'images/guanli_121.jpg';
  document.getElementById('toggleImg').alt = collapse ? collapse_all : expand_all;
}

function toggleCollapseExpand(obj, status)
{
  if (obj.tagName.toLowerCase() == 'li' && obj.className != 'menu-item')
  {
    for (i = 0; i < obj.childNodes.length; i++)
    {
      if (obj.childNodes[i].tagName == "UL")
      {
        if (status == null)
        {
          if (obj.childNodes[1].style.display != "none")
          {
            obj.childNodes[1].style.display = "none";
            ToggleHanlder.RecordState(obj.getAttribute("key"), "collapse");
            obj.className = "collapse";
          }
          else
          {
            obj.childNodes[1].style.display = "block";
            ToggleHanlder.RecordState(obj.getAttribute("key"), "explode");
            obj.className = "explode";
          }
          break;
        }
        else
        {
          if( status == "collapse")
          {
            ToggleHanlder.RecordState(obj.getAttribute("key"), "collapse");
            obj.className = "collapse";
          }
          else
          {
            ToggleHanlder.RecordState(obj.getAttribute("key"), "explode");
            obj.className = "explode";
          }
          obj.childNodes[1].style.display = (status == "explode") ? "block" : "none";
        }
      }
    }
  }
}
document.getElementById('menu-list').onclick = function(e)
{
  var obj = Utils.srcElement(e);
  toggleCollapseExpand(obj);
}

document.getElementById('tabbar-div').onmouseover=function(e)
{
  var obj = Utils.srcElement(e);

  if (obj.className == "tab-back")
  {
    obj.className = "tab-hover";
  }
}

document.getElementById('tabbar-div').onmouseout=function(e)
{
  var obj = Utils.srcElement(e);

  if (obj.className == "tab-hover")
  {
    obj.className = "tab-back";
  }
}

document.getElementById('tabbar-div').onclick=function(e)
{
  var obj = Utils.srcElement(e);

 // var mnuTab = document.getElementById('menu-tab');
  var hlpTab = document.getElementById('help-tab');
  var mnuDiv = document.getElementById('menu-list');
  var hlpDiv = document.getElementById('help-div');

  //if (obj.id == 'menu-tab')
//  {
//    mnuTab.className = 'tab-front';
//    hlpTab.className = 'tab-back';
//    mnuDiv.style.display = "block";
//    hlpDiv.style.display = "none";
//  }

  if (obj.id == 'help-tab')
  {
    mnuTab.className = 'tab-back';
    hlpTab.className = 'tab-front';
    mnuDiv.style.display = "none";
    hlpDiv.style.display = "block";

    loc = parent.frames['main-frame'].location.href;
    pos1 = loc.lastIndexOf("/");
    pos2 = loc.lastIndexOf("?");
    pos3 = loc.indexOf("act=");
    pos4 = loc.indexOf("&", pos3);

    filename = loc.substring(pos1 + 1, pos2 - 4);
    act = pos4 < 0 ? loc.substring(pos3 + 4) : loc.substring(pos3 + 4, pos4);
    loadHelp(filename, act);
  }
}

/**
 * 创建XML对象
 */
function createDocument()
{
  var xmlDoc;

  // create a DOM object
  if (window.ActiveXObject)
  {
    try
    {
      xmlDoc = new ActiveXObject("Msxml2.DOMDocument.6.0");
    }
    catch (e)
    {
      try
      {
        xmlDoc = new ActiveXObject("Msxml2.DOMDocument.5.0");
      }
      catch (e)
      {
        try
        {
          xmlDoc = new ActiveXObject("Msxml2.DOMDocument.4.0");
        }
        catch (e)
        {
          try
          {
            xmlDoc = new ActiveXObject("Msxml2.DOMDocument.3.0");
          }
          catch (e)
          {
            alert(e.message);
          }
        }
      }
    }
  }
  else
  {
    if (document.implementation && document.implementation.createDocument)
    {
      xmlDoc = document.implementation.createDocument("","doc",null);
    }
    else
    {
      alert("Create XML object is failed.");
    }
  }
  xmlDoc.async = false;

  return xmlDoc;
}

//菜单展合状态处理器
var ToggleHanlder = new Object();

Object.extend(ToggleHanlder ,{
  SourceObject : new Object(),
  CookieName   : 'Toggle_State',
  RecordState : function(name,state)
  {
    if(state == "collapse")
    {
      this.SourceObject[name] = state;
    }
    else
    {
      if(this.SourceObject[name])
      {
        delete(this.SourceObject[name]);
      }
    }
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie(this.CookieName, this.SourceObject.toJSONString(), date.toGMTString());
  },

  Reset :function()
  {
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie(this.CookieName, "{}" , date.toGMTString());
  },

  Load : function()
  {
    if (document.getCookie(this.CookieName) != null)
    {
      this.SourceObject = eval("("+ document.getCookie(this.CookieName) +")");
      var items = document.getElementsByTagName('LI');
      for (var i = 0; i < items.length; i++)
      {
        if ( items[0].getAttribute("name") == "menu")
        {
          for (var k in this.SourceObject)
          {
            if ( typeof(items[i]) == "object")
            {
              if (items[i].getAttribute('key') == k)
              {
                toggleCollapseExpand(items[i], this.SourceObject[k]);
                collapse = false;
              }
            }
          }
        }
     }
    }
    document.getElementById('toggleImg').src = collapse ? 'images/guanli_121.jpg' : 'images/guanli_121.jpg';
    document.getElementById('toggleImg').alt = collapse ? collapse_all : expand_all;
  }
});

ToggleHanlder.CookieName += "_1";
//初始化菜单状态
ToggleHanlder.Load();

//-->
</script>

</body>
</html>