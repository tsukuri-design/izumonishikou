<?php
add_action('init', function () {
    register_taxonomy('information_session_category', array(
        0 => 'information_session',
    ), array(
        'labels' => array(
            'name' => '学校説明会カテゴリー',
            'singular_name' => '学校説明会カテゴリー',
            'menu_name' => '学校説明会カテゴリー',
            'all_items' => '学校説明会カテゴリー 一覧',
            'edit_item' => '学校説明会カテゴリー を編集',
            'view_item' => '学校説明会カテゴリー を表示',
            'update_item' => '学校説明会カテゴリー を更新',
            'add_new_item' => '新規学校説明会カテゴリーを追加',
            'new_item_name' => '新規 学校説明会カテゴリー 名',
            'parent_item' => '親 学校説明会カテゴリー',
            'parent_item_colon' => '親の学校説明会カテゴリー:',
            'search_items' => '学校説明会カテゴリー を検索',
            'not_found' => '学校説明会カテゴリー が見つかりませんでした。',
            'no_terms' => 'No 学校説明会カテゴリー',
            'filter_by_item' => '学校説明会カテゴリー で絞り込む',
            'items_list_navigation' => '学校説明会カテゴリー list navigation',
            'items_list' => '学校説明会カテゴリー リスト',
            'back_to_items' => '← 学校説明会カテゴリー へ戻る',
            'item_link' => '学校説明会カテゴリー リンク',
            'item_link_description' => '学校説明会カテゴリー へのリンク',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
});

