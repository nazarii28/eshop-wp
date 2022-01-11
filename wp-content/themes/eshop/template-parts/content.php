<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eshop
 */

?>

<div class="blog-detail">
    <h2 class="blog-title"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h2>
    <div class="blog-meta">
        <span class="author">
            <a href="#"><i class="fa fa-user"></i><?php the_author(); ?></a><a href="#"><i class="fa fa-calendar"></i><?php the_date('j F, Y'); ?></a><a href="#"><i class="fa fa-comments"></i>Comment (15)</a></span>
    </div>
    <div class="content">
    <?php the_content(); ?>
    </div>
</div>

