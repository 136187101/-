<%
  Response.Buffer = True
  Server.ScriptTimeOut=9999999
  On Error Resume Next
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<meta http-equiv="Content-Language" content="zh-cn" />
<meta content="all" name="robots" /> 
<meta name="author" content="木目,Woodeye" />
<meta name="description" content="木目ASP文件上传工具" /> 
<meta name="keywords" content="木目,ASP,Upload,文件上传" />
<style type="text/css">
<!--
body,input {font-size:12px;}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {color: #FF0000}
-->
</style>
<title>木目ASP文件上传工具</title>
</head>
<body id="body">
<%
dim contentlen  
contentlen=request.totalbytes  

if contentlen>200000 then
 response.write "文件太大，超过200k，不允许上传。<a href=""" & Request.ServerVariables("URL") &""">请返回</a><br />"  
else  
  ExtName = "jpg,gif,png,txt,rar,zip,doc"    '允许扩展名
  SavePath = "upload"          '保存路径
  If Right(SavePath,1)<>"/" Then SavePath=SavePath&"/" '在目录后加(/)
  CheckAndCreateFolder(SavePath)

  UpLoadAll_a = Request.TotalBytes '取得客户端全部内容
  If(UpLoadAll_a>0) Then
    Set UploadStream_c = Server.CreateObject("ADODB.Stream")
    UploadStream_c.Type = 1
    UploadStream_c.Open
    UploadStream_c.Write Request.BinaryRead(UpLoadAll_a) 
    UploadStream_c.Position = 0

    FormDataAll_d = UploadStream_c.Read
    CrLf_e = chrB(13)&chrB(10)
    FormStart_f = InStrB(FormDataAll_d,CrLf_e)
    FormEnd_g = InStrB(FormStart_f+1,FormDataAll_d,CrLf_e)

    Set FormStream_h = Server.Createobject("ADODB.Stream")
    FormStream_h.Type = 1
    FormStream_h.Open
    UploadStream_c.Position = FormStart_f + 1
    UploadStream_c.CopyTo FormStream_h,FormEnd_g-FormStart_f-3
    FormStream_h.Position = 0
    FormStream_h.Type = 2
    FormStream_h.CharSet = "GB2312"
    FormStreamText_i = FormStream_h.Readtext
    FormStream_h.Close

    FileName_j = Mid(FormStreamText_i,InstrRev(FormStreamText_i,"\")+1,FormEnd_g)

    If(CheckFileExt(FileName_j,ExtName)) Then
      SaveFile = Server.MapPath(SavePath & FileName_j)

      If Err Then
        Response.Write "文件上传： <span style=""color:red;"">文件上传出错!</span>　<a href=""" & Request.ServerVariables("URL") &""">重新上传文件</a><br />"
        Err.Clear
      Else
        SaveFile = CheckFileExists(SaveFile)

        k=Instrb(FormDataAll_d,CrLf_e&CrLf_e)+4
        l=Instrb(k+1,FormDataAll_d,leftB(FormDataAll_d,FormStart_f-1))-k-2
        FormStream_h.Type=1
        FormStream_h.Open
        UploadStream_c.Position=k-1
        UploadStream_c.CopyTo FormStream_h,l
        FormStream_h.SaveToFile SaveFile,2
        
        SaveFileName1 = Mid(SaveFile,InstrRev(SaveFile,"\")+1)
        Response.write "文件上传： <span style=""color:red;"">" & SaveFileName1 & " </span>文件上传成功!　"
		session("SaveFileName1")=SaveFileName1
		'用法   ltu=session(SaveFileName1)
      End If
    Else
      Response.write "文件上传： <span style=""color:red;"">文件格式不正确!</span>　<a href=""" & Request.ServerVariables("URL") &""">重新上传文件</a><br />"
    End If

  Else
%>
<script language="Javascript">
<!--
function ValidInput()
{
    
if(document.upform.upfile.value=="") 
  {
    alert("请选择上传文件！")
    document.upform.upfile.focus()
    return false
  }
  return true
}
// -->
</script>
<form action='<%= Request.ServerVariables("URL") %>' method='post' name="upform" onsubmit="return ValidInput()"  enctype="multipart/form-data">
  <input type='file' name='upfile' size="40"> <input type='submit' value="上传">
  &nbsp;&nbsp; <span class="STYLE1">小于200KB
  </span>
</form>
<%
  End if
  Set FormStream_h = Nothing
  UploadStream.Close
  Set UploadStream = Nothing
%>
</body>
</html>
<%
  '判断文件类型是否合格
  Function CheckFileExt(FileName,ExtName) '文件名,允许上传文件类型
    FileType = ExtName 
    FileType = Split(FileType,",")
    For i = 0 To Ubound(FileType)
      If LCase(Right(FileName,3)) = LCase(FileType(i)) then
      CheckFileExt = True
      Exit Function
      Else
      CheckFileExt = False
      End if
    Next
  End Function

  '检查上传文件夹是否存在，不存在则创建文件夹
  Function CheckAndCreateFolder(FolderName)
    fldr = Server.Mappath(FolderName)
    Set fso = CreateObject("Scripting.FileSystemObject")
    If Not fso.FolderExists(fldr) Then
      fso.CreateFolder(fldr)
    End If
    Set fso = Nothing
  End Function

'检查文件是否存在，重命名存在文件
Function CheckFileExists(FileName)
  Set fso=Server.CreateObject("Scripting.FileSystemObject")
  If fso.FileExists(SaveFile) Then
    i=1
    msg=True
    Do While msg
      CheckFileExists = Replace(SaveFile,Right(SaveFile,4),"_" & i & Right(SaveFile,4))
      If not fso.FileExists(CheckFileExists) Then
        msg=False
      End If
      i=i+1
    Loop
  Else
    CheckFileExists = FileName
  End If
  Set fso=Nothing
End Function
end if
%>