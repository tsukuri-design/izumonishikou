<?php declare(strict_types=1);

/** Remove gutenberg block library css from loading on fronted */
function removeWpBlockCss()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Remove wooommerce block css
    wp_dequeue_style('global-styles'); // Remove theme.json
}
add_action('wp_enqueue_scripts', 'removeWpBlockCss', 100);
