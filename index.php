<?php
/**
 * Main index template for Microblog Stream
 *
 * @package Microblog_Stream
 */

get_header();
?>

<main id="site-main" class="site-main">
    <div class="timeline">

        <?php
        // Front page compose box: only for logged in users who can publish posts.
        if ( is_user_logged_in() && current_user_can( 'publish_posts' ) && is_home() && ! is_paged() ) :
        ?>
            <section class="micro-compose">
                <form
                    class="micro-compose-form"
                    action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
                    method="post"
                >
                    <div class="micro-compose-inner">
                        <textarea
                            name="microblog_content"
                            class="micro-compose-textarea"
                            rows="3"
                            placeholder="<?php esc_attr_e( 'What is happening?', 'microblog-stream' ); ?>"
                            required
                        ></textarea>

                        <div class="micro-compose-footer">
                            <span class="micro-compose-hint">
                                <?php esc_html_e( 'Press Post to publish a new update.', 'microblog-stream' ); ?>
                            </span>
                            <button type="submit" class="micro-compose-submit">
                                <?php esc_html_e( 'Post', 'microblog-stream' ); ?>
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="action" value="microblog_quick_post" />
                    <?php wp_nonce_field( 'microblog_quick_post', 'microblog_quick_nonce' ); ?>
                </form>

                <?php if ( isset( $_GET['micro_posted'] ) && '1' === $_GET['micro_posted'] ) : ?>
                    <p class="micro-compose-notice">
                        <?php esc_html_e( 'Update posted.', 'microblog-stream' ); ?>
                    </p>
                <?php endif; ?>
            </section>
        <?php
        endif;
        ?>

        <?php if ( have_posts() ) : ?>

            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'content', 'micro' );
            endwhile;
            ?>

            <?php
            global $wp_query;

            if ( $wp_query->max_num_pages > 1 ) :
                ?>
                <div class="pagination pagination-load-more">

                    <?php if ( get_next_posts_link() ) : ?>
                        <div class="pagination-older">
                            <?php next_posts_link( esc_html__( 'Load more', 'microblog-stream' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_paged() && get_previous_posts_link() ) : ?>
                        <div class="pagination-newer">
                            <?php previous_posts_link( esc_html__( 'Newer posts', 'microblog-stream' ) ); ?>
                        </div>
                    <?php endif; ?>

                </div>

                    <div class="pagination-back-to-top">
                        <a href="#site-main" class="back-to-top-chip">
                            <span class="back-to-top-chip-icon" aria-hidden="true">↑</span>
                            <span class="back-to-top-chip-label"><?php esc_html_e( 'Back to top', 'microblog-stream' ); ?></span>
                        </a>
                    </div>

            <?php endif; ?>

        <?php else : ?>

            <p><?php esc_html_e( 'No posts yet. Create your first micro post to get started.', 'microblog-stream' ); ?></p>

        <?php endif; ?>

    </div><!-- .timeline -->
</main>

<?php
get_footer();