<div class="top_wrap">

    <h1 class="heading1">
        <?php if (isset($data['parent_info']) && $data['parent_info']): ?>
            <a class="singular__parent-link" href="<?php echo esc_url($data['parent_info']['url']); ?>">
                <?php echo esc_html($data['parent_info']['text']); ?>
            </a>
        <?php endif; ?>
        <div class="heading_inner">
            <?php if (get_field('en')): ?><span class="en"><?php echo get_field('en'); ?></span><?php endif; ?>
            <span class="ja"><?php echo get_the_title(); ?></span>
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
            <?php if (get_the_content()): ?>
                <div class="block_editor_content">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php echo get_custom_related_posts(); ?>
</div>