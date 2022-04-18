<?php

/**
 * Template name: thể lệ 1  Page
 * @author : Hy Hý
 */
get_header();
while (have_posts()) :
    the_post();
?>
    <main class="main main-rules">
        <section class="rules frame sec-60" data-aos="fade">
            <div class="container">
                <div class="frame-title --mb-40">
                    <h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
                        <?php the_title() ?>
                    </h2>
                </div>
                <div class="frame-content">
                    <div class="frame-content-wrap">
                        <div class="content" data-aos="zoom-out" data-aos-delay="100">
                            <div class="mona-content">
                                <?php the_content() ?>
                            </div>
                        </div>
                    </div> 
                    <div class="frame-btn">
                        <?php  
                        $QuizClass= new MonaQuizClass();
                        $postId = $QuizClass->get_test_now(); 
                        $disable = '';
                        if( !$postId ) {
                            $disable = 'disabled';
                        }
                        ?>
                        <a href="<?php echo get_permalink( M_P_TEST_EXAM ) ?>" 
                        class="main-btn btn-green " data-aos="fade-up" data-aos-delay="150">
                            <?php echo __('Thi thử', 'monamedia') ?>
                        </a>
                        <a href="#popup-baodanh" class="main-btn btn-green open-popup-btn <?php echo $disable ?>" 
                        data-aos="fade-up" data-aos-delay="150">
                            <?php echo __('Trải nghiệm', 'monamedia') ?>
                        </a>
                        <?php 
                       
                        $disable = '';
                        if( get_field('check_open_hoat_dong_tranh_tai', $postId) == false ){
                            $disable = 'disabled';
                        };
                        ?>
                        <a href="<?php echo get_the_permalink(THE_LE_THI) ?>" 
                        class="main-btn <?php echo $disable ?>" data-aos="fade-up" data-aos-delay="150">
                            <?php echo __('Hoạt động tranh tài', 'monamedia') ?>
                        </a>
                    </div>
                </div>
                <div class="frame-bg">
                    <img src="<?php echo site_url(); ?>/template/images/bg-child.png" alt="" />
                </div>
            </div>
        </section>
    </main>
<?php
endwhile;
get_footer(); ?>