<?php
/**
 * Template part for displaying a single micro post card.
 *
 * @package Microblog_Stream
 */

$permalink = get_permalink();
$likes     = (int) get_post_meta( get_the_ID(), '_microblog_like_count', true );
$replies   = get_comments_number();
$media_id  = (int) get_post_meta( get_the_ID(), '_microblog_media_id', true );
?>

<article
    id="post-<?php the_ID(); ?>"
    <?php post_class( 'micro-post' ); ?>
    data-permalink="<?php echo esc_url( $permalink ); ?>"
>
    <div class="micro-post-inner">

        <div class="micro-post-avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
        </div>

        <div class="micro-post-main">
            <div class="micro-post-headerline">
                <span class="micro-post-author"><?php the_author(); ?></span>
                <span class="micro-post-separator">·</span>
                <span class="micro-post-datetime">
                    <?php microblog_stream_time_ago(); ?>
                </span>
            </div>

            <div class="micro-post-content">
                <?php the_content(); ?>
            </div>

            <?php if ( $media_id ) : ?>
                <?php
                $mime_type = get_post_mime_type( $media_id );
                $media_url = wp_get_attachment_url( $media_id );
                ?>
                <?php if ( $mime_type && $media_url ) : ?>
                    <div class="micro-post-media">
                        <?php if ( 0 === strpos( $mime_type, 'image/' ) ) : ?>

                            <?php echo wp_get_attachment_image( $media_id, 'large' ); ?>

                        <?php elseif ( 0 === strpos( $mime_type, 'video/' ) ) : ?>

                            <?php echo wp_video_shortcode( array( 'src' => $media_url ) ); ?>

                        <?php elseif ( 0 === strpos( $mime_type, 'audio/' ) ) : ?>

                            <?php echo wp_audio_shortcode( array( 'src' => $media_url ) ); ?>

                        <?php else : ?>
                            <a
                                href="<?php echo esc_url( $media_url ); ?>"
                                class="micro-doc-chip"
                                target="_blank"
                                rel="noopener"
                            >
                                <span class="micro-doc-chip-icon" aria-hidden="true">📄</span>
                                <span class="micro-doc-chip-label">
                                    <?php echo esc_html( get_the_title( $media_id ) ); ?>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <footer class="micro-post-meta">

                <div class="micro-post-tags">
                    <?php the_tags( '', '', '' ); ?>
                </div>

                <div class="micro-post-actions">

                    <button
                        type="button"
                        class="micro-meta-pill micro-like-button"
                        data-post-id="<?php the_ID(); ?>"
                        aria-pressed="false"
                    >
                        <span class="micro-meta-pill-icon" aria-hidden="true"></span>
                        <span class="micro-like-text">
                            <?php echo esc_html( microblog_stream_like_label( $likes ) ); ?>
                        </span>
                    </button>

                    <a
                        class="micro-meta-pill micro-replies-pill"
                        href="<?php echo esc_url( get_comments_link() ); ?>"
                    >
                        <span class="micro-meta-pill-icon" aria-hidden="true"></span>
                        <span class="micro-replies-text">
                            <?php
                            /* translators: %s: number of replies (comments). */
                            printf(
                                esc_html( _n( '%s reply', '%s replies', $replies, 'microblog-stream' ) ),
                                number_format_i18n( $replies )
                            );
                            ?>
                        </span>
                    </a>

                </div>

            </footer>
        </div><!-- .micro-post-main -->

    </div><!-- .micro-post-inner -->
</article>