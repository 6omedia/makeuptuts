<?php get_header(); ?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php wpb_set_post_views(get_the_ID()); ?>
			
						<div class="tutPost">
							<h1><?php the_title(); ?></h1>

							<div class="summary">
								<p>
									<?php echo get_field('summary'); ?>
								</p>
							</div>

							<?php echo get_field('youtube_video'); ?>

							<p class="video_src"><em>Source: </em><a href="<?php echo get_field('video_source'); ?>"><?php echo get_field('video_source_title'); ?></a></p>

							<h4>Share On...</h4>

							<?php echo get_dev_share_buttons(); ?>

							<h2>What You'll Need</h2>
							<a id="selectAll">Select All</a>
							<a id="addAll">Add Selected To Wish List</a>
							<img id="spin" class="spin" src="<?php bloginfo('template_directory'); ?>/img/ajax-loader.gif">

							<table id="vid_product_list">

							<?php

								$products = [];
								// $times = explode(",", get_field('video_times'));
								$times = explode("###", get_field('video_times'));

								$productSize = sizeof($times);
								$index = 0;

								for($i=0; $i<$productSize; $i++){	

									// times
									if($i % 3 == 0) {
										echo '<tr>';
										echo '<td width="80px"><span>' . $times[$i] . '</span></td>';
									}

									// names 
									if($i % 3 == 1) {

										$product = new stdClass(); 
										$product->id = $times[$i+1];

										// $productInfo = wc_get_product( $times[$i+1] );

										$product->title = 'Some Kind Of Lip Gloss'; // $productInfo->post->post_title;
										$product->price = '45'; // $productInfo->get_price();
										$product->desc = 'Yeah lip gloss and things its all good yeah'; //  $productInfo->post->post_content;
										$product->img = 'dfbbfd'; // $productInfo->get_image();
										$product->link = 'dsffvfdbf'; // $productInfo->post->guid;

										$products[] = $product;

										echo '<td><a href="" class="yith-wcqv-button lb_link" data-index="' . $index . '">' . $times[$i] . '</a></td>';
										echo '<td><input type="checkbox" data-productid="' . $times[$i+1] . '" checked></td>';

										$index++;

									}

								}

							?>

							</table>

							<?php

								// $modalString = '';
								// $size = sizeof($products);
								// for($i=0; $i<$size; $i++){

								// 	preg_match_all("/\[[^\]]*\]/", $products[$i]->desc, $matches);

								// 	foreach ($matches as $match) {
										
								// 		$products[$i]->desc = str_replace($match, '', $products[$i]->desc);

								// 	}	

								// 	$modalString .= '<div class="lb_modal">';
								// 	$modalString .= 	'<div class="lb">';
								// 	$modalString .= 		'<div class="container-fluid">';
								// 	$modalString .=				'<a href="' . $products[$i]->link . '"><h2>' . $products[$i]->title . '</h2></a>';
								// 	$modalString .= 		'<div class="row">';
								// 	$modalString .= 		'<div class="col-sm-4 lb_product_img">';
								// 	$modalString .=				$products[$i]->img;
								// 	$modalString .=			'</div>';
								// 	$modalString .= 		'<div class="col-sm-8">';
									
								// 	$modalString .=	        	'<p>' . custom_echo($products[$i]->desc, 250) .'</p>';
								// 	$modalString .=	        	'<p class="price">£' . $products[$i]->price . '</p>';
								// 	$modalString .=				'<a href="?add-to-cart=' . $products[$i]->id . '" class="button">Add to Cart</a>';
								// 	$modalString .= 			'</div>';
								// 	$modalString .= 			'</div>';
								// 	$modalString .=			'</div>';
								// 	$modalString .=		'</div>';
								// 	$modalString .=	'</div>';

								// }

								// echo $modalString;

							?>

							<div class="postContent">
								<?php the_content(); ?>
							</div>

							<div id="post_navigation">
								<div class="row">
									<div class="col-xs-6">
										<div class="row">
											<div class="hidden-xs col-sm-7">
												<div class="previmg">

													<?php

														$prevPost = get_previous_post();
											            $prevthumbnail = get_the_post_thumbnail($prevPost->ID);
											            previous_post_link('%link', $prevthumbnail);

													?>

												</div>
											</div>
											<div class="col-sm-5">
												<div class="prev">
													<h3><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Previous</h3>
													<?php previous_post_link('%link'); ?> 
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="row">
											<div class="col-sm-5">
												<div class="next">
													<h3>Next <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></h3>
													<?php next_post_link('%link'); ?> 
												</div>
											</div>
											<div class="hidden-xs col-sm-7">
												<div class="nextimg">

													<?php

														$nextPost = get_next_post();
											            $nextThumbnail = get_the_post_thumbnail($nextPost->ID);
											            previous_post_link('%link', $nextThumbnail);

													?>

												</div>
											</div>											
										</div>
									</div>
								</div>
								
							</div>

						</div>

					<?php endwhile; else : ?>

					<?php endif; ?>

				</div>
				<div class="col-sm-3">
					<div class="side">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>

		jQuery( document ).ready( function($) { 

			var btnSelectAll = $('#selectAll');
			var btnAddAll = $('#addAll');
			var checkBoxes = $('#vid_product_list input[type=checkbox]');
			btnAddAll.hide();

			// var lb_link = $('.lb_link');
			// var lb_modal = $('.lb_modal');

			// lb_link.on('click', function(event){

			// 	var modalPosition = $(this).data('index');
			// 	console.log(modalPosition);
			// 	popUp(modalPosition);

			// 	event.preventDefault();

			// });

			// $('.lb_modal').on('click', function(){
			// 	popDown();
			// });

			// function popUp(modalPosition){

			// //	console.log(modalPosition);
			// 	lb_modal.eq(modalPosition).fadeIn(200);
				
			// }

			// function popDown(){
			// 	lb_modal.fadeOut(200);
			// }

			btnSelectAll.on('click', function(){

				checkBoxes.css('display', 'inline-block');
				btnAddAll.show();
				$(this).css('color', '#ccc').css('outline', 'none');

			});

			btnAddAll.on('click', function(){

				var spin = $('#spin');
				var checked = $( "input:checked" );
				var checkedLength = checked.length;

				spin.css('display', 'inline-block');
				$(this).hide();

				checked.each(function( index ) {
				  // console.log( index + ": " + $( this ).data('productid') );

				  	var queryString = '?add-to-cart=' + $( this ).data('productid');

					$.ajax({
						url: queryString,
						//type: 'GET',
						//dataType: 'json',
						data:
						{

						},
						success: function(data)
						{
							// console.log('success.. ', data);

							if(index == checkedLength-1){
								window.location = 'basket';
							}
					
						},
						error: function(xhr, desc, err)
						{
							// console.log('failed... ', xhr, desc, err);
						}
					});

				});

			});

		});
	</script>


<?php get_footer(); ?>