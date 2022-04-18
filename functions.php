<?php
if( get_current_user_id(  ) != 1 ) 
    define('ACF_LITE', true);

define('M_P_REGISTER', 10);
define('M_P_LOGIN', 12);
define('M_P_LOST_PASSWORD', 61);
define('M_P_ACCOUNT', 67);
define('M_P_CHOOSE_TEAM', 111);
define('M_P_TEAM', 80);
define('M_P_TEST_EXAM', 162);
define('M_P_THELE_2', 74);
define('M_P_THELE', 69);
define('M_P_POSTS', '');
define('M_P_HOME',6 );

define('M_AVATAR_DEFAULT', 113);
define('M_AVATAR_USER_DEFAULT', 343);


require_once( get_template_directory() . '/core/class/core.class.php' );
require_once( get_template_directory() . '/core/class/Mona_walker.php' );
require_once( get_template_directory() . '/core/class/hook.class.php' );
require_once( get_template_directory() . '/core/customizer.php' );
require_once( get_template_directory() . '/includes/functions.php' );
require_once( get_template_directory() . '/includes/ajax.php' );

require_once( get_template_directory() . '/includes/controller/autoload.php' );

// image size register
function mona_image_size() {
    //  add_image_size('slider-full', 1900, 790, true);
     add_image_size('200x200', 200, 200, true);
     add_image_size('600x370', 600, 370, true);
}
add_action('after_setup_theme', 'mona_image_size');

function mona_register_menu() {
    register_nav_menus(
        [
            'primary-menu' => __('Theme Main Menu', 'monamedia'),
            'footer-menu' => __('Theme Footer Menu', 'monamedia'),
            'top-menu' => __('Theme Top Menu', 'monamedia'),
            'main-menu' => __('Main menu side', 'monamedia'),
        ]
    );
}

add_action('after_setup_theme', 'mona_register_menu');

function mona_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => __('blog', 'mona_media'),
        'description' => __('The first (primary) sidebar.', 'mona_media'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="lbl">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'id' => 'footer-dang-ky-nhan-tin',
        'name' => __('Footer đăng ký nhận tin', 'mona_media'),
        'description' => __('The first (primary) sidebar.', 'mona_media'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="title tt-20 f-bold">',
        'after_title' => '</p>',
    ));
    register_sidebar(array(
        'id' => 'footer-thong-tin-lienhe',
        'name' => __('Footer Thông tin liên hệ', 'mona_media'),
        'description' => __('The first (primary) sidebar.', 'mona_media'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="title tt-20 f-bold">',
        'after_title' => '</p>',
    ));

    register_sidebar(array(
        'id' => 'footer-hinh-anh',
        'name' => __('Footer hình ảnh', 'mona_media'),
        'description' => __('The first (primary) sidebar.', 'mona_media'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="title tt-20 f-bold">',
        'after_title' => '</p>',
    ));
    
    // register widget item
     // require_once(get_template_directory() . '/widget/mona-cart.php');
  //  register_widget('mona_cart');
}

add_action('widgets_init', 'mona_register_sidebars');

function mona_style() {
    wp_enqueue_style('mona-custom', get_template_directory_uri() . '/css/mona-custom.css?a=' . rand() );
    wp_enqueue_script('mona-sweetalert2', get_template_directory_uri() . '/js/modules/sweetalert2.all.min.js', array(), false, true); 
    wp_enqueue_script('mona-read-file', get_template_directory_uri() . '/js/lib/read-excel-file.min.js', array(), false, true); 
    wp_enqueue_script('mona-front', get_template_directory_uri() . '/js/front.js', array(), false, true); 
    wp_localize_script(
        'mona-front', 
        'mona_ajax_url', 
        array(
            'ajaxURL' => admin_url('admin-ajax.php'),
            'siteURL' => get_site_url() ,
            'm_total_point' => 100 ));
}

add_action('wp_enqueue_scripts', 'mona_style');

function mona_filter_admin_url($url, $path, $blog_id)
{

    if ($path === 'admin-ajax.php' && !is_admin()) {

        $url .= '?mona-ajax';
    }
    return $url;
}
add_filter('admin_url', 'mona_filter_admin_url', 999, 3);

add_filter( 'script_loader_tag', 'add_id_to_script', 10, 3 );

function add_id_to_script( $tag, $handle, $src ) {

  if (  'mona-front' == $handle ) { 
    
    $tag = '<script type="module" src="' . esc_url( $src ) . '"  > </script>';
  } 
  return $tag;
}

function add_menu_parent_class($items) {
    $parents = array();
    foreach ($items as $item) {
        //Check if the item is a parent item
        if ($item->menu_item_parent && $item->menu_item_parent > 0) {
            $parents[] = $item->menu_item_parent;
        }
    }

    foreach ($items as $item) {
        if (in_array($item->ID, $parents)) {
            //Add "menu-parent-item" class to parents
            $item->classes[] = 'dropdown';
        }
    }

    return $items;
}

add_filter('wp_nav_menu_objects', 'add_menu_parent_class');
