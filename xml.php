<?php
		$keyarray = "<?xml version=\"1.0\" encoding=\"gb2312\"?>\n<graph subCaption='单位（元）' xAxisName='天数' yAxisMinValue='0' yAxisName='' decimalPrecision='0'>\n";//头部
		
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		$keyarray = $keyarray."<set name='子标签例子' value='test' hoverText='no'/>\n";
		
		$keyarray = $keyarray."</graph>";//结束
		
		$root = $_SERVER['DOCUMENT_ROOT'];
		$fithname = $root."/";
		$filename = $fithname."xml.xml";
		$fp=fopen($filename,"w");
		fwrite($fp,iconv("UTF-8","gb2312",$keyarray));
		fclose($fp);
?>