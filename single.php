<?php
/**
 * Single post template for Microblog Stream
 *
 * @package Microblog_Stream
 */

get_header();
?>

<main id="site-main" class="site-main">
    <div class="timeline">

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'micro' ); ?>

                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <section class="comments-wrap">
                        <?php comments_template(); ?>
                    </section>
                <?php endif; ?>

            <?php endwhile; ?>
        <?php endif; ?>

    </div><!-- .timeline -->
</main>

<?php
get_footer();