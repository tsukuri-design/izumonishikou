<div class="top_wrap">
    <h1 class="heading1">
        <?php if (isset($data['parent_info']) && $data['parent_info']): ?>
                    <a class="singular__parent-link" href="<?php echo esc_url($data['parent_info']['url']); ?>">
                        <?php echo esc_html($data['parent_info']['text']); ?>
                    </a>
        <?php endif; ?>
        <div class="heading_inner">
            <?php if (is_singular('topics')): ?>
                    <span class="en">NEWS</span>
                    <span class="ja">お知らせ</span>
                <?php else: ?>
                    <?php if (get_field('en')): ?><span class="en"><?php echo get_field('en'); ?></span><?php endif; ?>
                    <span class="ja"><?php echo get_the_title(); ?></span>
        <?php endif; ?>
        </div>
    </h1>
    <?php if (get_the_post_thumbnail()): ?>
        <div class="top_image">
            <?php echo get_the_post_thumbnail(); ?>
        </div>
    <?php endif; ?>
</div>
<div class="singular__main">
    <?php if (getHeaderLinks(get_the_content()) !== ''): ?>
        <div class="header_links inaction inaction_opacity"><?php echo getHeaderLinks(get_the_content()); ?></div>
    <?php endif; ?>
    <div class="singular">
        <div class="content_wrap">
            <div class="block_editor_content">
                <?php if (is_singular('topics')): ?>
                    <h1 class="heading1"><?php echo get_the_title(); ?></h1>
                <?php endif; ?>
                <?php if (get_the_content()): ?>
                    <?php the_content(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php echo get_custom_related_posts(); ?>
</div>