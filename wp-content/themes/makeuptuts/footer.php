
    <?php

        // if(is_user_logged_in()){
        //     include('inc/wishlist.php');
        // }

        include('inc/wishlist.php');

    ?>


    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>Copyright &copy; 2016 Makeup Tutorials. All rights reserved.</p>
                    <ul class="list social_list">
                        <li class="fb"><a href=""></a></li>
                        <li class="tw"><a href="https://twitter.com/makeuptuts_"></a></li>
                        <li class="ig"><a href="https://www.instagram.com/makeuptutorialsco"></a></li>
                        <li class="pin"><a href="https://uk.pinterest.com/makeuptutorialsco"></a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <img src="<?php bloginfo('template_directory'); ?>/img/grey_logo.png">
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>

