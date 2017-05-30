<?php

	class PopUpProducts {

		private $productList = [];
		private $productIds = [];
		private $allAdded = false;

		function getProductList(){
			return $this->productList;
		}

		// function wishListClasses($productId){

		// 	$wsHeart = 'ws_heart'; 
		// 	$wsAdded = 'ws_heart ws_added';

		// 	global $current_user;

		//     if(!is_user_logged_in()){
		//         return $wsHeart;
		//     }

		//     $wishlist = get_user_meta($current_user->ID, 'wishlist', true);

		//     if(!isset($wishlist)){
		//     	return $wsHeart;
		//     }

		//     if(!is_array($wishlist)){
		//     	return $wsHeart;
		//     }

		//     if(in_array($productId, $wishlist)){
		//     	return $wsAdded;
		//     }else{
		//     	return $wsHeart;
		//     }

		// }

		function renderProductTable(){

				$disClass = '';

				if($this->allAdded == true){
					$disClass = 'disabled';
				}
		
			?>
			
				<a id="addAll" class="<?php echo $disClass; ?>">Add All To Wish List</a>
				<img id="spin" class="spin" src="<?php bloginfo('template_directory'); ?>/img/ajax-loader.gif">

				<table id="vid_product_list">
					<?php foreach ($this->productList as $product) { ?>

						<tr data-productid="<?php echo $product['id']; ?>">
							<td width="80px"><span><?php echo $product['time']; ?></span></td>
							<td><p class="tuts_product" ><?php echo $product['name']; ?></p></td>
							<td><span data-post_id="<?php echo $product['id']; ?>" class="<?php echo $product['ws_classes']; ?>"></span></td>
						</tr>

					<?php } ?>
				</table>

			<?php 		
		
		}

		function fillProductData($rawData){

			$times = explode(",", $rawData);

			foreach ($times as $time) {
				$pRow = explode("#", $time);
				$this->productIds[] = $pRow[1];
			}

			$productPosts = get_posts(array(
				'post_type' => 'affproducts',
				'post__in' => $this->productIds
			));

			$this->allAdded = true;

			for($i=0; $i<sizeof($productPosts); $i++){

				$tArray = explode('#', $times[$i]);

				$wsClasses = wishListClasses($productPosts[$i]->ID);

				if($wsClasses == 'ws_heart'){
					$this->allAdded = false;
				}

				$this->productList[$i]['id'] = $productPosts[$i]->ID;
				$this->productList[$i]['name'] = $productPosts[$i]->post_title;
				$this->productList[$i]['time'] = $tArray[0];
				$this->productList[$i]['ws_classes'] = $wsClasses;

			}

		}		

		function __construct($rawData){

			$this->fillProductData($rawData);

		}

	}

?>