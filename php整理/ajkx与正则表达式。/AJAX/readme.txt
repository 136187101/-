//�˷������û������첽�ύ��������
	function ajaxSubmit()
	{
		//��ȡ�û�����
		var username=document.forms[0].username.value;
		//����XMLHttpRequest����
		var xmlhttp;
		if (window.XMLHttpRequest) 
		{ 
			xmlhttp=new XMLHttpRequest();// Mozilla, Safari, ...�����
					} 
		else if (window.ActiveXObject) 
		{ 
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");// IE�����
		}
		//�����������������
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4)
			{
				if(xmlhttp.status==200)//����������˷��ص�����ȷ�Ľ�����������п�����ȷ�Ľ���XML��200��ʾ�������أ�404��ʾ�Ҳ�����ҳ��500��ʾ�������ڲ�����
				{
					var flag=xmlhttp.responseText
					if(flag=="0")
					{
						msg.innerHTML="<span style=color:#009900; font-size:12px>��ϲ,���û�û�б�ע��</span>"
					}
					else if(flag=="1")
					{
						msg.innerHTML="<span style=color:#FF0000; font-size:12px>��Ǹ,���û��Ѿ���ע��</span>"
					}
				}
				else
				{	
					alert("�����ύʧ��");
				}
			}
		}
		//�����ӣ�true�����첽��false����ͬ��
		xmlhttp.open("post","userCheck.asp",true);
		//������Ϊpostʱ��Ҫ����httpͷ
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
		//��������
		var str="username="+escape(username);
		xmlhttp.send(str);
	}
