<?php 

/* WISHLIST AJAX */

function wishlist_add_item(){

    if ( !wp_verify_nonce( $_REQUEST['nonce'], "wishlist_add_item_nonce") ) {
        exit("No naughty business");
    }   

    $response['yeah'] = 'yeah it worked';

    echo json_encode($response);

    die();

}

function wishlist_must_login(){
    echo "You must log in to add to wish list";
    die();
}

add_action("wp_ajax_wishlist_add_item", "wishlist_add_item");
add_action("wp_ajax_nopriv_wishlist_must_login", "wishlist_must_login");

?>