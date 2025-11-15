<?php
/**
 * Main template file
 */

get_header();
?>

<main class="timeline" role="main">
    <?php if ( have_posts() ) : ?>

        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'content', 'micro' );
        endwhile;
        ?>

        <div class="pagination">
            <?php
            echo paginate_links(
                array(
                    'prev_text' => '&larr; Newer',
                    'next_text' => 'Older &rarr;',
                )
            );
            ?>
        </div>

    <?php else : ?>

        <p>No posts yet. Create your first micro post to get started.</p>

    <?php endif; ?>
</main>

<?php
get_footer();