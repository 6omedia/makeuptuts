

jQuery(document).ready(function($){

	/*

		DISPLAYING WISHLIST

	*/

	var wishListBtn = $('#wishlist');
	var modal = $('.ws_modal');
	var ws_box = $('.ws_box');
	var loadingBox = $('.ws_box .loadingBox');
	var loginMsg = $('.ws_msg').hide();
	var wishListDisplay = $('.wishListDisplay').hide();
	var wishlist_list = $('#wishlist_list');
	// var removeProductBtn = $('.item-cross');

	function loadWishList(callback){

		jQuery.ajax({
	        type: "post",
	        dataType: "json",
	        url: wsAjax.ajaxurl,
	        data: {
	        	action: "wishlist_get_items"
	        },
	        success: function(data) {
	            callback(data);
	        },
	        error: function(xhr, desc, err){
	        	console.log(xhr, desc, err);
	        }
	    });

	}

	function openWishList(loggedIn){

		modal.fadeIn(200);
		modal.addClass('wsOpen');
		wishListBtn.addClass('wsOpen');

		if(loggedIn){
			loadWishList(function(data){
				// console.log(data);
				renderWishListTable(data.wishlist);
				loadingBox.fadeOut(200);
				wishListDisplay.fadeIn(200);
			});
		}else{

			loadingBox.hide();
			loginMsg.show();

		}
	
	}

	function closeWishList(){
		modal.fadeOut(200);
		modal.removeClass('wsOpen');
		wishListBtn.removeClass('wsOpen');
	}

	function cheapestMerchant(merchants){

		var merchant = {
			link: '',
			price: 10000
		};

		var priceLength = 0;
		if(merchants.price != null){
			priceLength = merchants.price.length;
		}

		for(var i=0; i<priceLength; i++){

			if(merchants.price[i] < merchant.price){
				merchant.price = merchants.price[i];
				merchant.link = merchants.link[i];
			}		

		}

		if(merchant.price == 10000){
			merchant.price = 0;
		}

		return merchant;

	}

	function removeFromWishList(productId, callback){

		// ajax php
		jQuery.ajax({
	        type: "post",
	        dataType: "json",
	        url: wsAjax.ajaxurl,
	        data: {
	        	action: "wishlist_remove_item", 
	        	productId: productId
	        },
	        success: function(data) {
	            callback(data);
	        },
	        error: function(xhr, desc, err){
	        	console.log('cdscds ', xhr, desc, err);
	        }
	    });

	}

	function renderWishListTable(wishlist){

		var string = '';

		if(wishlist.length > 0){

			for(var i=0; i<wishlist.length; i++){

				var merchant = cheapestMerchant(wishlist[i].merchants);

				string += '<li>';
				string += '<p>' + wishlist[i].title + '</p>';
				string += '<span> from £' + merchant.price + '</span>';
				string += '<a href="' + merchant.link + '" class="btn_style">Buy Best Price</a>';
				string += '<a href="' + wishlist[i].merchants.product_link + '" class="btn_style">View All Prices</a>';
				string += '<div class="item-cross" data-productid="' + wishlist[i].merchants.productId + '">x</div>';
				string += '</li>';
			}

		}else{
			string += '<li><p>Your wish list is empty</p></li>';
		}

		wishlist_list.empty();

		wishlist_list.append(string);

	}

	wishListBtn.on('click', function(){
		if(modal.hasClass('wsOpen')){	
			closeWishList();
		}else{
			openWishList(true);
		}
	});

	$('body').on('click', '.item-cross', function(){

		var productId = $(this).data('productid');
		removeFromWishList(productId, function(data){
			if(data.success == '1'){
				loadingBox.fadeIn(200);
				wishListDisplay.fadeOut(200);
				loadWishList(function(data){
					renderWishListTable(data.wishlist);
					loadingBox.fadeOut(200);
					wishListDisplay.fadeIn(200);
				});
			}else{
				alert('Could not remove from wishlist');
			}
		});

	});


	/*

		SAVING TO WISHLIST

	*/

	var addToWishListBtn = $('.ws_heart');

	function addToWishList(postId, callback){

		// ajax php
		jQuery.ajax({
	        type: "post",
	        dataType: "json",
	        url: wsAjax.ajaxurl,
	        data: {
	        	action: "wishlist_add_item", 
	        	postId: postId
	        },
	        success: function(data) {
	            callback(data);
	        },
	        error: function(xhr, desc, err){
	        	console.log('cdscds ', xhr, desc, err);
	        }
	    });
	
	}

	addToWishListBtn.on('click', function(){
		
		var span = $(this); 
		span.addClass('spining');

		var postId = jQuery(this).attr("data-post_id");

		addToWishList(postId, function(data){
			// change this to Added to WishList
			// stop spinner
			span.removeClass('spining');
			// change hart to tick
			if(data.success == '1'){
				span.addClass('ws_added');	
			}else{
				
				// span.append(loginBox);
				openWishList(false);

			}
			
		});

	});

	$('.so_modal').on('click', '.pop_ws_heart', function(){
		
		var span = $(this); 
		span.addClass('spining');

		var postId = jQuery(this).attr("data-post_id");

		addToWishList(postId, function(data){
			// change this to Added to WishList
			// stop spinner
			span.removeClass('spining');
			// change hart to tick
			if(data.success == '1'){
				span.addClass('ws_added');	
			}else{
				
				// span.append(loginBox);
				openWishList(false);

			}
			
		});

	});

	$('.where_to_buy_box').on('click', '.ws_added', function(){
		var thisSpan = $(this);
		var productId = $(this).data('post_id');
		removeFromWishList(productId, function(data){
			if(data.success == '1'){
				thisSpan.removeClass('ws_added');
			}
		});		
	});

	$('.ws_x').on('click', function(){
		closeWishList();
	});

});
