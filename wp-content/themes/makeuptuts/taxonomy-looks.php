
<?php get_header(); ?>

	<section id="looksPage">
		<div class="container">

			<h1><?php single_cat_title(); ?></h1>

			<?php $mostRecent = true; ?>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<?php if($mostRecent){ ?>

						<a href="<?php the_permalink(); ?>">
							<div class="mostRecentPost">
								<h2><?php the_title(); ?></h2>
								<?php the_post_thumbnail( 'medium' ); ?>
							</div>
						</a>
						<div class="row">

						<?php $mostRecent = false; ?>

					<?php }else{ ?>

					<div class="col-xs-6 col-sm-4">
						<a href="<?php the_permalink(); ?>">
							<div class="catPost">
								<!-- <h2><?php // the_title(); ?></h2> -->
								<?php the_post_thumbnail( 'medium' ); ?>
							</div>
						</a>
					</div>

					<?php } ?>

				<?php endwhile; else : ?>

				<?php endif; ?>

				<?php wp_reset_query(); ?>
			</div> <!-- closing row -->

		</div>
	</section>

<?php get_footer(); ?>