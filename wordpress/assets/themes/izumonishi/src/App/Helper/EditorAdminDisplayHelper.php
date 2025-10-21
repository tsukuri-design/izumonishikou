<?php declare(strict_types=1);

/*
 * 管理者以外の管理画面のいらいないものを非表示
 */

if (!current_user_can('administrator')) {
    /** WordPress本体の更新通知を非表示 */
    function hide_update_nag()
    {
        remove_action('admin_notices', 'update_nag', 3);
        remove_action('admin_notices', 'maintenance_nag', 10);
    }
    add_action('admin_init', 'hide_update_nag');

    /** 左メニュー周り */
    function removeMenus()
    {
        remove_menu_page('index.php'); // ダッシュボード
        remove_menu_page('edit.php'); //固定ページ
        remove_menu_page('edit.php?post_type=page'); //　投稿
        remove_menu_page('edit.php?post_type=log'); // Hide "log" post type menu for non-admins
        remove_menu_page('edit-comments.php'); // コメント
        remove_menu_page('tools.php'); // ツール
        remove_menu_page('themes.php'); // 外観
        remove_menu_page('profile.php'); // プロフィール

    }
    add_action('admin_menu', 'removeMenus', 999);

    add_action('admin_menu', function () {
        // Only for non-admins (editors etc.). Remove this line if you want it for admins too.
        if (current_user_can('administrator'))
            return;

        global $menu;

        $pages_key = null; // 固定ページ
        $banner_key = null; // バナー (CPT)

        foreach ($menu as $key => $item) {
            if (!isset($item[2]))
                continue;

            if ($item[2] === 'edit.php?post_type=page') {
                $pages_key = $key;
            } elseif ($item[2] === 'edit.php?post_type=banner') {
                $banner_key = $key;
            }
        }

        // Move Pages to just after Banner (banner_key + 1)
        if ($pages_key !== null && $banner_key !== null) {
            $pages_menu = $menu[$pages_key];
            unset($menu[$pages_key]);

            $new_key = $banner_key + 1;
            while (isset($menu[$new_key])) {
                $new_key++;
            }
            $menu[$new_key] = $pages_menu;

            // Ensure the order persists
            ksort($menu);
        }
    }, 9999);



    /** ダッシュボードの不要な項目を非表示 */
    function remove_dashboard_widgets()
    {
        global $wp_meta_boxes;
        unset(
            $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'], // 概要
            $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'], // クイックドラフト
            $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'], // アクティビティ
            $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'], // WordPress イベントとニュース
            $wp_meta_boxes['dashboard']['normal']['core']['kusanagi-security-information'], // KUSANAGIのセキュリティ状況
        );
    }
    add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

    /** 上部のバー周りの不要なものを非表示 */
    function removeAdminBarMenu($wp_admin_bar)
    {
        $wp_admin_bar->remove_menu('wp-logo'); // WordPressロゴ.
        $wp_admin_bar->remove_menu('about'); // WordPressロゴ / WordPressについて.
        $wp_admin_bar->remove_menu('wporg'); // WordPressロゴ / WordPress.org.
        $wp_admin_bar->remove_menu('documentation'); // WordPressロゴ / ドキュメンテーション.
        $wp_admin_bar->remove_menu('support-forums'); // WordPressロゴ / サポート.
        $wp_admin_bar->remove_menu('feedback'); // WordPressロゴ / フィードバック.

        $wp_admin_bar->remove_menu('updates'); // 更新.
        $wp_admin_bar->remove_menu('comments'); // コメント.

        $wp_admin_bar->remove_menu('new-content'); // 新規投稿.
        $wp_admin_bar->remove_menu('new-post'); // 新規投稿 / 投稿.
        $wp_admin_bar->remove_menu('new-media'); // 新規投稿 / メディア.
        $wp_admin_bar->remove_menu('new-page'); // 新規投稿 / 固定.
        $wp_admin_bar->remove_menu('new-user'); // 新規投稿 / ユーザー.

        // $wp_admin_bar->remove_menu('menu-toggle'); // メニュー.
    }
    add_action('admin_bar_menu', 'removeAdminBarMenu', 999);
    // Run late so it wins over any earlier filters.
    // add_action('after_setup_theme', function () {
    //     // In case something already set it to true:
    //     remove_filter('show_admin_bar', '__return_true');

    //     // Hide for logged-out users
    //     if (!is_user_logged_in()) {
    //         add_filter('show_admin_bar', '__return_false', 1000);
    //         return;
    //     }

    //     // Optional: only show for users who can edit posts (editors/admins)
    //     if (!current_user_can('edit_posts')) {
    //         add_filter('show_admin_bar', '__return_false', 1000);
    //     }
    // });
    add_action('after_setup_theme', function () {
        remove_filter('show_admin_bar', '__return_true');

        // Hide for all users except administrators
        if (!current_user_can('administrator')) {
            add_filter('show_admin_bar', '__return_false', 1000);
        }
    });




    /** 右上のヘルプを非表示 */
    function disableHelpLink()
    {
        echo '<style type="text/css"> #contextual-help-link-wrap {display: none !important;} </style>';
    }
    add_action('admin_head', 'disableHelpLink');

    /** 管理画面下部のフッターテキストを削除 */
    add_filter('admin_footer_text', '__return_empty_string');

    /** 管理画面下部のバージョン情報を削除 */
    function removeAdminFooter()
    {
        remove_filter('update_footer', 'core_update_footer');
    }
    add_action('admin_menu', 'removeAdminFooter');
}
