<?php 

add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

function excerpt2($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function mtuts_excerpt_length( $length ) {
	return 16;
}
add_filter( 'excerpt_length', 'mtuts_excerpt_length', 999 );

function mtuts_register_theme_menus() {
	
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu' ),
			'footer-menu' =>__( 'Footer Menu' ),
			'cats_left' => __('Category List Left'),
			'cats_right' => __('Category List Right'),
            'makeup_nav' => __('MakeUp Nav'),
            'skincare_nav' => __('Skincare Nav'),
            'hair_nav' => __('Hair Nav')
		)
	);
	
}

add_action( 'init', 'mtuts_register_theme_menus' );


function mtuts_create_widget( $name, $id, $description ) {

	register_sidebar(array(
		'name' => __( $name ),	 
		'id' => $id, 
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="module-heading">',
		'after_title' => '</h2>'
	));

}

mtuts_create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar' );
mtuts_create_widget( 'Search Sidebar', 'search', 'Displays the search box on the header' );
mtuts_create_widget( 'Trending Sidebar', 'trending', 'For the popular posts' );


function mtuts_theme_styles() {
	
	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style( 'googleFonts1_css', 'https://fonts.googleapis.com/css?family=Montserrat:400,700' );
	wp_enqueue_style( 'googleFonts_css', 'https://fonts.googleapis.com/css?family=Trirong:300,400,400i,700,700i' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'responsive_css', get_template_directory_uri() . '/css/responsive.css' );
	
}

add_action( 'wp_enqueue_scripts', 'mtuts_theme_styles' );

function mtuts_theme_js() {

	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true);
	// wp_enqueue_script( 'player_js', get_template_directory_uri() . '/js/player.js', array('jquery'), '', true);

}

add_action( 'wp_enqueue_scripts', 'mtuts_theme_js' );
add_filter( 'auto_update_plugin', '__return_false' );

// custom popular posts

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function custom_echo($x, $length){
  if(strlen($x)<=$length)
  {
    return $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    return $y;
  }
}

?>