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
     