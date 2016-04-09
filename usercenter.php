<?php
	define('ZC_IN',true);
	define("POS", "personal");
	define("TITLE", "个人中心");

	if(!isset($_COOKIE['user'])) echo '<script>location.href="login.php";</script>';
	if(!($_GET['pos'] == 'data'  or $_GET['pos'] == 'pwd')) echo '<script>location.href="usercenter.php?pos=data";</script>';
		
	require './include/header.inc.php';
	require './include/fun.inc.php';
	
	$user = $_COOKIE['user'];
	$query = "select * from zc_user where (email='$user')";
	$result = _mysql($query, "search");     //用户表的信息
	
	$shuyuan = $result[0]['shuyuan'];
	$shuyuan_array = array("zy" => '仲英书院','ny' => '南洋书院', "cs" => '崇实书院','pk' => '彭康书院','lz'=>'励志书院','wz'=>'文治书院',''=>'');

	$building = $result[0]['building'];		
	$sushe = $result[0]['sushe'];		
	$phone = $result[0]['phone'];		
	$name = $result[0]['name'];
	
?> 
<div class="m-content">
	<div class="g-container">
		<ul class="nav">
			<li class="<?php if($_GET['pos'] == 'data') echo 'active';?>"><a href="usercenter.php?pos=data">个人资料</a></li>
			<li class="<?php if($_GET['pos'] == 'pwd') echo 'active';?>"><a href="usercenter.php?pos=pwd">修改密码</a></li>
		</ul>
		<ul class="content">
		<?php
			if($_GET['pos'] == 'data'){
		?>
			<li class="data">
				<h2>个人资料 Personal data</h2>
				<div class="detail">
					<form id="data">
						<div class="one-item">
							<label>邮箱帐号：</label>
							<span><?php echo $user;?></span>
						</div>
						<div class="one-item">
							<label>书院：</label>
							<select name="shuyuan" data-selected="<?php echo $shuyuan; ?>">
								<option value="ny" class="ny">南洋书院</option>
								<option value="zy" class="zy">仲英书院</option>
								<option value="wz" class="wz">文治书院</option>
								<option value="pk" class="pk">彭康书院</option>
								<option value="cs" class="cs">崇实书院</option>
								<option value="lz" class="lz">励志书院</option>
							</select>
						</div>
						<div class="one-item">
							<label>宿舍楼：</label>
							<input type="text" name="building" value="<?php echo $building; ?>" autocomplete="off"/>
						</div>
						<div class="one-item">
							<label>宿舍房间号：</label>
							<input type="text" name="sushe" value="<?php echo $sushe; ?>" autocomplete="off"/>
						</div>
						<div class="one-item">
							<label>姓名：</label>
							<input type="text" name="name" value="<?php echo $name; ?>" autocomplete="off"/>
						</div>
						<div class="one-item">
							<label>联系电话：</label>
							<input type="text" name="phone" value="<?php echo $phone; ?>" autocomplete="off"/>
						</div>
						<div class="one-item">
							<input class="u-submit" type="submit" value="确定修改"/>
						</div>
					</form>
				</div>
			</li>
		<?php
			}else{
		?>
			<li class="password">
				<h2>修改密码 Changed password</h2>
				<div class="detail">
					<form id="password">
						<div class="one-item">
							<label>旧密码：</label>
							<input type="password" name="old"/>
						</div>
						<div class="one-item">
							<label>新密码：</label>
							<input type="password" name="new"/>
						</div>
						<div class="one-item">
							<label>确认密码：</label>
							<input type="password" name="new2"/>
						</div>
						<div class="one-item">
							<input class="u-submit" type="submit" value="确定修改"/>
						</div>
					</form>
				</div>
			</li>
		<?php 
			}
		?>
		</ul>
	</div>
</div>
<?php 
	require 'include/footer.inc.php';
?>