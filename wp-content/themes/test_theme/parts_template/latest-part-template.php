<?php
/**
 * The template for displaying pages in category using Wordpress loop
 */
?>
<?php
//Set parameters of displaying
$args=
	array(
		'numberposts' => 0,
		'category_name' =>'latest',
		'post_type' => 'page',
	);
//Get pages with foreach cycle
$latest_pages= get_posts($args);
foreach( $latest_pages as $post ){ setup_postdata($post);?>
    <div class="swiper-slide">
        <div class="col-sm-6 col-md-3 product-1">
            <div class="thumbnail">
                <div>
                    <img class="latest_image"
                         src="<?php
                         $search= site_url('/');
                         $url = str_replace( $search,
						     '',
						     $image = get_field( 'image', $post ) );
					     echo( $url );
					     ?>" alt="...">
                    <div class="latest_buttons">
                        <button class="btn">Add to Compare</button>
                        <button class="btn">Add to Whishlist</button>
                    </div>
                </div>
                <div class="caption">
                    <span class="name_caption"><?php the_title(); ?></span>
                    <p><a href="#fn-modal" class="btn btn-primary fancybox" role="button" data-related-product="1">Add to
                            cart</a>
                        <a href="#" class="btn btn-default price"
                           role="button"><span>$</span><span><?php echo get_field( 'price', $post ) ?></span></a></p>
                </div>
            </div>
        </div>
    </div>
<?php } wp_reset_postdata();?>