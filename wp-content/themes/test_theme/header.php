<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>;" charset="<?php bloginfo('charset'); ?>"/>
    <title><?php echo wp_get_document_title(); ?></title>
    <meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>
<body>
<!--Wrapper-->
<div id="wrapper">
    <header id="sub-header">
        <div class="container">
            <div class="row">
                <!--Site logo-->
                <div class="text-left-lg logo">
                    <a href="index.php">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png"></a>
                    <span>So turn the lights out</span>
                </div>
                <!--Show or not site menu in case of user login/logout-->
                <div class="text-right-lg shop-bar">

					<?php if (is_user_logged_in())
					{
						?>
                        <ul>
                            <li><a href="">Whish list</a></li>
                            <li><a href="">Shopping cart</a></li>
                            <li><a href="">Checkout</a></li>
                            <li><a href="<?php echo get_permalink(118) ?>">My account</a></li>
                            <li><a href="<?php echo get_permalink(116) ?>">Logout</a></li>
                        </ul>
                        <button class="basket_shop"></button>
						<?php
					}
					else
					{
						?>
                        <ul>
                            <li><a href="<?php echo get_permalink(110) ?>">Login</a></li>
                        </ul>
						<?php
					}
					?>
                </div>
            </div>
        </div>
    </header>
    <!--Navigation menu-->
    <header class="header">
        <div class="container">
            <div class="row">
                <nav id="navigation">
                    <ul >
                        <li><a href="">Desktops</a></li>
                        <li><a href="">Laptops & Notebooks</a>
                            <ul class="submenu">
                                <li><a href="">Sony</a></li>
                                <li><a href="">Android</a></li>
                                <li><a href="">Apple</a></li>
                                <li><a href="">Acer</a></li>
                                <li><a href="">HP</a></li>
                                <li><a href="">Intel</a></li>
                            </ul>

                        </li>
                        <li><a href="">Components</a></li>
                        <li><a href="">Tablets</a></li>
                        <li><a href="">Software</a></li>
                        <li><a href="">Phones & PDAs</a></li>
                        <li><a href="">Cameras</a></li>
                        <li><a href="">Contact</a></li>
                        <!--                       <li>--><?php //wp_nav_menu('theme_location=top-navigation'); ?><!--</li>-->
                    </ul>
                    <div id="box">
                        <div class="head"></div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!--Welcome message-->
    <div id="bottom_bat">
        <div class="container">
            <div class="row">
                <div class="call_for_login text-center-lg">
					<?php if (is_user_logged_in())
					{
						$current_user = wp_get_current_user();
						echo '<span>Welcome to our site '. $current_user->display_name .'!</span>';
					}
					else
					{
						?>
                        <span>Welcome visitor! You can login or create an account.</span>
						<?php
					}
					?>
                </div>
            </div>
        </div>
    </div>