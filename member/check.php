<?php
	define("ZC_IN", true);
	require '../include/fun.inc.php';
	echo _mysql("select * from zc_user where email = '$_POST[email]'", "count");
?>