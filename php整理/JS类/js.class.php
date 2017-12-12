<?php
class JS
{
    function JS(){}
    
    /**
     *　返回上页
     * @param $step 返回的层数 默认为1
     */
    function Back($step = -1)
    {
        $msg = "history.go(".$step.");";
        $this->_Write($msg);
        //$this->FreeResource();
        exit;
    }

    /**
     * 弹出警告的窗口
     * @param $msg 警告信息
     */
    function Alert($msg)
    {
        $msg = "alert('".$msg."');";
        $this->_Write($msg);
    }
    /**
     * 写js
     * @param $msg
     */
    function _Write($msg)
    {
        echo "<script language=javascript>";
        echo $msg;
        echo "</script>";
    }

    /**
     * 刷新当前页
     */
    function Reload()
    {
        $msg = "location.reload();";
       // $this->FreeResource();
        $this->_Write($msg);
        exit;
    }
    /**
     * 刷新弹出父页
     */
    function ReloadOpener()
    {
        $msg = "if (opener)    opener.location.reload();";
        $this->_Write($msg);
    }

    /**
     * 跳转到url
     * @param $url 目标页
     */
    function Goto($url)
    {
        $msg = "location.href = '$url';";
       // $this->FreeResource();
        $this->_Write($msg);
        exit;
    }
	/**
	*是否	
	*/
	function Confirm($string)
	{

		$msg = "confirm('".$string."');";
		$this->_Write($msg);
	}
    /**
     * 关闭窗口
     */
     function Close()
     {
         $msg = "window.close()";
        //$this->FreeResource();
        $this->_Write($msg);
        exit;
        
     }
    /**
     * 提交表单
     * @param $frm 表单名
     */
    function Submit($frm)
    {
        $msg = $frm.".submit();";
        $this->_Write($msg);
    }
    /** 
     * 关闭数据库连接
     */
   /* function FreeResource()
    {
        // 数据库连接标志
        global $conn;
        if (is_resource($conn))
            @mysql_close($conn);
    }*/
}
?>