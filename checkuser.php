<?php
	header("content-type:text/html;charset=utf-8");
	define('ZC_IN',true);
	require 'include/fun.inc.php';
	if(!isset($_GET['email'])){
		echo "<script>location.href='register.php?step=one';</script>";
	}else{
		$email =strHandle($_GET['email']);
		$query = "select * from zc_user where email='$email'";
		$result = _mysql($query, "search");
		$uniqid = $result[0]['check_str'];
		if(!!$uniqid){
			if($uniqid == $_GET['uniqid'])
			{
				$query = "update zc_user set check_str='' where email='$email'";
				$result = _mysql($query, "update");
				if($result == 1){
					echo "<script>location.href='register.php?step=three&status=ok';</script>";
				}else{
					echo "<script>alert('激活失败！');</script>";
				}
			}else{
				echo "<script>alert('非法激活！');location.href='register.php?step=one';</script>";
			}
		}else{
			echo "<script>alert('该账户已经激活，请登录！');location.href='login.php';</script>";
		}
	}
?>