<section class="topics inaction" id="topics">
    <div class="topics__header inaction_opacity">
        <h2 class="topics__heading heading2">
            <span class="topics__heading-en">NEWS</span>
            <span class="topics__heading-ja">お知らせ</span>
        </h2>
        <a href="<?php echo get_home_url(); ?>/topics/" class="topics__button">一覧を見る</a>
    </div>
    <?php topics_categories(false); ?>
    <div class="topics__posts-wrap inaction_opacity">
        <div class="topics__posts">
            <?php if (!empty($data['topics'])): ?>
                <?php foreach ($data['topics'] as $topics): ?>
                    <a href="<?php echo esc_url($topics['link']); ?>" class="topics__post" <?php echo $topics['target']; ?>>
                        <?php if (!empty($topics['image_html'])): ?>
                            <figure class="topics__image"><?php echo $topics['image_html']; ?></figure>
                        <?php endif; ?>
                        <div class="topics__text-wrap">
                            <span class="topics__date"><?php echo $topics['date']; ?></span>
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
                            <div class="topics__title"><?php echo $topics['title']; ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="topics__arrows">
            <button class="topics__arrow topics__arrow--left"><?php svg('banner_arrow2'); ?></button>
            <button class="topics__arrow topics__arrow--right"><?php svg('banner_arrow2'); ?></button>
        </div>
    </div>
</section>