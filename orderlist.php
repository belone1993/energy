<?php
	define('ZC_IN',true);
	define("POS", "orderlist");
	define("TITLE", "我的订单");
	
	require './include/header.inc.php';
	require './include/fun.inc.php';
	
	if(!isset($_COOKIE['user'])) echo '<script>location.href="login.php";</script>';
		
	$user = $_COOKIE['user'];
	if ( isset($_GET['pos'])) {
		$position = $_GET['pos'];
	} else {
		$position = 'zc';
	}
	
	if ($position !== 'payway') {
		$query = "select * from ".$position."_order where (belong_to='$user') order by id desc";
		$order_list_info = _mysql($query, "search");     //订单表的信息
		$max = 5;
		$page = ceil(count($order_list_info) / $max);


		if(isset($_GET['page'])){
			if($_GET['page'] > $page){
				echo '<script>location.href="orderlist.php?pos=$position";</script>';
			}
			$offset = $max * ($_GET['page'] - 1);
		}else{
			$offset = 0;
		}
		
		
		$shuyuan_array = array("zy" => '仲英书院','ny' => '南洋书院', "cs" => '崇实书院','pk' => '彭康书院','lz'=>'励志书院','wz'=>'文治书院',''=>'');
		date_default_timezone_set("PRC");
		$weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
		$status_content = array('1'=>'未支付','2'=>'已支付，配送中','3'=>'交易完成','5'=>'等待确认收货');
		$status = array('1'=>'display:block','2'=>'display:none','3'=>'display:none','5'=>'display:none');
		$payway = array('1'=>'在线支付','2'=>'支付宝转账');

		$current_list = array_slice($order_list_info, $offset, $max);
	}
