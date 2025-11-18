<?php
/**
 * Microblog Stream functions
 */

if ( ! function_exists( 'microblog_stream_setup' ) ) {
    function microblog_stream_setup() {

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Featured images.
        add_theme_support( 'post-thumbnails' );

        // HTML5 markup support.
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        // Menus.
        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'microblog-stream' ),
            )
        );

        // Make theme translatable.
        load_theme_textdomain( 'microblog-stream', get_template_directory() . '/languages' );
    }
}
add_action( 'after_setup_theme', 'microblog_stream_setup' );

/**
 * Enqueue styles and scripts
 */
function microblog_stream_scripts() {
    // Noto Sans font from Google Fonts.
    wp_enqueue_style(
        'microblog-stream-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Main theme stylesheet.
    wp_enqueue_style(
        'microblog-stream-style',
        get_stylesheet_uri(),
        array( 'microblog-stream-fonts' ),
        wp_get_theme()->get( 'Version' )
    );

    // Theme script for clickable cards.
    wp_enqueue_script(
        'microblog-stream-script',
        get_template_directory_uri() . '/microblog.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'microblog_stream_scripts' );

/**
 * Helper to output a small timestamp string for micro posts.
 */
function microblog_stream_time_ago() {
    $time           = get_the_time( 'U' );
    $human_readable = human_time_diff( $time, current_time( 'timestamp' ) );
    echo esc_html( $human_readable . ' ago' );
}

/**
 * Auto generate a title using date and time if the title is empty.
 */
function microblog_stream_autotitle( $data, $postarr ) {
    if ( 'post' === $data['post_type'] && '' === trim( $data['post_title'] ) ) {

        // Use the post date if present; otherwise use current time.
        if ( ! empty( $data['post_date'] ) && '0000-00-00 00:00:00' !== $data['post_date'] ) {
            $timestamp = strtotime( $data['post_date'] );
        } else {
            $timestamp = current_time( 'timestamp' );
        }

        // Example: Nov 14, 2025 3:27 pm.
        $data['post_title'] = date_i18n( 'M j, Y g:i a', $timestamp );
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'microblog_stream_autotitle', 10, 2 );
/**
 * Handle front page microblog quick post submissions.
 */
function microblog_stream_handle_quick_post() {

    // Must be logged in.
    if ( ! is_user_logged_in() ) {
        wp_safe_redirect( home_url() );
        exit;
    }

    // Must have permission to publish posts.
    if ( ! current_user_can( 'publish_posts' ) ) {
        wp_safe_redirect( home_url() );
        exit;
    }

    // Check nonce.
    if ( ! isset( $_POST['microblog_quick_nonce'] ) || ! wp_verify_nonce( $_POST['microblog_quick_nonce'], 'microblog_quick_post' ) ) {
        wp_safe_redirect( home_url() );
        exit;
    }

    $content = isset( $_POST['microblog_content'] ) ? wp_kses_post( wp_unslash( $_POST['microblog_content'] ) ) : '';

    if ( '' === trim( $content ) ) {
        // Nothing to save, just bounce back.
        wp_safe_redirect( home_url() );
        exit;
    }

    $post_args = array(
        'post_title'   => '', // You already handle empty titles by date/time.
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_author'  => get_current_user_id(),
    );

    $post_id = wp_insert_post( $post_args );

    // Redirect back to home with a small flag.
    $redirect = home_url( '/' );
    $redirect = add_query_arg( 'micro_posted', '1', $redirect );

    wp_safe_redirect( $redirect );
    exit;
}
add_action( 'admin_post_microblog_quick_post', 'microblog_stream_handle_quick_post' );