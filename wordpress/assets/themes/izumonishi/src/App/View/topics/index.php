<section class="topics" id="topics">
    <div class="header_wrap">
        <h2 class="heading2">
            <span class="en">NEWS</span>
            <span class="ja">お知らせ</span>
        </h2>
    </div>
    <?php topics_categories(true); ?>
    <div class="post_wrap">
        <div class="topics__posts">
            <?php if (!empty($data['topics']['posts'])): ?>
                <?php foreach ($data['topics']['posts'] as $topics): ?>
                    <a href="<?php echo esc_url($topics['link']); ?>" class="topics__post">
                        <?php if (!empty($topics['image'])): ?>
                            <figure class="image"><?php echo $topics['image']; ?></figure>
                        <?php endif; ?>
                        <div class="text_wrap">
                            <span class="date"><?php echo $topics['date']; ?></span>
                            <div class="categories">
                                <?php if (!empty($topics['categories'])): ?>
                                    <?php foreach ($topics['categories'] as $category): ?>
                                        <div class="category">
                                            <span class="icon"><?php svg('cat_icon'); ?></span><?php echo esc_html($category->name); ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="title"><?php echo $topics['title']; ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="coming_soon">Coming Soon</span>
            <?php endif; ?>
        </div>
        <?php
        // Pagination
        if (
            !empty($data['topics']['max_num_pages'])
            && $data['topics']['max_num_pages'] > 1
            && !empty($data['topics']['paged'])
        ) {
            echo paginate_links([
                'base' => get_pagenum_link(1) . '%_%',
                'format' => 'page/%#%/',
                'current' => max(1, $data['topics']['paged']),
                'total' => $data['topics']['max_num_pages'],
                'prev_text' => '',
                'next_text' => '',
                'type' => 'list',
            ]);
        }
        ?>
    </div>
</section>