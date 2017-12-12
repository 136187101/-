//此方法将用户输入异步提交到服务器
	function ajaxSubmit()
	{
		//获取用户输入
		var username=document.forms[0].username.value;
		//创建XMLHttpRequest对象
		var xmlhttp;
		if (window.XMLHttpRequest) 
		{ 
			xmlhttp=new XMLHttpRequest();// Mozilla, Safari, ...浏览器
					} 
		else if (window.ActiveXObject) 
		{ 
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");// IE浏览器
		}
		//创建请求结果处理程序
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4)
			{
				if(xmlhttp.status==200)//代表服务器端返回的是正确的结果，这样才有可能正确的解析XML。200表示正常返回；404表示找不到网页；500表示服务器内部错误
				{
					var flag=xmlhttp.responseText
					if(flag=="0")
					{
						msg.innerHTML="<span style=color:#009900; font-size:12px>恭喜,此用户没有被注册</span>"
					}
					else if(flag=="1")
					{
						msg.innerHTML="<span style=color:#FF0000; font-size:12px>抱歉,此用户已经被注册</span>"
					}
				}
				else
				{	
					alert("数据提交失败");
				}
			}
		}
		//打开连接，true代表异步，false代表同步
		xmlhttp.open("post","userCheck.asp",true);
		//当方法为post时需要设置http头
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
		//发送数据
		var str="username="+escape(username);
		xmlhttp.send(str);
	}
