<?php
add_action('init', function () {
    register_post_type('banner', array(
        'labels' => array(
            'name' => 'バナー',
            'singular_name' => 'バナー',
            'menu_name' => 'バナー',
            'all_items' => 'バナー 一覧',
            'edit_item' => 'バナー を編集',
            'view_item' => 'バナー を表示',
            'view_items' => 'バナー を表示',
            'add_new_item' => '新規バナーを追加',
            'add_new' => '新規バナーを追加',
            'new_item' => '新規 バナー',
            'parent_item_colon' => '親のバナー:',
            'search_items' => 'バナー を検索',
            'not_found' => 'バナー が見つかりませんでした。',
            'not_found_in_trash' => 'ゴミ箱にバナーはありません',
            'archives' => 'バナー アーカイブ',
            'attributes' => 'バナー の属性',
            'insert_into_item' => 'バナー に挿入',
            'uploaded_to_this_item' => 'Uploaded to this バナー',
            'filter_items_list' => 'バナー リストを絞り込み',
            'filter_by_date' => 'バナー 日時で絞り込み',
            'items_list_navigation' => 'バナー list navigation',
            'items_list' => 'バナー リスト',
            'item_published' => 'バナー を公開しました。',
            'item_published_privately' => 'バナー published privately.',
            'item_reverted_to_draft' => 'バナー reverted to draft.',
            'item_scheduled' => 'バナー を予約しました。',
            'item_updated' => 'バナー を更新しました。',
            'item_link' => 'バナー リンク',
            'item_link_description' => 'バナー へのリンク。',
        ),
        'public' => true,
        'show_in_rest' => true,
        'supports' => array(
            0 => 'title',
        ),
        'delete_with_user' => false,
    ));
});

