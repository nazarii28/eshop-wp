<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'wp_ajax_search_action', 'esp_search_ajax_action_callback' );
add_action( 'wp_ajax_nopriv_search_action', 'esp_search_ajax_action_callback' );
function esp_search_ajax_action_callback() {

	if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}
	$arg              = array(
		'post_type'   => array( 'post', 'product' ),
		'post_status' => 'publish',
		's'           => sanitize_post($_POST['s']),
		'product_cat' => (sanitize_post($_POST['category']) == 'All Category') ? '' : sanitize_post($_POST['category']),
	);
	$query_ajax       = new WP_Query( $arg );
	$json_data['out'] = ob_start( PHP_OUTPUT_HANDLER_CLEANABLE );
	if ( $query_ajax->have_posts() ) {
		while ( $query_ajax->have_posts() ) {
			$query_ajax->the_post();
			?>
			<div class="res">
				<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
			</div>
			<?php
		}
	} else {
		?>
		<p>
			Ничего не найдено
		</p>
		<?php
	}
	$json_data['out'] .= ob_get_clean();
	wp_send_json( $json_data );
	wp_die();
}

add_action( 'wp_ajax_login_action', 'ajax_login' );
add_action( 'wp_ajax_nopriv_login_action', 'ajax_login' );

function ajax_login(){

	// Первым делом проверяем параметр безопасности
	if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}

	// Получаем данные из полей формы и проверяем их
	$info = array();
	$info['user_login'] = $_POST['username'];
	$info['user_password'] = $_POST['password'];
	$info['remember'] = true;

	$user_signon = wp_signon( $info, false );
	if ( is_wp_error($user_signon) ){
		echo json_encode(array('loggedin'=>false, 'message'=>__('Неправильный логин или пароль!')));
	} else {
		echo json_encode(array('loggedin'=>true, 'message'=>__('Отлично! Идет перенаправление...')));
	}

	die();
}

add_action( 'wp_ajax_register_action', 'ajax_register' );
add_action( 'wp_ajax_nopriv_register_action', 'ajax_register' );

function ajax_register() {
	// Первым делом проверяем параметр безопасности
	if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}

	// Получаем данные из полей формы и проверяем их
	$info = array();
	$info['user_login'] = $_POST['username'];
	$info['user_password'] = $_POST['password'];

	$user_register = wp_insert_user( $info );

	if ( is_wp_error($user_register) ){
		$error  = $user_register->get_error_codes() ;

		if(in_array('empty_user_login', $error))
			echo json_encode(array('loggedin'=>false, 'message'=>__($user_register->get_error_message('empty_user_login'))));
        elseif(in_array('existing_user_login',$error))
			echo json_encode(array('loggedin'=>false, 'message'=>__('This username is already registered.')));
        elseif(in_array('existing_user_email',$error))
			echo json_encode(array('loggedin'=>false, 'message'=>__('This email address is already registered.')));
	} else {
		echo json_encode(array('loggedin'=>true, 'message'=>__('Пользователь зарегестрирован')));
	}

	die();

}

add_action( 'wp_ajax_quickview_action', 'ajax_quickview' );
add_action( 'wp_ajax_nopriv_quickview_action', 'ajax_quickview' );

function ajax_quickview() {

	if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}


	$query_ajax = new WP_Query([
        'post_type' => 'product',
        'p' => $_POST['product_id']
    ]);
	$json_data['out'] = ob_start( PHP_OUTPUT_HANDLER_CLEANABLE );

	if ( $query_ajax->have_posts() ) {
		while ( $query_ajax->have_posts() ) {
			$query_ajax->the_post();
			?>
            <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'blog-single', $product ); ?>>
                <div class="row">
                    <div class="col-lg-6">
			            <?php
			            /**
			             * Hook: woocommerce_before_single_product_summary.
			             *
			             * @hooked woocommerce_show_product_sale_flash - 10
			             * @hooked woocommerce_show_product_images - 20
			             */
			            do_action( 'woocommerce_before_single_product_summary' );
			            ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="summary entry-summary">
				            <?php
				            /**
				             * Hook: woocommerce_single_product_summary.
				             *
				             * @hooked woocommerce_template_single_title - 5
				             * @hooked woocommerce_template_single_rating - 10
				             * @hooked woocommerce_template_single_price - 10
				             * @hooked woocommerce_template_single_excerpt - 20
				             * @hooked woocommerce_template_single_add_to_cart - 30
				             * @hooked woocommerce_template_single_meta - 40
				             * @hooked woocommerce_template_single_sharing - 50
				             * @hooked WC_Structured_Data::generate_product_data() - 60
				             */
				            do_action( 'woocommerce_single_product_summary' );
				            ?>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		}
	}
	$json_data['out'] .= ob_get_clean();
	wp_send_json( $json_data );
	wp_die();
}

add_action( 'wp_ajax_eshop_products_action', 'eshop_ajax_products' );
add_action( 'wp_ajax_nopriv_eshop_products_action', 'eshop_ajax_products' );


function eshop_ajax_products() {
	if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
		wp_die( 'Данные отправлены с левого адреса' );
	}

	$product_category = $_POST['category'];

	$arg = [
		'posts_per_page' => 4,
		'post_type' => 'product',
		'product_cat' => $product_category
	];

	$query_ajax = new WP_Query( $arg );

	$json_data['out'] = ob_start( PHP_OUTPUT_HANDLER_CLEANABLE );

	if ( $query_ajax->have_posts() ) {
		while ( $query_ajax->have_posts() ) {
			$query_ajax->the_post();
			global $product;
			?>
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="<?php echo get_permalink( $product->get_id() ); ?>">
							<?php echo $product->get_image('large') ?>

                        </a>
                        <div class="button-head">
                            <div class="product-action">
                                <a class="quickview-btn popup-trigger" data-id="<?= $product->get_id(); ?>" title="Quick View" href="#quickviewModal"><i class=" ti-eye"></i><span>Quick Shop</span></a>
								<?php if (!is_user_logged_in()) : ?>
                                    <a title="Wishlist" class="popup-trigger" href="#exampleModal"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                    <a title="Compare" class="popup-trigger" href="#exampleModal"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
								<?php else : ?>
                                    <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                    <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
								<?php endif; ?>
                            </div>
                            <div class="product-action-2">
								<?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="<?php echo get_permalink( $product->get_id() ); ?>"><?php the_title() ?></a></h3>
                        <div class="product-price">
                            <span><?php echo woocommerce_template_loop_price(); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
		}
	}

	$json_data['out'] .= ob_get_clean();
	wp_send_json( $json_data );
	wp_die();


}
