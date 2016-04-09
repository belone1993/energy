<?php
	define('ZC_IN',true);
	require '../include/fun.inc.php';
	$email = $_COOKIE['user'];
	$content = $_POST['text_content'];
	$query = "insert into zc_feedback (email,feedcontent,time) value ('$email','$content',NOW())";
	echo _mysql($query, 'insert');
?>