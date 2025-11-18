<?php
/**
 * Main index template for Microblog Stream
 *
 * @package Microblog_Stream
 */

get_header();
?>

<main class="site-main">
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
                            placeholder="What is happening?"
                            required
                        ></textarea>

                        <div class="micro-compose-footer">
                            <span class="micro-compose-hint">
                                Press Post to publish a new update.
                            </span>
                            <button type="submit" class="micro-compose-submit">
                                Post
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="action" value="microblog_quick_post" />
                    <?php wp_nonce_field( 'microblog_quick_post', 'microblog_quick_nonce' ); ?>
                </form>

                <?php if ( isset( $_GET['micro_posted'] ) && '1' === $_GET['micro_posted'] ) : ?>
                    <p class="micro-compose-notice">
                        Update posted.
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
                            <?php next_posts_link( 'Load more' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( is_paged() && get_previous_posts_link() ) : ?>
                        <div class="pagination-newer">
                            <?php previous_posts_link( 'Newer posts' ); ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        <?php else : ?>

            <p>No posts yet. Create your first micro post to get started.</p>

        <?php endif; ?>

    </div><!-- .timeline -->
</main>

<?php
get_footer();