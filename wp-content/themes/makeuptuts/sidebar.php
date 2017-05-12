<div class="sidebar">

	<?php
		$postId = '25';
	?>

	<?php if( dynamic_sidebar('page') ) : else : endif; ?>

	<!-- Recent Posts -->

	<?php 
	
		$cat = get_the_category(); 
		$cat = $cat[0]->cat_name; 

	?>

	<?php if(!is_home()){ ?>

		<h2>Related Posts</h2>
		<?php
			query_posts('category_name=' . $cat);
		?>

		<ul id="relatedPosts" class="list">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
					<!-- <a class="readMore" href="<?php // the_permalink(); ?>"><?php // the_title(); ?></a> -->
				</li>
				
			<?php endwhile; else : ?>
			<?php endif; ?>
			<?php wp_reset_query(); ?>

		</ul>

	<?php } ?>

</div>