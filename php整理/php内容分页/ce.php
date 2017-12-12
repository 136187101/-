<?php

//[page_end] 分页符号

       function Pagination($total, $per, $page)
     {
               /*
               函数名称：Pagination($total, $per, $page)
               功能：分页，并且提供相邻页的链接
               最后修订：tony(qidongfei@163.com) 2007-3-21

               定义 $total : 记录总数
               $per： 每页的记录数
               $page ：当前页码
               */
             if($page=="" || $page<1) $page=1;
             $apage=$total/$per;//计算页数（包含小数点的）
             $allpage=ceil($apage);//取整返回
             $next=$page+1;         //下一页
             $pre=$page-1;           //上一页
             $startcount0=$page-3;   //前面3页输出起始序号
             $endcount0=$page-1;     //前面3页输出终止序号
             $startcount=$page+1;   //后面3页输出起始序号
             $endcount=$page+3;     //后面3页输出终止序号
             if($startcount0<1) $startcount0=1; //为了避免输出的时候产生负数，设置如果小于1就从序号1开始
             if($allpage<$endcount) $endcount=$allpage;   //页码+3的可能性就会产生最终输出序号大于总页码，那么就要将其控制在页码数之内

             $url=basename($_SERVER['PHP_SELF']);   //取得当前的文件名

             $query_array=explode("&",$_SERVER['argv'][0]);   //取得传递的参数，并且拆分到数组打散

             foreach ($query_array as $key => $value)     if (strstr($value,"page="))   unset($query_array[$key]);   //处理一下，将page=xxx的参数干掉

             $query_string=implode("&amp;",$query_array);


             if($page==1 && $allpage==1)
             { 
$menu.= "";  

return $menu;

             }
             else
             {


                         if($page==1)
                         {
                           /*如果为第一页，直接从第二页链接开始输出*/
                               $menu.= "<B>[$page]</B>&nbsp;";
                               for ($page=2;$page<=$endcount;$page++)   $menu.= "<a href=\"{$url}?{$query_string}&amp;page={$page}\" class=link02><B>[$page]</B></a>   ";
                               $menu.= "&nbsp;<a href=\"{$url}?{$query_string}&amp;page=".$next."\" class=link02><B>下一页</B></a>&nbsp;&nbsp;<a href=\"{$url}?{$query_string}&amp;page=".$allpage."\" class=link02><B>末页</B></a>";  
return $menu;
                         }
                         elseif($page==$allpage)
                         {

                               $menu.="   <a href=\"{$url}?{$query_string}&amp;page=1\" class=link02><B>首页</B></a>
                                       <a href=\"{$url}?{$query_string}&amp;page=".$pre."\" class=link02><B>上一页</B></a>&nbsp;&nbsp;";
                               for ($page=$startcount0;$page<=$endcount0;$page++)   $menu.="<a href=\"{$url}?{$query_string}&amp;page={$page}\" class=link02><U><B>[$page]</B></U></a>   "; //后面3页
                               $menu.="<B>[$allpage]</B>";  
return $menu;

                         }
                         else
                         {
                                     $menu.="   <a href=\"{$url}?{$query_string}&amp;page=1\" class=link02><B>首页</B></a>&nbsp;&nbsp;<a href=\"{$url}?{$query_string}&amp;page=".$pre."\" class=link02><B>上一页</B></a>&nbsp;&nbsp;"; 

                                   for ($page=$startcount0;$page<=$endcount0;$page++)  
   $menu.="<a href=\"{$url}?{$query_string}&amp;page={$page}\" class=link02><B>[$page]</B></a>&nbsp;";     //前面3页输出
                                   $menu.="<B>[$page]</B>&nbsp;";
                                   for ($page=$startcount;$page<=$endcount;$page++)  
   $menu.="<a href=\"{$url}?{$query_string}&amp;page={$page}\" class=link02><U><B>[$page]</B></U></a>&nbsp;"; //后面3页

                                   $menu.="&nbsp;<a href=\"{$url}?{$query_string}&amp;page=".$next."\" class=link02><B>下一页</B></a>&nbsp;&nbsp;<a href=\"{$url}?{$query_string}&amp;page=".$allpage."\" class=link02><B>末页</B></a>
                                       ";  
return $menu;

                         }
             }


     }


   function arPagination($content,$page)
   {
     /*
     函数名称： arPagination($content,$page)
     功能：文章分页
     最后修订：tony(qidongfei@163.com) 2007-03-21
     定义 $content : 文章的内容
     $page ：当前页码
     说明：分页标签[page_end]
     */
     if($page=="" || $page==0) $page=1;
     $pagenum=$page-1;
     $contentarr = explode ("[page_end]", $content);     //按照[arpage]对文章内容进行分割
     $arrnum=count($contentarr);                       //返回数组的总数
     $aaa=Pagination($arrnum, "1", $page) ; 
//$menu.="<span style=\"float:right\">$aaa</span><br/><br/><br/>";               //输出分页
     $menu.="$contentarr[$pagenum]";                       //输出当前页
$menu.="<br/><br/><center>$aaa</center>";               //输出分页

return $menu;

   }

	$content="1111111111111111111111111111111111111111111111111111111111111111111111111111[page_end]222222222222222222222222222222222222222222222222222222222222222222222[page_end]33333333333333333333333333333333333333333333333333333333333333333333333333[page_end]444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444[page_end]555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555555";
  echo $content = arPagination($content,$_GET['page']);     //显示   
  	 $content;

?>
