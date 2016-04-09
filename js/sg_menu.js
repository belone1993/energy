$(function(){
	function all_price_fn(){
		var all = 0;
		$('.order_list_price').each(function(){
			all += parseFloat($(this).html());
		})
		$('.all_price').html(all.toFixed(1));
	};
	
	function add_fn(){
		var _this = $(this);
		_this.prev().html(function(index,value){
			return parseInt(value) + 1;
		});
		_this.parents('.order_list_count').next().html(function(index,value){
			return (parseFloat(value) + parseFloat(_this.prevAll('.food_price').val())).toFixed(1);
		})
		$('.all_num').html(function(index,value){
			return parseInt(value) + 1;
		});
		all_price_fn();
		return false;
	}
	
	function reduce_fn(){
		var _this = $(this);
		_this.next().html(function(index,value){
			if(parseInt(value) == 1){
				_this.parents('.order_list').remove();
				return '0';
			}else{
				return parseInt(value) - 1;
			}
			});
		_this.parents('.order_list_count').next().html(function(index,value){
			return (parseFloat(value) - parseFloat(_this.prevAll('.food_price').val())).toFixed(1);
			});
		
		$('.all_num').html(function(index,value){
				return parseInt(value) - 1;
		});
		all_price_fn();
		return false;
	}
	
	$('.add').click(function(){
		var datetime = new Date();
		if(datetime.getDay() == 6 || datetime.getDay() ==0){
			alert('周末停止营业！');
			return false;
		};
		if(datetime.getHours() >= 23){
			alert('时间超过22：30停止下单！');
			return false;
		}else if(datetime.getHours() == 22 && datetime.getMinutes() >= 30){
			alert('时间超过22：30停止下单！');
			return false;
		};
		if(!$.cookie('user')){
			alert('您还未登录，请先登录！');
			location.href="login.php";
			return false;
		}
	
		var exist = false;
		_this = $(this);
		if ($('#order').find('ul').size() != 0) {
			$('#order').find('.order_list_name').each(function(index, value){
					if($(this).html() == _this.attr('data-name')){
						exist = true;
						$(this).next().find('.count_number').html(function(index,value){
							return parseInt(value) + 1;
						});
						var obj_price = $(this).next().find('.food_price');
						$(this).next().next().html(function(index,value){
							return (parseFloat(value) + parseFloat(obj_price.val())).toFixed(1);
						})
					};
			});
		};
		if(!exist){
			$('#order').prepend("<ul class='order_list'><li class='order_list_name'>" + $(this).attr('data-name') + "</li><li class='order_list_count'><input value='" + $(this).attr('data-price') + "' name='food_price' type='hidden' class='food_price'/><input value='" + $(this).attr('data-id') + "' name='food_id' type='hidden' class='food_id'/><input value='" + $(this).attr('data-name') + "' name='food_name' type='hidden' class='food_name'/><a class='count_reduce'>-</a><div class='count_number'>1</div><a  class='count_add'>+</a></li><li class='order_list_price'>" + $(this).attr('data-price') + "</li></ul>");
			$('.count_add').off('click',add_fn).on('click',add_fn);
			$('.count_reduce').off('click',reduce_fn).on('click',reduce_fn);
		}
		
		$('.all_num').html(function(index,value){
			return parseInt(value) + 1;
		});
		all_price_fn();
	});
	
	$('.count_add').on('click',add_fn);
	$('.count_reduce').on('click',reduce_fn);
	
	$('#clear').on('click',function(){
		if(confirm('确定要清空购物车？')){
			$('#order').html('');
			$('.all_price').html('0');
			$('.all_num').html('0');
		}
	});
	$('#sub').on('click',function(){
		if($('#order').find('ul').size() == 0){
			alert('购物车为空！');
			return false;
		};
		if(!confirm('确定要提交订单？')){
			return false;
		}else{
			var params = '';
			$('#order').find('ul').each(function(){
				params = params + $(this).find('.order_list_name').html() + '+' + $(this).find('.count_number').html() + '+' + $(this).find('.order_list_price').html() + '#';
			});
			$('.input_list').append('<input type="hidden" name="params" value="'+ params +'"/>');
		}
	})
})
