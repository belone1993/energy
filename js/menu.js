$(function(){
	//保存DOM
	var lists = {},
		oMenus = $('.menu'),
		oMenusNav = $('.nav').eq(0),
		oShopList = $('.order-list').eq(0),
		oShopCount = $('.all').find('.all-number').eq(0),
		oShopPrice = $('.all').find('.all-price').eq(0),
		oShopClear = $('.clear').eq(0),
		shopCart = {},
		position = $('.j-position').eq(0).attr('data-pos'),
		url = (position == 'zc' ? '' : './yx_shoplist.php'),
		oSub = $('.u-submit').eq(0),
		oForm = $('#form'),
		nMenus = position == 'zc' ? 4 : 3; 
	
	if(position == 'zc'){
		//菜单列表	
		lists['0'] = lists['drink'] = [
			{ 
				"id": 1, 
				"name": "自煮豆浆(不加糖)", 
				"intro": "规格：300ml<br>包装：豆浆放在杯中，并封口", 
				"price": 2.0, 
				"img": "doujiang.png" 
			},	
			{ 
				"id": 2, 
				"name": "自煮豆浆(加糖)", 
				"intro": "规格：300ml<br>包装：豆浆放在杯中，并封口", 
				"price": 2.0, 
				"img": "doujiang.png" 
			},	
			{ 
				"id": 3, 
				"name": 
				"蒙牛纯牛奶无菌枕", 
				"intro": "净含量：240mL<br>保质期：45天<br>保存方法：常温避光保存", 
				"price": 2.2, 
				"img": "mncnn.png" 
			},	
			{ 
				"id": 4, 
				"name": "夏进早餐奶(麦香)", 
				"intro": "净含量：200mL<br>保质期：45天<br>保存方法：常温避光保存", 
				"price": 2.0, 
				"img": "zaocannai.png" 
			}
		];

		lists['2'] = lists['bread'] = [
			{ 
				"id": 7, "name": "葡萄干蛋糕卷", "intro": "规格：110g(4个装)<br >保质期:4天<br >保存条件：冷藏或置于阴凉干燥处", 
				"price": 5.0, 
				"img": "putaogan.png" 
			},	
			{ 
				"id": 8, 
				"name": "鸡腿汉堡面包", 
				"intro": "重量：140g <br >保质期：4天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 6.0,
				"img": "jtmb.png" 
			},	
			{ 
				"id": 9, 
				"name": "轻乳酪蒸蛋糕", 
				"intro": "重量：90g <br >保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 4.0, 
				"img": "qrl.png" 
			},	
			{ 
				"id": 10, 
				"name": "苹果派面包", 
				"intro": "重量：120g<br >保质期：6天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 3.0, 
				"img": "pgpmb.png" 
			},	
			{ 
				"id": 11, 
				"name": "吉士排包", 
				"intro": "重量：340g<br >保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 6.5, 
				"img": "jsp.png" 
			},	
			{ 
				"id": 12, 
				"name": "小吉士排包", 
				"intro": "重量：110g <br >保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 2.5, 
				"img": "xjsp.png" 
			},	
			{ 
				"id": 13, 
				"name": "切片面包", 
				"intro": "重量：330g<br > 保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 6.0, 
				"img": "qpmb.png" 
			},	
			{ 
				"id": 14, 
				"name": "全麦面包", 
				"intro": "重量：330g<br > 保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 6.0, 
				"img": "qmmb.png" 
			},	
			{ 
				"id": 15, 
				"name": "小热狗面包", 
				"intro": "重量：95g <br >保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 3.5, 
				"img": "xrg.png" 
			},	
			{ 
				"id": 16, 
				"name": "日式三明治", 
				"intro": "重量：95g<br > 保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 4.0, 
				"img": "rssmz.png" 
			},	
			{
			 	"id": 17, 
			 	"name": "醇熟切片面包", 
			 	"intro": "重量：400g<br > 保质期：5天<br >保存条件：冷藏或置于阴凉干燥处 ",
			 	 "price": 7.5, 
			 	 "img": "csqp.png" 
			},	
			{ 
				"id": 18, 
				"name": "鸡腿三明治", 
				"intro": "重量：130g<br >保质期：3天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 6.5, 
				"img": "jtsmz.png" 
			},	
			{ 
				"id": 19, 
				"name": "手撕面包", 
				"intro": "重量：160g<br > 保质期：6天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 5.0, 
				"img": "ssmb.png" 
			},	
			{ 
				"id": 20, 
				"name": "桃李鸡腿汉堡面包", 
				"intro": "重量：120g<br >保质期：4天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 4.5, 
				"img": "xjthb.png" 
			},	
			{ 
				"id": 21, 
				"name": "迷你豆沙面包", 
				"intro": "重量：170g<br > 保质期：6天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 5.0, 
				"img": "dsmb.png" 
			},	
			{ 
				"id": 22, 
				"name": "迷你奶香面包", 
				"intro": "重量：170g<br > 保质期：6天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 6.0, 
				"img": "nxmb.png" 
			},	
			{ 
				"id": 23, 
				"name": "葡萄干切片面包", 
				"intro": "重量：130g ，两片装<br >保质期：3天<br >保存条件：冷藏或置于阴凉干燥处 ", 
				"price": 3.5, 
				"img": "ptgqplpz.png" 
			}
		];

		lists['1'] = lists['food'] = [
			{
				"id": 24,
				"name": "油条",
				"intro": "店家现炸油条，美味可口",
				"price": 1.5,
				"img": "yt.png"
			},	
			{
				"id": 25,
				"name": "肉包子",
				"intro": "肉馅包子，大小比康桥的包子大不少，男生建议两个就能相当饱",
				"price": 1.2,
				"img": "bz.png"
			},	
			{
				"id": 26,
				"name": "菜包子",
				"intro": "菜馅包子，大小比康桥的包子大不少，男生建议两个就能相当饱",
				"price": 1.2,
				"img": "bz.png"
			},	
			{
				"id": 27,
				"name": "八宝稀饭",
				"intro": "装在杯中，并用封口机封好，附送吸管供食用",
				"price": 2.2,
				"img": "bbxf.png"
			},	
			{
				"id": 28,
				"name": "豆腐脑",
				"intro": "装在碗中，并附一次性汤勺",
				"price": 3.0,
				"img": "dfn.png"
			},	
			{
				"id": 29,
				"name": "茶叶蛋",
				"intro": "茶香浓郁，鲜香可口",
				"price": 1.5,
				"img": "cyd.png"
			},	
			{
				"id": 30,
				"name": "菜盒子",
				"intro": "小麦粉做皮，蔬菜和肉类做馅",
				"price": 2.0,
				"img": "chz.png"
			},	
			{
				"id": 31,
				"name": "糖糕",
				"intro": "糖糕以表皮松脆掉屑，内层软乎与白糖馅相得益彰而著名，较甜，请注意",
				"price": 1.2,
				"img": "tg.png"
			}
		];

		lists['3'] = lists['set'] = [
			{
				"id": 32,
				"name": "套餐A",
				"intro": "1杯豆浆+2个包子+1颗蛋",
				"price": 4.8,
				"img": "a.jpg"
			},	
			{
				"id": 33,
				"name": "套餐B",
				"intro": "1杯豆浆+1个包子+1个菜盒子",
				"price": 4.2,
				"img": "b.jpg"
			},	
			{
				"id": 34,
				"name": "套餐C",
				"intro": "1杯豆浆+2个油条",
				"price": 4.0,
				"img": "c.jpg"
			},	
			{
				"id": 35,
				"name": "套餐D",
				"intro": "1个八宝稀饭+1个油条+1颗蛋",
				"price": 4.2,
				"img": "d.jpg"
			},	
			{
				"id": 36,
				"name": "套餐E",
				"intro": "1个豆腐脑+1个油条+1颗蛋",
				"price": 4.8,
				"img": "e.jpg"
			}
		];
	}else{
		//设置夜宵导航
		$('.m-nav').find('a').removeClass('active');
		$('.m-nav').find('a').eq(2).addClass('active');

		lists['0'] = lists['food'] = [
			{
				"id": 37,
				"name": "炒细面",
				"intro": "",
				"price": 5.5,
				"img": "cxm.jpg"
			},	
			{
				"id": 38,
				"name": "炒河粉",
				"intro": "",
				"price": 5.5,
				"img": "chf.jpg"
			},	
			{
				"id": 39,
				"name": "炒饼",
				"intro": "",
				"price": 5.5,
				"img": "cb.jpg"
			},	
			{
				"id": 40,
				"name": "炒米粉",
				"intro": "",
				"price": 5.5,
				"img": "cmf.jpg"
			},	
			{
				"id": 41,
				"name": "炒拉条",
				"intro": "",
				"price": 5.5,
				"img": "clt.jpg"
			},	
			{
				"id": 42,
				"name": "蛋炒饭",
				"intro": "",
				"price": 5.5,
				"img": "dcf.jpg"
			},	
			{
				"id": 43,
				"name": "馄饨",
				"intro": "",
				"price": 5.5,
				"img": "hd.jpg"
			},	
			{
				"id": 44,
				"name": "馄饨面",
				"intro": "",
				"price": 6.5,
				"img": "hdm.jpg"
			},	
			{
				"id": 45,
				"name": "米线",
				"intro": "",
				"price": 5.5,
				"img": "mx.jpg"
			},	
			{
				"id": 46,
				"name": "麻辣(三鲜)粉",
				"intro": "",
				"price": 5.5,
				"img": "mlf.jpg"
			},	
			{
				"id": 47,
				"name": "汤河粉",
				"intro": "",
				"price": 5.5,
				"img": "thf.jpg"
			},	
			{
				"id": 48,
				"name": "汤米粉",
				"intro": "",
				"price": 5.5,
				"img": "tmf.jpg"
			},	
			{
				"id": 49,
				"name": "小笼包",
				"intro": "",
				"price": 4.5,
				"img": "xlb.jpg"
			},	
			{
				"id": 50,
				"name": "紫菜汤",
				"intro": "",
				"price": 3,
				"img": "zct.jpg"
			},	
			{
				"id": 51,
				"name": "紫菜蛋花汤",
				"intro": "",
				"price": 4,
				"img": "jdt.jpg"
			},	
			{
				"id": 52,
				"name": "骨头汤",
				"intro": "",
				"price": 2,
				"img": "gtt.jpg"
			}
		];

		lists['1'] = lists['drink'] = [
			{
				"id": 53,
				"name": "可口可乐",
				"intro": "",
				"price": 2.5,
				"img": "kele.jpg"
			},	
			{
				"id": 54,
				"name": "百事可乐",
				"intro": "",
				"price": 2.5,
				"img": "bskl.jpg"
			},	
			{
				"id": 55,
				"name": "冰峰",
				"intro": "",
				"price": 3.0,
				"img": "bf.jpg"
			},	
			{
				"id": 56,
				"name": "加多宝",
				"intro": "",
				"price": 4.0,
				"img": "jdb.jpg"
			},	
			{
				"id": 57,
				"name": "脉动",
				"intro": "",
				"price": 4.0,
				"img": "md.jpg"
			},	
			{
				"id": 58,
				"name": "经典奶茶",
				"intro": "",
				"price": 4.0,
				"img": "jdnc.jpg"
			},	
			{
				"id": 59,
				"name": "阿萨姆奶茶",
				"intro": "",
				"price": 4.0,
				"img": "asmnc.jpg"
			},	
			{
				"id": 60,
				"name": "果粒橙",
				"intro": "",
				"price": 3.5,
				"img": "glc.jpg"
			},	
			{
				"id": 61,
				"name": "鲜果橙",
				"intro": "",
				"price": 3.0,
				"img": "xgc.jpg"
			},	
			{
				"id": 62,
				"name": "冰红茶",
				"intro": "",
				"price": 3.0,
				"img": "bhc.jpg"
			},	
			{
				"id": 63,
				"name": "农夫山泉",
				"intro": "",
				"price": 2.0,
				"img": "nfsq.jpg"
			},	
			{
				"id": 64,
				"name": "椰汁",
				"intro": "",
				"price": 4.5,
				"img": "yz.jpg"
			},	
			{
				"id": 65,
				"name": "果缤纷",
				"intro": "",
				"price": 3.0,
				"img": "gbf.jpg"
			}
		];

		lists['2'] = lists['discount'] = [
			{
				"id": 66,
				"name": "炒细面2份",
				"intro": "",
				"price": 9.0,
				"img": "cxm.jpg"
			},	
			{
				"id": 67,
				"name": "炒河粉2份",
				"intro": "",
				"price": 9.0,
				"img": "chf.jpg"
			},	
			{
				"id": 68,
				"name": "炒饼2份",
				"intro": "",
				"price": 9.0,
				"img": "cb.jpg"
			},	
			{
				"id": 69,
				"name": "炒米粉2份",
				"intro": "",
				"price": 9.0,
				"img": "cmf.jpg"
			},	
			{
				"id": 70,
				"name": "炒拉条2份",
				"intro": "",
				"price": 9.0,
				"img": "clt.jpg"
			},	
			{
				"id": 71,
				"name": "蛋炒饭2份",
				"intro": "",
				"price": 9.0,
				"img": "dcf.jpg"
			}
		];
	}
	// oForm.attr('action', url);
	
	//生成菜单
	for(var i = 0; i < nMenus; i++){
		var tLists = lists[i],
			tStr = '',
			item;
		for(var j = 0, len = tLists.length; j < len; j++){
			item = tLists[j];
			tStr += '<li>' + 
						'<div class="img-box"><img src="./img/menu/' + position + '/' + item.img + '"></div>' +
						'<div class="name"><label>名称：</label><span>' + item.name + '</span></div>' +
						'<div class="price"><label>单价：</label><span>' + item.price + '元</span></div>' +
						'<div class="introduce"><label>说明：</label><span>' + item.intro + '</span></div>' +
						'<div><a href="javascript:void(0);" class="add" data-id="' + item.id + '" data-price="' + item.price + '" data-name="' + item.name + '">+加入购物车</a></div>'
					'</li>';
		}
		oMenus.eq(i).html(tStr);
	};
	//购物车是否存在菜单
	if(!!$.cookie('user') && JSON){
		var key = $.cookie('user') + '_' + position + '_shopcart';
		if(!!$.cookie(key)){
			shopCart = JSON.parse($.cookie(key));
			refreshCart();
		}
	}
	//导航点击切换菜单
	oMenusNav.on('click', function(e){
		var target = $(e.target),
			index = target.index();
		for(var i = 0; i < nMenus; i++) {
			oMenusNav.children().eq(i).removeClass('active');
			if(i == index){
				oMenus.eq(i).show();
			}else{
				oMenus.eq(i).hide();
			}
		}			
		target.addClass('active');
	});
	//加入购物车点击
	oMenus.on('click', function(e){
		var target = $(e.target);
		//不是点击加入购物不作处理
		if(!target.hasClass('add')){
			return;
		}
		//检测是否登录
		if(!$.cookie('user')){
		    alert('您还未登录，请先登录！');
		    location.href="./login.php";
			return false;
		}
		addItem(target.attr('data-id'), target.attr('data-name'), target.attr('data-price'));
	});
	//清空购物车
	oShopClear.on('click', function(e){
		if(confirm('确定要清空购物车？')){
			shopCart = {};
			refreshCart();
		}
	});
	//点击购物车中的+号 和 -号
	oShopList.on('click', function(e){
		var target = $(e.target);
		//点击购物车中的+号
		if(target.hasClass('add')){
			addItem(target.attr('data-id'), target.attr('data-name'), target.attr('data-price'));
		};
		//点击购物车中的-号
		if(target.hasClass('reduce')){
			var id = target.attr('data-id');
			var t = shopCart[id];
			t['count']--;
			if(t['count'] == 0){
				delete shopCart[id]
			}
			refreshCart();
		};
	})
	/**
	 * 添加新物品到购物车
	 */
	function addItem (id, name, price){
		//检测点击的物品是否已经在购物车里了
		if(shopCart[id] !== undefined){
			var t = shopCart[id];
			t['count']++;
		}else{
			//没有就存进shopCart里面
			var t = shopCart[id] = {};
			t['name'] = name;
			t['count'] = 1;
			t['price'] = parseFloat(price).toFixed(1);
		}
		//更新购物车
		refreshCart();
	}
	/**
	 * 更新购物车
	 */
	function refreshCart(){

		var itemStr = '',
			count = 0,
			price = 0;

		for(var i in shopCart){
			var t = shopCart[i];
			count += t['count'];
			price += parseFloat((parseFloat(t['price']) * t['count']).toFixed(1));
			itemStr +=  '<li class="order-item">' +
						   	'<span class="name">' + t['name'] + '</span>' +
						   	'<div class="count-box">' +
						   		'<a data-id="' + i + '" data-price="' + t['price'] + '" href="javascript:void(0);" class="reduce">-</a>' +
						   		'<span class="count" data-id="' + i + '" data-name="' + t['name'] + '" data-price="' + t['price'] + '">' + t['count'] + '</span>' +
						   		'<a href="javascript:void(0);" class="add" data-id="' + i + '" data-name="' + t['name'] + '" data-price="' + t['price'] + '">+</a>' +
						   	'</div>' +
						   	'<span class="price">' + (parseFloat(t['price']) * t['count']).toFixed(1) + '</span>' +
						'</li>';
		}

		oShopList.html(itemStr);
		oShopCount.html(count);
		oShopPrice.html(price.toFixed(1));
		
		if(!!JSON){
			var key = $.cookie('user') + '_' + position + '_shopcart';
			$.cookie(key, JSON.stringify(shopCart));
		}
	}
	/**
	 * 提交表单
	 */
	oSub.on('click', function(e){
		var isEmpty = true,
			params = '';
		for(var i in shopCart){
			isEmpty = false;
			break;
		}
		if(isEmpty) {
			alert('购物车不能为空！');
			return false;
		}
		if(!confirm('确定要提交订单吗？')){
			return false;
		}
		for(var i in shopCart){
			var t = shopCart[i];
			params += t['name'] + '+' + t['count'] + '+' + t['price'] + '&';
		}
		params = params.slice(0, -1);
		oForm.append('<input type="hidden" name="params" value="' + params + '"/>');
		oForm.append('<input type="hidden" name="position" value="' + position + '"/>');
		shopCart = {};
		refreshCart();
	});

})
