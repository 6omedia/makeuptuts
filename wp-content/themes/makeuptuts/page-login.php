<?php
/*
	Template Name: login
 */


	if(is_user_logged_in()){
        wp_redirect( home_url() );
		exit;
    }

?>

<?php get_header(); ?>

<section id="loginPage">
	<div class="container">
		<h1>Login</h1>

		<?php 

			if(isset($_GET['login'])){
				if($_GET['login'] == 'failed'){

					?>

					<div class="form_error">
						<?php echo 'Unable to login, incorrect username/password'; ?>			
					</div>

					<?php

				}
			} 

		?>

		<div class="loginForm">
			<?php 

				$args = array(
					'redirect' => home_url()
				);

				wp_login_form($args); 

			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>