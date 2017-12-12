<?php
require_once("../../include/global.php");
require_once("../session.php");
if($act == "shen"){
	$db->setQuery("update `leave` set state=1 where id=$pid");
	$db->query();
	$js->alert("审核成功");
	$js->Goto("gl_leve.php");
}elseif($act == "ping"){
	$db->setQuery("update `leave` set state=0 where id=$pid");
	$db->query();
	$js->alert("屏蔽成功");
	$js->Goto("gl_leve.php");
}elseif($act == "del"){
	$db->setQuery("delete from `leave` where id in($tid)");
	$db->query();
	$js->alert("删除成功");
	$js->Goto("gl_leve.php");
}
if($Submit3 == "搜索"){
$sql = "select * from `leave` where name like '%".$sou."%' order by px desc,leaveTime desc,state desc";
}else{
$sql = "select * from `leave` order by px desc,leaveTime desc,state desc";
}
$pagepre = 5;
$db->setQuery($sql);
$zong = $db->num_rows();
	  if($zong == ""){
	  $kong = "<div style='padding-top:5px;'>当前还没有任何记录&nbsp;&nbsp;<input name='Submit2' type='button' id='Submit2' value='返回' onclick='javascript:history.go(-1)'; class='anniu'/></div>";
	  $zong = 1 ;
	  }
	$liwqbjpage=new liwqpage(array('total'=>$zong,'perpage'=>$pagepre));
	$db->setQuery($sql,$liwqbjpage->offset(),$pagepre);
	if($_GET["PB_page"] == ""){
	$_GET["PB_page"]= 1;
	}
