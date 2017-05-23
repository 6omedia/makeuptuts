<?php

	class PopUpProducts {

		private $productList = [];
		private $productIds = [];

		function getProductList(){
			return $this->productList;
		}

		function renderProductTable(){

			?>
			
				<table id="vid_product_list">
					<?php foreach ($this->productList as $product) { ?>
					
						<tr data-productid="<?php echo $product['id']; ?>">
							<td width="80px"><span><?php echo $product['time']; ?></span></td>
							<td><p class="tuts_product" ><?php echo $product['name']; ?></p></td>
							<td><div class="add_wishlist"></div></td>
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

			for($i=0; $i<sizeof($productPosts); $i++){

				$tArray = explode('#', $times[$i]);

				$this->productList[$i]['id'] = $productPosts[$i]->ID;
				$this->productList[$i]['name'] = $productPosts[$i]->post_title;
				$this->productList[$i]['time'] = $tArray[0];	

			}

		}		

		function __construct($rawData){

			$this->fillProductData($rawData);

		}

	}

?>