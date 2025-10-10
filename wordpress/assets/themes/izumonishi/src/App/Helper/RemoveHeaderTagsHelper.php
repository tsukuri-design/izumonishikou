<?php declare(strict_types=1);

/**
 * Delete unnecessary header tags
 * 不要なヘッダータグを削除
 */

/** Delete generator */
remove_action('wp_head', 'wp_generator');

/** Delete emoji */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/** Delete DNS prefetch of emoji */
add_filter('emoji_svg_url', '__return_false');

/** Delete REST link */
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);

/** Delete Manufest */
remove_action('wp_head', 'wlwmanifest_link');

/** Delete EditURI tags */
remove_action('wp_head', 'rsd_link');

/** Delete short link */
remove_action('wp_head', 'wp_shortlink_wp_head');

/** Delete oembed */
remove_action('wp_head', 'wp_oembed_add_discovery_links');
