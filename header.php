<?php

/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @author : monamedia
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <!-- Meta
                ================================================== -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">
    <?php wp_site_icon(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="stylesheet" href="<?php echo get_site_url() ?>/template/css/styles.css" />
    <link rel="stylesheet" href="<?php echo get_site_url() ?>/template/css/backdoor.css" />
    <?php wp_head(); ?>
</head>
<?php
if (wp_is_mobile()) {
    $body = 'mobile-detect';
} else {
    $body = 'desktop-detect';
}
?>

<body <?php body_class($body); ?>>
    
    <div class="wrapper">
        <div id="page-loading">
            <img src="<?php echo site_url(); ?>/template/images/logo-1.png" alt="" />
        </div>
        <?php $classHeder = 'aos-init aos-animate';
        if (is_front_page())
            $classHeder = 'header-home';
        ?>
        <header class="header <?php echo $classHeder ?>">
            <div class="container">
                <div class="header__inner">
                    <div class="logo">
                        <?php echo get_custom_logo(); ?>
                    </div>
                    <div class="header-desktop">
                        <?php
                        wp_nav_menu(array(
                            'container' => false,
                            'container_class' => 'nav-ul',
                            'menu_class' => 'header__list',
                            'theme_location' => 'primary-menu',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'fallback_cb' => false,
                        ));
                        ?>
                    </div>
                    <div class="header__list-wrap header-fixed">
                        <div class="header__list-inner">
                            <div class="logo">
                                <?php echo get_custom_logo(); ?>
                            </div>
                            <?php
                            wp_nav_menu(array(
                                'container' => false,
                                'container_class' => 'nav-ul',
                                'menu_class' => 'header__list',
                                'theme_location' => 'main-menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'fallback_cb' => false,
                            ));
                            ?>
                            <ul class="social-mobile">
                                <?php get_template_part('patch/social', 'icon'); ?>
                            </ul>
                        </div>
                        <div class="overlay"></div>
                    </div>
                    <?php if (is_user_logged_in(  )) {
                        $UserClass = new MonaUserClass();
                        $dataUser = $UserClass->get_data_user(get_current_user_id(  ));
                        ?>
                    <div class="account-user">
                        <div class="wrap-account-user">  
                            <span class="wrap-avatar">
                                <?php
                                $avatar = M_AVATAR_USER_DEFAULT;
                                if( $dataUser['_avatar'] != '') {
                                    $avatar = $dataUser['_avatar'];
                                }
                                echo wp_get_attachment_image( $avatar ,'200x200' ) ?>
                            </span>
                            <a href="<?php echo get_permalink( M_P_ACCOUNT ) ?>" class="full-name"><?php echo $dataUser['name'] ?></a>
                        </div>
                        <div class="account-dropdown">
                            <ul>
                                <li><a href="<?php echo get_permalink( M_P_ACCOUNT ) ?>">Báo danh</a></li>
                                <li><a href="<?php echo get_permalink( M_P_TEAM ) ?>">Trang cá nhân</a></li>
                                <li><a href="#" class="mona-logout-action main-btn-ajax">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                        <?php
                    } ?>
                    <div class="header-btn">
                        <a href="<?php echo get_permalink(M_P_THELE) ?>" class="main-btn">Vào thi</a>
                    </div>
                   
                   
                    <div class="header-noti">
                        <?php get_template_part('patch/notification/main') ?>
                    </div>
                    <div class="header__mobile">
                        <div class="hamburger-btn">
                            <span class="bar"></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <?php //var_dump(get_post_meta( get_the_ID(), '_point_total_team', true ))  ?>