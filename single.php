<?php
get_header();
while (have_posts()):
    the_post();
    ?>
<main class="main main-news-dt">
    <section class="news-dt sec-60" data-aos="fade">
        <div class="container">
            <div class="news-dt__wrap">
                <div class="news-dt__title --mb-30" data-aos="fade-up" data-aos-delay="100">
                    <h1 class="main-title tt-30 t-capitalize --s-cl">
                      <?php the_title() ?>
                    </h1>
                </div>
                <div class="news-dt__content">
                    <div class="cols">
                        <div class="col left">
                            <div class="content" data-aos="fade-up" data-aos-delay="200">
                                <?php $image =get_field('hinh_anh_detail_post');
                                $size='full';
                                echo wp_get_attachment_image($image,$size) ?>
                                <p class="date"><b><?php
                                        $timeago = vi_human_time_diff(get_the_time('U'), current_time('timestamp'));
                                        if ($timeago == false) {
                                            the_time('d/m/Y');
                                        } else {
                                            echo $timeago . ' trước';
                                        }
                                    ?></b></p>
                                <div class="mona-content">
                                    
                                <?php the_content() ?>
                                </div>
                            </div>
                        </div>
                        <div class="col right">
                            <div class="news-related">
                                <h3 class="title tt-30 --mb-30 --s-cl"><?php echo __('Tin liên quan','monamedia') ?></h3>
                                <div class="is-slider-mobile --loop --swiper-pag">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                        <?php
                                            $taxoRelated = wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'));
                                            $args = array(
                                                'post_type' => 'post',
                                                'post_status' => 'publish',
                                                'posts_per_page' => 3,
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'category',
                                                        'field' => 'id',
                                                        'terms' => $taxoRelated,
                                                    )
                                                ),
                                                'post__not_in' => array($post->ID),
                                            );
                                            $relatedPosts = new WP_Query($args);
                                            $time_poot =0;
                                            while($relatedPosts->have_posts()){
                                                $time_poot +=100;
                                            $relatedPosts->the_post();
                                            ?>
                                            <div class="swiper-slide" data-aos="fade-up" data-aos-delay="<?php echo $time_poot ?>">
                                                <div class="newsbox">
                                                    <a href="<?php  the_permalink() ?>" class="img"><?php the_post_thumbnail('351x228') ?></a>
                                                    <div class="cont">
                                                        <p class="times"><?php
                                                            $timeago = vi_human_time_diff(get_the_time('U'), current_time('timestamp'));
                                                            if ($timeago == false) {
                                                                the_time('d/m/Y');
                                                            } else {
                                                                echo $timeago . ' trước';
                                                            }
                                                        ?></p>
                                                        <p class="title">
                                                            <a href="<?php the_permalink() ?>">
                                                            <?php the_title() ?></a>
                                                        </p>
                                                        <a href="<?php the_permalink() ?>" class="readmore-btn"><?php echo __('Xem thêm','monamedia') ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                           <?php 
                                        }
                                        $time_poot++;  wp_reset_query() ?>
                                        </div>
                                        <div class="swiper-pagination" data-aos="fade-up" data-aos-delay="300"></div>
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
endwhile;
get_footer();
?>