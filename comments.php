<?php
/**
 * Comments template
 *
 * @package Microblog_Stream
 */

if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();

            if ( 1 === (int) $comments_number ) {
                printf(
                    /* translators: %s: post title. */
                    esc_html__( 'One comment on "%s"', 'microblog-stream' ),
                    esc_html( get_the_title() )
                );
            } else {
                printf(
                    esc_html(
                        /* translators: 1: number of comments, 2: post title. */
                        _n(
                            '%1$s comment on "%2$s"',
                            '%1$s comments on "%2$s"',
                            $comments_number,
                            'microblog-stream'
                        )
                    ),
                    number_format_i18n( $comments_number ),
                    esc_html( get_the_title() )
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size'=> 40,
                )
            );
            ?>
        </ol>

        <?php
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="comment-navigation" aria-label="<?php esc_attr_e( 'Comment navigation', 'microblog-stream' ); ?>">
                <div class="nav-previous">
                    <?php previous_comments_link( esc_html__( 'Older comments', 'microblog-stream' ) ); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link( esc_html__( 'Newer comments', 'microblog-stream' ) ); ?>
                </div>
            </nav>
            <?php
        endif;

        if ( ! comments_open() && $comments_number ) :
            ?>
            <p class="no-comments">
                <?php esc_html_e( 'Comments are closed.', 'microblog-stream' ); ?>
            </p>
            <?php
        endif;
    endif;

    comment_form();
    ?>

</section>