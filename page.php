<?php
get_header();
while (have_posts()):
    the_post();
    ?>
    <main><!--End header-->

        <div id="primary" class="page">
            <div class="container clear">


                <section class="content">
                    <div class="box-content">
                        <h1 class="page-title"><?php the_title(); ?></h1>

                        <div class="the-content">
                            <div class="addresses clear">
                                <?php the_content(); ?>
                            </div> <!--addresses-->
                        </div><!--the-content-->

                    </div><!--box-content-->
                </section>

<?php //echo get_template_part('sidebar');?>
            </div><!--container-->			
        </div><!--#primary-->


        <!--Start footer-->
    </main>    
    <?php
endwhile;
get_footer();
?>