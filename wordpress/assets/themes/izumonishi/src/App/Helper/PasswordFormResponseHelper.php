<?php declare(strict_types=1);
/**
 *  パスワードページの設定
 *  パスワードの文言を変更
 */

function passwordFormResponse()
{
    return '<p style="text-align: center;">このコンテンツはパスワードで保護されています。<br>閲覧するには以下にパスワードを入力してください。</p><form class="post_password" action="' . home_url('/') . NEW_LOGIN_PAGE . '/?action=postpass" method="post"><input name="post_password" type="password" size="24"><input type="submit" name="Submit" value="' . esc_attr__('OK') . '"></form>';
}
add_filter('the_password_form', 'passwordFormResponse');
