$(function(){
	
	//侧导航返回顶部
	$('#elevator').find('.back_to_top').click(function(){
		var timer1 = setInterval(function(){
			var scrollOfTop = 	$(document).scrollTop();
			scrollOfTop -= 10;
			if(scrollOfTop <= 0){
				$(document).scrollTop(0);
				clearInterval(timer1);
			}else{
				$(document).scrollTop(scrollOfTop);
			}
		},5)
		
	})
	
	//侧导航微信公众号
	$('#elevator').find('.weixin').mouseover(function(){
		$('#elevator').find('.weixin_pop').show();
	})
	$('#elevator').find('.weixin').mouseout(function(){
		$('#elevator').find('.weixin_pop').hide();
	})
	
	//侧导航app
	$('#elevator').find('.app').mouseover(function(){
		$('#elevator').find('.app_pop').show();
	})
	$('#elevator').find('.app').mouseout(function(){
		$('#elevator').find('.app_pop').hide();
	})
	
	//退出
	$('#logout').click(function(){
		$.cookie('user', null, {expires: -1, path: '/'});
		location.href = './index.php';
	})

})