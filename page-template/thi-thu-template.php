<?php

/**
 * Template name: Thi thử  Page
 * @author : Hy Hý
 */

if (!is_user_logged_in()) {
    wp_redirect(get_permalink(M_P_LOGIN) . '?redirect=' . get_permalink());
    exit;
}
get_header();
while (have_posts()) :
    the_post();
    $QuizClass = new MonaQuizClass();
    $queryQuiz = $QuizClass->get_list_test_exam( );
    $resultArr = $QuizClass->get_result_test( $queryQuiz ); 
?>
    <main class="main main-test">
        <section class="test frame sec-60" data-aos="fade">
            <div class="container">
                <div class="frame-title --mb-40">
                    <h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
                        Trắc nghiệm thi thử
                    </h2>
                </div>
                <div class="frame-content">
                    <div class="frame-content-wrap">
                        <div class="test-frame" data-aos="zoom-out" data-aos="100">
                            <!-- DANH SÁCH CÁC CÂU HỎI -->
                            <form action="#" class="test-form">
                                <input type="hidden" id="data-result" value='<?php echo json_encode($resultArr) ?>'>
                                <div class="is-slider --mb-40">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php 
                                            $index = 0;
                                            while( $queryQuiz->have_posts() ) { 
                                                $queryQuiz->the_post(); 
                                                $index++ 
                                            ?>
                                            <div class="swiper-slide"> 
                                                <?php 
                                                set_query_var( 'm_index', $index ) ;
                                                get_template_part( 'patch/quiz/test', 'item' );
                                                ?>
                                            </div>     
                                                <?php 
                                            }wp_reset_query(  );
                                            ?> 
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </form>
                            <!-- ĐẶT THỜI GIAN CHO BÀI THI -->
                            <?php $time = get_field('time_test_exam');
                            $timeArr = explode(':' , $time);
                                ?>
                            <div class="qs-time cd__test" data-minutes="<?php echo $timeArr[0] ?>" data-seconds="<?php echo $timeArr[1] ?>">
                                00:00
                            </div>
                            <p class="remind">
                                *Bạn có thể bỏ qua câu hiện tại và làm câu tiếp theo, rồi
                                quay lại làm sau nhé
                            </p>
                        </div>
                    </div>
                    <div class="frame-btn">
                        <a href="#" class="test-slider-btn main-btn btn-gray" data-func="prev" data-aos="fade-up" data-aos-delay="150">Trở lại</a>
                        <a href="#" class="test-slider-btn main-btn" data-func="next" data-aos="fade-up" data-aos-delay="150">Câu tiếp theo</a>
                    </div>
                </div>
                <div class="frame-bg">
                    <img src="<?php echo site_url('template') ?>/images/bg-child.png" alt="#" />
                </div>
            </div>
        </section>
    </main>
<?php
endwhile;
get_footer(); ?>
<script type="text/javascript">
    window.onbeforeunload = function() {
        return "Bạn có chắc muốn thoát?";
    }
</script>