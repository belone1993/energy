<?php
	if(!defined("ZC_IN")) {
		exit("illegal use!");
	}
?>
	<div class="m-footer">
		<div class="g-container">
			<span>&copy; 2015 - <?php echo date('Y') ?> 能量作坊 版权所有</span>
		</div>
	</div>
	<?php
		if(POS != 'kefu'){
	?>
	<script src="./js/jquery-1.7.1.min.js"></script>
    <script src="./js/jquery.cookie.js"></script>
    <script src="./js/common.js"></script>
    <script src="./js/<?php echo POS?>.js"></script>
    <?php 
    	}
    ?>
</body>	
</html>