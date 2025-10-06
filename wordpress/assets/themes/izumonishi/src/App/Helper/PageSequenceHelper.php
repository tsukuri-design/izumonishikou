<?php

namespace App\Helper;

/**
 * 固定ページ通し番号機能のヘルパークラス（ACF対応）
 */
class PageSequenceHelper
{
    /**
     * 通し番号フィールド名
     */
    const FIELD_NAME = 'page_sequence_number';

    /**
     * 初期化
     */
    public static function init(): void
    {
        // 管理画面でのみ動作
        if (!is_admin()) {
            return;
        }

        // ACFフィールドグループを登録
        add_action('acf/init', [self::class, 'register_acf_fields']);

        // 固定ページ一覧に通し番号カラムを追加
        add_filter('manage_pages_columns', [self::class, 'add_sequence_column']);
        add_action('manage_pages_custom_column', [self::class, 'display_sequence_column'], 10, 2);

        // 通し番号でソート可能にする
        add_filter('manage_edit-page_sortable_columns', [self::class, 'make_sequence_sortable']);
        add_action('pre_get_posts', [self::class, 'handle_sequence_sorting']);

        // クイック編集機能
        add_action('quick_edit_custom_box', [self::class, 'add_quick_edit_field'], 10, 2);
        add_action('save_post', [self::class, 'save_sequence_number']);

        // クイック編集用のJavaScript
        add_action('admin_enqueue_scripts', [self::class, 'enqueue_admin_scripts']);
    }

    /**
     * ACFフィールドグループを登録
     */
    public static function register_acf_fields(): void
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        acf_add_local_field_group([
            'key' => 'group_page_sequence',
            'title' => '固定ページ通し番号',
            'fields' => [
                [
                    'key' => 'field_page_sequence_number',
                    'label' => '通し番号',
                    'name' => self::FIELD_NAME,
                    'type' => 'text',
                    'instructions' => '固定ページの通し番号を入力してください（半角英数字のみ）',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '例: 001, A01, 1-1',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => 10,
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'side',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '固定ページの通し番号を管理します',
        ]);
    }

    /**
     * 固定ページ一覧に通し番号カラムを追加
     */
    public static function add_sequence_column(array $columns): array
    {
        $new_columns = [];
        $inserted = false;

        foreach ($columns as $key => $value) {
            $new_columns[$key] = $value;

            if ($key === 'title' && !$inserted) {
                $new_columns[self::FIELD_NAME] = '通し番号';
                $inserted = true;
            }
        }

        if (!$inserted) {
            $new_columns[self::FIELD_NAME] = '通し番号';
        }

        return $new_columns;
    }

    /**
     * 通し番号カラムの内容を表示
     */
    public static function display_sequence_column(string $column_name, int $post_id): void
    {
        if ($column_name !== self::FIELD_NAME) {
            return;
        }

        $sequence_number = get_field(self::FIELD_NAME, $post_id);
        if ($sequence_number) {
            echo '<span class="page-sequence-display">' . esc_html($sequence_number) . '</span>';
        } else {
            echo '<span class="page-sequence-empty">未設定</span>';
        }
    }

    /**
     * 通し番号カラムをソート可能にする
     */
    public static function make_sequence_sortable(array $columns): array
    {
        $columns[self::FIELD_NAME] = self::FIELD_NAME;
        return $columns;
    }

    /**
     * 通し番号でのソート処理
     */
    public static function handle_sequence_sorting(\WP_Query $query): void
    {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        $orderby = $query->get('orderby');

        if ($orderby === self::FIELD_NAME) {
            $query->set('meta_key', self::FIELD_NAME);
            $query->set('orderby', 'meta_value');
        }
    }

    /**
     * クイック編集に通し番号フィールドを追加
     */
    public static function add_quick_edit_field(string $column_name, string $post_type): void
    {
        if ($post_type !== 'page' || $column_name !== self::FIELD_NAME) {
            return;
        }
        ?>
        <fieldset class="inline-edit-col-right">
            <div class="inline-edit-col">
                <label>
                    <span class="title">通し番号</span>
                    <span class="input-text-wrap">
                                <input type="text" name="<?php echo esc_attr(self::FIELD_NAME); ?>" class="ptitle" value="" placeholder="例: 001, A01, 1-1" maxlength="10">
                            </span>
                </label>
            </div>
        </fieldset>
        <?php
    }

    /**
     * 通し番号を保存
     */
    public static function save_sequence_number(int $post_id): void
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
            $sequence_number = sanitize_text_field($_POST[self::FIELD_NAME]);

            if (empty($sequence_number)) {
                delete_field(self::FIELD_NAME, $post_id);
            } else {
                update_field(self::FIELD_NAME, $sequence_number, $post_id);
            }
        }
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
                    var sequenceNumber = $(this).closest("tr").find(".page-sequence-display").text();
                    if (sequenceNumber === "未設定") {
                        sequenceNumber = "";
                    }
                    
                    setTimeout(function() {
                        $("input[name=\'' . self::FIELD_NAME . '\']").val(sequenceNumber);
                    }, 100);
                });
            });
        ');
    }
}
