<?php
	header("Content-type: image/PNG");
	define("ZC_IN", true);
	require 'fun.inc.php';
	getCheckCodeImage(100, 30, 4, '/');
?>