$result= $db->loadObjectList();
$resu= $db->loadObject();
if($Submitmoshi == "确定"){
	if($moshi == 1){
	$sql = "update `leave` set moshi = 1";
	$db->setquery($sql);
	$db->query();
	$js->alert("审核模式以提交");
	$js->goto("?");
	}elseif($moshi == "0"){
	$sql = "update `leave` set moshi = 0";
	$db->setquery($sql);
	$db->query();
	$js->alert("非审核模式以提交");
	$js->goto("?");
	}
}
if($Submit == "修改"){
$sql = "update `leave` set px='$px' where id = $pxid";
	$db->setquery($sql);
	$db->query();
	$js->alert("修改成功");
	$js->goto("?");
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
<script type="text/javascript" charset="utf-8" src="../js/huanse.js"></script>
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

strurl = "?act=del&PB_page=<?=$_GET["PB_page"];?>&tid=" +strid;//据实际修改一下

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
                        <td width="95%" class="STYLE1"><span class="STYLE3">你当前的位置</span>：【留言板】-【留言管理】</td>
					  </tr>
                  </table></td>
                  <td width="20%" align="right"><input name="sou" type="text" id="sou" style="height:13px; color:#999999" value="名称搜索" /></td>
                  <td width="5%" align="right"><input name="submit" type="image" src="../images/tab_21.gif"/></td>
				  <input type="hidden" name="Submit3" value="搜索" />
                  <td width="29%"><table border="0" align="right" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="60">&nbsp;</td>
                        <td><table border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="60"><table width="87%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/quit.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a class="bai" style="color:#000000" onclick="sltAll();" onmouseover="this.style.cursor='hand'">全选</a></td>
                                  </tr>
                              </table></td>
                              <td width="60"><table width="90%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/33.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a onclick="sltNull();" style="color:#000000" onmouseover="this.style.cursor='hand'">取消</a></td>
                                  </tr>
                              </table></td>
                              <td width="50"><table width="88%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td class="STYLE1"><img src="../images/11.gif" width="14" height="14" /></td>
                                    <td class="STYLE1"><a onclick="SelectChk();" style="color:#000000" onmouseover="this.style.cursor='hand'">删除</a></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
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
            <td align="center">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()">
                <tr>
                  <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">&nbsp;</td>
                  <td width="3%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="STYLE1">序号</span></td>
                  <td width="11%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">咨询者姓名</span></td>
                  <td width="26%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">咨询标题</span></td>
                  <td width="8%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">咨询内容</td>
                  <td width="7%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">回复内容</td>
                  <td width="7%" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">咨询详细</span></td>
                  <td width="10%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF"><span class="bai">咨询</span>时间</td>
                  <td width="4%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF">排序</td>
                  <td width="21%" height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">基本操作</td>
                </tr>
                <?php 
		  $i=1;
		  foreach($result as $rs){
		  ?>
                <tr>
                  <td height="20" align="center" bgcolor="#FFFFFF"><input name="del" type="checkbox" id="del" value="<?=$rs->id?>" />                  </td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$i?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$rs->name?></td>
                  <td align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
                  <?=$rs->leaveTitle?></td>
                  <td align="center" bgcolor="#FFFFFF"><a href="?act=zi&id=<?=$rs->id?>">查看</a></td>
                  <td align="center" bgcolor="#FFFFFF"><a href="?act=hui&id=<?=$rs->id?>">查看</a></td>
                  <td align="center" bgcolor="#FFFFFF"><a href="?act=cha&id=<?=$rs->id?>">查看详细</a></td>
                  <td align="center" bgcolor="#FFFFFF"><?php echo date("Y-m-d h:i:s",$rs->leaveTime)?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><?=$rs->px?></td>
                  <td height="20" align="center" bgcolor="#FFFFFF"><a href="gl_leve.php?act=pai&amp;pxid=<?=$rs->id?>">排序修改</a>|
                    <?php 
	  			if($rs->moshi == 1){
	  				if($rs->state){?>
                    <a href="gl_leve.php?act=ping&amp;pid=<?=$rs->id?>">屏蔽</a>|
                    <?php }else{?>
                    <a href="gl_leve.php?act=shen&amp;pid=<?=$rs->id?>">审核</a>|
                <?php } }?>
                    <a href="replay.php?hid=<?php echo $rs->id?>">回复</a>|&nbsp;&nbsp;
<a href="gl_leve.php?act=del&amp;tid=<?=$rs->id?>" onclick="return ConfirmDelBig();"><img src="../images/del.gif" width="16" height="16" border="0" />删除</a></td>
                </tr>
                <?php 
		   $i++;
		   }?>
              </table>
			  <?=$kong?>
<?php if($act == "zi"){
  $query = "select * from `leave` where id = $id";
  $db->setQuery($query);
  $rst = $db->loadObject();
  ?>
                <table width="70%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()" style="margin-top:30px;">
                  <tr>
                    <td height="22" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">
                      <?=$rst->name?>咨询内容</td>
                  </tr>
                  <tr>
                    <td height="20" align="center" bgcolor="#FFFFFF"><textarea name="content" style="width:100%;height:100px;"><?=$rst->leaveContent?></textarea>
</td>
                  </tr>
              </table>
  <?php }?>  				
				
				
				
				
	<?php
if($act == "delt"){
	$sql = "delete from replay where id =$ids";
	$db->setQuery($sql);
	$db->query();
	$js->goto("?act=hui&id=$id");
	}
if($act == "hui"){
	$query = "select a.*,b.name from replay a left join `leave` b on a.leaveId=b.id where a.leaveId=$id";
	$db->setQuery($query);
	$tt = $db->loadObject();
	$rs = $db->loadObjectList();
?>			
				
				<table width="70%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()" style="margin-top:30px;">
                  <tr>
                    <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="STYLE1">回复
                        <?=$tt->name?>
的内容</td>
                  </tr>
		<?php 
		$i=1;
		foreach($rs as $rt){?>
				  <tr>
                    <td width="78%" height="20" align="left" bgcolor="#FFFFFF">
	<script type="text/javascript">
    KE.show({
        id : 'content<?=$i?>',
        cssPath : '/admin/editubb/index.css',
        items : [
        'undo', 'redo', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
        'removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
        'insertunorderedlist']
    });
  </script>
					<textarea id="content<?=$i?>" name="content" style="width:100%;height:100px;visibility:hidden;"><?=$rt->replayContent?></textarea></textarea></td>
                    <td width="22%" align="left" valign="bottom" bgcolor="#FFFFFF"><a href="gl_leve.php?act=delt&amp;ids=<?=$rt->id?>&amp;id=<?=$id?>">删除</a>&nbsp;&nbsp;&nbsp;&nbsp; 回复时间:
                    <?=date("y-m-d",$rt->replayTime)?></td>
				  </tr>
				  <tr>
				    <td height="20" colspan="2" align="right" bgcolor="#FFFFFF">&nbsp;</td>
			      </tr>
				  <?php 
				  $i++;
				  }?>
              </table>
				
				
				
	<?php } if($act == "cha"){
$query = "select * from `leave` where id=$id";
$db->setquery($query);
$liwq_query = $db->loadobject();
?>			
				<table width="70%" border="0" cellpadding="0" cellspacing="1" bgcolor="b5d6e6" onmouseover="changeto()"  onmouseout="changeback()" style="margin-top:30px;">
                  <tr>
                    <td height="22" colspan="2" align="center" background="../images/bg.gif" bgcolor="#FFFFFF" class="liwq_color STYLE1">咨询者姓名
                        <?=$liwq_query->name?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="gl_leve.php">返回</a></td>
                  </tr>
                  <tr>
                    <td width="14%" height="25" align="center" bgcolor="#FFFFFF">咨询标题：</td>
                    <td width="86%" align="left" bgcolor="#FFFFFF"><?=$liwq_query->leaveTitle?></td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFFF">电话：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=$liwq_query->tel?></td>
                  </tr>
                  <tr style="display:none;">
                    <td height="25" align="center" bgcolor="#FFFFFF">QQ：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=$liwq_query->QQ?></td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFFF">Email：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=$liwq_query->email?></td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFFF">公司：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=$liwq_query->Company?></td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFFF">主题：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=$liwq_query->Subject?></td>
                  </tr>
                  <tr style="display:none;">
                    <td height="25" align="center" bgcolor="#FFFFFF">咨询IP：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=$liwq_query->ip?></td>
                  </tr>
                  <tr>
                    <td height="25" align="center" bgcolor="#FFFFFF">咨询时间：</td>
                    <td align="left" bgcolor="#FFFFFF"><?=@date("Y-m-d h:i:s",$liwq_query->leaveTime)?></td>
                  </tr>
              </table>
			<?php }?>	
				
			</td>
            <td width="8" background="../images/tab_15.gif">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="35" background="../images/tab_19.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12" height="35"><img src="../images/tab_18.gif" width="12" height="35" /></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="29%" class="STYLE4">&nbsp;&nbsp;共有
                    <?=$zong?>
                    条记录，当前第
                    <?=$_GET["PB_page"];?>
                    /
                    <?=$liwqbjpage->totalpage?>
                    页，当前
                    <?=$pagepre?>
                    条</td>
                  <td width="25%" align="left" class="STYLE4">
					<?php if($act == "pai"){
					if($Submitpx == "修改"){
						$db->setQuery("update `leave` set px='$px' where id=$pxid");
						$db->query();
						$js->Goto("gl_leve.php");
					
					}
					$query = "select * from `leave` where id=$pxid";
					$db->setquery($query);
					$levepx = $db->loadobject();
					?>
                    排序修改：
                    <input name="px" type="text" id="px" size="5" value="<?=$levepx->px?>"/> 
                    <input type="submit" name="Submitpx" value="修改" /> 
                    <input type="button" name="Submit2" value="取消" onclick="javascript:window.location='?'"/> <?php }?></td>
                  <td align="left" class="STYLE4"><span>模式选择
 					  <select name="moshi" id="moshi">
                        <option value="1" <?php $resu->moshi?"selected='selected'":"";?>>审核模式</option>
                        <option value="0" <?php !$resu->moshi?"selected='selected'":"";?>>非审核模式</option>
                      </select>
                      &nbsp;
                      <input name="Submitmoshi" type="submit" id="Submitmoshi" value="确定" class="anniu"/>
                  </span></td>
                  <td width="23%" align="right" valign="middle"><?=$liwqbjpage->show(3)?></td>
                </tr>
            </table></td>
            <td width="16"><img src="../images/tab_20.gif" width="16" height="35" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>

</body>
</html>

