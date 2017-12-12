<?php
require_once("../../include/global.php");
require_once("../session.php");
if($Submit=="添加"){	
		$sql = "select * from news_zilei where id = $zileiid";
		$db->setquery($sql);
		$news_tit = $db->loadobject();

		$url = "/400dianhua/".$news_tit->yzititle."/index-".time().".html";
		$img = new Image("image","newspic");
		if($img->upload()){
			$image = $img->getImgPath();
		}		
		$imgs = new Image("image2","newspic");
		if($imgs->upload()){
			$image2 = $imgs->getImgPath();
		}
		$files_t = new Filest("files_a","files");
		if($files_t->upload()){
			$files_url = $files_t->getfilesPath();
		}
	
	$query = "insert into news(ziid,title,name,author,image,image_rot,files_url,htmlurl,shiping,zhicheng,jiage,type1,type2,type3,type4,type5,content,times,px,seo_title,seo_gjci,seo_type,zhanshi,tuijian,zhiding,redian) values('$zileiid','$title','$name','$author','$image','$image2','$files_url','$url','$shiping','$zhicheng','$jiage','$type1','$type2','$type3','$type4','$type5','$content','".time()."','$px','$seo_title','$seo_gjci','$seo_type','$zhanshi','$tuijian','$zhiding','$redian')";
	$db->setQuery($query);	
	
	if($tid == 2){
	$path = ROOT."/admin/mod/index-1.htm";
	$array = array(
				"{-zititle-}"=>$row_yi->zititle,
				"{-title-}"=>$title,
				"{-wztitle-}"=>$author,
				"{-seotitle-}"=>$seo_title,
				"{-seogjci-}"=>$seo_gjci,
				"{-seotype-}"=>$seo_type,
				"{-content-}"=>stripslashes($content),
	);
	$html = new CreateHtml();
	$html->readTemplate($path);
	$html->createStaticHtml($array,ROOT.$url);
	$html->foreachhtml(ROOT.$url);
	$html->diqutitlehhtml(ROOT.$url,$zileiid);
	$html->diquleibiehtml(ROOT.$url);
	}
		if($db->query()){
			$js->Alert("添加成功");
			$js->Goto("news_gl.php?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan");
		}
}
		$sql = "select * from news_zilei where id = $zid";
		$db->setquery($sql);
		$row_yi = $db->loadObject(); 
		$row_zilei = "-[".$row_yi->zititle."]";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站后台管理系统</title>
