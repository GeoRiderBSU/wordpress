<?php
/**
 * The template for displaying the brands section
 *
 * Displays content of brands section.
 */
?>
<section id="brands">
    <div class="container">
        <div class="row">
            <div class="brands_title">
                <h1>Brands</h1>
                <div class="brands_control"></div>
            </div>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="grow"
                             src="<?php echo esc_url(get_template_directory_uri()); ?>/images/brands/01.jpg"/>
                    </div>
                    <div class="swiper-slide">
                        <img class="grow"
                             src="<?php echo esc_url(get_template_directory_uri()); ?>/images/brands/02.jpg"/>
                    </div>
                    <div class="swiper-slide">
                        <img class="grow"
                             src="<?php echo esc_url(get_template_directory_uri()); ?>/images/brands/03.jpg"/>
                    </div>
                    <div class="swiper-slide">
                        <img class="grow"
                             src="<?php echo esc_url(get_template_directory_uri()); ?>/images/brands/04.jpg"/>
                    </div>
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>
