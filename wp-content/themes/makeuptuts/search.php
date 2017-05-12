
<?php get_header();	

	$currentlyViewing = 'All';

	if(isset($_POST['current'])){
		$currentlyViewing = $_POST['current'];
	}

?>

	<section id="searchPage">
		<div class="container">

			<form action="" method="post" id="search_filters">
				<h2>Filter By...</h2>
				<ul class="list">
					<li><button name="current" value="All" type="submit">All</button></li>
					<li><button name="current" value="post" type="submit">Tutorials</button></li>
					<li><button name="current" value="bestof" type="submit">Best Of</button></li>
					<li><button name="current" value="reviews" type="submit">Reviews</button></li>
					<li><button name="current" value="news" type="submit">News</button></li>
					<li><button name="current" value="tips" type="submit">Tips &amp; Tricks</button></li>
				</ul>
			</form>

			<?php

					//query_posts('post_type=' . $currentlyViewing);
				
				if($currentlyViewing == 'All'){

					$args = array(
						'post_type' =>  array(
											'post',
											'bestof',
											'reviews',
											'news',
											'tips' 
										),
						's' => $s
					);

					$query = new WP_Query($args);

				}else{

					$args = array(
						'post_type' => $currentlyViewing,
						's' => $s
					);

					$query = new WP_Query($args);

				}
		

			?>

			<h1 class="search-title">
			<?php echo $query->post_count; // $wp_query->found_posts; ?> <?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>"
			</h1>

			<div class="row">

				<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

					<div class="col-sm-6">
						<div class="row">
							<div class="searchItem">
								<div class="col-sm-5">
									<div class="img_box">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
									</div>
								</div>
								<div class="col-sm-7">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<p><?php echo excerpt2(16); ?></p>
									<?php if(get_post()->post_type == 'product'){ ?>
										<a href="<?php the_permalink(); ?>" class="readMore">View Product</a>
									<?php }else{ ?>
										<a href="<?php the_permalink(); ?>" class="readMore">Read More...</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

				<?php endwhile; else : ?>
				<?php endif; ?>

			<!-- 	<div class="paginationLinks">
					<div class="nav-previous alignleft"><?php // next_posts_link( 'Older posts' ); ?></div>
					<div class="nav-next alignright"><?php // previous_posts_link( 'Newer posts' ); ?></div>
				</div> -->

			</div> <!-- end of row -->
		</div>
	</section>

<?php get_footer(); ?>