<?php
/**
 * The template for displaying pages in category using Wordpress loop
 */

//Set parameters of displaying
$args=
	array(
		'numberposts' => 4,
		'category_name' =>'featured',
		'post_type' => 'page',
		'orderby' => 'rand'
	);
//Get pages with foreach cycle
$featured_pages= get_posts($args);
foreach( $featured_pages as $post ){ setup_postdata($post);?>
<div class="col-sm-6 col-md-3">
	<div class="thumbnail">
		<img
			src="<?php
                         $search= site_url('/');
                         $url = str_replace( $search,
	                         '',
	                         $image = get_field( 'image', $post ) );
					     echo( $url );
					     ?>"
			alt="...">
		<div class="caption">
			<span><?php the_title();?></span>
			<p>
				<a
					href="#"
					class="btn btn-primary"
					role="button">Add to cart
				</a>
				<a
					href="#"
					class="btn btn-default"
					role="button"><span>$</span><span><?php echo get_field( 'price', $post )?></span>
				</a>
			</p>
		</div>
	</div>
</div>
<?php } wp_reset_postdata();?>