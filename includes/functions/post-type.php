<?php 
function mona_add_custom_post() {
    $args = array(
        'labels' => array(
            'name' => 'Thư viện câu hỏi',
            'singular_name' => 'Thư viện câu hỏi',
            'add_new' => __('Thêm câu hỏi', 'monamedia'),
            'add_new_item' => __('Câu hỏi mới', 'monamedia'),
            'edit_item' => __('Sửa câu hỏi', 'monamedia'),
            'new_item' => __('Câu hỏi mới', 'monamedia'),
            'view_item' => __('Xem câu hỏi', 'monamedia'),
            'view_items' => __('Xem thư viện câu hỏi', 'monamedia'),
        ),
        'description' => 'Thêm câu hỏi',
        'supports' => array(
            'title',
            // 'editor',
            // 'author',
            // 'thumbnail',
            // 'comments',
            'revisions',
            'custom-fields'
        ),
        'taxonomies' => array('mona_category_question'),
        'hierarchical' => false,
		'show_in_rest' => true,
        'public' => true, 
        'rewrite' => array(
            'slug' => 'chi-tiet-cau-hoi',
            'with_front' => true
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-media-text',
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post'
    );
    register_post_type('mona_question', $args);

    $tax_args = array(
        'labels' => array(
            'name' => __('Danh sách', 'monamedia'),
            'singular_name' => __('Danh sách', 'monamedia'),
            'search_items' => __('Tìm Danh sách', 'monamedia'),
            'all_items' => __('Tất cả Danh sách', 'monamedia'),
            'parent_item' => __('Parent Danh sách', 'monamedia'),
            'parent_item_colon' => __('Parent Danh sách', 'monamedia'),
            'edit_item' => __('Sửa Danh sách', 'monamedia'),
            'add_new' => __('Thêm Danh sách', 'monamedia'),
            'update_item' => __('Sửa Danh sách', 'monamedia'),
            'add_new_item' => __('Thêm mới Danh sách', 'monamedia'),
            'new_item_name' => __('Thêm mới tên Danh sách', 'monamedia'),
            'menu_name' => __('Danh sách', 'monamedia'),
        ),
        'hierarchical' => true,
        'has_archive' => true,
        'public' => true,
        'rewrite' => array(
            'slug' => 'danh-sach-cau-hoi',
            'with_front' => true
        ),
        'capabilities' => array(
            'manage_terms' => 'publish_posts',
            'edit_terms' => 'publish_posts',
            'delete_terms' => 'publish_posts',
            'assign_terms' => 'publish_posts',
        ),
    );
    register_taxonomy('mona_category_question', 'mona_question', $tax_args);

    $args = array(
        'labels' => array(
            'name' => 'Thông báo',
            'singular_name' => 'Thông báo',
            'add_new' => __('Thêm Thông báo', 'monamedia'),
            'add_new_item' => __('Thông báo mới', 'monamedia'),
            'edit_item' => __('Sửa Thông báo', 'monamedia'),
            'new_item' => __('Thông báo mới', 'monamedia'),
            'view_item' => __('Xem Thông báo', 'monamedia'),
            'view_items' => __('Xem Thông báo', 'monamedia'),
        ),
        'description' => 'Thêm Thông báo',
        'supports' => array(
            'title',
            'editor',
            // 'author',
            // 'thumbnail',
            // 'comments',
            'revisions',
            'custom-fields'
        ),
        'taxonomies' => array(''),
        'hierarchical' => false,
		'show_in_rest' => false,
        'public' => false, 
        'rewrite' => array(
            'slug' => 'chi-tiet-thong-bao',
            'with_front' => true
        ),
        'show_ui' => false,
        'show_in_menu' => false,
        'show_in_nav_menus' => false,
        'show_in_admin_bar' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-bell',//dashicons-bell
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post'
    );
    register_post_type('mona_notification', $args);

    # team 
    $args = array(
        'labels' => array(
            'name' => 'Nhóm',
            'singular_name' => 'Nhóm',
            'add_new' => __('Thêm Nhóm', 'monamedia'),
            'add_new_item' => __('Nhóm mới', 'monamedia'),
            'edit_item' => __('Sửa Nhóm', 'monamedia'),
            'new_item' => __('Nhóm mới', 'monamedia'),
            'view_item' => __('Xem Nhóm', 'monamedia'),
            'view_items' => __('Xem thư viện Nhóm', 'monamedia'),
        ),
        'description' => 'Thêm Nhóm',
        'supports' => array(
            'title',
            // 'editor',
            // 'author',
            // 'thumbnail',
            // 'comments',
            'revisions',
            'custom-fields'
        ),
        'taxonomies' => array(''),
        'hierarchical' => false,
		'show_in_rest' => true,
        'public' => true, 
        'rewrite' => array(
            'slug' => 'chi-tiet-nhom',
            'with_front' => true
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-media-text',
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post'
    );
    register_post_type('mona_teams', $args);

    $args = array(
        'labels' => array(
            'name' => 'Bài thi',
            'singular_name' => 'Bài thi',
            'add_new' => __('Thêm Bài thi', 'monamedia'),
            'add_new_item' => __('Bài thi mới', 'monamedia'),
            'edit_item' => __('Sửa Bài thi', 'monamedia'),
            'new_item' => __('Bài thi mới', 'monamedia'),
            'view_item' => __('Xem Bài thi', 'monamedia'),
            'view_items' => __('Xem thư viện Bài thi', 'monamedia'),
        ),
        'description' => 'Thêm Bài thi',
        'supports' => array(
            'title',
            // 'editor',
            // 'author',
            'thumbnail',
            'excerpt',
            // 'comments',
            'revisions',
            'custom-fields'
        ),
        'taxonomies' => array(''),
        'hierarchical' => false,
		'show_in_rest' => true,
        'public' => true, 
        'rewrite' => array(
            'slug' => 'bai-thi',
            'with_front' => true
        ),
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-media-text',
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post'
    );
    // register_post_type('mona_test', $args); # bỏ
    flush_rewrite_rules();
}

add_action('init', 'mona_add_custom_post');


?>