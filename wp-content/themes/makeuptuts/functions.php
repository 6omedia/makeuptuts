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
            'hair_nav' => __('Hair Nav'),
            'hair_cats' => __('Hair for category page')
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

    wp_register_script( 'wish_js', get_template_directory_uri() . '/js/wishlist.js', array('main_js') );
    wp_localize_script( 'wish_js', 'wsAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))); 
    wp_enqueue_script( 'wish_js' );
	
    if(is_page('register')){
        wp_enqueue_script( 'frontuser_js', get_template_directory_uri() . '/js/frontuser.js', array('main_js'), '', true);
    }

    if(is_page('shop')){
        wp_enqueue_script( 'shop_js', get_template_directory_uri() . '/js/shop.js', array('main_js'), '', true);
    }

    if(is_single()){
        wp_register_script( 'popupproducts_js', get_template_directory_uri() . '/js/popupproducts.js', array('wish_js'));
        wp_localize_script( 'popupproducts_js', 'ppAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))); 
        wp_enqueue_script( 'popupproducts_js' );
    }

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

/*************************** 

  Custom Login Stuff

****************************/

function mtuts_login_fail( $username ) {
     $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
     // if there's a valid referrer, and it's not the default log-in screen
     if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
          wp_redirect(home_url() . '/login/?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
          exit;
     }
}
add_action( 'wp_login_failed', 'mtuts_login_fail' );  // hook failed login

function add_lost_password_link() {
  return '<a class="forgotPasswordLink" href="' . home_url() . '/wp-login.php?action=lostpassword">Forgot Password?</a>';
}
add_action( 'login_form_middle', 'add_lost_password_link' );

function redirect_logged_in_user( $redirect_to = null ) {
    $user = wp_get_current_user();
    if ( user_can( $user, 'manage_options' ) ) {
        if ( $redirect_to ) {
            wp_safe_redirect( $redirect_to );
        } else {
            wp_redirect( admin_url() );
        }
    } else {
        wp_redirect( home_url( 'member-account' ) );
    }
}

// function redirect_to_custom_lostpassword() {
//     if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
//         if ( is_user_logged_in() ) {
//             redirect_logged_in_user();
//             exit;
//         }
 
//         wp_redirect( home_url( 'member-password-lost' ) );
//         exit;
//     }
// }
// add_action( 'login_form_lostpassword', 'redirect_to_custom_lostpassword' );

/**
 * Disable admin bar on the frontend of your website
 * for subscribers.
 */

function mtuts_disable_admin_bar() {
    if ( ! current_user_can('edit_posts') ) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action( 'after_setup_theme', 'mtuts_disable_admin_bar' );
 
/**
 * Redirect back to homepage and not allow access to
 * WP admin for Subscribers.
 */
function mtuts_redirect_admin(){
    if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
        wp_redirect( site_url() );
        exit;      
    }
}
add_action( 'admin_init', 'mtuts_redirect_admin' );

/* WISHLIST AJAX */

// require('functions/wishlist.php');
// $wishlist = new WishList();

function wishlist_add_item(){

    $response['success'] = '0';
    $response['loggedin'] = '0';

    // check logged in 
    global $current_user;

    if(!is_user_logged_in()){
        echo json_encode($response);
        die();
    }

    $response['loggedin'] = '1';
    $user = wp_get_current_user();

    // wishlist meta
    if($_POST['postId'] == ''){
        die();
    }

    $productIds = json_decode($_POST['postId']);

    $old_wishlist = get_user_meta($user->ID, 'wishlist', true);

    if (isset($old_wishlist) && is_array($old_wishlist)){
        //if we saved already more the one notes
        $old_wishlist = array_merge($old_wishlist, $productIds);
        if(update_user_meta( $user->ID, 'wishlist', $old_wishlist) != false)
            $response['success'] = '1';
            $response['ws'] = $old_wishlist;

    }
    if (isset($old_wishlist) && !is_array($old_wishlist)){
        //if we saved only one note before
        $new_wishlist = array($old_wishlist, $productIds);
        if(update_user_meta( $user->ID, 'wishlist', $new_wishlist) != false )
            $response['success'] = '1';
            $response['newws'] = $new_wishlist;
    
    }
    if (!isset($old_wishlist)){
        //first note we are saving fr this user
        if(update_user_meta( $user->ID, 'wishlist', $productIds) != false )
            $response['success'] = '1';
            $response['productId'] = $productId;
    
    }

    echo json_encode($response);
    die();

}

function wishlist_get_items(){

    $response['success'] = '0';
    $response['loggedin'] = '0';
    $response['error'] = '';
    $response['wishlist'] = [];

    // check logged in 
    global $current_user;

    if(!is_user_logged_in()){
        echo json_encode($response);
        die();
    }

    $response['loggedin'] = '1';
    $user = wp_get_current_user();

    $old_wishlist = get_user_meta($user->ID, 'wishlist', true);
    if (!isset($old_wishlist)){
        $response['error'] = 'Your wish list is currently empty';
        $response['success'] = '1';
    }
    if (isset($old_wishlist)){//we have notes. Removed the extra ! here.
        $response['success'] = '1';
        if(!empty($old_wishlist)){
            $args = array(
                'post_type' => 'affproducts',
                'post__in' => $old_wishlist
            );

            $posts = get_posts($args);

            foreach ($posts as $post) {
                $pArray = [];
               // $pArray['post'] = $post;
                $pArray['title'] = $post->post_title;
                $pArray['merchants']['price'] = get_post_meta($post->ID, 'prices', true);
                $pArray['merchants']['link'] = get_post_meta($post->ID, 'links', true);
                $pArray['merchants']['product_link'] = $post->guid;
                $pArray['merchants']['productId'] = $post->ID; 
                $response['wishlist'][] = $pArray;
            }

            $response['success'] = '1';

        }else{

            $response['success'] = '0';

        }
    }

    echo json_encode($response);
    die();    

}

function wishlist_remove_item(){

    $response['success'] = '0';
    $response['loggedin'] = '0';
    $response['error'] = '';

    // check logged in 
    global $current_user;

    if(!is_user_logged_in()){
        echo json_encode($response);
        die();
    }

    $response['loggedin'] = '1';
    $user = wp_get_current_user();

    $productId = false;

    if(isset($_POST['productId'])){
        if($_POST['productId'] != '' && $_POST['productId'] != undefined){
            $productId = $_POST['productId'];
        }
    }

    $productId = $_POST['productId'];
    $wishlist = get_user_meta($user->ID, 'wishlist', true);

    $response['wishlist_before'] = $wishlist;

    $productExists = true;

    while($productExists){

        if(($key = array_search($productId, $wishlist)) !== false) {
            unset($wishlist[$key]);
        }else{
            $productExists = false;
        }

    }
    
    $response['wishlist_after'] = $wishlist;

    if(update_user_meta( $user->ID, 'wishlist', $wishlist) != false )
            $response['success'] = '1';

    echo json_encode($response);
    die();    

}

function wishListClasses($productId){

    $wsHeart = 'ws_heart'; 
    $wsAdded = 'ws_heart ws_added';

    global $current_user;

    if(!is_user_logged_in()){
        return $wsHeart;
    }

    $wishlist = get_user_meta($current_user->ID, 'wishlist', true);

    if(!isset($wishlist)){
        return $wsHeart;
    }

    if(!is_array($wishlist)){
        return $wsHeart;
    }

    if(in_array($productId, $wishlist)){
        return $wsAdded;
    }else{
        return $wsHeart;
    }

}

add_action("wp_ajax_wishlist_add_item", "wishlist_add_item");
add_action("wp_ajax_wishlist_get_items", "wishlist_get_items");
add_action("wp_ajax_wishlist_remove_item", "wishlist_remove_item");

/* POPUP PRODUCTS */

// function getCheapestMerchant($merchants){
//     return $merchants[0];
// }

function getproduct_info_item(){

    // $response['success'] = '0';
    global $post; 

    $productId = $_POST['productid'];
    $productPost = get_post($productId);
    $response['product']['id'] = $productPost->ID; 
    $response['product']['link'] = home_url() . '/shop/' . $productPost->post_name;
    $response['product']['title'] = $productPost->post_title;
    $response['product']['img'] = get_the_post_thumbnail($productId);

    $custom = get_post_custom($productId);

    $merchants = [];

    $merchantNames = unserialize($custom['merchants'][0]);
    $merchantIds = unserialize($custom['merchantids'][0]);
    $merchantLinks = unserialize($custom['links'][0]);
    $merchantPrices = unserialize($custom['prices'][0]);

    $size = sizeof($merchantNames);

    for($i=0; $i<$size; $i++){
        $merchants[] = array(
            'name' => $merchantNames[$i],
            'id' => $merchantIds[$i],
            'link' => $merchantLinks[$i],
            'price' => $merchantPrices[$i]
        );
    }

    usort($merchants, function($a, $b){
        return $a['price'] - $b['price'];
    });

    $response['product']['merchants'] = $merchants;
    $response['ws_classes'] = wishListClasses($productId);

    echo json_encode($response);
    die();  

}

add_action("wp_ajax_getproduct_info_item", "getproduct_info_item");
add_action('wp_ajax_nopriv_getproduct_info_item', 'getproduct_info_item');

// require('inc/tutorial_content.php');
// $tutsContent = new TutsContent();

function mut_pagination() {
    global $wp_query;
    $big = 999999999;
    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?page=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false,
        'type' => 'array',
        'prev_next' => TRUE,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
            ));

    if (is_array($pages)) {
        $current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination">';
        foreach ($pages as $i => $page) {
            if ($current_page == 1 && $i == 0) {
                echo "<li class='active'>$page</li>";
            } else {
                if ($current_page != 1 && $current_page == $i) {
                    echo "<li class='active'>$page</li>";
                } else {
                    echo "<li>$page</li>";
                }
            }
        }
        echo '</ul>';
    }
}

?>