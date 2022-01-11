<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eshop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <base href="<?php echo get_template_directory_uri(); ?>/">

	<?php wp_head(); ?>
</head>

<body class="js">
<?php wp_body_open(); ?>

<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->


<!-- Header -->
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
                            <li><i class="ti-email"></i> support@shophub.com</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
	                        <?php if (!is_user_logged_in()) : ?>
                                <li><i class="ti-power-off"></i><a class="popup-trigger" href="#exampleModal">Login</a></li>
	                        <?php else : ?>
                                <li><i class="ti-power-off"><a href="<?php echo wp_logout_url(home_url()); ?>">Выход</a></i></li>
                                <li><i class="ti-user"></i> <a href="<?php the_permalink('12'); ?>">My account</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
	                    <?php
	                    the_custom_logo();
	                    ?>
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">

                        <div class="search-bar">
                            <select>
                                <option selected="selected">All Category</option>
	                            <?php
                                    $terms = get_terms( 'product_cat', [
                                        'hide_empty' => false,
                                    ] );

                                    foreach( $terms as $term ) :
                                    ?>
                                        <option><?= $term->name ?></option>

                                    <?php
                                    endforeach;
                                    ?>
                            </select>
                            <form>
                                <input name="search" id="search-inp" placeholder="Search Products Here....." type="search">
                                <button id="search-btn" class="btnn"><i class="ti-search"></i></button>
                            </form>
                            <div class="search-result"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar">
                            <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
	                    <?php if (is_user_logged_in()) : ?>
                            <div class="sinlge-bar">
                                <a href="<?php the_permalink('12'); ?>" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                            </div>
                        <?php endif; ?>

	                    <?php
	                    $instance = array(
		                    'title' => '',
	                    );

	                    the_widget( 'WC_Widget_Cart', $instance );
	                    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="all-category">
                            <h3 class="cat-heading" style="cursor: pointer;"><i class="fa fa-bars" aria-hidden="true"></i>Категории</h3>
                            <ul class="main-category" style="display: none;">
                                <?php
                                $terms = get_terms( [
	                                'taxonomy' => 'product_cat',
	                                'hide_empty' => false,
                                ] );
                                foreach ($terms as $category) {
                                    echo '<li><a href="'.get_term_link( $category->term_id ).'">'.$category->name.'</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
	                                        <?php
	                                        wp_nav_menu(
		                                        array(
			                                        'theme_location' => 'menu-1',
			                                        'menu_id'        => 'primary-menu',
			                                        'container'       => 'ul',
			                                        'menu_class'  => 'nav main-menu menu navbar-nav',
		                                        )
	                                        );
	                                        ?>
<!--                                            <li class="active"><a href="#">Home</a></li>-->
<!--                                            <li><a href="#">Product</a></li>-->
<!--                                            <li><a href="#">Service</a></li>-->
<!--                                            <li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>-->
<!--                                                <ul class="dropdown">-->
<!--                                                    <li><a href="cart.html">Cart</a></li>-->
<!--                                                    <li><a href="checkout.html">Checkout</a></li>-->
<!--                                                </ul>-->
<!--                                            </li>-->
<!--                                            <li><a href="#">Pages</a></li>-->
<!--                                            <li><a href="--><?php //echo get_permalink(70); ?><!--">Блог</a>-->
<!--                                            </li>-->
<!--                                            <li><a href="contact.html">Contact Us</a></li>-->
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->