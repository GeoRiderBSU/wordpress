<?php
/**
 * The template for displaying the latest section
 *
 * Displays latest section and all include parts of this.
 */
?>
<section id="latest">
<div class="container">
	<div class="row">
		<div class="latest_title">
			<h1>Latest</h1>
			<div class="latest_control"><button class="btn"></button></div>
		</div>
		<div class="row">
			<div class="swiper-container">
				<div class="swiper-wrapper">
                    <?php get_template_part('/parts_template/latest-part-template'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
</div>
</section>