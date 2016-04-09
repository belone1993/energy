<?php
	define('ZC_IN',true);
	require '../include/fun.inc.php';
	$email = $_COOKIE['user'];
	$query = "update zc_user set name='$_POST[name]',shuyuan='$_POST[shuyuan]',building='$_POST[building]',sushe='$_POST[sushe]',phone='$_POST[phone]' where email='$email'";
	echo _mysql($query, 'update');
?>
