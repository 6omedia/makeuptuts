
<?php get_header(); ?>

	<section id="category_page">
		<div class="container">

			<p class="visible-xs" id="byCats">By Category...</p>

			<h1><?php single_cat_title(); ?></h1>

			<div class="row">
				<div class="col-sm-3">
					<div class="side" id="catsSide">
						<div class="x cat-x visible-xs">x</div>

						<h2>MakeUp</h2>
						<?php

			                $defaults = array(
			                    'container' => false,
			                    'theme_location' => 'makeup_nav',
			                    'menu_class' => 'list product_cat_list'
			                );
			                
			                wp_nav_menu( $defaults );                

			            ?>

						<h2>Skin Care</h2>
						<?php

			                $defaults = array(
			                    'container' => false,
			                    'theme_location' => 'skincare_nav',
			                    'menu_class' => 'list product_cat_list'
			                );
			                
			                wp_nav_menu( $defaults );                

			            ?>

			            <h2>Hair</h2>
						<?php

			                $defaults = array(
			                    'container' => false,
			                    'theme_location' => 'hair_cats',
			                    'menu_class' => 'list product_cat_list'
			                );
			                
			                wp_nav_menu( $defaults );                

			            ?>

					</div>
				</div>
				<div class="col-sm-9">

					<?php

						$postType = 'any';

						if(isset($_POST['muPostType'])){
							// echo 'njknklnl' . $_POST['muPostType']; 
							$postType = $_POST['muPostType'];
						}

						$cat = get_queried_object();
						$cat = $cat->slug;

						$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

						$args = array(
							'post_type' => $postType,
							'category_name' => $cat, 
							'posts_per_page' => 12,
							'paged' => $paged
						);

						$query = new WP_Query( $args );

						// $current1 = "currentFilter";

						$current1 = "";

						if($postType == 'any'){
							$current1 = "currentFilter";							
						}

						$current2 = "";

						if($postType == 'post'){
							$current2 = "currentFilter";							
						}

						$current3 = "";

						if($postType == 'bestof'){
							$current3 = "currentFilter";							
						}

						$current4 = "";

						if($postType == 'reviews'){
							$current4 = "currentFilter";							
						}

						$current5 = "";

						if($postType == 'news'){
							$current5 = "currentFilter";							
						}

						$current6 = "";

						if($postType == 'tips'){
							$current6 = "currentFilter";							
						}

					?>

					<form action="" method="post">
						<ul class="list theFilters">
							<li class="<?php echo $current1; ?>"><button name="muPostType" value="any" type="submit">All</button></li>
							<li class="<?php echo $current2; ?>"><button name="muPostType" value="post" type="submit">Tutorials</button></li>
							<li class="<?php echo $current3; ?>"><button name="muPostType" value="bestof" type="submit">Best Of</button></li>
							<li class="<?php echo $current4; ?>"><button name="muPostType" value="reviews" type="submit">Reviews</button></li>
							<li class="<?php echo $current5; ?>"><button name="muPostType" value="news" type="submit">News</button></li>
							<li class="<?php echo $current6; ?>"><button name="muPostType" value="tips" type="submit">Tips &amp; Tricks</button></li>
						</ul>
					</form>

					<div class="row">

						<?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>

							<div class="col-xs-6 col-sm-4 col-md-4">
								<a href="<?php the_permalink(); ?>">
									<div class="review_item">

										<h2><?php the_title(); ?></h2>
										<?php the_post_thumbnail(); ?>

									</div>
								</a>	
							</div>

						<?php endwhile; endif; wp_reset_postdata(); ?>

					</div>
						
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>