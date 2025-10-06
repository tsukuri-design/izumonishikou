<?php

namespace App\Helper;

/**
 * 固定ページ英語タイトル機能のヘルパークラス（ACF対応）
 */
class PageEnglishTitleHelper
{
    /**
     * 英語タイトルフィールド名
     */
    const FIELD_NAME = 'en';

    /**
     * 初期化
     */
    public static function init(): void
    {
        // 管理画面でのみ動作
        if (!is_admin()) {
            return;
        }

        // クイック編集機能のみ
        add_action('quick_edit_custom_box', [self::class, 'add_quick_edit_field'], 10, 2);
        add_action('save_post', [self::class, 'save_english_title']);

        // AJAX処理
        add_action('wp_ajax_get_page_english_title', [self::class, 'ajax_get_english_title']);

        // クイック編集用のJavaScript
        add_action('admin_enqueue_scripts', [self::class, 'enqueue_admin_scripts']);
    }


    /**
     * クイック編集に英語タイトルフィールドを追加
     */
    public static function add_quick_edit_field(string $column_name, string $post_type): void
    {
        if ($post_type !== 'page') {
            return;
        }
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label>
                    <span class="title">英語タイトル</span>
                    <span class="input-text-wrap">
                                                <input type="text" name="<?php echo esc_attr(self::FIELD_NAME); ?>" class="ptitle" value="" placeholder="例: English Title" maxlength="100">
                                            </span>
                </label>
            </div>
        </fieldset>
        <?php
    }

    /**
     * 英語タイトルを保存
     */
    public static function save_english_title(int $post_id): void
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (get_post_type($post_id) !== 'page') {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST[self::FIELD_NAME])) {
            $english_title = sanitize_text_field($_POST[self::FIELD_NAME]);

            if (empty($english_title)) {
                delete_field(self::FIELD_NAME, $post_id);
            } else {
                update_field(self::FIELD_NAME, $english_title, $post_id);
            }
        }
    }

    /**
     * AJAX処理：英語タイトルの取得
     */
    public static function ajax_get_english_title(): void
    {
        // 権限チェック
        if (!current_user_can('edit_posts')) {
            wp_die('権限がありません。');
        }

        // ノンスチェック
        if (!wp_verify_nonce($_POST['nonce'], 'get_page_english_title')) {
            wp_die('セキュリティチェックに失敗しました。');
        }

        $post_id = intval($_POST['post_id']);

        // 固定ページかチェック
        if (get_post_type($post_id) !== 'page') {
            wp_send_json_error('固定ページではありません。');
        }

        // 英語タイトルを取得
        $english_title = get_field(self::FIELD_NAME, $post_id);
        $english_title = $english_title ?: '';

        wp_send_json_success($english_title);
    }

    /**
     * 管理画面のJavaScript追加
     */
    public static function enqueue_admin_scripts(string $hook): void
    {
        if ($hook !== 'edit.php' || get_current_screen()->post_type !== 'page') {
            return;
        }

        wp_add_inline_script('jquery', '
            jQuery(document).ready(function($) {
                // クイック編集を開く前に現在の値を取得
                $(".editinline").on("click", function() {
                    var postId = $(this).closest("tr").attr("id").replace("post-", "");
                    
                    // AJAXで現在の英語タイトルを取得
                    $.ajax({
                        url: ajaxurl,
                        type: "POST",
                        data: {
                            action: "get_page_english_title",
                            post_id: postId,
                            nonce: "' . wp_create_nonce('get_page_english_title') . '"
                        },
                        success: function(response) {
                            if (response.success) {
                                $("input[name=\'' . self::FIELD_NAME . '\']").val(response.data);
                            }
                        }
                    });
                });
            });
        ');
    }
}
