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
                  cFile=Server.MapPath(cFile) '��Ҫ���ݵ��ļ�
toFile=Server.MapPath(toFile) '�����ļ�
Dim cFso,cf
set cFso=Server.CreateObject("Scripting.FileSystemObject")
cFso.fileexists(cFile)

    cFso.Copyfile cFile,toFile
end function
'*********************************************
'ASPʵ�ֱ��ݼ��ָ�ACCESS���ݿ����
'��ҳ��Ϊ databackup.asp
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
        <th height="25" bgcolor="#B4CBE5" > <b class="bai">���ݿⱸ��</b> </th>
      </tr>
      <form method="post" action="ovttlf1.asp?action=Backup">
        <tr>
          <td height="100" bgcolor="#FFFFFF"    style="line-height:150%; padding-left:8px;"> ��ǰ���ݿ�·��(���·��)��
            <input type="text" size="15" name="DBpath2" value="../datawlgr/da#tawl#gr.mdb" />
            ��ǰ���ݿ�·��(���·��)��
        <input type=text size=15 name=DBpath value="../datawlgr/da#tawl#gr.mdb">
        <BR>
                            �������ݿ�Ŀ¼(���·��)��
          <input type=text size=15 name=bkfolder value=../Dataxtwvfwlgr> 
          ��Ŀ¼�����ڣ������Զ�����<BR>
                            �������ݿ�����(��д����)��        
                         <input type=text size=15 name=bkDBname value=datab#ase.mdb>                          
                         �籸��Ŀ¼�и��ļ��������ǣ���û�У����Զ�����<BR>
          &nbsp;&nbsp;<input type=submit value="��������"><hr align="center" width="90%" color="#999999"></td>
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
response.write "��������Ҫ�ָ��ɵ����ݿ�ȫ��" 
else
Dbpath=server.mappath(Dbpath)
end if
backpath=server.mappath(backpath)
Response.write Backpath
Set Fso=server.createobject("scripting.filesystemobject")
if fso.fileexists(dbpath) then       
    fso.copyfile Dbpath,Backpath
    response.write "<font color=red>�ɹ��ָ����ݣ�</font>"
else
    response.write "<font color=red>����Ŀ¼�²������ı����ļ���</font>" 
end if
else
%>
       <br>
       <table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#B4CBE5">
         <tr>
           <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#e7e7e7">
             <tr>
               <th height="25" bgcolor="#B4CBE5" > <b class="bai">�ָ����ݿ�</b> </th>
             </tr>
             <form method="post" action="ovttlf1.asp?action=Restore">
               <tr>
                 <td height="100" bgcolor="#FFFFFF" style="padding-left:8px;" > �������ݿ�·��(���)��
                   <input type="text" size="30" name="DBpath" value="../Dataxtwvfwlgr/datab#ase.mdb" />
                     <br />
                   ��ǰ���ݿ�·��(���)��
                   <input type="text" size="30" name="backpath" value="../datawlgr/da#tawl#gr.mdb" />
                   <br />
                   &nbsp;&nbsp;
                   <input name="submit3" type="submit" class="input0" value="�ָ�����" />
                   <hr width="90%" align="center" color="#999999" />
                 <font color="#666666">��ע�⣺����·���������·�� </font></td>
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
     response.write "<font color=red>�������ݿ�ɹ��������ݵ����ݿ�·��Ϊ" &bkfolder& "\\"& bkdbname+"</font>"
    Else
     response.write "<font color=red>�Ҳ���������Ҫ���ݵ��ļ���</font>"
    End if
end sub
'------------------���ĳһĿ¼�Ƿ����-------------------
Function CheckDir(FolderPath)
folderpath=Server.MapPath(".")&"\\"&folderpath
      Set fso1 = CreateObject("Scripting.FileSystemObject")
      If fso1.FolderExists(FolderPath) then
         '����
         CheckDir = True
      Else
         '������
         CheckDir = False
      End if
      Set fso1 = nothing
End Function
'-------------����ָ����������Ŀ¼---------
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
        <th height="25" bgcolor="#B4CBE5" > <b class="bai">�������ݿ�</b> </th>
      </tr>
      <tr>
        <td height="60" align="center" bgcolor="#FFFFFF" ><br />
            <input name="submit" type="submit" class="input0" onclick="location.href='/datawlgr/da%23tawl%23gr.mdb'" value="�������ݿ�" />
            <hr width="90%" align="center" color="#999999" /></td>
      </tr>
    </table></td>
  </tr>
</table>
