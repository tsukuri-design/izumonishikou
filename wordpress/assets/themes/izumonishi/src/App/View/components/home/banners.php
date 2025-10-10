<div class="banners inaction inaction_opacity">
    <?php if (!empty($data['banner'])): ?>
        <?php foreach ($data['banner'] as $banner): ?>
            <div class="banner_slide">
                <?php if (!empty($banner['link']['url'])): ?>
                    <a href="<?php echo esc_url($banner['link']['url']); ?>" target="<?php echo esc_attr($banner['link']['target'] ?? '_self'); ?>">
                    <?php endif; ?>
                    <?php if (!empty($banner['image_url'])): ?>
                        <img src="<?php echo esc_url($banner['image_url']); ?>" alt="">
                    <?php endif; ?>
                    <?php if (!empty($banner['link']['url'])): ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="arrows">
        <button class="arrow banner_arrow_left"><?php svg('banner_arrow'); ?></button>
        <button class="arrow banner_arrow_right"><?php svg('banner_arrow'); ?></button>
    </div>
</div>