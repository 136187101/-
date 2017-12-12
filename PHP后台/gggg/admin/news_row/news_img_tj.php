<?php
require_once("../../include/global.php");
require_once("../session.php");
if($Submit=="上传"){	
		$img = new Image("image","newspic");
		if($img->upload()){
			$image = $img->getImgPath();
		}		
	$query = "insert into news(img_id,image,times)values('$id','$image','".time()."')";
	$db->setQuery($query);
		if($db->query()){
			$js->Alert("添加成功");
			$js->Goto("news_img_gl.php?id=$id");
		}
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
<title>网站后台管理系统</title>
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
                        <td width="95%"><span class="STYLE3">你当前的位置</span>：[图片添加]<?=$row_zilei?></td>
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
                  <td width="100" height="25" align="right" bgcolor="#FFFFFF">图片：</td>
                  <td width="597" height="20" align="left" bgcolor="#FFFFFF">
                  <input name="image" type="file" id="image" class="file"/></td>
                </tr>
                
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input name="Submit" type="submit"  class="anniu" id="Submit" value="上传"/>                    
                    &nbsp;&nbsp;
                    <input name="Submit2" type="button" class="anniu" id="Submit2" value="返回" onclick="location.href='news_img_gl.php?id=<?=$id?>&PB_page=<?=$PB_page?>'";/></td>
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