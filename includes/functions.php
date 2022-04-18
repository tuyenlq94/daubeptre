<?php
# auto require file function .php 
$classFiles = glob(get_template_directory()  . '/includes/functions/*.php');
foreach ($classFiles as $key => $url ) {
    require_once( $url );
}
require_once( get_template_directory() . "/includes/upload/upload.class.php" );

function mona_page_navi($wp_query='') {
	if($wp_query==''){
	global $wp_query;	
	}
    
    $bignum = 999999999;
    if ($wp_query->max_num_pages <= 1)
        return;
    echo '<nav class="pagination">';
    echo paginate_links(array(
        'base' => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
        'format' => '',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3
    ));
    echo '</nav>';
}
function mona_page_navi_url($wp_query = '', $url = '') {
    if ($wp_query == '') {
        global $wp_query;
    }
    $bignum = 999999999;
    if ($url == '') {
        $url = str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum)));
    }

    if ($wp_query->max_num_pages <= 1)
        return;
    echo '<nav class="pagination">';
    echo paginate_links(array(
        'base' => $url,
        'format' => '',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3
    ));
    echo '</nav>';
}
 
function m_get_display_name( $userId ) {
    return (new MonaUserClass())->get_display_name($userId);
}
function m_str_id_to_arr( $str ){
    $str =  str_replace( '[' , '' , $str);
    $str =  str_replace( ']' , '' , $str);
    $arr = explode(',' , $str);
    return $arr;
}