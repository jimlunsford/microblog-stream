<?php
/**
 * Archive template
 */

get_header();
?>

<main class="timeline" role="main">
    <?php if ( have_posts() ) : ?>
        <header class="archive-header micro-post">
            <div class="micro-post-inner">
                <div class="micro-post-main">
                    <h1 class="micro-post-title">
                        <?php the_archive_title(); ?>
                    </h1>
                    <div class="micro-post-content">
                        <?php the_archive_description(); ?>
                    </div>
                </div>
            </div>
        </header>

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

        <p>No posts found.</p>

    <?php endif; ?>
</main>

<?php
get_footer();