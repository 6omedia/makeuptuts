<?php

	class WishList {

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
		    $productId = $_POST['postId'];

		    $old_wishlist = get_user_meta($user->ID, 'wishlist', true);

		    if (isset($old_wishlist) && is_array($old_wishlist)){
		        //if we saved already more the one notes
		        $old_wishlist[] = $productId;
		        if(update_user_meta( $user->ID, 'wishlist', $old_wishlist) != false)
		            $response['success'] = '1';

		    }
		    if (isset($old_wishlist) && !is_array($old_wishlist)){
		        //if we saved only one note before
		        $new_wishlist = array($old_wishlist, $productId);
		        if(update_user_meta( $user->ID, 'wishlist', $new_wishlist) != false )
		            $response['success'] = '1';
		    
		    }
		    if (!isset($old_wishlist)){
		        //first note we are saving fr this user
		        if(update_user_meta( $user->ID, 'wishlist', $productId) != false )
		            $response['success'] = '1';
		    
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

		function __construct(){
			add_action("wp_ajax_wishlist_add_item", array($this, "wishlist_add_item"));
			add_action("wp_ajax_wishlist_get_items", array($this, "wishlist_get_items"));
			add_action("wp_ajax_wishlist_remove_item", array($this, "wishlist_remove_item"));
		}

	}

?>