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