<?php
	define('POS', 'index');
	define('ZC_IN',true);
	define('TITLE', '首页');
	require './include/header.inc.php';
?>
<!--点餐-->
<div class="slide slide-1">
	<img class="slide-bg" src="./img/bg1.jpg" />
	<div class="g-container">
		<span class="slide-logo">LOGO</span>
		<span class="slide-slogan">能量作坊，做最好的餐饮</span>
		<div class="slide-link">
			<a href="./menu.php">开始订餐</a>
		</div>
		<div class="down-btn white-down-btn" data-id="1"></div>
	</div>
</div>
<!--温馨提示-->
<div class="slide slide-2">
	<div class="g-container">
		<div class="up-btn black-up-btn" data-id="0"></div>
		<ul class="tips">
			<li>
				<span class="tip-icon tip-icon-1"></span>
				<p class="tip tip-1">明天的早餐是提前一天，也就是今天订</p>
			</li>
			<li>
				<span class="tip-icon tip-icon-2"></span>
				<p class="tip tip-2">请在19：00之前下好订单，过时停止接单</p>
			</li>
			<li>
				<span class="tip-icon tip-icon-3"></span>
				<p class="tip tip-3">订单请在19：00前更改，过时无法取消</p>
			</li>
		</ul>
		<div class="down-btn black-down-btn" data-id="2"></div>
	</div>
</div>
<!--订单方式-->
<div class="slide slide-3">
	<div class="g-container">
		<div class="up-btn black-up-btn" data-id="1"></div>
		<img class="wechat-erweima" src="./img/gzh.jpg" />
		<div class="down-btn black-down-btn" data-id="3.4"></div>
	</div>	
</div>
<!-- 过度 -->
<div class="slide slide-4">
	<img class="slide-bg" src="./img/bg7.png" />
</div>
<!-- 时钟 -->
<div class="slide slide-5">
	<div class="g-container">
		<div class="up-btn white-up-btn" data-id="2"></div>
		<img class="clock"  src="./img/clock.png" />
		<h1>今日倒计时</h1>
		<div class="timer-content">
			<span id="hour">00</span>
			<span>:</span>
			<span id="minute">00</span>
			<span>:</span>
			<span id="second">00</span>
		</div>
		<div class="down-btn white-down-btn" data-id="4.4"></div>
	</div>
</div>
<!-- 尾部 -->
<div class="slide slide-6">
	<img class="slide-bg" src="./img/bg5.jpg" />
	<div class="g-container">
		<div class="up-btn up-top-btn" data-id="0"></div>
		<h1>开始运营的疏远</h1>
		<ul class="shuyuans">
			<li>仲英书院</li>
		</ul>
		<a class="beian" href="http://www.miibeian.gov.cn/" target="_blank">网站备案号-闽ICP备14015043号</a>
	</div>
</div>
<?php
	require './include/footer.inc.php';
?>