?> 
<!-- '<div style="width:710px;margin:0 auto;"><img src="./img/no_order.jpg" /></div>' -->
<div class="m-content">
	<div class="g-container">
		<ul class="nav">
			<li><a class="<?php if($position == 'zc') echo 'active'; ?>" href="./orderlist.php?pos=zc">早餐订单</a></li>
			<li><a class="<?php if($position == 'yx') echo 'active'; ?>" href="./orderlist.php?pos=yx">夜宵订单</a></li>
			<!-- <li><a class="<?php //if($position == 'payway') echo 'active'; ?>" href="./orderlist.php?pos=payway">付款方式</a></li> -->
		</ul>
		<ul class="content">
			<?php 
				if ($position == 'zc') {
			?>
			<li class="zc">
				<?php
					if(count($current_list) == 0){
				?> 
					<div class="no-order"><img src="./img/no_order.jpg" /></div>
				<?php
					}
				?>
				<ul>
					<?php 
						foreach ($current_list as $key => $value){
							//处理在线支付接口是否出现
							$style = '';
							if($value['payway'] != 1){
								$style = 'style="display:none;"';
							}
							//是否可以取消订单
							$style2 = '';
							if ($value['status'] != 1) {
								$style2 = 'style="display:none"';
							}
							//处理订单详情
							$list_content_array = explode("&", $value['content']);
							$list_content = '';
							foreach ($list_content_array as $key2=>$value2){
								$list_details = explode('+', $value2);
								$list_content = $list_content.''.$list_details[0].' '.$list_details[1].'份，共'.$list_details[2].'元<br />';
							}
							//收获人信息
							$list_msg = $value['name'].'  '.$value['phone'].'<br />'.
									    $shuyuan_array[$value['shuyuan']].'  '.$value['building'].'  '.$value['sushe'];
							//送货时间
							$list_time = '第'.$value['order_weeknum'].'周<br />'.$weekday[$value['send_weekday']];
					?>
					<li class="one-order">
						<div class="msg">
							<div class="order-time"><?php echo $value['order_datetime']; ?></div>
							<div class="order-id">订单号：<?php echo $value['id']; ?></div>
							<div class="order-price">应付金额：<span><?php echo $value['price']; ?></span> 元</div>
							<div class="order-price">付款方式：<span><?php echo $payway[$value['payway']]; ?></span></div>
							<div class="tip" <?php echo $style; ?>>(在线支付接口已经去掉了)</div>
							<div class="delete">
								<a <?php echo $style2; ?> class="delete-btn" href="javascript:void(0);" data-id="<?php echo $value['id']; ?>" data-pos="<?php echo $position; ?>">[取消订单]</a>
							</div>
						</div>
						<table class="detail">
							<thead>
								<tr>
									<th class="order-content">订单内容</th>
									<th class="order-msg">收货人信息</th>
									<th class="order-time">配送时间</th>
									<th class="omega order-status">订单状态</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $list_content; ?></td>
									<td><?php echo $list_msg; ?></td>
									<td><?php echo $list_time; ?></td>
									<td class="omega"><?php echo $status_content[$value['status']];?></td>
								</tr>
							</tbody>
						</table>
					</li>

					<?php 
						} 
					?>
					<div class="pagination" <?php if($page <= 1){echo 'style="display:none;"';}?>>
						<?php 
							require 'include/pagination.inc.php';
							pagination($max, count($order_list_info), "pos=zc");
						?>
					</div>
				</ul>
			</li>
			<?php 
				} else if ($position == 'yx') {
			?>
			<li class="yx">
				<?php
					if(count($current_list) == 0){
				?> 
					<div class="no-order"><img src="./img/no_order.jpg" /></div>
				<?php
					}
				?>
				<ul>
					<?php 
						foreach ($current_list as $key => $value){
							//处理在线支付接口是否出现
							$style = '';
							if($value['payway'] != 1){
								$style = 'style="display:none;"';
							}
							//处理订单详情
							$list_content_array = explode("&", $value['content']);
							$list_content = '';
							foreach ($list_content_array as $key2=>$value2){
								$list_details = explode('+', $value2);
								$list_content = $list_content.''.$list_details[0].' '.$list_details[1].'份，共'.$list_details[2].'元<br />';
							}
							//收获人信息
							$list_msg = $value['name'].'  '.$value['phone'].'<br />'.
									    $shuyuan_array[$value['shuyuan']].'  '.$value['building'].'  '.$value['sushe'];
							//送货时间
							$list_time = '第'.$value['order_weeknum'].'周<br />'.$weekday[$value['send_weekday']];
					?>
					<li class="one-order">
						<div class="msg">
							<div class="order-time"><?php echo $value['order_datetime']; ?></div>
							<div class="order-id">订单号：<?php echo $value['id']; ?></div>
							<div class="order-price">应付金额：<span><?php echo $value['price']; ?></span> 元</div>
							<div class="order-price">付款方式：<span><?php echo $payway[$value['payway']]; ?></span></div>
							<div class="tip" <?php echo $style; ?>>(在线支付接口已经去掉了)</div>
						</div>
						<table class="detail">
							<thead>
								<tr>
									<th class="order-content">订单内容</th>
									<th class="order-msg">收货人信息</th>
									<th class="order-time">配送时间</th>
									<th class="omega order-status">订单状态</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $list_content; ?></td>
									<td><?php echo $list_msg; ?></td>
									<td><?php echo $list_time; ?></td>
									<td class="omega"><?php echo $status_content[$value['status']];?></td>
								</tr>
							</tbody>
						</table>
					</li>

					<?php 
						} 
					?>
					<div class="pagination" <?php if($page <= 1){echo 'style="display:none;"';}?>>
						<?php 
							require 'include/pagination.inc.php';
							pagination($max, count($order_list_info), "pos=yx");
						?>
					</div>
				</ul>
			</li>
			<?php 
				} else {
			?>
			<li class="payway">
				
			</li>
			<?php 
				}
			?>
		</ul>
		<?php 
			// if(count($order_list_info) == 0){
			// 	echo '<div style="width:200px;margin:60px auto;height:30px;"><a style="display:block;height:30px;width:90px;float:left;text-align:center;line-height:30px;font-size:16px;border-radius:5px; background:#44b549;color:#fff;" href="orderlist.php">早餐订单</a><a style="display:block;height:30px;width:90px;float:left;text-align:center;line-height:30px;font-size:16px;border-radius:5px;"  href="yx_orderlist.php">夜宵订单</a></div>';
			// 	echo 
			// }else{
			// 	echo '<div style="width:200px;margin:60px auto;height:30px;"><a style="display:block;height:30px;width:90px;float:left;text-align:center;line-height:30px; background:#44b549;color:#fff;font-size:16px;border-radius:5px;" href="orderlist.php">早餐订单</a><a style="display:block;height:30px;width:90px;float:left;text-align:center;line-height:30px;font-size:16px;border-radius:5px;"  href="yx_orderlist.php">夜宵订单</a></div>';
			// 	echo '<div style="width:900px; height:80px; border:1px solid #44b549;margin-top:60px;border-radius:15px;padding:20px 50px; font-size:20px;"><span style="color:#44b549;">付款方式：</span>直接转账到支付宝账户：15686058776，账户姓名填：康东扬，<span style="color: #ff8040;">并留言您付款的订单号。</span><br><span style="color:#44b549;">温馨提示：</span>（1）订单付款后生效，因需要提前将订单给商家，请于19点前付款。<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; （2）如需退款请联系站长，不过请注意隔天的订单一旦超过今天的19点不可退款</div>';
			// };
			
		?>
		
	</div>
</div>
<?php 
	require 'include/footer.inc.php';
?>
