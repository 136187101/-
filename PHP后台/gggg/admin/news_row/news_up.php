<?php
require_once("../../include/global.php");
require_once("../session.php");
$query = "select * from news where id=$id";
$db->setQuery($query);
$pro = $db->loadObject();

$sql = "select * from news_zilei where id = $zid";
$db->setquery($sql);
$row_yi = $db->loadObject(); 
$row_zilei = "-[".$row_yi->zititle."]";

$image = $pro->image;
$image2 = $pro->image_rot;
			if($tupian == "dels"){
			$query = "update news set image_rot='' where id =$id";
			$db->setQuery($query);
			$db->query();
			$root = ROOT.$pro->image_rot;
			@unlink($root);
			$js->alert("删除成功");
			$js->goto("?id=$id&zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=$PB_page&sou=$sou");
			}
			if($tupian1 == "del"){
			$query = "update news set image='' where id =$id";
			$db->setQuery($query);
			$db->query();
			$root = ROOT.$pro->image;
			@unlink($root);
			$js->alert("删除成功");
			$js->goto("?id=$id&zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=$PB_page&sou=$sou");			
			}
if($Submit=="修改"){
			
			$url = "$pro->htmlurl";
			if($_FILES[image][name]){
				$img = new Image("image","newspic");
				if($img->upload()){
					$image = $img->getImgPath();
					$root = ROOT.$pro->image;
					@unlink($root);
				}else{
					echo $image;
				}
			}
			if($_FILES[image2][name]){
				$imgs = new Image("image2","newspic");
				if($imgs->upload()){
					$image2 = $imgs->getImgPath();
					$root = ROOT.$pro->image_rot;
					@unlink($root);
				}else{
					echo $image2;
				}
			}
			if($_FILES[files_a][name]){
				$files_t = new Filest("files_a","files");
				if($files_t->upload()){
					$files_url = $files_t->getfilesPath();
					$root = ROOT.$files_url;
					@unlink($root);
				}else{
					echo $files_url;
				}
			}

	$query = "update news set ziid='$zileiid',title='$title',name='$name',author='$author',image='$image',image_rot='$image2',files_url='$files_url',htmlurl='$url',shiping='$shiping',zhicheng='$zhicheng',jiage='$jiage',type1='$type1',type2='$type2',type3='$type3',type4='$type4',type5='$type5',content='$content',times='".time()."',px='$px',seo_title='$seo_title',seo_gjci='$seo_gjci',seo_type='$seo_type' where id = $id";
	$db->setQuery($query);
	$db->query();
	
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
	$html->diqutitlehhtml(ROOT.$url,$zid);
	$html->diquleibiehtml(ROOT.$url);
	}
	
	$js->alert("修改成功");
	$js->Goto("news_gl.php?zid=$zid&tid=$tid&gid=$gid&yuyan=$yuyan&PB_page=$PB_page&sou=$sou");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script type="text/javascript" src="../../include/ckeditor/ckeditor.js"></script>
