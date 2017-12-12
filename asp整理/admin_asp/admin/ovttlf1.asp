<!--#include file="anquan.asp"--><head>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="wlgr.css" rel="stylesheet" type="text/css">

       <style type="text/css">
<!--
tr {
	font-size: 12px;
}
-->
       </style>


</head>



<%  
'*****************************************
function CopyTo(ByVal cFile,ByVal toFile)
                  cFile=Server.MapPath(cFile) '所要备份的文件
toFile=Server.MapPath(toFile) '备份文件
Dim cFso,cf
set cFso=Server.CreateObject("Scripting.FileSystemObject")
cFso.fileexists(cFile)

    cFso.Copyfile cFile,toFile
end function
'*********************************************
'ASP实现备份及恢复ACCESS数据库操作
'本页面为 databackup.asp
dim dbpath,bkfolder,bkdbname,fso,fso1
    call main()
      call main2()
    set conn=nothing
sub main()
if request("action")="Backup" then
call backupdata()
else
%>

<br>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
      <tr>
        <th height="25" bgcolor="#B4CBE5" > <b class="bai">数据库备份</b> </th>
      </tr>
      <form method="post" action="ovttlf1.asp?action=Backup">
        <tr>
          <td height="100" bgcolor="#FFFFFF"    style="line-height:150%; padding-left:8px;"> 当前数据库路径(相对路径)：
            <input type="text" size="15" name="DBpath2" value="../datawlgr/da#tawl#gr.mdb" />
            当前数据库路径(相对路径)：
        <input type=text size=15 name=DBpath value="../datawlgr/da#tawl#gr.mdb">
        <BR>
                            备份数据库目录(相对路径)：
          <input type=text size=15 name=bkfolder value=../Dataxtwvfwlgr> 
          如目录不存在，程序将自动创建<BR>
                            备份数据库名称(填写名称)：        
                         <input type=text size=15 name=bkDBname value=datab#ase.mdb>                          
                         如备份目录有该文件，将覆盖，如没有，将自动创建<BR>
          &nbsp;&nbsp;<input type=submit value="备份数据"><hr align="center" width="90%" color="#999999"></td>
        </tr>
      </form>
    </table></td>
  </tr>
</table>
       <%
end if
end sub
sub main2()

if request("action")="Restore" then
Dbpath=request.form("Dbpath")
backpath=request.form("backpath")
if dbpath="" then
response.write "请输入您要恢复成的数据库全名" 
else
Dbpath=server.mappath(Dbpath)
end if
backpath=server.mappath(backpath)
Response.write Backpath
Set Fso=server.createobject("scripting.filesystemobject")
if fso.fileexists(dbpath) then       
    fso.copyfile Dbpath,Backpath
    response.write "<font color=red>成功恢复数据！</font>"
else
    response.write "<font color=red>备份目录下并无您的备份文件！</font>" 
end if
else
%>
       <br>
       <table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
         <tr>
           <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
             <tr>
               <th height="25" bgcolor="#B4CBE5" > <b class="bai">恢复数据库</b> </th>
             </tr>
             <form method="post" action="ovttlf1.asp?action=Restore">
               <tr>
                 <td height="100" bgcolor="#FFFFFF" style="padding-left:8px;" > 备份数据库路径(相对)：
                   <input type="text" size="30" name="DBpath" value="../Dataxtwvfwlgr/datab#ase.mdb" />
                     <br />
                   当前数据库路径(相对)：
                   <input type="text" size="30" name="backpath" value="../datawlgr/da#tawl#gr.mdb" />
                   <br />
                   &nbsp;&nbsp;
                   <input name="submit3" type="submit" class="input0" value="恢复数据" />
                   <hr width="90%" align="center" color="#999999" />
                 <font color="#666666">·注意：所有路径都是相对路径 </font></td>
               </tr>
             </form>
           </table></td>
         </tr>
       </table>
      <%
end if
end sub
sub backupdata()

    Dbpath=request.form("Dbpath")
    Dbpath=server.mappath(Dbpath)
    bkfolder=request.form("bkfolder")
    bkdbname=request.form("bkdbname")
    Set Fso=server.createobject("scripting.filesystemobject")
    if fso.fileexists(dbpath) then
     If CheckDir(bkfolder) = True Then
     fso.copyfile dbpath,bkfolder& "\\"& bkdbname
     else
     MakeNewsDir bkfolder
     fso.copyfile dbpath,bkfolder& "\\"& bkdbname
     end if
     response.write "<font color=red>备份数据库成功，您备份的数据库路径为" &bkfolder& "\\"& bkdbname+"</font>"
    Else
     response.write "<font color=red>找不到您所需要备份的文件。</font>"
    End if
end sub
'------------------检查某一目录是否存在-------------------
Function CheckDir(FolderPath)
folderpath=Server.MapPath(".")&"\\"&folderpath
      Set fso1 = CreateObject("Scripting.FileSystemObject")
      If fso1.FolderExists(FolderPath) then
         '存在
         CheckDir = True
      Else
         '不存在
         CheckDir = False
      End if
      Set fso1 = nothing
End Function
'-------------根据指定名称生成目录---------
Function MakeNewsDir(foldername)
dim f
      Set fso1 = CreateObject("Scripting.FileSystemObject")
          Set f = fso1.CreateFolder(foldername)
          MakeNewsDir = True
      Set fso1 = nothing
End Function
%>
<br>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#e7e7e7">
      <tr>
        <th height="25" bgcolor="#B4CBE5" > <b class="bai">下载数据库</b> </th>
      </tr>
      <tr>
        <td height="60" align="center" bgcolor="#FFFFFF" ><br />
            <input name="submit" type="submit" class="input0" onclick="location.href='/datawlgr/da%23tawl%23gr.mdb'" value="下载数据库" />
            <hr width="90%" align="center" color="#999999" /></td>
      </tr>
    </table></td>
  </tr>
</table>
