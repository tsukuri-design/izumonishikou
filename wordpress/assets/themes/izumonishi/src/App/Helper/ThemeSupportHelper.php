<?php declare(strict_types=1);

/**
 * add_theme_support
 * WordPess内の　設定 > メディアも修正して下さい。
 *
 * サムネイルのサイズ：300x300
 * サムネイルの実寸法にトリミングする：チェック外す
 * 中サイズ：800x800
 * 大サイズ：1600x1600
 * アップロードしたファイルを年月ベースのフォルダーに整理：チェックを外す
 */

function addThemeSupport()
{
    /** Add Post Thumnails **/
    add_theme_support('post-thumbnails');
    // add_image_size('lazy', 50, 50, false);
    // add_image_size('ogp', 1200, 630, true);
    add_image_size('medium_large', 0, 0);
    add_image_size('1536x1536', 0, 0);
    add_image_size('2048x2048', 0, 0);

    /**
     * Set WordPress output tags to html5
     * WordPressの出力タグをhtml5にする
     */
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style'));
}
add_action('after_setup_theme', 'addThemeSupport');
