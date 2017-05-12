
<?php get_header(); ?>

<div class="container">
    <section id="topPosts" class="hidden-xs">
        <div class="row">

            <?php

                $home_posts = [];

                $popularpost = new WP_Query( array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
                while ( $popularpost->have_posts() ) : $popularpost->the_post();

                    $post_obj = new stdClass();
                    $post_obj->title = get_the_title();
                    $post_obj->img = get_the_post_thumbnail();
                    $post_obj->url = get_permalink();
                    $home_posts[] = $post_obj;

                endwhile;
               
            ?>

            <div class="col-sm-3">
                <a href="<?php echo $home_posts[2]->url ?>">
                    <div class="side_video">
                        <?php echo $home_posts[2]->img ?>
                        <h3><?php echo $home_posts[2]->title ?></h3>
                    </div>
                </a>
                <a href="<?php echo $home_posts[1]->url ?>">
                    <div class="side_video">
                        <?php echo $home_posts[1]->img ?>
                        <h3><?php echo $home_posts[1]->title ?></h3>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="<?php echo $home_posts[0]->url ?>">
                    <div class="large_video">
                        <?php echo $home_posts[0]->img ?>
                    </div>
                    <h2><?php echo $home_posts[0]->title ?></h2>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="<?php echo $home_posts[3]->url ?>">
                    <div class="side_video">
                        <?php echo $home_posts[3]->img ?>
                        <h3><?php echo $home_posts[3]->title ?></h3>
                    </div>
                </a>
                <a href="<?php echo $home_posts[4]->url ?>">
                    <div class="side_video">
                        <?php echo $home_posts[4]->img ?>
                        <h3><?php echo $home_posts[4]->title ?></h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div> 

<div class="container">
    <div class="row">
        <div class="col-sm-9">

            <?php

                $args = array(
                    'posts_per_page' => 5
                );
                $the_query = new WP_Query( $args );

            ?>
            
            <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <div class="row">
                    <div class="homePost">
                        <div class="col-sm-5">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium' ); ?>     
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                            <?php echo custom_echo(get_field('summary'), 96); ?>
                            <p>
                                <a class="readMore" href="<?php the_permalink(); ?>">Read more...</a>
                            </p>
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

<?php get_footer(); ?>