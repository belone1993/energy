<?php
	if (!defined('ZC_IN'))
	{
		exit('Access Denied!');
	};

	require 'config.inc.php';
	/**
	 * 生成验证码
	 * @param $w 验证码图像宽度，px
	 * @param $h 验证码图像高度，px
	 * @param $many 验证码位数
	 * @param $path 验证码cookie存放的目录
	 */
	
	function getCheckCodeImage($w,$h,$many,$path){
		$image = imagecreate($w,$h) or die("建立图像失败");
		$color1 = imagecolorallocate($image,255,0,255);
		$color2 = imagecolorallocate($image,0,128,255);
		$color3 = imagecolorallocate($image,128,128,255);
		$color4 = imagecolorallocate($image,0,128,0);
		$color5 = imagecolorallocate($image,255,128,0);
		$bgColor = imagecolorallocate($image,255,255,255);
		$arColor = array($color1,$color2,$color3,$color4,$color5);
	
		$checkWord = '';
		$checkChar = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIGKLMNOPQRSTUVWXYZ1234567890';
		for($i=0; $i<$many; $i++){
			$char=mt_rand(0, strlen($checkChar)-1);
			$checkWord.=$checkChar[$char];
		}
		setcookie('checkchar',$checkWord,time() + 600,$path);
	
		imagefill($image,0,0,$bgColor);
		for($i=0;$i<$many;$i++)
		{
			$col = $arColor[mt_rand(0,4)];
			$font_size = mt_rand(0,3) + (($h)*3/5);
			$angle = (mt_rand(0,30)-15)%360;
			$y = mt_rand(0,2) + ($h*2/3);
			$x = $i*($w/$many)+mt_rand(0,5);
			imagettftext($image, $font_size, $angle, $x, $y, $col, 'swissko.ttf', $checkWord[$i]);
		};
		Imagepng($image);
		ImageDestroy($image);
	}

	/**
	 * 得到unipid字符串
	 * @param none
	 * @return string
	 */
	
	function uniqidStr(){
		return sha1(uniqid(rand(),true));
	}
	
	/**
	 * 处理字符串，将左右空格去掉，如果需要转义则转义，用于数据存入数据库使用
	 * @param $str 要被处理的字符串
	 * @return string
	 */
	
	define('GPC',get_magic_quotes_gpc());
	function strHandle($str){
		$string = trim($str);
		if(GPC)
		{
			return $string;
		}else 
		{
			return addslashes($string);
		}	
	}
	
	 /**
	  * @得到IP地址
	  * @param none
	  * @return string
	  */
	
	function getIp(){
		if (getenv("HTTP_CLIENT_IP"))
		{
			$ip = getenv("HTTP_CLIENT_IP");
		}	
		else if(getenv("HTTP_X_FORWARDED_FOR"))
		{
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		}	
		else if(getenv("REMOTE_ADDR"))
		{
			$ip = getenv("REMOTE_ADDR");
		}
		else 
		{	
			$ip = "Unknow";
		}
		return $ip;
	}
	
	/**
	 * 数据库处理函数
	 * @param  $query mysql处理语句
	 * @param  $kind 处理类型
	 * @return  如果$kind等于count，则返回符合语句的条数
	 * @return  如果$kind等于search，则返回符合语句的二维数组，第一维代表第几个符合，第二维为数据库信息，键为数据库表名
	 * @return  如果$kind等于其他，如果操作成功则返回大于零的数，否则返回零
	 */
	function _mysql($query,$kind){
		$host = '';
		$user = '';
		$password = '';
		$name = '';
		$conn=@mysql_connect($host,$user,$password) or die ('数据库链接失败:'.mysql_errno());
		@mysql_select_db($name) or die('数据库错误：'.mysql_errno());
		@mysql_query('SET NAMES UTF8') or die('字符集错误：'.mysql_errno());
	
		$result = mysql_query($query,$conn);
		if($kind == 'count')
		{
			$many = mysql_num_rows($result);
			mysql_close();
			return  $many;
		}elseif ($kind == 'search')
		{
			$arRow = array();
			$i = 0;
			while(!!$row = mysql_fetch_array($result))
			{
				$arRow[$i] = $row;
				$i++;
			};
			mysql_close();
			return $arRow;
		}else 
		{
			mysql_close();
			return $result;
		}
	}
	
?>