<script src="../../include/ckeditor/sample.js" type="text/javascript"></script>
<link href="../../include/ckeditor/sample.css" rel="stylesheet" type="text/css" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.menuNo { color:#000; cursor:pointer; line-height:28px;}
.menuOn { background:url(../images/left_nei.jpg) repeat-x; color:#ff0000; cursor:pointer; line-height:28px;}
.list_none {display:none}
.list {margin:0px;padding:5px;height:auto}
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
  function lwqyanse(ids) {
  		document.getElementById(ids).className="input_hongse";
  }
  function lwq_yanseno(ids){
  		document.getElementById(ids).className="input_none";
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
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[栏目管理]<?=$row_zilei?></td>
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
            <td align="center"><table width="95%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">修改<?=$row_zilei?></span></td>
                </tr>
				
			<?php if(strstr($row_yi->xiangmu,"s_1")){?>    
                <tr>
                  <td width="137" height="25" align="right" bgcolor="#FFFFFF"><span class="table_title">标题：</span></td>
                  <td width="877" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="title" type="text" id="title" value="<?=$pro->title?>" class="input_none" onclick="lwqyanse('title');" onblur="lwq_yanseno('title');"/>
                  </td>
                </tr>
				<?php }?>
			 <?php if(strstr($row_yi->xiangmu,"s_2")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">操作：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <input name="zhanshi" type="checkbox" id="checkbox18" value="1" <?=$pro->zhanshi?"checked":"";?>/>首页展示<input name="tuijian" type="checkbox" id="checkbox16" value="1" <?=$pro->tuijian?"checked":"";?>/>推荐 <input name="zhiding" type="checkbox" id="checkbox17" value="1" <?=$pro->zhiding?"checked":"";?>/>置顶 <input name="redian" type="checkbox" id="checkbox19" value="1" <?=$pro->redian?"checked":"";?>/>热点</td>
                </tr>
                <?php }?>
                
               <?php if(strstr($row_yi->xiangmu,"s_3")){?>  
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">作者：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="name" type="text" id="name" value="<?=$pro->name?>" class="input_none" onclick="lwqyanse('name');" onblur="lwq_yanseno('name');"/>
                  </td>
                </tr>
				<?php }?>
				
				
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">类别：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><select name="zileiid" id="zileiid">
		<?php
		$zlid=$pro->ziid;
		$sqlz_id=mysql_query("select * from news_zilei where id='$zid'");
		$rsz_id=mysql_fetch_array($sqlz_id);
		?>
          <option value="<?=$rsz_id["id"]?>"><?=$rsz_id["zititle"]?></option>
        </select>
					<span class="STYLE7">*</span></td>
                </tr>
                
                <?php if(strstr($row_yi->xiangmu,"s_4")){?> 
			    <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">网站标题：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="author" type="text" id="author" value="<?=$pro->author?>" class="input_none" onclick="lwqyanse('author');" onblur="lwq_yanseno('author');"/>
                  </td>
                </tr>
				<?php }?>
                
                <?php if(strstr($row_yi->xiangmu,"s_5")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">来源：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="zhicheng" type="text" id="zhicheng" value="<?=$pro->zhicheng?>" class="input_none" onclick="lwqyanse('zhicheng');" onblur="lwq_yanseno('zhicheng');"/>
                  </td>
                </tr>
                <?php }?>
				
 				<?php if(strstr($row_yi->xiangmu,"s_6")){?> 
                 <tr>
                  <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">图片：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><a href="?tupian=dels&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"></a>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="image" type="file" id="image" class="file"/></td>
                        <td align="right" valign="bottom">
						<table width="120" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">
							<?php if($pro->image == ""){?>
                            <img src="../images/zanwu.gif" width="120" height="110"/>
                            <?php }else{?>
                            <img src="<?=$pro->image?>" width="120" height="110" border="0"/>
                            <?php }?>						
                            </td>
                          </tr>
                          <tr>
                            <td align="center">
                            <a href="?tupian1=del&amp;id=<?=$id?>&amp;zid=<?=$zid?>&amp;tid=<?=$tid?>&amp;gid=<?=$tid?>&amp;yuyan=<?=$yuyan?>&amp;PB_page=<?=$PB_page?>&amp;sou=<?=$sou?>"><img src="../images/shancu.jpg" border="0" style="margin:3px 0;"/></a>                            </td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                    </table>                  
                  </td>
                </tr>				
				<?php 
				}
				?>
                
                
				 <?php if(strstr($row_yi->xiangmu,"s_7")){?> 
                <tr>
                  <td height="20" align="right" valign="bottom" bgcolor="#FFFFFF">图片大图：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                  
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="27%" valign="bottom"><input name="image2" type="file" id="image2" class="file"/></td>
                        <td align="right" valign="bottom">
						<table width="120" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                        <?php if($pro->image_rot == ""){?>
						<img src="../images/zanwu.gif" width="120" height="110" border="0"/>
						<?php }else{?>
						<img src="<?=$pro->image_rot?>" width="120" height="110" border="0"/>
						<?php }?>
                            </td>
                          </tr>
                          <tr>
                            <td align="center"><a href="?tupian=dels&id=<?=$id?>&zid=<?=$zid?>&tid=<?=$tid?>&gid=<?=$tid?>&yuyan=<?=$yuyan?>&PB_page=<?=$PB_page?>&sou=<?=$sou?>"><img src="../images/shancu.jpg" border="0" style="margin:3px 0;"/></a></td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                    </table>				  
                  </td>
                </tr>
				<?php }?>
				
				
				
				
				<?php if(strstr($row_yi->xiangmu,"s_8")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">文件路径：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF" style="color:red;"><input name="files_url" type="text" id="files_url" value="<?=$pro->files_url?>" class="input_none" onclick="lwqyanse('files_url');" onblur="lwq_yanseno('files_url');"/> 
                    &nbsp;&nbsp;*&nbsp;如文件超出服务器限制大小请在这里直接填写路径</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">文件：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF" style="color:#FF0000;"><input name="files_a" type="file" id="files_a" class="file"/>
&nbsp; &nbsp;                   *上传文件格式（.rar&nbsp;&nbsp;&nbsp;&nbsp; .txt&nbsp;&nbsp; &nbsp;.doc&nbsp;&nbsp; &nbsp;&nbsp;.pdf ）的类型</td>
                </tr>
				<?php }?>
                
				<?php if(strstr($row_yi->xiangmu,"s_9")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">seo标题：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <input name="seo_title" type="text" id="seo_title" value="<?=$pro->seo_title?>" class="input_none" onclick="lwqyanse('seo_title');" onblur="lwq_yanseno('seo_title');"/>
                  </td>
                </tr>
                <?php }?>
                
                
                <?php if(strstr($row_yi->xiangmu,"s_10")){?> 
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo关键词：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <textarea name="seo_gjci" cols="45" rows="5" id="seo_gjci"><?=$pro->seo_gjci?></textarea>
                  </td>
                </tr>
                <?php }?>
                
                
                <?php if(strstr($row_yi->xiangmu,"s_11")){?> 
                <tr>
                  <td height="20" align="right" bgcolor="#FFFFFF">seo描述：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF">
                    <textarea name="seo_type" id="seo_type" cols="45" rows="5" ><?=$pro->seo_type?></textarea>
                  </td>
                </tr>
				<?php }?>
				
				<?php if(strstr($row_yi->xiangmu,"s_16")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">优酷视频web连接：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><textarea name="shiping" id="shiping" cols="45" rows="5"><?=$pro->shiping?></textarea></td>
                </tr>
				<?php }?>
				
				<?php if(strstr($row_yi->xiangmu,"s_15")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">价格：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="jiage" type="text" id="jiage" size="5" value="<?=$pro->jiage?>"/></td>
                </tr>
				 <?php }?>
                
                <?php if(strstr($row_yi->xiangmu,"s_12")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"><span class="table_title">排序：</span></td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input name="px" type="text" id="px" value="<?=$pro->px?>" size="5"/></td>
                </tr>
                <?php }?>
                
                 <?php if(strstr($row_yi->xiangmu,"s_13")){?> 
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">是否展示特性：</td>
                  <td height="20" align="left" bgcolor="#FFFFFF"><input type="checkbox" name="checkbox" value="checkbox" onclick="document.all.liwqbj1.style.display=(this.checked?'':'none')"/></td>
                </tr>
				<tr>
				  <td colspan="2" align="center" bgcolor="#FFFFFF">
				  
				  <table width="100%" border="0" cellspacing="0" cellpadding="0" id="liwqbj1" style="display:none;">
                    <tr>
                      <td colspan="2" align="left" bgcolor="#FFFFFF">
					  <table height="31" border="0" cellpadding="0" cellspacing="0" style="border:#dcdcdc solid 1px; background:url(../images/left_nei_1.jpg) repeat-x; margin-top:10px; margin-left:5px;">
                          <tr>
                      <td width="100" align="center" class="menuOn" id="mod1" onclick="switchmodTag('mod','list','1');this.blur();">描述</td>
					  <td width="100" align="center" class="menuOn" id="mod2" onclick="switchmodTag('mod','list','2');this.blur();">特点 </td>
					  <td width="100" align="center" class="menuOn" id="mod3" onclick="switchmodTag('mod','list','3');this.blur();">规格</td>
					  <td width="100" align="center" class="menuOn" id="mod4" onclick="switchmodTag('mod','list','4');this.blur();">应用</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr class="list" id="list1">
                      <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type1" id="type1" style="width:100%; height:150px;"><?=$pro->type1?></textarea></td>
                    </tr>
                    <tr class="list_none" id="list2">
                      <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type2" id="type2" style="width:100%; height:150px;"><?=$pro->type2?></textarea></td>
                    </tr>
                    <tr class="list_none" id="list3">
                      <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type3"  id="type3" style="width:100%; height:150px;"><?=$pro->type3?></textarea></td>
                    </tr>
                    <tr class="list_none" id="list4">
                      <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type4" id="content4" style="width:100%; height:150px;visibility:hidden;"><?=stripslashes($pro->type4);?></textarea></td>
                    </tr>
                    <tr class="list_none" id="list5">
                      <td colspan="2" align="center" bgcolor="#FFFFFF"><textarea name="type5" id="content5" style="width:100%; height:150px;visibility:hidden;"><?=stripslashes($pro->type5);?></textarea></td>
                    </tr>
                  </table></td>
			    </tr>
                <?php }?>
                
               <?php if(strstr($row_yi->xiangmu,"s_14")){?> 
				<tr>
                  <td height="20" colspan="2" align="center" bgcolor="#FFFFFF">
				  <textarea class="ckeditor" cols="80" id="editor1" name="content" rows="10"><?=stripslashes($pro->content);?></textarea>
				  </td>
                </tr>
				<?php }?>
                
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="修改"/>                    
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