<script type="text/javascript" src="../../include/ckeditor/ckeditor.js"></script>
<script src="../../include/ckeditor/sample.js" type="text/javascript"></script>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.menuNo { color:#000; cursor:pointer; line-height:28px;}
.menuOn { background:url(../images/left_nei.jpg) repeat-x; color:#ff0000; cursor:pointer; line-height:28px;}
.list_none {display:none}
.list {margin:0px;padding:5px;height:auto}
.yangshi{ border:#ff0000 solid 1px; padding:1px 20px; color:#fff; font-weight:bold; background:#ff0000;}
</style>
<script type="text/javascript" charset="utf-8" src="../editubb/kindeditor.js"></script>
<script language=javascript type="text/javascript"> 
    KE.show({
        id : 'type1',
        cssPath : '../editubb/index.css'
    });
    KE.show({
        id : 'type2',
        cssPath : '../editubb/index.css'
    });
    KE.show({
        id : 'type3',
		cssPath : '../editubb/index.css'
    });
    KE.show({
        id : 'content4',
        cssPath : '../editubb/index.css'
    });
    KE.show({
        id : 'content5',
        cssPath : '../editubb/index.css'
    });
</script>


<script language="javascript">
function lwqyanse(ids) {
  		document.getElementById(ids).className="input_hongse";
}
function lwq_yanseno(ids){
  		document.getElementById(ids).className="input_none";
}
function switchmodTag(modtag,modcontent,modk) {
    for(i=1; i <= 10; i++) {
      if (i==modk) {
        document.getElementById(modtag+i).className="menuOn";
		document.getElementById(modcontent+i).className="list";
		}
      else {
        document.getElementById(modtag+i).className="menuNo";
		document.getElementById(modcontent+i).className="list_none";
		}
    }
  }

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
<form action="" method="post" enctype="multipart/form-data" name="myform" id="myform" onsubmit="return checkSubmit();">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="30" background="../images/tab_05.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="30"><img src="../images/tab_03.gif" width="12" height="30" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="46%" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="5%"><div align="center"><img src="../images/tb.gif" width="16" height="16" /></div></td>
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[栏目管理]                          <?=$row_zilei?></td>
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
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">添加&nbsp;&nbsp;<?=$row_zilei?></span></td>
                </tr>
				
                <tr>
                  <td width="144" height="25" align="right" bgcolor="#FFFFFF">项目分配：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <input name="checkbox2" type="checkbox" id="checkbox" onclick="document.all.liwqbj_s.style.display=(this.checked?'':'none')"/>                  </td>
                </tr>
                <tr id="liwqbj_s" style="display:none;">
                  <td height="20" align="right" bgcolor="#FFFFFF">&nbsp;</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="xm">
                      <tr>
                        <td width="100" height="25" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_1" <?php if(strstr($row_yi->xiangmu,"s_1")){ echo "checked";}?>/>
                        标题</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_2" <?php if(strstr($row_yi->xiangmu,"s_2")){ echo "checked";}?>/>
                        操作</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_3" <?php if(strstr($row_yi->xiangmu,"s_3")){ echo "checked";}?>/>
                        作者</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_4" <?php if(strstr($row_yi->xiangmu,"s_4")){ echo "checked";}?>/>
                        网站标题</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_5" <?php if(strstr($row_yi->xiangmu,"s_5")){ echo "checked";}?>/>
                        来源</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_6" <?php if(strstr($row_yi->xiangmu,"s_6")){ echo "checked";}?>/>
                        图片上传</td>
                      </tr>
                      <tr>
                        <td width="100" height="25" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_7" <?php if(strstr($row_yi->xiangmu,"s_7")){ echo "checked";}?>/>
                          大
                          图上传</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_8" <?php if(strstr($row_yi->xiangmu,"s_8")){ echo "checked";}?>/>
文件上传</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_9" <?php if(strstr($row_yi->xiangmu,"s_9")){ echo "checked";}?>/>
                          seo标题</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_10" <?php if(strstr($row_yi->xiangmu,"s_10")){ echo "checked";}?>/>
                          seo关键词</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_11" <?php if(strstr($row_yi->xiangmu,"s_11")){ echo "checked";}?>/>
                          seo描述</td>
                        <td width="100" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_12" <?php if(strstr($row_yi->xiangmu,"s_12")){ echo "checked";}?>/>
                          排序</td>
                      </tr>
                      <tr>
                        <td height="25" align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_13" <?php if(strstr($row_yi->xiangmu,"s_13")){ echo "checked";}?>/>
                          是否展示特性</td>
                        <td align="left">
                          <input name="xiangmu[]" type="checkbox" id="xiangmu" value="s_14" <?php if(strstr($row_yi->xiangmu,"s_14")){ echo "checked";}?>/>
详细内容</td>
                        <td align="left"><input name="xiangmu[]" type="checkbox" id="xiangmu[]" value="s_15" <?php if(strstr($row_yi->xiangmu,"s_15")){ echo "checked";}?>/>
价格</td>
                        <td align="left"><input name="xiangmu[]" type="checkbox" id="xiangmu[]" value="s_16" <?php if(strstr($row_yi->xiangmu,"s_16")){ echo "checked";}?>/>
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
                    </table>                  </td>
                </tr>
       <?php if(strstr($row_yi->xiangmu,"s_1")){?>           
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">标题：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="title" type="text" id="title" class="input_none" onclick="lwqyanse('title');" onblur="lwq_yanseno('title');"/></td>
                </tr>
      <?php }?>         
               
               
       <?php if(strstr($row_yi->xiangmu,"s_2")){?>          
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">操作：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
<input name="zhanshi" type="checkbox" id="checkbox18" value="1" />首页展示<input name="tuijian" type="checkbox" id="checkbox16" value="1" />推荐 <input name="zhiding" type="checkbox" id="checkbox17" value="1" />置顶 <input name="redian" type="checkbox" id="checkbox19" value="1" />热点</td>
                </tr>
         <?php }?>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">类别：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                <select name="zileiid" id="zileiid">
                <?php
                $sqlz_id=mysql_query("select * from news_zilei where id='$zid'");
                $rsz_id=mysql_fetch_array($sqlz_id);
                ?>
                  <option value="<?=$rsz_id["id"]?>"><?=$rsz_id["zititle"]?></option>
                </select>&nbsp;&nbsp;<span class="STYLE7">*</span></td>
                </tr>
                
                
                
				<?php if(strstr($row_yi->xiangmu,"s_3")){?>     
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">作者：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="name" type="text" id="name" class="input_none" onclick="lwqyanse('name');" onblur="lwq_yanseno('name');"/></td>
                </tr>
                <?php }?>
                
                
                <?php if(strstr($row_yi->xiangmu,"s_4")){?>    
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">网站标题：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="author" type="text" id="author" class="input_none" onclick="lwqyanse('author');" onblur="lwq_yanseno('author');"/></td>
                </tr>
				<?php }?>
                
                <?php if(strstr($row_yi->xiangmu,"s_5")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">来源：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="zhicheng" type="text" id="zhicheng" class="input_none" onclick="lwqyanse('zhicheng');" onblur="lwq_yanseno('zhicheng');"/></td>
                </tr>
				<?php }?>
				
				<?php if(strstr($row_yi->xiangmu,"s_6")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">图片：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="image" type="file" id="image" class="file"/></td>
                </tr>
				<?php }?>
				
				
				
				<?php if(strstr($row_yi->xiangmu,"s_7")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">图片大图：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="image2" type="file" id="image2" class="file"/></td>
                </tr>
				<?php }?>
				
				
				
				<?php if(strstr($row_yi->xiangmu,"s_8")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">文件路径：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="files_url" type="text" id="files_url" value="<?=$files_url?>" class="input_none" onclick="lwqyanse('files_url');" onblur="lwq_yanseno('files_url');"/></td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">文件：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="files_a" type="file" id="files_a" class="file"/></td>
                </tr>
				<?php }?>
                
                
                <?php if(strstr($row_yi->xiangmu,"s_9")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">seo标题：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <input name="seo_title" type="text" id="seo_title" class="input_none" onclick="lwqyanse('seo_title');" onblur="lwq_yanseno('seo_title');"/>                  </td>
                </tr>
                <?php }?>
                
                <?php if(strstr($row_yi->xiangmu,"s_10")){?> 
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo关键词：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <textarea name="seo_gjci" cols="45" rows="5" id="seo_gjci"></textarea>                  </td>
                </tr>
                <?php }?>
                
                
                <?php if(strstr($row_yi->xiangmu,"s_11")){?> 
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <textarea name="seo_type" id="seo_type" cols="45" rows="5"></textarea>                  </td>
                </tr>
                <?php }?>
				 <?php if(strstr($row_yi->xiangmu,"s_16")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">优酷视频web连接：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="shiping" id="shiping" cols="45" rows="5"></textarea></td>
                </tr>
				 <?php }?>
                <?php if(strstr($row_yi->xiangmu,"s_15")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">价格：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="jiage" type="text" id="jiage" value="0" size="5"/></td>
                </tr>
				 <?php }?>
                <?php if(strstr($row_yi->xiangmu,"s_12")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">排序：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="0" size="5"/></td>
                </tr>
                <?php }?>
                
                
                
            <?php if(strstr($row_yi->xiangmu,"s_13")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">是否展示特性：</td>
                  <td width="870" height="20" align="left" bgcolor="#FFFFFF">
                  <input type="checkbox" name="checkbox" value="checkbox" onclick="document.all.liwqbj1.style.display=(this.checked?'':'none')"/></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" bgcolor="#FFFFFF">
				  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="liwqbj1" style="display:none;">
				<tr>
                  <td height="20" colspan="2" align="left" bgcolor="#FFFFFF"><table height="31" border="0" cellpadding="0" cellspacing="0" style="border:#dcdcdc solid 1px; background:url(../images/left_nei_1.jpg) repeat-x; margin-top:10px; margin-left:5px;">
                    <tr>
                      <td width="100" align="center" class="menuOn" id="mod1" onclick="switchmodTag('mod','list','1');this.blur();">描述</td>
					  <td width="100" align="center" class="menuOn" id="mod2" onclick="switchmodTag('mod','list','2');this.blur();">特点 </td>
					  <td width="100" align="center" class="menuOn" id="mod3" onclick="switchmodTag('mod','list','3');this.blur();">规格</td>
					  <td width="100" align="center" class="menuOn" id="mod4" onclick="switchmodTag('mod','list','4');this.blur();">应用</td>
                    </tr>
                  </table>				  </td>
                </tr>
				
                <tr class="list" id="list1">
                  <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type1" id="type1" style="width:100%; height:150px;"></textarea></td>
                </tr>
				
                <tr class="list_none" id="list2">
                  <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type2" id="type2" style="width:100%; height:150px;"></textarea></td>
                </tr>
				
                <tr class="list_none" id="list3">
                  <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type3"  id="type3" style="width:100%; height:150px;"></textarea></td>
                </tr>
				
                <tr class="list_none" id="list4">
                  <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type4" id="content4" style="width:100%; height:150px;visibility:hidden;"></textarea></td>
                </tr>
				
                <tr class="list_none" id="list5">
                  <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type5" id="content5" style="width:100%; height:150px;visibility:hidden;"></textarea></td>
                </tr>
				</table>				</td>
                </tr>
                <?php }?>
                <?php if(strstr($row_yi->xiangmu,"s_14")){?> 
                <tr>
                  <td height="20" colspan="2" align="center" bgcolor="#FFFFFF">
				  
				  <textarea class="ckeditor" cols="80" id="editor1" name="content" rows="10"></textarea>
          	<script type="text/javascript">
				CKEDITOR.replace( 'editor1',
					{
						skin : 'v2'
					});
			</script>

				</td>
                </tr>
                <?php }?>
                
                
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="添加"/>                    
                    &nbsp;&nbsp;
                    <input name="Submit2" type="button" class="anniu" id="Submit2" value="返回" onclick="location.href='news_gl.php?zid=<?=$zid?>&tid=<?=$tid?>&gid=<?=$gid?>&yuyan=<?=$yuyan?>&PB_page=<?=$PB_page?>&sou=<?=$sou?>'";/></td>
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
</form>
</body>
</html>


