<?php
add_action('init', function () {
    register_taxonomy('topics_category', array(
        0 => 'topics',
    ), array(
        'labels' => array(
            'name' => 'お知らせカテゴリー',
            'singular_name' => 'お知らせカテゴリー',
            'menu_name' => 'お知らせカテゴリー',
            'all_items' => 'お知らせカテゴリー 一覧',
            'edit_item' => 'お知らせカテゴリー を編集',
            'view_item' => 'お知らせカテゴリー を表示',
            'update_item' => 'お知らせカテゴリー を更新',
            'add_new_item' => '新規お知らせカテゴリーを追加',
            'new_item_name' => '新規 お知らせカテゴリー 名',
            'parent_item' => '親 お知らせカテゴリー',
            'parent_item_colon' => '親のお知らせカテゴリー:',
            'search_items' => 'お知らせカテゴリー を検索',
            'not_found' => 'お知らせカテゴリー が見つかりませんでした。',
            'no_terms' => 'No お知らせカテゴリー',
            'filter_by_item' => 'お知らせカテゴリー で絞り込む',
            'items_list_navigation' => 'お知らせカテゴリー list navigation',
            'items_list' => 'お知らせカテゴリー リスト',
            'back_to_items' => '← お知らせカテゴリー へ戻る',
            'item_link' => 'お知らせカテゴリー リンク',
            'item_link_description' => 'お知らせカテゴリー へのリンク',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
});

