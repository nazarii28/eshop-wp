<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package eshop
 */

get_header();
woocommerce_breadcrumb();
?>
    <!-- Start Blog Single -->
    <section class="blog-single section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="blog-single-main">
                        <div class="row">
                            <div class="col-12">
                                <div class="image">
                                    <?php echo get_the_post_thumbnail(); ?>
                                </div>
	                            <?php
                                    while ( have_posts() ) :
                                        the_post();

                                        get_template_part( 'template-parts/content', get_post_type() );


                                    endwhile; // End of the loop.
	                            ?>
                                <div class="share-social">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="content-tags">
                                                <h4>Tags:</h4>
                                                <ul class="tag-inner">
                                                    <?php
                                                    $tags = get_tags();
                                                    $html = '';
                                                    foreach ( $tags as $tag ) {
	                                                    $tag_link = get_tag_link( $tag->term_id );

	                                                    $html .= "<li><a href='{$tag_link}'>{$tag->name}</a></li>";
                                                    }
                                                    echo $html;
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="comments">
                                    <div class="comments">

		                                <?php
		                                $post_id = get_the_id();
		                                $args = array ('post_type' => 'post', 'post_id' => $post_id);
		                                $comments = get_comments( $args );
		                                $comments_count = count($comments);
		                                if($comments) {
			                                ?>
                                            <h3 class="comment-title">Comments (<?= $comments_count ?>)</h3>
			                                <?php
			                                wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments);
		                                }

		                                ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="reply">
                                    <div class="reply-head">
                                        <?php
                                        comment_form([
                                            'class_submit' => 'btn',
                                            'submit_button' => '<button type="submit" id="%2$s" class="%3$s">%4$s</button>',
                                            'title_reply_before' => '<h2 class="reply-title">',
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog Single -->




<?php
get_footer();
