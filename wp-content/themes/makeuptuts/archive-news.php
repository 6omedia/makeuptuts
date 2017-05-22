<?php get_header(); ?>

	<section class="archive_page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1>News</h1>
					<?php $mostRecent = true; ?>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<?php if($mostRecent){ ?>
								
								<div class="row">
									<div class="col-sm-6">
										<a class="pinkHover" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
									<div class="col-sm-6">
										<h2><?php the_title(); ?></h2>
										<?php the_excerpt(); ?>
										<a class="readMore" href="<?php the_permalink(); ?>">Read More</a>
									</div>
								</div>

								<?php $mostRecent = false; ?>
								<div class="archivesAll">
								<div class="row">

							<?php }else{ ?>

								<div class="col-sm-3">
									<a href="<?php the_permalink(); ?>">
										<div class="archiveItem">
											<?php the_post_thumbnail(); ?>
											<h2><?php the_title(); ?></h2>
										</div>
									</a>
								</div>

							<?php } ?>

						<?php endwhile; else : ?>
						<?php endif; ?>

						</div>
						</div>
					</div>

					<?php wp_reset_query(); ?>

				</div>
				<!-- <div class="col-sm-3">
					<div class="side">
		                <?php // get_sidebar('archive'); ?>
		            </div>
				</div> -->
			</div>
		</div>
	</section>

<?php get_footer(); ?>