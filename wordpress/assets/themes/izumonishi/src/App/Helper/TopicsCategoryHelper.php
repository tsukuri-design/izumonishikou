<?php
function topics_categories($show_active = true)
{
    $current_slug = '';
    if ($show_active && is_tax('topics_category')) {
        $term = get_queried_object();
        $current_slug = isset($term->slug) ? (string) $term->slug : '';
    }

    $outer_class = $show_active
        ? 'topics__category-overflow'
        : 'topics__category-overflow inaction_opacity';

    $home = get_home_url();
    $items = [
        ['label' => 'ALL', 'url' => $home . '/information/', 'type' => 'all'],
        ['label' => '入試情報', 'url' => $home . '/topics_category/entry/', 'slug' => 'entry'],
        ['label' => '学校生活', 'url' => $home . '/topics_category/school-life/', 'slug' => 'school-life'],
        ['label' => '部活動', 'url' => $home . '/topics_category/club/', 'slug' => 'club'],
        ['label' => 'その他', 'url' => $home . '/topics_category/other/', 'slug' => 'other'],
    ];

    // ACTIVE判定：$show_active=false のときは ALL のみ active
    $is_active = function ($item) use ($show_active, $current_slug) {
        // 強制ALLアクティブ
        if (!$show_active) {
            return (($item['type'] ?? '') === 'all');
        }
        // 通常：コンテキストに応じて
        if (($item['type'] ?? '') === 'all') {
            return is_post_type_archive('topics') || is_front_page() || $current_slug === '';
        }
        if (isset($item['slug'])) {
            return ($current_slug === $item['slug']);
        }
        return false;
    };
    ?>
    <div class="<?php echo esc_attr($outer_class); ?>">
        <div class="topics__category-wrap">
            <?php foreach ($items as $item): ?>
                <?php $active = $is_active($item) ? ' topics__category-item--active' : ''; ?>
                <a href="<?php echo esc_url($item['url']); ?>" class="topics__category-item<?php echo $active; ?>">
                    <?php echo esc_html($item['label']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
