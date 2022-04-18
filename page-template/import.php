<?php

/**
 * Template name: Import quiz data Page
 * @author : Hy Hý
 */
if( get_current_user_id(  ) != 1 ) { 
    wp_redirect( home_url(  ) );exit;
}
get_header();
while (have_posts()) :
    the_post();
?> 
    <!-- <div class="import-wrap-btn box-has-ajax"> 
        <input type="file" name="" id="import-data">
        <div class="list-response">
            <ul>
                <li>Bắt đầu </li> 
            </ul>
        </div>
    </div>   -->
    <?php 
    $QuizClass = new MonaQuizClass();
    $count  = 200;
    $page =   max(1, get_query_var('paged')); 
    $offset= ($page-1)*$count;
    $args = array(
        'post_type' => 'mona_teams',
        'posts_per_page' => $count, 
        'page' => $page, 
        'offset'=> $offset,
        'order' => 'DESC', 
    ); 
    echo '<ul>';
    global $wpdb;
    $sql = "SELECT `user_id` as 'userId' FROM `mona_prex_usermeta` WHERE `meta_key` LIKE '_school' AND `meta_value` LIKE '%dao son tay%'";
    $ArrayUser = $wpdb->get_results( $sql , ARRAY_A );
    $arrayIds  = [];
    foreach ($ArrayUser as $k => $id ) {
        $arrayIds[] =$id['userId'] ;
    } 
    $quizQuery = new WP_Query( $args ) ; 
    while( $quizQuery->have_posts() ) { 
        $quizQuery->the_post();  
        $listUser  = get_post_meta( get_the_ID() , '_list_user_team' , true); 
        
        if ( count( $listUser) == 3 ) {continue;};
        echo '<li> <a href="'.get_permalink(  ).'">  ' . get_the_title( ) . '</a>'; 
            ?>
            <ul class="child" style="margin-left:20px">
                <?php 
                if( is_array( $listUser ) and count( $listUser) < 3 ) { 
                    foreach( $listUser as $key => $id ) {  
                        if( in_array( $id , $arrayIds ) ){
                            // if( get_post_status(  get_the_ID()  ) == 'trash') continue;
                            // $postArr = [
                            //     'ID' => get_the_ID(),
                            //     'post_status' => 'trash',
                            // ];
                            // wp_update_post( $postArr );
                            // continue;
                        }
                        echo '<li>'.get_user_meta( $id, '_school',true ).'</li>';
                    }
                } ?> 
            </ul>
            <?php
        echo ' </li> <br>' ;
    }wp_reset_query(  );
    echo '</ul>';
    ?> 
    <!-- <main class="main main-test">
        <section class="test frame sec-60" data-aos="fade">
            <div class="container">
                <div class="frame-title --mb-40">
                    <h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
                        <?php echo __('Trắc nghiệm', 'monamedia') ?>
                    </h2>
                </div>
                <div class="frame-content">
                    <div class="frame-content-wrap">
                        <div class="test-frame" data-aos="zoom-out" data-aos="100"> 
                            <form action="#" class="test-form">
                                
                                <div class="is-slider --mb-40">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php 
                                            $count_number = 1;
                                            while ($quizQuery->have_posts()) {
                                                $quizQuery->the_post();
                                                set_query_var( 'm_index', $count_number )
                                                ?>
                                                <div class="swiper-slide"> 
                                                    <?php get_template_part( 'patch/quiz/test' , 'item') ?>
                                                </div>
                                                <?php
                                                $count_number++;
                                            }
                                            wp_reset_query(); ?> 
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </form> 
                        </div>
                        <?php mona_page_navi( $quizQuery ) ?>
                    </div>
                    <div class="frame-btn">
                        <a href="#" class="test-slider-btn main-btn btn-gray" data-func="prev" data-aos="fade-up" data-aos-delay="150">Trở lại</a>
                        <a href="#" class="test-slider-btn main-btn" data-func="next" data-aos="fade-up" data-aos-delay="150">Câu tiếp theo</a>
                    </div>
                </div>
                <div class="frame-bg">
                    <img src="<?php echo site_url(); ?>/template/images/bg-child.png" alt="#" />
                </div>
            </div>
        </section>
    </main>  -->
<?php
endwhile;
get_footer();
?>