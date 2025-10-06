<div class="top_wrap">
    <h1 class="heading1">
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
    <?php /* if (getHeaderLinks(get_the_content()) !== ''): ?>
   <div class="header_links inaction inaction_opacity"><?php echo getHeaderLinks(get_the_content()); ?></div>
<?php endif; */ ?>
    <div class="club-activities">

        <div class="club-activities-first-view">
            <figure class="club-activities-first-view-image"><?php echo picture_array(['src' => 'img/', 'name' => 'club-activities-first-view', 'alt' => 'club-activities-first-view']); ?></figure>
            <div class="club-activities-first-view-text">

            </div>
        </div>
    </div>


    <?php echo get_custom_related_posts(); ?>
</div>