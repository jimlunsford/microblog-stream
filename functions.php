<?php
/**
 * Microblog Stream functions
 */

if ( ! function_exists( 'microblog_stream_setup' ) ) {
    function microblog_stream_setup() {

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

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

    $theme_version = wp_get_theme()->get( 'Version' );

    // Main theme stylesheet.
    wp_enqueue_style(
        'microblog-stream-style',
        get_stylesheet_uri(),
        array( 'microblog-stream-fonts' ),
        $theme_version
    );

    // Theme script for clickable cards, load more, likes, and nav.
    wp_enqueue_script(
        'microblog-stream-script',
        get_template_directory_uri() . '/microblog.js',
        array(),
        $theme_version,
        true
    );

    // Localized strings for JavaScript.
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
 * Format a like label.
 *
 * @param int $count Like count.
 * @return string
 */
function microblog_stream_like_label( $count ) {
    $count = (int) $count;

    if ( 1 === $count ) {
        /* translators: %s: like count, singular. */
        $template = __( '%s like', 'microblog-stream' );
    } else {
        /* translators: %s: like count, plural. */
        $template = __( '%s likes', 'microblog-stream' );
    }

    return sprintf( $template, number_format_i18n( $count ) );
}

/**
 * Auto generate a title using date and time if the title is empty.
 *
 * This keeps the editor clean for short posts while still giving posts
 * a unique title in the admin area.
 *
 * @param array $data    Sanitized post data.
 * @param array $postarr Raw post data.
 * @return array
 */
function microblog_stream_autotitle( $data, $postarr ) {
    if ( 'post' === $data['post_type'] && '' === trim( $data['post_title'] ) ) {

        // Use the post date if present; otherwise use current time.
        if ( ! empty( $data['post_date'] ) && '0000-00-00 00:00:00' !== $data['post_date'] ) {
            $timestamp = strtotime( $data['post_date'] );
        } else {
            $timestamp = current_time( 'timestamp' );
        }

        // Example: 11-29-2025 1:09:15 pm (mm-dd-yyyy g:i:s a, 12 hour time with seconds).
        $data['post_title'] = date_i18n( 'm-d-Y g:i:s a', $timestamp );
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
        // You already handle empty titles by date and time.
        'post_title'   => '',
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_author'  => get_current_user_id(),
    );

    $post_id = wp_insert_post( $post_args );

    if ( $post_id && ! is_wp_error( $post_id ) && current_user_can( 'upload_files' ) ) {
        // Handle optional media upload from the front page composer.
        if ( ! empty( $_FILES['microblog_media']['name'] ) ) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $attachment_id = media_handle_upload( 'microblog_media', $post_id );

            if ( ! is_wp_error( $attachment_id ) ) {
                update_post_meta( $post_id, '_microblog_media_id', (int) $attachment_id );

                $mime_type = get_post_mime_type( $attachment_id );
                if ( $mime_type && 0 === strpos( $mime_type, 'image/' ) && ! has_post_thumbnail( $post_id ) ) {
                    set_post_thumbnail( $post_id, $attachment_id );
                }
            }
        }
    }

    // Redirect back to home with a small flag.
    $redirect = home_url( '/' );
    $redirect = add_query_arg( 'micro_posted', '1', $redirect );

    wp_safe_redirect( $redirect );
    exit;
}
add_action( 'admin_post_microblog_quick_post', 'microblog_stream_handle_quick_post' );

/**
 * Ajax handler for likes.
 */
function microblog_stream_handle_like() {
    check_ajax_referer( 'microblog_stream_like', 'nonce' );

    $post_id = isset( $_POST['post_id'] ) ? (int) $_POST['post_id'] : 0;

    if ( ! $post_id || 'post' !== get_post_type( $post_id ) ) {
        wp_send_json_error();
    }

    $count = (int) get_post_meta( $post_id, '_microblog_like_count', true );
    $count ++;
    update_post_meta( $post_id, '_microblog_like_count', $count );

    $label = microblog_stream_like_label( $count );

    wp_send_json_success(
        array(
            'count' => $count,
            'label' => $label,
        )
    );
}
add_action( 'wp_ajax_microblog_stream_like', 'microblog_stream_handle_like' );
add_action( 'wp_ajax_nopriv_microblog_stream_like', 'microblog_stream_handle_like' );

/**
 * Make plain text URLs in post content clickable.
 *
 * This runs after core content filters so formatting and shortcodes are applied
 * first, then converts any remaining URLs into anchor tags.
 *
 * @param string $content Post content.
 * @return string
 */
function microblog_stream_make_clickable_in_content( $content ) {
    return make_clickable( $content );
}
add_filter( 'the_content', 'microblog_stream_make_clickable_in_content', 20 );