<?php

/**
 * Template name: nội dung tranh tài   Page
 * @author : Hy Hý
 */
get_header();
while (have_posts()) :
    the_post();
?>
    <style>
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .pu-baodanh-btn form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .pu-baodanh-btn form .f-control::placeholder {
            color: rgba(0, 0, 0, .6)
        }

        .pu-baodanh-btn form div:nth-child(n + 3) {
            grid-column: span 2;
        }
    </style>
    <main class="main main-rules-2">
        <section class="rules frame sec-60" data-aos="fade">
            <div class="container">
                <div class="frame-title --mb-40">
                    <h2 class="main-title tt-30 --s-cl t-capitalize" data-aos="fade-up">
                        Nội Dung Vòng Thi Tranh Tài:
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
                        $QuizClass = new MonaQuizClass();
                        $postId = $QuizClass->get_test_now();
                        $disable = '';
                        if( get_field('check_open_hoat_dong_tranh_tai', $postId) == false and get_current_user_id(  ) != 1 ){
                            $disable = 'disabled';
                        };
                    ?>
                        <a href="#popup-tranh-tai" class="main-btn open-popup-btn <?php echo $disable ?>" data-aos="fade-up" data-aos-delay="150"><?php echo __('Bắt đầu thi', 'monamedia') ?></a>
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