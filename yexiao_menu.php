<?php
	define('ZC_IN',true);
	define("POS", "menu");
	define("TITLE", "夜宵菜单");
	require './include/header.inc.php';
	require './include/fun.inc.php';

?> 
<div class="m-menu j-position" data-pos="yx">
	<div class="g-container">
		<div class="menu-box g-col-17">
			<ul class="nav">
				<li class="food-nav active">夜宵</li>
				<li class="drink-nav">饮料</li>
				<li class="discount-nav">优惠专区</li>
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
					<li>夜宵目前只在仲英运营。</li>
					<li>送货到宿舍，订后40分钟内到达，8：30开始送货。</li>
					<li>请在22:00前下单，过时停止接单。</li>
					<li>一旦下单不可取消，请慎重下单。</li>
					<li>饮料只是帮带，不能只订饮料。</li>
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