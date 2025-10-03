<?php view('components/menu'); ?>

<div class="page-header">
    <div class="page-header__logo"><a href="<?php echo get_home_url(); ?>"><?php svg('logo'); ?></a></div>
    <figure class="page-header__image">
        <?php echo picture('', 'info_top', 'jpg', '', 'webp', '', '', '', ''); ?>
    </figure>
</div>

<section class="topics" id="topics">
    <!-- Posts area -->
    <div class="singular__main">

        <?php if (is_page('current-students/information')):
            $class = 'has_sidebar'; ?>
            <h1 class="heading1">
                                                                <span class="en">INFORMATION</span>
                                                                <span class="ja">在校生・保護者へのお知らせ</span>
                                                            </h1>
        <?php else:
            $class = ''; ?>
            <h1 class="heading1">
                                                                <span class="en">INFORMATION</span>
                                                                <span class="ja">お知らせ</span>
                                                            </h1>
        <?php endif; ?>
        <!-- Category tabs -->
        <?php if (empty($data['hide_category_menu'])): ?>
            <?php topics_categories(true); ?>
        <?php endif; ?>
        <div class="singular <?php echo $class; ?>">
            <div class="topics__posts-wrap content_wrap">
                <div class="topics__posts">
                    <?php if (!empty($data['topics']['posts'])): ?>
                        <?php foreach ($data['topics']['posts'] as $topics): ?>
                            <a href="<?php echo esc_url($topics['link']); ?>" class="topics__post" <?php echo $topics['target']; ?>>
                                <?php if (!empty($topics['image'])): ?>
                                    <figure class="topics__image">
                                        <?php echo $topics['image']; ?>
                                    </figure>
                                <?php endif; ?>

                                <div class="topics__text-wrap">
                                    <span class="topics__date"><?php echo esc_html($topics['date']); ?></span>

                                    <div class="topics__categories">
                                        <?php if (!empty($topics['categories'])): ?>
                                            <?php foreach ($topics['categories'] as $category): ?>
                                                <div class="topics__category">
                                                    <span class="topics__category-icon"><?php svg('cat_icon'); ?></span>
                                                    <?php echo esc_html($category->name); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="topics__title"><?php echo esc_html($topics['title']); ?></div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="topics__coming-soon">Coming Soon</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    // Pagination
    if (
        !empty($data['topics']['max_num_pages']) &&
        $data['topics']['max_num_pages'] > 1 &&
        !empty($data['topics']['paged'])
    ) {
        echo paginate_links([
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%/',
            'current' => max(1, (int) $data['topics']['paged']),
            'total' => (int) $data['topics']['max_num_pages'],
            'prev_text' => '',
            'next_text' => '',
            'type' => 'list',
        ]);
    }
    ?>
    <?php
    echo get_custom_related_posts(); ?>
</section>