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
							<!-- <a id="selectAll">Select All</a> -->

							<?php

								require('functions/videoproduct.php');

								$popUpProducts = new PopUpProducts(get_field('video_times'));
								$popUpProducts->renderProductTable();

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

	<div class="tuts_modal so_modal">
		<div class="tuts_modal_box modal_box">
			<div class="loadingBox">
				<img src="<?php bloginfo('template_directory'); ?>/img/ajax-loader.gif">
				<p>loading</p>
			</div>
			<div class="tutsProductBox">
				<h3></h3>
				<div class="row">
					<div class="col-sm-5">
						<div id="tuts_productImg">
							
						</div>
					</div>
					<div class="col-sm-7">
						<div class="tuts_links">
							
						</div>
						<table id="popupTable">
							
						</table>
					</div>
				</div>
			</div>
			<div class="tuts_x popx"></div>
		</div>
	</div>

	<script>

		jQuery( document ).ready( function($) { 

			// var btnSelectAll = $('#selectAll');
			// var btnAddAll = $('#addAll');
			// var checkBoxes = $('#vid_product_list input[type=checkbox]');
			// btnAddAll.hide();

			// btnSelectAll.on('click', function(){

			// 	checkBoxes.css('display', 'inline-block');
			// 	btnAddAll.show();
			// 	$(this).css('color', '#ccc').css('outline', 'none');

			// });

			// btnAddAll.on('click', function(){

			// 	var spin = $('#spin');
			// 	var checked = $( "input:checked" );
			// 	var checkedLength = checked.length;

			// 	spin.css('display', 'inline-block');
			// 	$(this).hide();

			// 	checked.each(function( index ) {
			// 	  // console.log( index + ": " + $( this ).data('productid') );

			// 	  	var queryString = '?add-to-cart=' + $( this ).data('productid');

			// 		$.ajax({
			// 			url: queryString,
			// 			//type: 'GET',
			// 			//dataType: 'json',
			// 			data:
			// 			{

			// 			},
			// 			success: function(data)
			// 			{
			// 				// console.log('success.. ', data);

			// 				if(index == checkedLength-1){
			// 					window.location = 'basket';
			// 				}
					
			// 			},
			// 			error: function(xhr, desc, err)
			// 			{
			// 				// console.log('failed... ', xhr, desc, err);
			// 			}
			// 		});

			// 	});

			// });

		});
	</script>


<?php get_footer(); ?>