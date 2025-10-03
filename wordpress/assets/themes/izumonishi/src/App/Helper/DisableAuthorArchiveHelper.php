<?php declare(strict_types=1);
/**
 * Author Archive Access Redirection
 * Redirects from Author archive pages to the home page, except in admin panel.
 */
function redirect_author_archive_to_home()
{
    // Check if it's an author archive page and not in the admin panel
    if (!is_admin() && (!empty($_GET['author']) || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']))) {
        wp_redirect(home_url(''));
        exit;
    }
}

add_action('template_redirect', 'redirect_author_archive_to_home');