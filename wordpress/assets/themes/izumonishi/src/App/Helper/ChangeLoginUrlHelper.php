<?php declare(strict_types=1);

/**
 * Change Login URL
 */

define('NEW_LOGIN_PAGE', 'EAA62B67B8C912B13EFC63556EEC614BEB9BF16');
add_action('login_init', function () {
    if (!defined('LOGIN_PAGE_DEFINE') || hash('sha512', '8DA8A3A101B552D75DBAC609E7913C5A9AF649A') != LOGIN_PAGE_DEFINE) {
        error_log('Unauthorized login attempt on ' . date('Y-m-d H:i:s'));
        status_header(404);
        exit;
    }
});

add_filter('site_url', function ($url, $path, $scheme, $blog) {
    $len = 0 - strlen(NEW_LOGIN_PAGE);
    $uri = rtrim(str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']), '/');
    if (is_user_logged_in() === true || substr($uri, $len) === NEW_LOGIN_PAGE) {
        $url = str_replace('wp-login.php', NEW_LOGIN_PAGE . '/', $url);
    }

    return $url;
}, 10, 4);

/** 新しく指定したログインページがURLに含まれない場合は、$locationの中のwp-login.phpを''に置き換える */
add_filter('wp_redirect', function ($location, $status) {
    /** 新しく指定したログインページがURLに含まれない場合は */
    if (stripos($_SERVER['REQUEST_URI'], NEW_LOGIN_PAGE) !== false) {
        /** $locationの中の'wp-login.php'を''に置き換える */
        $location = str_replace('wp-login.php', '', $location);
    }

    return $location;
}, 10, 2);

/** /wp-admin へのアクセスで wp-login.phpへリダイレクトさせない */
function stopRedirect($scheme)
{
    if ($user_id = wp_validate_auth_cookie('', $scheme)) {
        return $scheme;
    }

    wp_redirect(esc_url(home_url()));
    exit();
}
add_filter('auth_redirect_scheme', 'stopRedirect', 9999);
