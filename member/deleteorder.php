<?php
	define("ZC_IN", true);
	require '../include/fun.inc.php';
	if(isset($_POST['in_ok'])){
		$id = (int)$_POST['id'];
		$query = "delete from zc_order where id=$id";
		echo _mysql($query,'delete');
	}else{
		echo '2';
	};
?>