<?php
/*The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
*  e.g., it puts together the home page when no home.php file exists.
*/
get_header();

//Template for Main slider
get_template_part('parts_template/main_slider');

//Template for Featured section
get_template_part('parts_template/featured');

//Template for Brands section
get_template_part('parts_template/brands');

//Template for Latest section
get_template_part('parts_template/latest');

//get_template_part('parts_template/latest-back-top');
//get_template_part('parts_template/latest-back-top2');

//Template for fancybox modal window
get_template_part('parts_template/fancybox');

get_footer();