<?php declare(strict_types=1);
/**
 * Redirect to Toppage if access 404 page.
 * 404を表示せずにトップページにリダイレクト
 */

function redirect404()
{
    if (is_404()) {
        wp_safe_redirect(home_url('/'));
        exit();
    }
}
add_action('template_redirect', 'redirect404');
