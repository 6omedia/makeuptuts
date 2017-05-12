<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/fav.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if (is_page_template( 'page-generate.php' )){ echo '<meta name="robots" content="noindex,nofollow">'; } ?>

    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div class="isMobile" style="display: none"></div>
        <div class="pink_header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        
                        <ul class="list social_list">
                            <li class="fb"><a href=""></a></li>
                            <li class="tw"><a href=""></a></li>
                            <li class="pin"><a href=""></a></li>
                        </ul>

                    </div>
                    <div class="col-xs-6">

                        <ul class="list pink_menu">
                            <li><a href="">Shop</a></li>
                            <li>|</li>
                            <li><a href="">Login</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="nav_header">
            <div class="container">

                <div class="logo_container">
                    <a href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/mut_logo.png"></a>
                </div>

                <div class="nav_container">
                    <img id="burger" src="<?php bloginfo('template_directory'); ?>/img/burger.png">

                    <?php
                    
                        $defaults = array(
                            'container' => false,
                            'theme_location' => 'main-menu',
                            'menu_id' => 'main_nav',
                            'menu_class' => 'list'
                        );
                        
                        wp_nav_menu( $defaults );
                    
                    ?>
                </div>

                <div class="search_container">
                    <div class="search">
                        <div class="search-btn-cont">
                            <input id="searchsubmit">
                        </div>
                    </div>
                </div>

                <ul id="mob_navigation" class="list visible-xs">
                    <li class="looks"><a href="#">Looks</a></li>
                    <li class="link_makeup"><a href="#">MakeUp</a></li>
                    <li class="link_skincare"><a href="#">Skin Care</a></li>
                    <li class="link_hair"><a href="#">Hair</a></li>
                </ul>

            </div>
        </div>
    </header>

    <nav id="makeup_nav" class="second_nav">
        <div class="container">
            <?php

                $defaults = array(
                    'container' => false,
                    'theme_location' => 'makeup_nav',
                    'menu_class' => 'list'
                );
                
                wp_nav_menu( $defaults );                

            ?>
        </div>
    </nav>

    <nav id="skincare_nav" class="second_nav">
        <div class="container">
            <?php

                $defaults = array(
                    'container' => false,
                    'theme_location' => 'skincare_nav',
                    'menu_class' => 'list'
                );
                
                wp_nav_menu( $defaults );                

            ?>
        </div>
    </nav>

    <nav id="hair_nav" class="second_nav">
        <div class="container">
            <?php

                $defaults = array(
                    'container' => false,
                    'theme_location' => 'hair_nav',
                    'menu_class' => 'list'
                );
                
                wp_nav_menu( $defaults );                

            ?>
        </div>
    </nav>

    <section id="megaMenu">
       <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="trending">

                        <h2 id="trendingH2">TRENDING TUTORIALS</h2>
                        <div class="row">

                            <?php if( dynamic_sidebar('trending') ) : else : endif; ?>

                        </div>

                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="tutsCats">
                        <h2>TUTORIAL CATEGORIES</h2>
                        <?php
                            
                            $defaults = array(
                                'container' => false,
                                'theme_location' => 'cats_left',
                                'menu_id' => 'cats_left',
                                'menu_class' => 'list'
                            );
                            
                            wp_nav_menu( $defaults );
                        
                        ?>

                        <?php
                            
                            $defaults = array(
                                'container' => false,
                                'theme_location' => 'cats_right',
                                'menu_id' => 'cats_right',
                                'menu_class' => 'list'
                            );
                            
                            wp_nav_menu( $defaults );
                        
                        ?>

                    </div>
                </div>
            </div>

       </div>
    </section>

    <div id="search_popup">
        <div class="x search-x">x</div>
        <div class="search searchBox">
            <p>Search...</p>
          <!--   <div class="search-btn-cont"> -->
            <?php if( dynamic_sidebar('search') ) : else : endif; ?>
            <!-- </div> -->
        </div>
    </div>

    <script>
        
        jQuery(document).ready(function($){

            class dropDown {

                expand(li){

                    $('#main_nav li').each(function(){
                            
                        $(this).removeClass('ddSelected');

                    });

                    $('#mob_navigation li').each(function(){
                            
                        $(this).removeClass('ddSelected');

                    });

                    $('#megaMenu').css('height', '0px').css('padding-top', '0px');
                    $('#makeup_nav').css('height', '0px').css('padding-top', '0px');
                    $('#skincare_nav').css('height', '0px').css('padding-top', '0px');
                    $('#hair_nav').css('height', '0px').css('padding-top', '0px');

                    this.dropdown.css('height', this.navHeight).css('padding-top', this.padding);
                    li.addClass(this.selectedClass);

                }

                collapse(li){

                    this.dropdown.css('height', '0px').css('padding-top', '0px');
                    li.removeClass(this.selectedClass);

                }

                addListerners(navBtn, selected, dropdown){

                    const thisClass = this;

                    navBtn.on('click', function(){

                        if($(this).hasClass(selected)){

                            thisClass.collapse($(this));

                        }else{

                            thisClass.expand($(this));

                        }

                    });
                }

                constructor(navBtn, dropdown, navHeight, padding){
                    this.navBtn = navBtn;
                    this.dropdown = dropdown;
                    this.selectedClass = 'ddSelected';
                    this.navHeight = navHeight;
                    this.padding = padding;
                    this.addListerners(this.navBtn, this.selectedClass, this.dropdown);
                }

            }

            class Popup {

                popUp(message, customform){

                    let modal = '<div class="c_modal">';
                    modal += '<div class="box">';
                    modal += '<p>' + message + '</p>';

                    if(customform !== undefined){
                        modal += customform;
                    }else{
                        modal += '<button id="yes_btn">Yes</button>';
                        modal += '<button id="no_btn">No</button>';
                    }

                    modal += '</div>';
                    modal += '</div>';

                    $('body').append(modal);

                    const thisClass = this;

                    $('.c_modal').on('click', function(e){

                        if($(e.target).is('.box') || $(e.target).is('button') || $(e.target).is('input')){
                            e.preventDefault();
                            return;
                        }

                        thisClass.popDown();
                        
                    });

                }

                popDown(){

                    $('.c_modal').remove();
                    $('.c_modal').off();

                }

                constructor(positiveFunc, negativeFunc){
                    this.positiveFunc = positiveFunc;
                    this.negativeFunc = negativeFunc;
                }

            }

            let looksObj = {
                height: '390px',
                padding: '40px'
            };

            let makeupObj = {
                height: '370px',
                padding: '40px'
            };

            let skincareObj = {
                height: '265px',
                padding: '40px'
            };

            let hairObj = {
                height: '265px',
                padding: '40px'
            };

            if($('.isMobile').css('z-index') == '0'){

                // mobile
                looksObj.height = 'auto';
                looksObj.padding = '0px';
                makeupObj.height = 'auto';
                makeupObj.padding = '0px';
                skincareObj.height = 'auto';
                skincareObj.padding = '0px';
                hairObj.height = 'auto';
                hairObj.padding = '0px';

            }

            const looksDropdown = new dropDown($('.looks'), $('#megaMenu'), looksObj.height, looksObj.padding);
            const makeupDropdown = new dropDown($('.link_makeup'), $('#makeup_nav'), makeupObj.height, makeupObj.padding);
            const skincareDropdown = new dropDown($('.link_skincare'), $('#skincare_nav'), skincareObj.height, skincareObj.padding);
            const healthDropdown = new dropDown($('.link_hair'), $('#hair_nav'), hairObj.height, hairObj.padding);

            var burger = $('#burger');
            var mobNav = $('#main_nav');
            // var open = false;

            burger.on('click', function(){

                if(mobNav.hasClass('expanded')){
                    mobNav.removeClass('expanded');
                }else{
                    mobNav.addClass('expanded');
                }

            });

            $('#byCats').on('click', function(){
                $('#catsSide').addClass('catsexpanded');
            });

            $('.cat-x').on('click', function(){
                $('#catsSide').removeClass('catsexpanded');
            });

            // Shop side

            $('#shopByCats').on('click', function(){
                $('.shop_all_sidebar').addClass('catsexpanded');
            });

            $('.shop-x').on('click', function(){
                $('.shop_all_sidebar').removeClass('catsexpanded');
            });

            const searchPopup = $('#search_popup');

            $('.search-btn-cont #searchsubmit').on('click', function(){
                searchPopup.show(200);
            });

            $('.search-x').on('click', function(){
                searchPopup.hide(200);
            });

        });
        
    </script>