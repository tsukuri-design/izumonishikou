<?php declare(strict_types=1);

/*
 * パスワードページの設定
 * 「保護中」を消す
 */

function removeProtected($title)
{
    return '%s';
}
add_filter('protected_title_format', 'removeProtected');
