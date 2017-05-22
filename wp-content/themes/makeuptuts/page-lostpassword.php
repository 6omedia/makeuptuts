<?php
/*
	Template Name: lost password
 */


	if(is_user_logged_in()){
        wp_redirect( home_url() );
		exit;
    }

?>

<?php get_header(); ?>

<section id="loginPage">
	<div class="container">
		<h1>Lost Password</h1>

	</div>
</section>

<?php get_footer(); ?>