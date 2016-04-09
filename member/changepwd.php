<?php
	define('ZC_IN',true);
	require '../include/fun.inc.php';
	$email = $_COOKIE['user'];
	$old = $_POST['old'];
	$new = $_POST['new'];
	$new2 = $_POST['new2'];
	if(!$old){
		echo '0';
	}elseif(!$new){
		echo '1';	
	}elseif($new != $new2){
		echo '2';	
	}else{
		$old = sha1($_POST['old']);
		$new = sha1($_POST['new']);
		$new2 = sha1($_POST['new2']);
		
		$query = "select * from zc_user where (email='$email' and password='$old')";
		if(_mysql($query, 'count') == 1){
			$query = "update zc_user set password='$new' where email='$email'";
			$result = _mysql($query, 'update');
			if($result > 0){
				echo '4';
			}else{
				echo '5';
			}
		}else{
			echo '3';
		};
	}
	
?>