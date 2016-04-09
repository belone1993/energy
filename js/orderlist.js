$(function(){
	var oDeletes = $('.delete-btn');
	oDeletes.on('click', function(){

		if(confirm('确定取消订单？')){
			_this = $(this);
			$.ajax({
					type: 'POST',
					url: './member/deleteorder.php',
					data: 'id='+_this.attr('data-id') + '&' + 'in_ok=zc_ok',
					
					success:function(response,status,xhr){
						if(response == 1){
							alert('成功取消！');
							location.reload();
						}else{
							alert('订单取消失败，请检查网络后重新取消。');
						}
					},
					error: function(){
						alert('订单取消失败，请检查网络后重新取消。');
					}
			})
		}
	});
});
