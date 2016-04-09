<?php
	header("Content-type: text/html; charset=utf-8"); 
	define("ZC_IN", true);
	require '../include/fun.inc.php';
	print_r($_POST);
	
	foreach ($_POST['id'] as $key=>$value){
		$query = "update zc_order set status=$_POST[status_num] where id=$value";
		echo _mysql($query,'update');
	}
?>