$(function(){	
	//浏览器可视区大小
	var viewPort = {
		'height': $(window).height(),  
		'width': $(window).width()
	};  
	//缓存Dom
	var oDownBtns = $('.down-btn'),                        //向下滚动按钮
		oUpBtns = $('.up-btn'),                            //向上滚动按钮
		oSlideLogo = $('.slide-logo').eq(0),               //slide1的logo
	    oSlideSlogan = $('.slide-slogan').eq(0),           //slide1的slogan
	    oTipIcons = $('.tip-icon'),
	    oTips = $('.tip'),
	    oHour = $('#hour'),
	    oMinute = $('#minute'),
	    oSecond = $('#second');
	var slide = [];                  //滚动函数
	/* 第一个视口时钟 */
	slide[0] = {};
	slide[0].move = (function(){

		var t1 = parseFloat(oSlideLogo.css('top')),
			t2 = parseFloat(oSlideSlogan.css('left'));

		return function(){

			oSlideLogo.stop().css('top', '50px');
			oSlideSlogan.stop().css('left', '0px').css('opacity', '0');
			oSlideLogo.animate({
				'top': t1 + 'px'
			}, 1000, function(){
				oSlideSlogan.animate({
					'left': (t2 + 50) + 'px',
					'opacity': 1
				}, 500, function(){
					oSlideSlogan.animate({
						'left': (t2 - 25) + 'px',
					}, 300, function(){
						oSlideSlogan.animate({
							'left': t2 + 'px',
						}, 200);
					})
				})
			})
		}
	})();
	/* 第二个视口动画 */
	slide[1] = {};
	slide[1].move = (function(){
		var t1 = parseFloat(oTips.css('left')),
			t2 = parseFloat(oTipIcons.css('left'));
		return function(){
			oTips.stop().css('opacity', 0).css('left', (t1 + 300) + 'px');
			oTipIcons.stop().css('opacity', 0).css('left', '0px');
			function action(index){
				oTipIcons.eq(index).animate({
					'left': t2 + 'px',
					'opacity': 1
				},800, function(){
					oTipIcons.eq(index).addClass('roll');
					oTips.eq(index).animate({
						'left': t1 + 'px',
						'opacity': 1
					},1000, function(){
						oTipIcons.eq(index).removeClass('roll');
						if(index < 2){
							action(index + 1);
						}
					});
				})
			}
			action(0);
		}
	})();
	/* 第四个视口时钟 */
	slide[3] = {};
	slide[3].move = (function(){
		var reTime = new Date(),
			timer;
		reTime.setHours(19);
		reTime.setMinutes(0);
		reTime.setSeconds(0);
		reTime.setMilliseconds(0);
		reTime = reTime.getTime();
		function double(num){
			if(num < 10){
				return '0' + num;
			}else{
				return '' + num;
			}
		}
		return function(){
			clearTimeout(timer);
			var nowTime = (new Date()).getTime(),
				dt, hours, minutes, seconds;
			dt = reTime - nowTime
			if(dt <= 0){
				clearTimeout(timer);
				oHour.html('00');
				oSecond.html('00');
				oMinute.html('00');
			}else{
				hours = Math.floor(dt / 1000 / 60 / 60);
				minutes = Math.floor((dt - hours * 60 * 60 * 1000) / 1000 / 60);
				seconds = Math.floor((dt - hours * 60 * 60 * 1000 - minutes * 60 * 1000) / 1000);
				oHour.html(double(hours));
				oSecond.html(double(seconds));
				oMinute.html(double(minutes));
				setTimeout(slide[3].move, 1000);
			}
		};
	})()
	//执行默认动画
	for(var i = 0, len = slide.length; i < len; i++){
		if(slide[i] && slide[i].move){
			slide[i].move();
		}
	}
	//滚动函数
	function scrollTo(e){
		var k = $(this).attr('data-id'),
			top = parseFloat(k) * viewPort.height + 'px';
		if(slide[parseInt(k)] && slide[parseInt(k)].move){
			slide[parseInt(k)].move();
		};
		$("html,body").animate({
			scrollTop: top
		}, 500);	
	}
	//向下按钮点击
	oDownBtns.on('click', scrollTo);
	//向上按钮点击
	oUpBtns.on('click', scrollTo);
	//时钟
});