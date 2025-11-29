<?php
/**
 * Page template for static pages (About, Contact, etc.)
 *
 * @package Microblog_Stream
 */

get_header();
?>

<main class="site-main">
  <div class="timeline">

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'micro-post micro-page' ); ?>>
          <div class="micro-post-inner">
            <div class="micro-post-main">

              <h1 class="micro-post-title">
                <?php the_title(); ?>
              </h1>

              <div class="micro-post-content">
                <?php
                the_content();

                // Support paginated pages created with <!--nextpage--> tags.
                wp_link_pages(
                  array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'microblog-stream' ),
                    'after'  => '</div>',
                  )
                );
                ?>
              </div>

            </div>
          </div>
        </article>

      <?php endwhile; ?>
    <?php endif; ?>

  </div><!-- .timeline -->
</main>

<?php
get_footer();