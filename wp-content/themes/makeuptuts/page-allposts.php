<?php
/*
	Template Name: All Posts
 */
?>

<?php get_header(); ?>

	<h1><?php the_title(); ?></h1>

	<div class="container">
		<div class="page_content">
			<?php
				if (have_posts()) : while (have_posts()) : the_post();

				the_content();

				endwhile; endif;
			?>
		</div>
	</div>

<?php get_footer(); ?>