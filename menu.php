<?php
	define('ZC_IN',true);
	define("POS", "menu");
	define("TITLE", "早餐菜单");

	require './include/header.inc.php';
	require './include/fun.inc.php';

?> 
<div class="m-menu j-position" data-pos="zc">
	<div class="g-container">
		<div class="menu-box g-col-17">
			<ul class="nav">
				<li class="drink-nav active">饮品</li>
				<li class="food-nav">热食</li>
				<li class="bread-nav">面包</li>
				<li class="discount-nav">套餐专区</li>
			</ul>
			<!-- 饮料列表 -->
			<ul class="drink-menu menu"></ul>
			<!-- 食物列表 -->
			<ul class="food-menu menu f-hidden"></ul>
			<!-- 面包列表 -->
			<ul class="bread-menu menu f-hidden"></ul>
			<!-- 套餐 -->
			<ul class="set-meal-menu menu f-hidden"></ul>
		</div>
		<div class="notice g-col-7">
			<h1>温馨提示</h1>
			<p>
				<ol>
					<li>目前只在仲英书院运营。</li>
					<li>请在19:00前下单，过时停止接单。</li>
					<li>隔天订单在前一天19:00前可以取消，过时提交给商家便无法取消</li>
					<li>早餐配送是挂在宿舍窗户铁栏上。</li>
				</ol>
			</p>
		</div>
		<ul class="shopcard g-col-7">
			<h1 class="order-title">购物车</h1>
			<ul class="order-th">
				<li class="name">名字</li>
				<li class="count">份数</li>
				<li class="price">价格</li>
			</ul>
			<ul class="order-list">
			</ul>
			<div class="all">
				<span>总共</span>
				<span class="all-number">0</span>
				<span>份，￥</span>
				<span class="all-price">0</span>
			</div>
			<div class="order-foot">
				<a href="javacript:void(0);" class="clear">[清空购物车]</a>
				<form id="form" name="orderlist" method="post" action="./shoplist.php">
					<input name="sub" class="u-submit" type="submit" value="提交订单"/>
				</form>
			</div>
		</ul>
	</div>
</div>
<?php 
	require './include/footer.inc.php';
?>