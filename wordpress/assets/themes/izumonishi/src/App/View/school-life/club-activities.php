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
            <figure class="club-activities-first-view-image"><?php echo picture(
                get_theme_file_uri(),
                'school-life/club-activities/firstview',
                'jpg',
                '',
                'webp',
                '',
                '',
                '',
                ''
            ); ?></figure>
            <div class="club-activities-first-view-text">
                <h2 class="club-activities-first-view-heading2">打ち込める場所が<br>きっと見つかる</h2>
                <p class="club-activities-first-view-explain">
                    仲間と切磋琢磨しながら心身を鍛え、<br>
                    充実した学校生活を送ることができます。<br>
                    運動部・文化部ともに多彩なクラブが活動しており、<br>
                    一人ひとりの興味や個性を伸ばせる環境です。
                </p>
                <div class="club-activities-first-view-en">
                    <?php echo picture(
                        get_theme_file_uri(),
                        'school-life/club-activities/our-stage',
                        'svg',
                        '',
                        '',
                        '',
                        '',
                        '',
                        ''
                    ); ?>
                </div>
            </div>
        </div>

        <div class="club-activities-image-loop">
            <figure class="club-activities-image-loop-image">
                <?php echo picture(
                    get_theme_file_uri(),
                    'school-life/club-activities/image-loop1',
                    'jpg',
                    '',
                    'webp',
                ); ?>
            </figure>
            <figure class="club-activities-image-loop-image">
                <?php echo picture(
                    get_theme_file_uri(),
                    'school-life/club-activities/image-loop2',
                    'jpg',
                    '',
                    'webp',
                ); ?>
            </figure>
        </div>




    </div>


    <?php echo get_custom_related_posts(); ?>
</div>