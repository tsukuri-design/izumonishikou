<?php declare(strict_types=1);

/**
 * メディアページをインデックスしない
 *no index media page
 */

function mediaPageNoIndex()
{
    if (is_attachment()) {
        echo '<meta name="robots" content="noindex,follow">';
        header('Location: ' . esc_url(home_url()));
    }
}
add_action('wp_head', 'mediaPageNoIndex');
