<?php
get_header();
?>
<main class="main main-news">
    <section class="news sec-60" data-aos="fade">
        <div class="container">
            <div class="news-wrap">
                <h2 class="main-title tt-30 t-center --s-cl t-capitalize --mb-30" data-aos="fade-down"
                    data-aos-delay="100">
                   <?php  echo single_term_title() ?>
                </h2>
                <div class="news-list">
                    <div class="cols">

                        <?php $time_post_new =0;
                         while(have_posts()){
                             $time_post_new=+100;
                            the_post();
                            ?>
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
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
                                            <a href="<?php  the_permalink() ?>">
                                                <?php the_title() ?></a>
                                        </p>
                                        <a href="<?php  the_permalink() ?>" class="readmore-btn"><?php echo __('Xem thêm','monamedia') ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } 
                        $time_post_new++; wp_reset_query()?>
                    </div>
                    <nav class="pagination pagination-2" data-aos="fade-up" data-aos-delay="500">
                      <?php mona_page_navi() ?>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer();