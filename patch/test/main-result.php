<?php 
    $QuizClass = new MonaQuizClass();
     
    $userId = get_current_user_id(  );
    $postId = get_the_ID();
    $arrId = get_user_meta( $userId , '_request_test_' . $postId , true );
    $dataAns = get_user_meta( $userId , '_data_form_ans_' . $postId , true );   
    $arrId  = m_str_id_to_arr($arrId); 
    $args =[
        'post_type' => 'mona_question',  
        'post__in' =>  $arrId, 
        'posts_per_page' => 30,
        'orderby' => 'post__in', 
    ];
    $quizQuery = new WP_Query($args);
    
    ?> 
    <main class="main main-test">
        <section class="test frame sec-60" data-aos="fade">
            <div class="container">
                <div class="frame-title --mb-40">
                    <h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
                        <?php echo __('Kết quả chi tiết bài làm', 'monamedia') ?>
                    </h2>
                </div>
                <div class="frame-content">
                    <div class="frame-content-wrap">
                        <div class="test-frame" data-aos="zoom-out" data-aos="100">
                            <!-- DANH SÁCH CÁC CÂU HỎI -->
                            <form action="#" class="test-form"> 
                                <div class="is-slider --mb-40">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php 
                                            $count_number = 1;
                                            while ($quizQuery->have_posts()) {
                                                $quizQuery->the_post();
                                                set_query_var( 'm_index', $count_number );
                                                set_query_var( 'data_ans',  $dataAns  );
                                                ?>
                                                <div class="swiper-slide"> 
                                                    <?php get_template_part( 'patch/quiz/test' , 'result') ?>
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
                            <?php $time = "99:99";
                            $timeArr = explode(':' , $time);
                                ?>
                            <div class="qs-time cd__test" style="display:none" data-minutes="<?php echo $timeArr[0] ?>" data-seconds="<?php echo $timeArr[1] ?>">
                                00:00
                            </div>
                            <div class="view-point">
                                Bạn đạt được: <?php echo get_post_meta( get_the_ID(), '_point_user_test_'. $userId, true ) ?> Điểm
                            </div>
                            <!-- <p class="remind">
                                <?php //echo __('*Bạn có thể bỏ qua câu hiện tại và làm câu tiếp theo, rồi quay lại làm sau nhé', 'monamedia') ?> <br>
                                Trong toàn bộ quá trình thi vui lòng không thoát hay reload trang.
                            </p> -->
                        </div>
                    </div>
                    <!-- <div class="frame-btn">
                        <a href="#" class="test-slider-btn main-btn btn-gray" data-func="prev" data-aos="fade-up" data-aos-delay="150">Trở lại</a>
                        <a href="#" class="test-slider-btn main-btn" data-func="next" data-aos="fade-up" data-aos-delay="150">Câu tiếp theo</a>
                    </div> -->
                </div>
                <div class="frame-bg">
                    <img src="<?php echo site_url(); ?>/template/images/bg-child.png" alt="#" />
                </div>
            </div>
        </section>
    </main> 
 