<?php
/**
 * Header template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="site-wrapper">
    <div class="site-shell">
        <header class="site-header">
            <div class="site-header-inner">
                <div class="site-branding">
                    <div class="site-title-group">
                        <h1 class="site-title">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php bloginfo( 'name' ); ?>
                            </a>
                        </h1>
                        <?php if ( get_bloginfo( 'description' ) ) : ?>
                            <p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="site-meta-chips">
                    <div class="meta-chip">
                        <span class="meta-dot"></span>
                        <span><?php esc_html_e( 'Live microblog', 'microblog-stream' ); ?></span>
                    </div>
                    <div class="meta-chip">
                        <span class="micro-meta-pill-icon"></span>
                        <span>
                            <?php
                            $count = wp_count_posts();
                            printf(
                                /* translators: %d is the number of published posts */
                                esc_html__( '%d posts', 'microblog-stream' ),
                                intval( $count->publish )
                            );
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </header>