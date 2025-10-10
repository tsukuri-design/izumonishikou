<?php declare(strict_types=1);
/**
 * Change slug to English if slug is Japanese. ( custom post type slug + id)
 * スラッグが日本語の場合は英語に変更
 */

function convertPostSlug($slug, $post_ID, $post_status, $post_type)
{
    // Ensure $slug is a string
    $slug = (string) $slug;

    if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
        $slug = utf8_uri_encode($post_type) . $post_ID;
    }

    return $slug;
}

add_filter('wp_unique_post_slug', 'convertPostSlug', 10, 4);
