<?php
session_start ();
/**
 * website apps verifycode file
 *
 
* @copyright Copyright (C) 2010 中国万网互联网解决方案事业部 * @package apps
 * @access public
 * @version $Id: verifycode.php 1  $
 */

//创建随机字符串
$s_verifycode = GetRandomString(4, 0);
SetSession('verifycode', $s_verifycode);

//$_SESSION['verifycode']=$s_verifycode;

//创建图片
$o_im = imagecreate(57, 20);
$i_color_bg = imagecolorallocate($o_im, 255, 255, 255);
imagefill($o_im, 0, 0, $i_color_bg);

//写入字符
$i_color_font_0 = imagecolorallocate($o_im, GetRandomNumber(100, 0), GetRandomNumber(100, 0), GetRandomNumber(100, 0));
$i_color_font_1 = imagecolorallocate($o_im, GetRandomNumber(100, 0), GetRandomNumber(100, 0), GetRandomNumber(100, 0));
$i_color_font_2 = imagecolorallocate($o_im, GetRandomNumber(100, 0), GetRandomNumber(100, 0), GetRandomNumber(100, 0));
$i_color_font_3 = imagecolorallocate($o_im, GetRandomNumber(100, 0), GetRandomNumber(100, 0), GetRandomNumber(100, 0));
imagestring($o_im, 5, 5, 2, $s_verifycode{0}, $i_color_font_0);
imagestring($o_im, 5, 18, 2, $s_verifycode{1}, $i_color_font_1);
imagestring($o_im, 5, 31, 2, $s_verifycode{2}, $i_color_font_2);
imagestring($o_im, 5, 44, 2, $s_verifycode{3}, $i_color_font_3);

//加入干扰像素
for ($i = 0; $i < 100; $i++)
{
	$i_color_disturb = imagecolorallocate($o_im, GetRandomNumber(255, 0), GetRandomNumber(255, 0), GetRandomNumber(255, 0));
	imagesetpixel($o_im, GetRandomNumber(56, 0), GetRandomNumber(19, 0), $i_color_disturb);
}

//输出图像
header('Content-type: image/png');
imagepng($o_im);
imagedestroy($o_im);



/**
	 * 获得随机的字符串
	 *
	 * @param integer $iLength 生成的字符串的长度
	 * @param integer $iType 类型 1: 全小写 2: 全大写 3: 数字+小写 4: 数字+大写 5: 小写+大写 6: 数字+小写+大写
	 * @access public
	 * @return string
	 */
	function GetRandomString($iLength, $iType = 2)
	{
		$s_random_string = '';
		switch ($iType)
		{
			case 1:
				$s_characters = 'abcdefghijklmnopqrstuvwxyz';
				break;
			case 2:
				$s_characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 3:
				$s_characters = '0123456789abcdefghijklmnopqrstuvwxyz';
				break;
			case 4:
				$s_characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 5:
				$s_characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 6:
				$s_characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			default:
				$s_characters = '0123456789';
				break;
		}
		$i_length_max = strlen($s_characters) - 1;
		for($i = 0; $i < $iLength; $i++)
		{
			$s_random_string .= $s_characters[GetRandomNumber($i_length_max)];
		}
		return $s_random_string;
	}

		/**
	 * 获得随机的指定范围的数字
	 *
	 * @param integer $iMax 最大数字
	 * @param integer $iMin 最小数字
	 * @access public
	 * @return integer
	 */
	function GetRandomNumber($iMax, $iMin = 0)
	{
		list($s_msecond, $s_second) = explode(' ', microtime());
		$d_seed = (float)$s_second + ((float)$s_msecond * 100000);
		mt_srand($d_seed);
		return mt_rand($iMin, $iMax);
	}

		/**
	 * 设置一个Session值
	 *
	 * @param string $sName 传入的Session键名
	 * @param string $sValue 传入的Session键对应的值
	 * @access public
	 * @return null
	 */
	function SetSession($sName, $sValue)
	{
		$_SESSION[$sName] = $sValue;
	}

?>