<?php
/**
 * eshop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eshop
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'eshop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eshop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on eshop, use a find and replace
		 * to change 'eshop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eshop', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'eshop' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'eshop_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'eshop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eshop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eshop_content_width', 640 );
}
add_action( 'after_setup_theme', 'eshop_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eshop_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'eshop' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'eshop' ),
			'before_widget' => '<div id="%1$s" class="single-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'eshop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eshop_scripts() {
	wp_enqueue_style( 'eshop-animate', get_template_directory_uri() . '/assets/css/animate.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-slider', get_template_directory_uri() . '/assets/css/flex-slider.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-magnific', get_template_directory_uri() . '/assets/css/magnific-popup.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-nice-select', get_template_directory_uri() . '/assets/css/nice-select.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-owl', get_template_directory_uri() . '/assets/css/owl-carousel.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-reset', get_template_directory_uri() . '/assets/css/reset.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-slicknav', get_template_directory_uri() . '/assets/css/slicknav.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-themify', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), _S_VERSION );
	wp_enqueue_style( 'eshop-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );

	wp_enqueue_script( 'eshop-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-easing', get_template_directory_uri() . '/assets/js/easing.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-fancybox', get_template_directory_uri() . '/assets/js/facnybox.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-finalcountdown', get_template_directory_uri() . '/assets/js/finalcountdown.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-flex-slider', get_template_directory_uri() . '/assets/js/flex-slider.js', array(), _S_VERSION, true );
//	wp_enqueue_script( 'eshop-gmap', get_template_directory_uri() . '/assets/js/gmap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-magnific', get_template_directory_uri() . '/assets/js/magnific-popup.js', array(), _S_VERSION, true );
//	wp_enqueue_script( 'eshop-map', get_template_directory_uri() . '/assets/js/map-script.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-niceselect', get_template_directory_uri() . '/assets/js/nicesellect.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-onepage-nav', get_template_directory_uri() . '/assets/js/onepage-nav.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-scrolllup', get_template_directory_uri() . '/assets/js/scrollup.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-slicknav', get_template_directory_uri() . '/assets/js/slicknav.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-wypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-ytplayer', get_template_directory_uri() . '/assets/js/ytplayer.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'eshop-active', get_template_directory_uri() . '/assets/js/active.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'ajax', get_template_directory_uri() . '/assets/js/ajax.js', array(), _S_VERSION, true );
	wp_localize_script('ajax', 'ajax_obj', array(
		'url' => admin_url('admin-ajax.php'),
		'redirecturl' => $_SERVER['REQUEST_URI'],
		'nonce' => wp_create_nonce('search-nonce'),
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eshop_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/ajax.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


