<?php
/*
Template Name: Главная страница
*/
get_header();
?>
	<!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider" style="background-image: url('<?php echo wp_get_attachment_image_url(get_field('banner_image'), 'full'); ?>')">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span> <?php the_field('banner_subtitle') ?> </span><?php the_field('banner_title') ?></h1>
										<p><?php the_field('banner_text') ?></p>
										<div class="button">
											<a href="<?php the_field('banner_link') ?>" class="btn"><?php the_field('banner_button') ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->

	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
                <?php $banners = get_field('banners'); ?>
				<?php
                foreach ($banners as $item) {
                    ?>
                    <!-- Single Banner  -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-banner">
                            <img src="<?php echo $item['banners_image'] ?>" alt="<?php echo $item['banners_title'] ?>">
                            <div class="content">
                                <p><?php echo $item['banners_subtitle'] ?></p>
                                <h3><?php echo $item['banners_title'] ?></h3>
                                <a href="<?php echo $item['banners_link'] ?>"><?php echo $item['banners_button'] ?></a>
                            </div>
                        </div>
                    </div>
                    <!-- /End Single Banner  -->
                    <?php
                }
                ?>
			</div>
		</div>
	</section>
	<!-- End Small Banner -->

	<!-- Start Product Area -->
	<div class="product-area section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Trending Item</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="product-info">
						<div class="nav-main">
							<!-- Tab Nav -->
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item"><a data-category="woman" class="nav-link home_category_button active" href="#man">Женская одежда</a></li>
								<li class="nav-item"><a data-category="mans" class="nav-link home_category_button" href="#women">Мужская одежда</a></li>
								<li class="nav-item"><a data-category="kids" class="nav-link home_category_button" href="#kids">Для детей</a></li>
								<li class="nav-item"><a data-category="misc" class="nav-link home_category_button" href="#accessories">Аксесуары</a></li>
							</ul>
							<!--/ End Tabhome_category_button Nav -->
						</div>
						<div class="tab-content" id="myTabContent">
							<!-- Start Single Tab -->
							<div class="tab-pane fade show active">
								<div class="tab-single trending_products">
									<div class="row">
										<?php
										global $post;

										$myposts = get_posts( [
											'posts_per_page' => 4,
											'post_type' => 'product',
											'product_cat' => 'woman'
										] );

										foreach( $myposts as $post ){
											setup_postdata( $post );
											global $product;
											include('wp-content/themes/eshop/woocommerce/home-product.php');
										}
										wp_reset_postdata();
										?>

									</div>
								</div>
							</div>
							<!--/ End Single Tab -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Area -->

	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="https://via.placeholder.com/600x370" alt="#">
						<div class="content">
							<p>Man's Collectons</p>
							<h3>Man's items <br>Up to<span> 50%</span></h3>
							<a href="#">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="https://via.placeholder.com/600x370" alt="#">
						<div class="content">
							<p>shoes women</p>
							<h3>mid season <br> up to <span>70%</span></h3>
							<a href="#" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->

	<!-- Start Shop Blog  -->
	<section class="shop-blog section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>From Our Blog</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<?php
				global $post;

                    $myposts = get_posts( [
                        'posts_per_page' => 3,
                        'post_type' => 'post',
                    ] );

                    foreach( $myposts as $post ){
                        setup_postdata( $post );
                        ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Single Blog  -->
                            <div class="shop-single-blog">
                               <?php
                                if (get_the_post_thumbnail_url()):
                                ?>
                                 <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="#">
                                <?php
                                    else:
                               ?>
                                    <img src="https://via.placeholder.com/370x300" alt="#">
                                <?php
                                    endif;
                                ?>
                                <div class="content">
                                    <p class="date"><?php the_date('j F, Y. l'); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                                    <a href="<?php the_permalink(); ?>" class="more-btn">Continue Reading</a>
                                </div>
                            </div>
                            <!-- End Single Blog  -->
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<!-- End Shop Blog  -->

	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->
<?php
get_footer();
