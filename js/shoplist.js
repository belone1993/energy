$(function(){

	var position = $('.j-position').eq(0).attr('data-pos'),
		oCash = $('.cash').eq(0),
		oLine = $('.online').eq(0),
		oPayWay = $('.input-pay-way').eq(0),
		oInputs = $('.address').find('input'),
		oSub = $('.m-submit').eq(0),
		oSelect = $('select').eq(0);
	//选中默认书院
	if(!!oSelect.attr('data-selected')){
		oSelect.val(oSelect.attr('data-selected'));
	}
	//付款方式改变
	oCash.on('click',function(){
		$(this).addClass('active');
		oLine.removeClass('active');
		oPayWay.val('1');
	})
	$('.online').on('click',function(){
		$(this).addClass('active');
		oCash.removeClass('active');
		oPayWay.val('2');
	})
	//提交
	oSub.on('click', function(e){
		if(!$.trim(oInputs.eq(0).val())){
			alert('请填写收货人！');
			oInputs.eq(0).focus();
			return false;
		};
		if(!$.trim(oInputs.eq(1).val())){
			alert('请填写联系电话！');
			oInputs.eq(1).focus();
			return false;
		};
		if(!$.trim(oInputs.eq(2).val())){
			alert('请填写宿舍楼！');
			oInputs.eq(2).focus();
			return false;
		};
		if(!$.trim(oInputs.eq(3).val())){
			alert('请填写宿舍房间号！');
			oInputs.eq(3).focus();
			return false;
		};
	});
});
