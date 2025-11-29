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

    // Theme script for clickable cards, load more, and likes.
    wp_enqueue_script(
        'microblog-stream-script',
        get_template_directory_uri() . '/microblog.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );

    // Localized strings and AJAX data for JavaScript.
    wp_localize_script(
        'microblog-stream-script',
        'microblogStreamL10n',
        array(
            'loading'      => esc_html__( 'Loading...', 'microblog-stream' ),
            'noMorePosts'  => esc_html__( 'No more posts', 'microblog-stream' ),
            'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
            'likeNonce'    => wp_create_nonce( 'microblog_stream_like' ),
            'likeSingular' => esc_html__( '%s like', 'microblog-stream' ),
            'likePlural'   => esc_html__( '%s likes', 'microblog-stream' ),
        )
    );
}
add_action( 'wp_enqueue_scripts', 'microblog_stream_scripts' );

/**
 * Helper to output a small timestamp string for micro posts.
 */
function microblog_stream_time_ago() {
    $time           = get_the_time( 'U' );
    $human_readable = human_time_diff( $time, current_time( 'timestamp' ) );

    $time_string = sprintf(
        /* translators: %s: human readable time difference, for example "5 minutes". */
        __( '%s ago', 'microblog-stream' ),
        $human_readable
    );

    echo esc_html( $time_string );
}

/**
 * Auto generate a title using date and time if the title is empty.
 */
function microblog_stream_autotitle( $data, $postarr ) {
    if ( 'post' === $data['post_type'] && '' === trim( $data['post_title'] ) ) {

        // Use the post date if present, otherwise use current time.
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
        'post_title'   => '', // Empty titles are auto handled above.
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

/**
 * Handle AJAX likes for micro posts.
 */
function microblog_stream_handle_like() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'microblog_stream_like' ) ) {
        wp_send_json_error(
            array(
                'message' => __( 'Invalid like request.', 'microblog-stream' ),
            )
        );
    }

    $post_id = isset( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;

    if ( ! $post_id || 'post' !== get_post_type( $post_id ) ) {
        wp_send_json_error(
            array(
                'message' => __( 'Invalid post.', 'microblog-stream' ),
            )
        );
    }

    $current = (int) get_post_meta( $post_id, 'microblog_stream_likes', true );
    $new     = $current + 1;

    update_post_meta( $post_id, 'microblog_stream_likes', $new );

    $label = sprintf(
        _n( '%s like', '%s likes', $new, 'microblog-stream' ),
        number_format_i18n( $new )
    );

    wp_send_json_success(
        array(
            'count' => $new,
            'label' => $label,
        )
    );
}
add_action( 'wp_ajax_microblog_stream_like', 'microblog_stream_handle_like' );
add_action( 'wp_ajax_nopriv_microblog_stream_like', 'microblog_stream_handle_like' );