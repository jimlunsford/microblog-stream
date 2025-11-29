<?php
/**
 * Single post template for Microblog Stream
 */

get_header();
?>

<main class="site-main">
  <div class="timeline">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php
      $likes       = (int) get_post_meta( get_the_ID(), 'microblog_stream_likes', true );
      $likes_label = sprintf(
        _n( '%s like', '%s likes', $likes, 'microblog-stream' ),
        number_format_i18n( $likes )
      );
      ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class( 'micro-post' ); ?>>
        <div class="micro-post-inner">

          <div class="micro-post-avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
          </div>

          <div class="micro-post-main">

            <div class="micro-post-headerline">
              <span class="micro-post-author">
                <?php echo esc_html( get_the_author() ); ?>
              </span>
              <span class="micro-post-separator">&middot;</span>
              <span class="micro-post-datetime">
                <?php echo esc_html( get_the_time( 'M j, Y g:i a' ) ); ?>
              </span>
            </div>

            <div class="micro-post-content">
              <?php the_content(); ?>
            </div>

            <div class="micro-post-meta">
              <div class="micro-post-tags">
                <?php
                $tags = get_the_tags();
                if ( $tags ) {
                  foreach ( $tags as $tag ) {
                    printf(
                      '<a class="micro-tag" href="%1$s">#%2$s</a>',
                      esc_url( get_tag_link( $tag->term_id ) ),
                      esc_html( $tag->name )
                    );
                  }
                }
                ?>
              </div>

              <div class="micro-post-actions">
                <button
                  type="button"
                  class="micro-meta-pill micro-like-button"
                  data-post-id="<?php the_ID(); ?>"
                  aria-pressed="false"
                >
                  <span class="micro-meta-pill-icon"></span>
                  <span class="micro-like-text">
                    <?php echo esc_html( $likes_label ); ?>
                  </span>
                </button>

                <span class="micro-meta-pill">
                  <span class="micro-meta-pill-icon"></span>
                  <?php
                  comments_number(
                    __( '0 replies', 'microblog-stream' ),
                    __( '1 reply', 'microblog-stream' ),
                    __( '% replies', 'microblog-stream' )
                  );
                  ?>
                </span>

                <span class="micro-meta-pill">
                  <span class="micro-meta-pill-icon"></span>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php esc_html_e( 'Back to stream', 'microblog-stream' ); ?>
                  </a>
                </span>
              </div>
            </div>

          </div><!-- .micro-post-main -->
        </div><!-- .micro-post-inner -->
      </article>

      <?php if ( comments_open() || get_comments_number() ) : ?>
        <section class="comments-wrap">
          <?php comments_template(); ?>
        </section>
      <?php endif; ?>

    <?php endwhile; endif; ?>

  </div><!-- .timeline -->
</main>

<?php get_footer(); ?>