


<div class="ws_modal so_modal">
	
	<div class="ws_box">
		<div class="loadingBox">
			<img src="<?php bloginfo('template_directory'); ?>/img/ajax-loader.gif">
			<p>loading</p>
		</div>
		<div class="wishListDisplay">
			<h3>Wish List</h3>
			<ul class="list" id="wishlist_list"></ul>
		</div>
		<div class="ws_msg">
			<p>If you want to add products to your wish list, either login of register with us!</p>
			<a href="<?php echo home_url(); ?>/login">login</a><span>|</span><a href="<?php echo home_url(); ?>/register">Register</a>
		</div>
		<div class="ws_x"></div>
	</div>

</div>

<?php if(is_user_logged_in()){ ?>

		<div id="wishlist" class="wishlist">

		</div>

<?php } ?>