           function $(strid){
                return document.getElementById(strid);
            }
            function MessageBox_createDivs(){
                document.write('<div id="MessageBox">');
                document.write('<div id="MessageBoxTop"><table width="100%"><tr><td> ');
                document.write(' <div id="MessageBoxTitle">提示:</div> ');
                document.write(' </td><td align="right"> ');
                document.write(' <div id="MessageBox_CloseButton"><a href=\"#\" onclick=\"MessageBox_hide();\" align=\"right\">×</a></div>');
                document.write(' </td></tr></table></div>');
                document.write('<div id="MessageBoxBody">示例内容,请调用相关方法!');
                document.write(" </div> ");
                document.write(" </div> ");
                document.write(" <div id=\"MessageBoxBackground\"> ");
                document.write(" </div> ");
            }
            function MessageBox_setSize(){
                // for(i=0;i<100;i++){ document.write("<br/>"); }
                var bg=document.getElementById("MessageBoxBackground");
                var scroll_top=document.body.scrollTop;
                var scroll_left=document.body.scrollLeft;
                var scroll_width=document.body.offsetWidth;
                var scroll_height=document.body.offsetHeight;
                bg.style.width=(scroll_width-0-scroll_left)+"px";
                bg.style.height=(scroll_height-0-scroll_top)+"px";
                $("MessageBoxBackground").style.display='none';
                $("MessageBox").style.display='none';
            }
            function MessageBox_init(){
                MessageBox_createDivs();
                MessageBox_setSize();
            }
            function MessageBox_show(){
                var scroll_top=document.body.scrollTop;
                var scroll_left=document.body.scrollLeft;
                var scroll_width=document.body.offsetWidth;
                var scroll_height=document.body.offsetHeight;
                var messageBox_width=document.getElementById('MessageBox').style.width;
                var messageBox_left=(scroll_width-400)/2;
                //alert(scroll_width+","+messageBox_width+"");
                document.getElementById('MessageBoxBackground').style.display='';
                document.getElementById('MessageBox').style.display='';
                $("MessageBox").style.left=messageBox_left+"px";
            }
            function MessageBox_hide(){
                document.getElementById('MessageBoxBackground').style.display='none';
                document.getElementById('MessageBox').style.display='none';
                
            } 
            function MessageBox_setTitle(title){
                $("MessageBoxTitle").innerHTML=title;
            }
            function MessageBox_setBody(body){
                $("MessageBoxBody").innerHTML=body;
            }
            function MessageBox_addChild(strChild){
                var objChild=$(strChild);
                var obj=$("MessageBoxBody");
                obj.innerHTML=objChild.innerHTML;
                //obj.appendChild(objChild);
            }
            function MessageBox_showDialog(title,div_id){
                MessageBox_setTitle(title);
                MessageBox_addChild(div_id);
                MessageBox_show();
            }
            function MessageBox_showDialogText(title,message){
                MessageBox_setTitle(title);
                MessageBox_setBody(message);
                MessageBox_show();
            }
            MessageBox_init(); 