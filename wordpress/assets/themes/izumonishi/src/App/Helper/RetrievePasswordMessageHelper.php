<?php declare(strict_types=1);
/**
 * Customize the email sent to the "registrant" when resetting the password.
 * パスワードリセット時に「登録者」へ送信されるメールをカスタマイズ
 */

/** メッセージを設定 */
function RetrievePassMessage($message, $key, $user_login, $user_data)
{
    /** サイト情報を取得 */
    $blogname = stripslashes(get_option('blogname'));

    /** メッセージを編集 */
    $message = $user_login . ' 様' . "\r\n";
    $message .= "\r\n";
    $message .= 'あなたのアカウントに対して、パスワードのリセットが要求されました。' . "\r\n";
    $message .= "\r\n";
    $message .= 'もしこのリクエストが間違いだった場合は、このメールを無視してください。' . "\r\n";
    $message .= '何も操作をしなければ、これまでのパスワードがそのまま使用できます。' . "\r\n";
    $message .= "\r\n";
    $message .= 'パスワードをリセットする場合は、次のリンクをクリックしてください。' . "\r\n";
    $message .= 'パスワード変更画面にアクセスしますので、新しいパスワードを入力してください。' . "\r\n";
    $message .= "\r\n";
    $message .= esc_url(home_url('/')) . NEW_LOGIN_PAGE . "/?action=rp&key=$key&login=" . rawurlencode($user_login) . "\r\n";
    $message .= "\r\n";
    $message .= $blogname;

    /** メッセージを表示 */
    return $message;
}
add_filter('retrieve_password_message', 'RetrievePassMessage', 10, 4);
