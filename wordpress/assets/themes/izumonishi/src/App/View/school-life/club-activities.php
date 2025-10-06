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
            <figure class="club-activities-first-view-image"><?php echo picture_array([
                'src' => 'img/school-life/club-activities/',
                'name' => 'first-view',
                'alt' => '部活動画像'
            ]); ?></figure>
            <div class="club-activities-first-view-text">
                <h2 class="club-activities-first-view-heading2">打ち込める場所が<br>きっと見つかる</h2>
                <p class="club-activities-first-view-explain">
                    仲間と切磋琢磨しながら心身を鍛え、<br>
                    充実した学校生活を送ることができます。<br>
                    運動部・文化部ともに多彩なクラブが活動しており、<br>
                    一人ひとりの興味や個性を伸ばせる環境です。
                </p>
            </div>
        </div>
    </div>


    <?php echo get_custom_related_posts(); ?>
</div>