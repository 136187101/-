<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from news_zilei where id = $zid"; 
$db->setQuery($sql);
$tbb= $db->loadobject();
if($Submit == "搜索"){
$sql = "select a.*,c.zititle from news a left join news_zilei c on a.ziid=c.id where a.title like '%".$_GET["sou"]."%' or c.zititle like '%".$_GET["sou"]."%' order by a.px desc,a.zhiding desc";
}else{
$sql = "select a.*,c.zititle,c.gid,c.id as ziid from news a left join news_zilei c on a.ziid=c.id where c.id = $zid order by a.px desc,a.zhiding desc";
}
$pagepre = 10;
$db->setQuery($sql);
$zong = $db->num_rows();
	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
$rows = $db->loadObjectList();
$rowst = $db->loadObject();
if($zong == ""){
	  	$kong = "<div style='padding-top:5px;'>
	  当前还没有任何记录,您所在的当前位置是：".$tbb->zititle."</div>";
	  $zong = 1 ;
}
if($act == "del"){
	$query = "delete from news where id in($id)";
	$db->setQuery($query);
	$db->query();
	$js->alert("删除成功");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}


if($act == "nozhan"){
	$query = "update news set zhanshi='0' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("首页展示已取消");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}
if($act == "zhan"){
	$query = "update news set zhanshi='1' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("首页展示已展示");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}


if($act == "notui"){
	$query = "update news set tuijian='0' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("取消推荐");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}
if($act == "tui"){
	$query = "update news set tuijian='1' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("推荐成功");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}

if($act == "noredian"){
	$query = "update news set redian='0' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("已取消");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}
if($act == "redian"){
	$query = "update news set redian='1' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->alert("已成功");
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}
if($act == "zhiding"){
	$query = "update news set zhiding='1' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}

if($act == "nozhiding"){
	$query = "update news set zhiding='0' where id=$id";
	$db->setQuery($query);
	$db->query();
	$js->Goto("?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=".$_GET["PB_page"]);
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<style>
.yangshi{ border:#ff0000 solid 1px; padding:1px 20px; color:#fff; font-weight:bold; background:#ff0000;}
</style>
<script src="../js/huanse.js"></script>
<script language="javascript">
function sltAll()
{
	var max =document.form1.item("del");
	for(j=0;j<max.length;j++)
	{
		document.form1.del[j].checked = true;
	}
}
function sltNull()
{
	var max =document.form1.item("del");
	for(j=0;j<max.length;j++)
	{
		document.form1.item("del",j).checked = false;
	}
}
//-------------以上是全选取消代码---------------//


function SelectChk()
{
	var s=false,delid,n=0,strid,strurl;
	
	var nn =document.form1.item("del");
	for (j=0;j<nn.length;j++)
	{
		if (document.form1.item("del",j).checked)
		{
			n = n + 1;
			s=true;
			delid =document.form1.del[j].value;
			if(n==1){strid = delid;}
			else{strid = strid + "," + delid;}
		}
	}

	if (nn.length==null)
		{
		if (document.form1.del.checked)
		   { s=true;
		   strid =document.form1.del.value;}
		
		}

	strurl = "?act=del&zid=<?=$zid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&id=" +strid;//据实际修改一下
	if(!s)	{
			alert("请选择要删除的信息！");
			return false;
		}
		
	if ( confirm("你确定要删除这些信息吗？"))
	{
			form1.action = strurl;
			form1.submit();
		}
}
//-------------以上是全选删除代码---------------//

function ConfirmDelBig()
{
   if(confirm("确定要删除吗？一旦删除不能恢复！"))
     return true;
   else
     return false;
	 
}

function ConfirmDelSmall()
{
   if(confirm("确定要删除吗？\n将删除此栏目下所有栏目！"))
     return true;
   else
     return false;
	 
}

function checkSubmit() 
{ 
	if(document.form2.sou.value==''){
				alert('请填写您要搜索的关键词！！');
				form2.sou.focus();
				return false;
	}
	return true; 
}
</script>



<script language="javascript">
function liwqbj_getrs(value,ids){
		var teach_str = "";
		var liwqbj = document.getElementById(value);
		var liwqbj_str = liwqbj.getElementsByTagName("INPUT");
		for (var i = 0; i < liwqbj_str.length; i++) {
			if (liwqbj_str[i].checked) teach_str += liwqbj_str[i].value + ",";
		}
		valuest = teach_str.substring(0, teach_str.length-1);
		doedit_more(valuest,ids);
}

function doedit_more(value,id)
{
		var http_request = false;
		var values = encodeURI(value); //这里UTF-8下要用encodeURI 否则在IE浏览器上出现乱码。
		//var value = encodeURIComponent(value);
        if (window.ActiveXObject){    /*在IE下初始化XMLHttpRequest对象 */
                try{
                        //新版本的 Internet Explorer
                        http_request= new ActiveXObject("Msxml2.XMLHTTP");
                }catch (oldIE){
                        try {
                                //较老版本的 Internet Explorer
                                http_request= new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (failed){
                                        // 还是创建失败 =.=|||
                                        http_request= false;
                                }             
                }
			} else if (window.XMLHttpRequest){    /*在Firefox下初始化XMLHttpRequest对象 */
					http_request= new XMLHttpRequest();
			}
			if(!http_request){
					alert("创建ajax失败！"); 
					return false;
			   }
		url = "/admin/ajax/xiangmu.php?values="+values+"&id="+id;
		if (http_request)
		{
			http_request.open("GET", url, true);	
			http_request.onreadystatechange = liwqbj;    //指定响应方法
			http_request.setRequestHeader('If-Modified-Since','0'); 
			http_request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			http_request.send(null);
		}
		
		function liwqbj(){
				if(http_request.readyState < 4)
				{
					document.getElementById("xiangmu_id").innerHTML="<img src=/admin/images/load.gif />";
				}
				if (http_request.readyState == 4 ) {
					if (http_request.status == 200) {
						Text = http_request.responseText;
						document.getElementById("xiangmu_id").className="yangshi";
						document.getElementById("xiangmu_id").innerHTML=Text;
					} else {
						alert('您请求的页面发现错误');
					}
				}
		}
}  
</script>
</head>
<body>
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="14" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <form id="form2" name="form2" method="get" action="?zid=<?=$zid?>&amp;PB_page=<?=$_GET["PB_page"];?>&amp;yidlei=<?=$_GET["yidlei"]?>&amp;sou=<?=$_GET["sou"]?>" onsubmit="return checkSubmit();">
                <tr>
                  <td width="37%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[栏目管理]-[
                        <?=$tbb->zititle?>]</td>
                      </tr>
                  </table></td>
                  <td width="20%" align="right">模糊搜索：</td>
                  <td width="12%" align="right">
                  <input name="sou" type="text" id="sou" style="height:13px; color:#999999" value="<?=$_GET["sou"]?>" size="20" />
                  <input name="zid" type="hidden" id="zid" value="<?=$_GET["zid"]?>"/>
                  </td>
                  <td width="7%" align="left"><input name="submit" type="image" src="../images/tab_21.gif"/></td>
				  <input type="hidden" name="Submit" value="搜索">
                  <td width="24%">
                  
                  
                  <?php //if($zid != 16){?>   
				  <table border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="47"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="33%" class="STYLE1"><img src="../images/22.gif" width="14" height="14" /></td>
                              <td width="67%" class="STYLE1"><a href="news_tj.php?id=<?=$rowst->ziid?>&zid=<?=$zid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"]?>" class="STYLE6">新增</a></td>
                            </tr>
                  </table>
				  
				</td>
                        <td width="132"><table border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="60"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/quit.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a class="bai" style="color:#000000" onclick="sltAll();" onmouseover="this.style.cursor='hand'">全选</a></td>
                                  </tr>
                              </table></td>
                              <td width="60"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/33.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a onclick="sltNull();" style="color:#000000" onmouseover="this.style.cursor='hand'">取消</a></td>
                                  </tr>
                              </table></td>
                              <td width="50"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/11.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a onclick="SelectChk();" style="color:#000000" onmouseover="this.style.cursor='hand'">删除</a></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table>
                  <?php //}?>
				  </td> 
                </tr>
              </form>
            </table></td>
            <td width="12"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <form id="form1" name="form1" method="post" action="">	
          <tr>
            <td width="9" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">&nbsp;</td>
                  <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="STYLE1">序号</span></td>
				  <?php if($tid != 100000){?>
                  <td width="6%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">图</td>
				  <?php } if($tid != 100000){?>
                  <td width="14%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">标题</td>
				  <?php } if($tid == 100000){?>
                  <?php }?>
                  <td width="12%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">类别</td>
                  <td width="15%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">添加时间</td>
                  <td width="7%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">首页展示</td>
			      <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">推荐</td>
			      <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">热点</td>
			      <?php if($tid == 2){?>
                  <?php }?>
                  <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">排序</td>
                  <td width="28%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1" style="cursor:hand">基本操作</td>
                </tr>
                <?php 
			 	if($_GET["PB_page"] != 1){
		  		$i=$pagepre * ($_GET["PB_page"] - 1) + 1;
		 		 }else{
				$i=1;
				}
			 foreach($rows as $row){
				?>
                <tr>
                  <td height="20" align="center" bgcolor="#FFFFFF"><input name="del" type="checkbox" id="del" value="<?=$row->id?>" />                  </td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
				  <?php if($tid != 1000000){?>
                  <td align="center" bgcolor="#FFFFFF">
				  <?php if($row->image == ""){?>
				  <img src="../images/zanwu.gif" width="40" height="40" onmouseover="toolTip('<img src=../images/zanwu.gif style=cursor:hand>')" onmouseout="toolTip()"/>
				  <?php }else{?>
				  <img src="<?=$row->image?>" width="40" height="40" onmouseover="toolTip('<img src=<?=$row->image?> width=200 height=200 style=cursor:hand>')" onmouseout="toolTip()"/>
				  <?php }?>
				  </td>
				  
				  <?php } if($tid != 10000000){?>
                  <td height="20" align="left" bgcolor="#FFFFFF"> &nbsp;<?=$row->title?></td>
				   <?php } if($tid == 10000000){?>
                  <?php }?>
				  <td height="20" align="left" bgcolor="#FFFFFF">
				  &nbsp;&nbsp;<?=$row->zititle ? $row->zititle : "<font color='red'>暂无分类</font>";?>&nbsp;&nbsp;&nbsp;
				   <?php if($zid == 1000000){?>
				  (<?=strstr($row->files_url,".");?>)
				  <?php }?>
				  </td>
                  <td align="center" bgcolor="#FFFFFF"><?=date("Y-m-d h:i:s",$row->times)?></td>
                  <td align="center" bgcolor="#FFFFFF">
				  <?php if($row->zhanshi){?>
				  <a href="?act=nozhan&id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>" style="color:#FF0000"><img src="../images/icon_ok.gif" width="16" height="16" border="0"/></a>
				  <?php }else{?>
				  <a href="?act=zhan&id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>"><img src="../images/icon_no.gif" width="16" height="16" border="0"/></a>
				  <?php }?>	
				  </td>
				   <td align="center" bgcolor="#FFFFFF">
<?php if($row->tuijian){?>
				  <a href="?act=notui&id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>" style="color:#FF0000"><img src="../images/icon_ok.gif" width="16" height="16" border="0"/></a>
				  <?php }else{?>
				  <a href="?act=tui&id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>"><img src="../images/icon_no.gif" width="16" height="16" border="0"/></a>
				  <?php }?>                   
                   </td>
				   <td align="center" bgcolor="#FFFFFF">
<?php if($row->redian){?>
				  <a href="?act=noredian&id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>" style="color:#FF0000"><img src="../images/icon_ok.gif" width="16" height="16" border="0"/></a>
				  <?php }else{?>
				  <a href="?act=redian&id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>"><img src="../images/icon_no.gif" width="16" height="16" border="0"/></a>
				  <?php }?>                   
                   
                   </td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$row->px?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><a href="news_up.php?id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>">&nbsp;<img src="../images/edt.gif" width="16" height="16" border="0" />编辑</a>&nbsp;
				  <?php if($zid != 1){?>
				  <a href="?act=del&amp;id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a>
				  <?php }?>	
                  <?php if($tid == 9){?>
                  &nbsp;<a href="news_img_gl.php?id=<?=$row->id?>">图片管理</a>&nbsp;
                  <?php }?>	
                  <?php if($row->zhiding){?>
                  <a href="news_up.php?id=<?=$row->id?>&amp;zid=<?=$row->ziid?>&amp;tid=<?=$tid?>&amp;gid=<?=$gid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$_GET["PB_page"];?>"> &nbsp;</a>                  <a href="?act=nozhiding&amp;id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>">【取消置顶】</a>
                  <?php }else{?>
                  <a href="?act=zhiding&amp;id=<?=$row->id?>&zid=<?=$row->ziid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$_GET["PB_page"];?>">【置顶】</a>
                  <?php }?>
                  </td>
                </tr>
                <?php
				$i++;
				   }
				   ?>
              </table>
            <?=$kong?></td>
            <td width="9" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
	</form>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
				
                  <td width="47%" class="STYLE4">&nbsp;&nbsp;共有
                    <?=$zong?>
                    条记录，当前第
                    <?=$_GET["PB_page"];?>
                    /
                    <?=$liwqbjpage->totalpage?>
                    页，当前 <?=$pagepre?> 条                    </td>
                  <td align="right" class="STYLE4"><?=$liwqbjpage->show(3)?></td>
                </tr>
            </table>
			</td>
            <td width="16" align="right"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
  
  
  
  
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">项目分配</span></td>
                    </tr>
                  </table></td>
                  <td width="54%">&nbsp;</td>
                </tr>
            </table></td>
            <td width="16"><img src="../images/tab_07.gif" width="16" height="30" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="8" background="../images/tab_12.gif">&nbsp;</td>
            <td align="center"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" >
                <tr>
                  <td width="697" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">添加时 各个项目分配</span></td>
                </tr>
                <tr>
                  <td align="right" bgcolor="#FFFFFF">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="xm">
                      <tr>
                        <td width="100" height="25" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_1" <?php if(strstr($tbb->xiangmu,"s_1")){ echo "checked";}?>/>
                          标题</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_2" <?php if(strstr($tbb->xiangmu,"s_2")){ echo "checked";}?>/>
                          操作</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_3" <?php if(strstr($tbb->xiangmu,"s_3")){ echo "checked";}?>/>
                          作者</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_4" <?php if(strstr($tbb->xiangmu,"s_4")){ echo "checked";}?>/>
                          网站标题</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_5" <?php if(strstr($tbb->xiangmu,"s_5")){ echo "checked";}?>/>
                          来源</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_6" <?php if(strstr($tbb->xiangmu,"s_6")){ echo "checked";}?>/>
                          图片上传</td>
                      </tr>
                      <tr>
                        <td width="100" height="25" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_7" <?php if(strstr($tbb->xiangmu,"s_7")){ echo "checked";}?>/>
                          大
                          图上传</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_8" <?php if(strstr($tbb->xiangmu,"s_8")){ echo "checked";}?>/>
                          文件上传</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_9" <?php if(strstr($tbb->xiangmu,"s_9")){ echo "checked";}?>/>
                          seo标题</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_10" <?php if(strstr($tbb->xiangmu,"s_10")){ echo "checked";}?>/>
                          seo关键词</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_11" <?php if(strstr($tbb->xiangmu,"s_11")){ echo "checked";}?>/>
                          seo描述</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_12" <?php if(strstr($tbb->xiangmu,"s_12")){ echo "checked";}?>/>
                          排序</td>
                      </tr>
                      <tr>
                        <td height="25" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_13" <?php if(strstr($tbb->xiangmu,"s_13")){ echo "checked";}?>/>
                          是否展示特性</td>
                        <td align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_14" <?php if(strstr($tbb->xiangmu,"s_14")){ echo "checked";}?>/>
                          详细内容</td>
                        <td align="left"><input name="xiangmu[]" type="checkbox" id="xiangmu[]" value="s_15" <?php if(strstr($tbb->xiangmu,"s_15")){ echo "checked";}?>/>
价格</td>
                        <td align="left"><input name="xiangmu[]" type="checkbox" id="xiangmu[]" value="s_16" <?php if(strstr($tbb->xiangmu,"s_16")){ echo "checked";}?>/>
                          优酷视频</td>
                        <td align="left">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="30" align="left"><a href="javascript:liwqbj_getrs('xm','<?=$zid?>')"><img src="../images/baochun.gif" width="58" height="25" /></a></td>
                        <td align="left"><span id="xiangmu_id"></span></td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                    </table>
                  </td>
                </tr>                
                
            </table>
            
            </td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td>&nbsp;</td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
  
  
<script src="../js/tu.js"  language="javascript"></script>
 </body>
 </html>