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

            <?php
            // Optional media attached via the inline composer.
            $attachment_id = (int) get_post_meta( get_the_ID(), '_microblog_media_id', true );

            if ( $attachment_id ) :
                $mime_type = get_post_mime_type( $attachment_id );
                $url       = wp_get_attachment_url( $attachment_id );
                ?>
                <?php if ( $mime_type && 0 === strpos( $mime_type, 'image/' ) ) : ?>
                    <div class="micro-post-media">
                        <?php echo wp_get_attachment_image( $attachment_id, 'large' ); ?>
                    </div>
                <?php elseif ( $mime_type && 0 === strpos( $mime_type, 'video/' ) && $url ) : ?>
                    <div class="micro-post-media">
                        <?php echo wp_video_shortcode( array( 'src' => $url ) ); ?>
                    </div>
                <?php elseif ( $mime_type && 0 === strpos( $mime_type, 'audio/' ) && $url ) : ?>
                    <div class="micro-post-media">
                        <?php echo wp_audio_shortcode( array( 'src' => $url ) ); ?>
                    </div>
                <?php elseif ( $url ) : ?>
                    <div class="micro-post-media">
                        <a class="micro-doc-chip" href="<?php echo esc_url( $url ); ?>">
                            <span class="micro-doc-chip-icon" aria-hidden="true">📄</span>
                            <span>
                                <?php
                                $attachment_title = get_the_title( $attachment_id );
                                if ( $attachment_title ) {
                                    echo esc_html( $attachment_title );
                                } else {
                                    $path = parse_url( $url, PHP_URL_PATH );
                                    echo esc_html( basename( $path ) );
                                }
                                ?>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

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
                    <?php
                    // Like button.
                    $like_count = (int) get_post_meta( get_the_ID(), '_microblog_like_count', true );
                    $like_label = microblog_stream_like_label( $like_count );
                    ?>
                    <button
                        type="button"
                        class="micro-like-button micro-meta-pill"
                        data-post-id="<?php echo esc_attr( get_the_ID() ); ?>"
                        aria-pressed="false"
                    >
                        <span class="micro-meta-pill-icon"></span>
                        <span class="micro-like-text">
                            <?php echo esc_html( $like_label ); ?>
                        </span>
                    </button>

                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <a class="micro-meta-pill" href="<?php comments_link(); ?>">
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
                        </a>
                    <?php endif; ?>

                    <?php if ( is_singular() ) : ?>
                        <span class="micro-meta-pill">
                            <span class="micro-meta-pill-icon"></span>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php esc_html_e( 'Back to stream', 'microblog-stream' ); ?>
                            </a>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</article>