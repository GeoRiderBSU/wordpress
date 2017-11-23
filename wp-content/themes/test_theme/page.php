<?php
/**
 * The template for displaying single page
 */
?>
<?php
get_header();

?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="entry-content">
					<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					?>
            </div><!-- .entry-content -->
        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->
<?php
//	 } wp_reset_postdata();
get_footer();
?>
