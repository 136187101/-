<?php
require_once("../../include/global.php");
require_once("../session.php");
$sql = "select * from `weijingtai` where id = 1";
$db->setQuery($sql);
$wei = $db->loadobject();
if($Submit == "保存"){
	$sql = "update weijingtai set shou='$shou',gongsi='$gongsi',kaihu='$kaihu',fuwu='$fuwu',zounian='$zounian',shuiwu='$shuiwu',renzhen='$renzhen',zhuanli='$zhuanli',liuxue='$liuxue',qita='$qita',xinwen='$xinwen',huoban='$huoban',dantiao='$dantiao',lian='$lian',shangbiao='$shangbiao',zhenzhi='$zhenzhi'  where id = 1";
	$db->setquery($sql);
	$db->query();
	$js->alert("保存成功,页面已生成");
	$js->goto("weijintai_gl.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" charset="utf-8" src="../editubb/kindeditor.js"></script>
  <script type="text/javascript">
    KE.show({
        id : 'content2',
        cssPath : '/admin/editubb/index.css',
        items : [
        'undo', 'redo', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
        'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
        'insertunorderedlist']
    });
  </script>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
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
                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：[静态页面管理]-[伪静态生成管理]</td>
                      </tr>
                  </table>
                  </td>
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
            <td align="center"><table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6">
                <tr>
                  <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">伪静态生成管理</td>
                </tr>
                <tr>
                  <td width="11%" height="25" align="right" bgcolor="#FFFFFF">首页生成：</td>
                  <td width="89%" align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="shou" id="radio" value="1" <?php if($wei->shou){ echo "checked";}?> />
是
<input name="shou" type="radio" id="radio2" value="0" <?php if(!$wei->shou){ echo "checked";}?> />
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"> <a href="register_news.php?fid=1&amp;zid=2">注册公司</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="gongsi" id="gongsi" value="1" <?php if($wei->gongsi){ echo "checked";}?>/>
是
<input name="gongsi" type="radio" id="gongsi" value="0" <?php if(!$wei->gongsi){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"><a href="kj_news.php?zid=3" onfocus="undefined">银行开户</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="kaihu" id="radio5" value="1" <?php if($wei->kaihu){ echo "checked";}?> />
是
<input name="kaihu" type="radio" id="radio6" value="0" <?php if(!$wei->kaihu){ echo "checked";}?> />
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"> <a href="kj_news.php?zid=4">秘书服务</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="fuwu" id="fuwu" value="1" <?php if($wei->fuwu){ echo "checked";}?>/>
是
<input name="fuwu" type="radio" id="fuwu" value="0" <?php if(!$wei->fuwu){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"><a href="kj_news.php?zid=5">周年申报</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="zounian" id="zounian" value="1" <?php if($wei->zounian){ echo "checked";}?>/>
是
<input name="zounian" type="radio" id="zounian" value="0" <?php if(!$wei->zounian){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">  <a href="kj_news.php?zid=6">审计税务</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="shuiwu" id="zounian2" value="1" <?php if($wei->shuiwu){ echo "checked";}?>/>
是
<input name="shuiwu" type="radio" id="zounian2" value="0" <?php if(!$wei->shuiwu){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"> <a href="kj_news.php?zid=7">公证认证</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="renzhen" id="zounian3" value="1" <?php if($wei->renzhen){ echo "checked";}?>/>
是
<input name="renzhen" type="radio" id="zounian3" value="0" <?php if(!$wei->renzhen){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"> <a href="kj_news.php?zid=8">商标专利</a> ：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="zhuanli" id="zounian4" value="1" <?php if($wei->zhuanli){ echo "checked";}?>/>
是
<input name="zhuanli" type="radio" id="zounian4" value="0" <?php if(!$wei->zhuanli){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"><a href="kj_news.php?zid=9" onfocus="undefined">移民留学</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="liuxue" id="zounian5" value="1" <?php if($wei->liuxue){ echo "checked";}?>/>
是
<input name="liuxue" type="radio" id="zounian5" value="0" <?php if(!$wei->liuxue){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"> <a href="kj_news.php?zid=10">其它服务</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="qita" id="zounian6" value="1" <?php if($wei->qita){ echo "checked";}?>/>
是
<input name="qita" type="radio" id="zounian6" value="0" <?php if(!$wei->qita){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"><a href="kj_news.php?zid=11">新闻中心</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="xinwen" id="zounian7" value="1" <?php if($wei->xinwen){ echo "checked";}?>/>
是
<input name="xinwen" type="radio" id="zounian7" value="0" <?php if(!$wei->xinwen){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF"><a href="kj_hzhb.php?zid=12">合作伙伴</a>：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="huoban" id="zounian8" value="1" <?php if($wei->huoban){ echo "checked";}?>/>
是
<input name="huoban" type="radio" id="zounian8" value="0" <?php if(!$wei->huoban){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">单条信息：</td>
                  <td align="left" bgcolor="#FFFFFF">
              <input type="radio" name="dantiao" id="dantiao" value="1" <?php if($wei->dantiao){ echo "checked";}?>/>
是
<input name="dantiao" type="radio" id="dantiao" value="0" <?php if(!$wei->dantiao){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">离岸公司：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="lian" id="zounian10" value="1" <?php if($wei->lian){ echo "checked";}?>/>
是
<input name="lian" type="radio" id="zounian10" value="0" <?php if(!$wei->lian){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">注册商标：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    <input type="radio" name="shangbiao" id="zounian11" value="1" <?php if($wei->shangbiao){ echo "checked";}?>/>
是
<input name="shangbiao" type="radio" id="zounian11" value="0" <?php if(!$wei->dantiao){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="25" align="right" bgcolor="#FFFFFF">增值服务：</td>
                  <td align="left" bgcolor="#FFFFFF">
                    
<input type="radio" name="zhenzhi" id="zounian14" value="1" <?php if($wei->dantiao){ echo "checked";}?>/>
是
<input name="zhenzhi" type="radio" id="zounian12" value="0" <?php if(!$wei->dantiao){ echo "checked";}?>/>
否</td>
                </tr>
                <tr>
                  <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><input type="submit" name="Submit" id="Submit" class="anniu" value="保存" />
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
  </form>
</body>
</html>

