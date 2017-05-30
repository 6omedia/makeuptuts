    
jQuery(document).ready(function($){

	var tutsModal = $('.tuts_modal');
	var tutsProduct = $('.tuts_product');

	var tutsLoadingBox = $('.tuts_modal_box .loadingBox');
	var tutsProductBox = $('.tutsProductBox').hide();

	var tuts_product_elems = {
		title: $('.tutsProductBox h3'),
		img: $('#tuts_productImg'),
		links: $('.tuts_links'),
		table: $('#popupTable')
	};

	var vid_products = $('#vid_product_list tr');
	var addAll = $('#addAll');

	class Product {

		appendLinks(link, linksElem, postId, ws_classes){

			var wsClasses = 'pop_ws_heart';

			if(ws_classes == 'ws_heart ws_added'){
				wsClasses = 'pop_ws_heart ws_added';
			}

			console.log('HJHBJKKBJ ', wsClasses);

			var moreDetails = $('<a>', 
									{
										"class": "alink",
										"href": link
									}
								).text('More Product Details');

			var addWs = $('<span>', 
								{
									"class": wsClasses,
									"data-post_id": postId
								}
						);

			linksElem.empty();
			linksElem.append(moreDetails);
			linksElem.append(addWs);

		}

		renderProduct(ws_classes){
			this.elems.title.text(this.title);
			this.elems.img.empty();
			this.elems.img.append(this.img);
			this.elems.table.empty();

			this.appendLinks(this.link, this.elems.links, this.id, ws_classes);

			var table = this.elems.table;
			
			$(this.merchants).each(function(){
				var string = '';
				string += '<tr>';
				string += '<td>' + this.name + '</td>';
				string += '<td>£' + this.price + '</td>';
				string += '<td><a target="_blank" class="btn_style" href="' + this.link + '">Buy</a></td>';
				string += '</tr>';
				table.append(string);
			});			
		}

		constructor(data, elems){
			this.id = data.id;
			this.title = data.title;
			this.img = data.img;
			this.link = data.link;
			this.merchants = data.merchants;

			this.elems = elems;
		}

	}

	function loadProduct(productid, callback){

		// console.log(ppAjax.ajaxurl);

		jQuery.ajax({
	        type: "post",
	        dataType: "json",
	        url: ppAjax.ajaxurl,
	        data: {
	        	action: "getproduct_info_item", 
	        	productid: productid
	        },
	        success: function(data) {
	            callback(data);
	        },
	        error: function(xhr, desc, err){
	        	console.log('cdscds ', xhr, desc, err);
	        }
	    });

	}

	function openProductModal(productid){
		tutsModal.fadeIn(200);
		tutsLoadingBox.fadeIn(200);
		tutsProductBox.fadeOut(200);
		loadProduct(productid, function(data){
			console.log('loadProduct: ', data);
			if(data.product != null){
				var product = new Product(data.product, tuts_product_elems);
				product.renderProduct(data.ws_classes);
				tutsLoadingBox.fadeOut(200);
				tutsProductBox.fadeIn(200);
			}else{
				alert('Something went wrong, please try again later');
			}
		});
	}

	function closeProductModal(){
		tutsModal.fadeOut(200);
	}

	function disableSelectAll(){
		addAll.addClass('disabled');
	}

	function enableSelectAll(){
		addAll.removeClass('disabled');
	}

	tutsProduct.on('click', function(){
		var tr = $(this).parent().parent();
		openProductModal($(tr).data('productid'));
	});

	$('.tuts_x').on('click', function(){
		closeProductModal();
	});

	addAll.on('click', function(){

		if(!$(this).hasClass('disabled')){

			var productArray = [];

			vid_products.each(function(){
				productArray.push($(this).data('productid'));
			});

			addToWishList(productArray, function(data){
				if(data.success == '1'){
					// tick all products
					vid_products.each(function(){
						$(this).find('.ws_heart').addClass('ws_added');
					});
					// disable select all
					disableSelectAll();
				}
			});

		}

	});

});