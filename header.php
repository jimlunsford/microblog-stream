<?php
/**
 * The header for Microblog Stream
 *
 * @package Microblog_Stream
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#site-main"><?php esc_html_e( 'Skip to content', 'microblog-stream' ); ?></a>

<div class="site-wrapper">
  <div class="site-shell">

    <header class="site-header">
      <div class="site-header-inner">

        <div class="site-branding">
          <div class="site-title-group">
            <?php if ( is_front_page() && is_home() ) : ?>
              <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <?php bloginfo( 'name' ); ?>
                </a>
              </h1>
            <?php else : ?>
              <p class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                  <?php bloginfo( 'name' ); ?>
                </a>
              </p>
            <?php endif; ?>

            <?php
            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) :
              ?>
              <p class="site-tagline"><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
          </div>
        </div><!-- .site-branding -->

        <div class="site-meta-chips">
          <div class="meta-chip meta-chip-status">
            <span class="meta-dot"></span>
            <span><?php esc_html_e( 'Live microblog', 'microblog-stream' ); ?></span>
          </div>

          <div class="meta-chip meta-chip-count">
            <?php
            $post_counts = wp_count_posts( 'post' );
            $published   = isset( $post_counts->publish ) ? (int) $post_counts->publish : 0;

            printf(
              '%s',
              sprintf(
                esc_html( _n( '%s post', '%s posts', $published, 'microblog-stream' ) ),
                number_format_i18n( $published )
              )
            );
            ?>
          </div>

          <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <button
              type="button"
              class="meta-chip site-nav-toggle"
              aria-expanded="false"
              aria-controls="site-primary-nav"
            >
              <span class="site-nav-toggle-label">
                <?php esc_html_e( 'Menu', 'microblog-stream' ); ?>
              </span>
              <span class="site-nav-toggle-icon" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </button>
          <?php endif; ?>
        </div><!-- .site-meta-chips -->

      </div><!-- .site-header-inner -->

      <?php if ( has_nav_menu( 'primary' ) ) : ?>
        <nav
          id="site-primary-nav"
          class="site-nav"
          aria-label="<?php esc_attr_e( 'Primary menu', 'microblog-stream' ); ?>"
        >
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class'     => 'site-nav-list',
              'fallback_cb'    => false,
              'depth'          => 1,
            )
          );
          ?>
        </nav>
      <?php endif; ?>

    </header><!-- .site-header -->