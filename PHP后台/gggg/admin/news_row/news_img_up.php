<?php
require_once("../../include/global.php");
require_once("../session.php");
$query = "select * from news where id=$id";
$db->setQuery($query);
$pro = $db->loadObject();
$image = $pro->image;
	if($tupian1 == "del"){
				$query = "update news set image='' where id =$id";
				$db->setQuery($query);
				$db->query();
				$root = ROOT.$pro->image;
				@unlink($root);
				$js->alert("删除成功");
				$js->goto("?img_id=$img_id&id=$id&PB_page=$PB_page");			
	}
if($Submit=="修改"){
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
	$query = "update news set img_id='$img_id',image='$image',times='".time()."' where id = $id";
	$db->setQuery($query);
	$db->query();
	$js->alert("修改成功");
	$js->Goto("news_img_gl.php?id=$img_id&PB_page=$PB_page");
}

		$sql = "select * from news where id = $id";
		$db->setquery($sql);
		$row_yi = $db->loadObject(); 
		$row_zilei = "-[".$row_yi->title."]";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
        id : 'content4',
        cssPath : '../editubb/index.css',
        items : [
        'undo', 'redo','justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'removeformat', 'specialchar', 'emoticons', ]
    });
    KE.show({
        id : 'content5',
        cssPath : '../editubb/index.css',
        items : [
        'undo', 'redo','justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'title', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'link', 'unlink', 'removeformat', 'specialchar', 'emoticons', ]
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
                 <tr>
                  <td width="98" height="20" align="right" valign="bottom" bgcolor="#FFFFFF">图片：</td>
                  <td width="587" height="20" align="left" bgcolor="#FFFFFF">
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
                            <a href="?tupian1=del&img_id=<?=$img_id?>&id=<?=$id?>&PB_page=<?=$PB_page?>"><img src="../images/shancu.jpg" border="0" style="margin:3px 0;"/></a>                            </td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                    </table>                  
                  </td>
                </tr>				
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="修改"/>                    
                    &nbsp;&nbsp;
                    <input name="Submit2" type="button" class="anniu" id="Submit2" value="返回" onclick="location.href='news_img_gl.php?id=<?=$img_id?>&PB_page=<?=$PB_page?>'";/></td>
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
