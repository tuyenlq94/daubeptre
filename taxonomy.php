<?php
/*
 * CUSTOM POST TYPE TAXONOMY TEMPLATE
 *
 * This is the custom post type taxonomy template. If you edit the custom taxonomy name,
 * you've got to change the name of this template to reflect that name change.
 *
 * For Example, if your custom taxonomy is called "register_taxonomy('shoes')",
 * then your template name should be taxonomy-shoes.php
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates#Displaying_Custom_Taxonomies
 */
?>

<?php get_header(); ?>

<div id="main-wrap">

    <div class="all">
        <div class="main">
            <div class="mona-sidebar-left">
                <?php get_sidebar(); ?>
            </div>
            <div class="main-cont">
                <h1 class="archive-title h2"><span><?php _e('Posts Categorized:', 'monamedia'); ?></span> <?php single_cat_title(); ?></h1>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

                            <header class="article-header">

                                <h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                               

                            </header>

                            <section class="entry-content">
                                <?php the_excerpt('<span class="read-more">' . __('Read More &raquo;', 'monamedia') . '</span>'); ?>

                            </section>

                            <footer class="article-footer">

                            </footer>

                        </article>

                    <?php endwhile; ?>

                    <?php mona_page_navi(); ?>

                <?php else : ?>

                    <article id="post-not-found" class="hentry cf">
                        <header class="article-header">
                            <h1><?php _e('Oops, Post Not Found!', 'monamedia'); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e('Uh Oh. Something is missing. Try double checking things.', 'monamedia'); ?></p>
                        </section>
                        <footer class="article-footer">
                            <p><?php _e('This is the error message in the taxonomy-custom_cat.php template.', 'monamedia'); ?></p>
                        </footer>
                    </article>

                <?php endif; ?>

            </div>

        </div>

    </div>
</div>
    <?php get_footer(); ?>
