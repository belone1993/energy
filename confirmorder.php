<?php
	header("Content-Type:text/html;charset=utf-8");
	define('ZC_IN',true);
	require 'include/fun.inc.php';
	if(!isset($_POST['sub'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_POST['params'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_POST['address_name'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_POST['address_phone'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_POST['address_building'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_POST['address_sushe'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_POST['address_shuyuan'])) echo '<script>location.href="menu.php";</script>';
	if(!isset($_COOKIE['user'])) echo '<script>alert("登录过期！");location.href="login.php";</script>';
	
	$content = $_POST['params'];
	$name = $_POST['address_name'];
	$phone = $_POST['address_phone'];
	$building = $_POST['address_building'];
	$sushe = $_POST['address_sushe'];
	$shuyuan = $_POST['address_shuyuan'];
	$all_price = $_POST['all_price'];
	$payway = $_POST['payway'];
	$position = $_POST['position'];

	$stamp1 = strtotime("2016-2-1 00:00:00");
	$stamp2 = time();
	$week_num = floor(($stamp2 - $stamp1) / 60 / 60 / 24 / 7);

	$weekday = date('w');
	if($position == 'zc'){
		if($weekday == 5 || $weekday == 6 || $weekday == 0){
			$week_num += 1;
			$weekday = 1;
		}else{
			++$weekday;
		}
	};

	$user = $_COOKIE['user'];
	if($position == 'zc'){
		$query = "insert into zc_order (belong_to,shuyuan,building,sushe,name,phone,order_datetime,order_weeknum,content,send_weekday,status,price,payway) value ('$user','$shuyuan','$building','$sushe','$name','$phone',NOW(),'$week_num','$content','$weekday','1','$all_price','$payway')";
	}else{
		$query = "insert into yx_order (belong_to,shuyuan,building,sushe,name,phone,order_datetime,order_weeknum,content,send_weekday,status,price,payway) value ('$user','$shuyuan','$building','$sushe','$name','$phone',NOW(),'$week_num','$content','$weekday','1','$all_price','$payway')";
	}
	$result = _mysql($query,'insert');
	if($result != 1){
		echo "<script>alert('提交失败，请检查网络或者重新提交！');history.go(-1);</script>";
	}else{
		echo "<script>alert('下单成功！');location.href='./orderlist.php?pos=".$position."';</script>";
		// 取消掉支付宝支付功能
		// if($payway == 2){
		// 	echo "<script>alert('下单成功！');location.href='./orderlist.php';</script>";
		// }else{
		// 	$query = "select * from zc_order where belong_to='$user' order by id desc";
		// 	$result = _mysql($query,'search');
		// 	$id =  $result[0][0];
		// 	echo "<script>location.href='./alipay/create_partner_trade_by_buyer-PHP-UTF-8/index.php?operate=zc&orderid=$id';</script>";
		// }
	}
	
	
?> 