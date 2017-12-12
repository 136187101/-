<?php
class JS
{
    function JS(){}
    
   /**
    *返回上一级
    *@param  step  
    * */
    function Back($step = -1)
    {
        $msg = "history.go(".$step.");";
        $this->_Write($msg);
        exit;
    }

    /**
     * 弹出信息
     * @param $msg 弹出信息的内容
     */
    function Alert($msg)
    {
        $msg = "alert('".$msg."');";
        $this->_Write($msg);
    }
	
	function history_back(){
	 $msg= "history.back();";
	 $this->_Write($msg);
	exit;
	}
    /**
     * дjs
     * @param $msg
     */
    function _Write($msg)
    {
        echo "<script charset='utf-8' language=javascript>";
        echo $msg;
        echo "</script>";
    }
    /**
     *刷新本页面
     */
    function Reload()
    {
        $msg = "location.reload();";
        $this->_Write($msg);
        exit;
    }
    /**
     * 刷新子页面
     */
    function ReloadOpener()
    {
        $msg = "if (opener)    opener.location.reload();";
        $this->_Write($msg);
     }

    /**
     * 跳转
     * @param $url 定向的位置
     */
    function Goto($url)
    {
        $msg = "location.href = '$url';";
        $this->_Write($msg);
        exit;
    }
    /**
     * 框架跳转
     * @param $url 定向的位置
     */
	function Gotolwq($url)
    {
        $msg = "parent.frames('liwqbj1').location.href = '$url';";
        $this->_Write($msg);
        exit;
    }

	function gotoliwqbj($url)
    {
        $msg = "parent.frames('liwqbj2').location.href = '$url';";
        $this->_Write($msg);
        exit;
    }


	/**
	*弹出对话框
	*/
	function Confirm($string)
	{
		$msg = "confirm('".$string."');";
		$this->_Write($msg);
	}
    /**
     *关闭
     */
     function Close()
     {
        $msg = "window.close()";
        $this->_Write($msg);
        exit;
     }
    /**
     * 提交
     * @param $frm 表单的id
     */
    function Submit($frm)
    {
        $msg = $frm.".submit();";
        $this->_Write($msg);
    }
}
?>