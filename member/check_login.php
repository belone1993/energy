<?php
	define('ZC_IN',true);
	require '../include/fun.inc.php';
	$email = strHandle($_POST['email']);
	$pwd = sha1($_POST['pwd']);
	$query = "select * from zc_user where (email='$email' and password='$pwd')";
	$result = _mysql($query, "search");
	if(!!sizeof($result)){

		if(!!$result[0]['check_str']){
			echo '2';
		}else{	
			if(isset($_POST['save'])){
				if($_POST['save'] == 1){
					setcookie('user',$email,time() + 7*24*60*60,'/');
				}else{
					setcookie('user',$email,time() + 2*60*60,'/');
				}
			}else{
				setcookie('user',$email,time() + 2*60*60,'/');
			}
			echo '1';
		}
	}else{
		echo '0';
	};
?>