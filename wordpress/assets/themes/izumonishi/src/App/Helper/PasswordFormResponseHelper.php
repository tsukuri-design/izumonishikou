<?php declare(strict_types=1);
/**
 *  パスワードページの設定
 *  パスワードの文言を変更
 */

function passwordFormResponse()
{
    return '<p>このコンテンツはパスワードで保護されています。<br>閲覧するには以下にパスワードを入力してください。</p>' .
        '<div class="post_wrap">' .
        '<span class="label id">ID：</span>' .
        '<span class="input-fake">teacher</span>' .
        '</div>' .
        '<form class="post_password" action="' . home_url('/') . NEW_LOGIN_PAGE . '/?action=postpass" method="post">' .
        '<div class="post_wrap">' .
        '<span class="label password">パスワード：</span>' .
        '<input name="post_password" type="password" size="24"><input type="submit" name="Submit" value="' . esc_attr__('OK') . '">' . '
    </div></form>' .
        '<p class="has-small-font-size">※中学校関係者様向け案内資料では「ID」と「パスワード」の入力をお願いしていましたが、パスワードのみ入力してください。</p>'
    ;
}
add_filter('the_password_form', 'passwordFormResponse');
