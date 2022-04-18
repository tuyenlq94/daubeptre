 <?php 
    $QuizClass = new MonaQuizClass();
    $quizQuery = $QuizClass->get_list_test( );
    $resultArr = $QuizClass->get_result_test( $quizQuery ); 
    $userId = get_current_user_id(  );
    $post_ids = wp_list_pluck( $quizQuery->posts, 'ID' ); # save  
    update_user_meta( $userId, '_point_test_' . get_the_id(), 0 );
    update_post_meta( get_the_ID() , '_point_user_test_' . $userId  , 0  ); 
    update_user_meta( $userId, '_request_test_' . get_the_id() ,  $post_ids );
    ?> 
    <main class="main main-test">
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
                            <!-- DANH SÁCH CÁC CÂU HỎI -->
                            <form action="#" class="test-form">
                                <input type="hidden" id="data-result" value='<?php echo json_encode($resultArr) ?>'>
                                <input type="hidden" id="data-request" value='<?php echo json_encode( $post_ids ) ?>'> 
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
                            <!-- ĐẶT THỜI GIAN CHO BÀI THI --> 
                            <?php $time = get_field('time_test_exam');
                            $timeArr = explode(':' , $time);
                                ?>
                            <div class="qs-time cd__test" data-minutes="<?php echo $timeArr[0] ?>" data-seconds="<?php echo $timeArr[1] ?>">
                                00:00
                            </div>
                            <p class="remind">
                                <?php echo __('*Bạn có thể bỏ qua câu hiện tại và làm câu tiếp theo, rồi quay lại làm sau nhé', 'monamedia') ?> <br>
                                Trong toàn bộ quá trình thi vui lòng không thoát hay reload trang.
                            </p>
                        </div>
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
    </main> 
<!-- <script type="text/javascript">
    window.onbeforeunload = function() {
        return "Bạn có chắc muốn thoát?";
    }
</script> -->
 