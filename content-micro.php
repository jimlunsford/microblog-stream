<?php
/**
 * Template part for displaying a microblog post
 *
 * @package Microblog_Stream
 */
?>
<article
    id="post-<?php the_ID(); ?>"
    <?php post_class( 'micro-post' ); ?>
    data-permalink="<?php the_permalink(); ?>"
>
    <div class="micro-post-inner">

        <div class="micro-post-avatar">
            <?php
            // Use the post author's avatar; 40px is styled in CSS.
            echo get_avatar( get_the_author_meta( 'ID' ), 40 );
            ?>
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
                    <?php if ( is_singular() ) : ?>
                        <span class="micro-meta-pill">
                            <span class="micro-meta-pill-icon"></span>
                            <span>
                                <?php
                                echo esc_html(
                                    get_comments_number_text(
                                        __( '0 replies', 'microblog-stream' ),
                                        __( '1 reply', 'microblog-stream' ),
                                        __( '% replies', 'microblog-stream' )
                                    )
                                );
                                ?>
                            </span>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>