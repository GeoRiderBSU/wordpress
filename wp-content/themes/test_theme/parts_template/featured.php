<?php
/**
 * The template for displaying the featured section
 *
 * Displays content for featured section .
 */
?>
<section id="featured">
	<div class="container">
		<div class="row">
			<div class="featured_title btn_active">
				<h1>Featured</h1>
				<div class="featured_control"><button class="btn"></button></div>
			</div>
			<div class="row">
				<?php get_template_part('/parts_template/featured-part-template')?>
			</div>
		</div>
	</div>
</section>
