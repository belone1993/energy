<?php
	define('ZC_IN',true);
	define("POS", "shoplist");
	define("TITLE", "订单中心");
	
	require './include/header.inc.php';
	require './include/fun.inc.php';
	
	if(!isset($_COOKIE['user'])) echo '<script>location.href="login.php";</script>';
	if(!isset($_POST['sub'])) echo '<script>location.href="menu.php";</script>';
		
	$user = $_COOKIE['user'];
	$query = "select * from zc_user where (email='$user')";
	$user_info = _mysql($query, "search");     //用户表的信息
	$shuyuan_array = array("zy" => '仲英书院','ny' => '南洋书院', "cs" => '崇实书院','pk' => '彭康书院','lz'=>'励志书院','wz'=>'文治书院',''=>'');
	$position = $_POST['position'];
	$order_list_array = explode("&",$_POST['params']);
	$all_price = 0;
	date_default_timezone_set("PRC");
	$weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
?> 
<div class="m-content j-position"  data-pos="<?php echo $_POST['position'];?>">
	<div class="g-container">
		<form id="order-list" method="post" action="./confirmorder.php">
			<h1>填写并核对订单信息</h1>
			<div class="address">
				<h2>收货人信息（若不想每次都填写，请在个人中心完善资料）</h2>
				<div class="detail address-detail">
					<div class="one-line">
						<label>收货人<span class="red-text">*</span>：</label>
						<input type="text" name="address_name" value="<?php echo $user_info[0]['name'];?>"/>
						<label>联系电话<span class="red-text">*</span>：</label>
						<input type="text" name="address_phone" value="<?php echo $user_info[0]['phone'];?>"/>
					</div>
					<div class="one-line">
						<label>书院<span class="red-text">*</span>：</label>
						<select name="address_shuyuan" data-selected="<?php echo $user_info[0]['shuyuan'];?>">
							<option value="ny" class="ny">南洋书院</option>
							<option value="zy" class="zy">仲英书院</option>
							<option value="wz" class="wz">文治书院</option>
							<option value="pk" class="pk">彭康书院</option>
							<option value="cs" class="cs">崇实书院</option>
							<option value="lz" class="lz">励志书院</option>
						</select>
						<label>宿舍楼<span class="red-text">*</span>：</label>
						<input type="text" name="address_building" value="<?php echo $user_info[0]['building']?>" />
						<label>宿舍房间号<span class="red-text">*</span>：</label>
						<input type="text" name="address_sushe" value="<?php echo $user_info[0]['sushe']?>" />
					</div>
				</div>
			</div>
			<div class="time">
				<h2>配送时间（今天日期：<?php echo date('Y-m-d ');echo $weekday[date('w')];?>）</h2>
				<span class="time-detail detail">
					<?php 
						if($position == 'zc'){
							if(date('w') == 5 || date('w') == 6 || date('w') == 0){
								echo '下周的'.$weekday[1];
							}else{
								echo $weekday[date('w')+1];
							}
						}else{
							echo "我们将会在20：30开始配送";
						}
					?>
				</span>
			</div>
			<div class="pay-way">
				<h2>付款方式</h2>
				<div class="cash active">在线支付</div>
				<div class="online">支付宝转账</div>
			</div>
			<div class="order-list">
				<h2>清单</h2>
				<div class="table-box">
					<table>
						<tbody>
							<tr>
								<th class="name">名字</th>
								<th class="count">份额</th>
								<th class="price">价格</th>
							</tr>
							<?php 
								foreach ($order_list_array as $key => $value){
									$details_list_array = explode('+',$value);
									$all_price += $details_list_array[2] * $details_list_array[1];
									echo '<tr>';
									echo '<td>'.$details_list_array[0].'</td>';
									echo '<td>'.$details_list_array[1].'</td>';
									echo '<td>'.$details_list_array[2].'</td>';
									echo '</tr>';
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="order-foot">
				<input type="submit" value="确定订单" name="sub" class="m-submit"/>
				<div class="allprice">应付金额：<span class="all-price"><?php echo $all_price;?></span>元</div>
			</div>
			<div class="input-box">
				<input class="input-pay-price" type="hidden" name="all_price" value="<?php echo $all_price;?>"/>
				<input class="input-pay-params" type="hidden" name="params" value="<?php echo $_POST['params'];?>"/>
				<input class="input-pay-position" type="hidden" name="position" value="<?php echo $_POST['position'];?>"/>
				<input class="input-pay-way" type="hidden" name="payway" value="1"/>
			</div>
		</form>
	</div>
</div>
<?php 
	require 'include/footer.inc.php';
?>
