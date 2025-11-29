<?php
/**
 * Single post template for Microblog Stream.
 *
 * @package Microblog_Stream
 */

get_header();
?>

<main id="site-main" class="site-main">
    <div class="timeline">

        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content', 'micro' );
                ?>

                <div class="comments-wrap">
                    <?php
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>
                </div>

                <?php
            endwhile;
        endif;
        ?>

    </div><!-- .timeline -->
</main>

<?php
get_footer();