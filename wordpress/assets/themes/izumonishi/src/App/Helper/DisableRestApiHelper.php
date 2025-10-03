<?php declare(strict_types=1);
/**
 * ログインしていない場合はREST APIを無効化
 * Disable REST API.
 */

add_filter('rest_authentication_errors', function ($result) {
    if (!empty($result)) {
        return $result;
    }
    if (!is_user_logged_in()) {
        wp_redirect(home_url());
        exit;
    }

    return $result;
});
