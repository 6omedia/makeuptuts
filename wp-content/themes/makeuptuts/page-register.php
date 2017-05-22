<?php
/*
	Template Name: register
 */

	if(is_user_logged_in()){
        wp_redirect( home_url() );
		exit;
    }

    $err = '';
	$success = '';
	 
	global $wpdb, $PasswordHash, $current_user, $user_ID;
	 
	$pwd1 = '';
	$pwd2 = '';
	$first_name = '';
	$last_name = '';
	$email = '';
	$username = '';

	$pwd1_valid = 'valid';
	$pwd2_valid = 'valid';
	$first_name_valid = 'valid';
	$last_name_valid = 'valid';
	$email_valid = 'valid';
	$username_valid = 'valid';

	if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
		$pwd1 = $wpdb->escape(trim($_POST['pwd1']));
		$pwd2 = $wpdb->escape(trim($_POST['pwd2']));
		$first_name = $wpdb->escape(trim($_POST['first_name']));
		$last_name = $wpdb->escape(trim($_POST['last_name']));
		$email = $wpdb->escape(trim($_POST['email']));
		$username = $wpdb->escape(trim($_POST['username']));
		
		if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
			$err = 'Please don\'t leave the required fields.';

			if($pwd1 == "")
				$pwd1_valid = 'invalid';

			if($pwd2 == "")
				$pwd2_valid = 'invalid';

			if($first_name == "")
				$first_name_valid = 'invalid';

			if($last_name == "")
				$last_name_valid = 'invalid';

			if($email == "")
				$email_valid = 'invalid';

			if($username == "")
				$username_valid = 'invalid';


		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err = 'Invalid email address.';
			$email_valid = 'invalid';
		} else if(email_exists($email) ) {
			$err = 'Email already exist.';
			$email_valid = 'invalid';
		} else if($pwd1 <> $pwd2 ){
			$err = 'Password do not match.';
			$pwd1_valid = 'invalid';
			$pwd2_valid = 'invalid';		
		} else {

			$user_id = wp_insert_user( array ('first_name' => apply_filters('pre_user_first_name', $first_name), 'last_name' => apply_filters('pre_user_last_name', $last_name), 'user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
			if( is_wp_error($user_id) ) {
				$err = 'Error on user creation.';
			} else {
				do_action('user_register', $user_id);
				
				$success = 'You\'re successfully registered';
			}
			
		}
		
	}

?>

<?php get_header(); ?>

<section>
	<div class="container">
		<h1>Register</h1>
		<div class="loginForm registerForm">
			<form id="regForm" method="post">
				<h3>Don't have an account?<br /> Create one now.</h3>
				<div class="row">
					<div class="col-sm-6">
						<p><label>First Name</label></p>
						<p><input class="<?php echo $first_name_valid; ?>" type="text" value="<?php echo $first_name; ?>" name="first_name" id="first_name" /></p>
						<p><label>Last Name</label></p>
						<p><input class="<?php echo $last_name_valid; ?>" type="text" value="<?php echo $last_name; ?>" name="last_name" id="last_name" /></p>
						<p><label>Email</label></p>
						<p><input class="<?php echo $email_valid; ?>" type="text" value="<?php echo $email; ?>" name="email" id="email" /></p>
					</div>
					<div class="col-sm-6">
						<p><label>Username</label></p>
						<p><input class="<?php echo $username_valid; ?>" type="text" value="<?php echo $username; ?>" name="username" id="username" /></p>
						<p><label>Password</label></p>
						<p><input class="<?php echo $pwd1_valid; ?>" type="password" value="<?php echo $pwd1; ?>" name="pwd1" id="pwd1" /></p>
						<p><label>Password again</label></p>
						<p><input class="<?php echo $pwd2_valid; ?>" type="password" value="<?php echo $pwd2; ?>" name="pwd2" id="pwd2" /></p>
					</div>
				</div>
				<div class="errorBox">
					<?php if($success != "") { echo $success; } ?> <?php if($err != "") { echo $err; } ?>
				</div>
				<!-- <button type="submit" name="btnregister" class="button" id="submit">Submit</button> -->
				<button type="submit" class="button btn_style" id="submit">Submit</button>
				<input type="hidden" name="task" value="register" />
			</form>
		</div>
	</div>
</section>

<?php get_footer(); ?>