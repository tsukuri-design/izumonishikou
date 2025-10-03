<?php

/**
 * Create wp-config-inc.php with below contents
 * 個人用・ローカル用の wp-config-inc.phpを下記コンテンツを元に作成してください
 */

/** MySQL 設定 - この情報はホスティング先から入手してください。 */

/** WordPress のためのデータベース名 */
define('DB_NAME', 'XXX');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'XXX');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'XXX');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * localでUpdateできるようにするための設定
 */
define('FS_METHOD', 'direct');

/**
 * Change wp-content & uploads directory name
 */
define('WP_CONTENT_FOLDERNAME', 'assets');
define('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // 必要によってhttpsに変更したり、ディレクトリを追加修正してください
define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME);
define('UPLOADS', WP_CONTENT_FOLDERNAME . '/library');
