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
            <div class="club-activities-image-loop__track">
                <?php for ($i = 1; $i <= 11; $i++): ?>
                    <figure class="club-activities-image-loop-image">
                        <?php echo picture(
                            get_theme_file_uri(),
                            'school-life/club-activities/loop' . $i,
                            'jpg',
                            '',
                            'webp',
                        ); ?>
                    </figure>
                <?php endfor; ?>
                <?php for ($i = 1; $i <= 11; $i++): // duplicate for seamless loop ?>
                    <figure class="club-activities-image-loop-image">
                        <?php echo picture(
                            get_theme_file_uri(),
                            'school-life/club-activities/loop' . $i,
                            'jpg',
                            '',
                            'webp',
                        ); ?>
                    </figure>
                <?php endfor; ?>
            </div>
        </div>

        <section class="club-activities-content">
            <h2 class="club-activities-content-heading2">
                <span class="ja">注目の部活動</span>
                <span class="en">PICK UP</span>
            </h2>

            <div class="club-activities-content-items">

                <?php foreach ($data['club_activities_pickup'] as $activity): ?>
                    <div class="club-activities-content-item_wrap<?php echo $activity['reverse'] ? ' club-activities-content-item_wrap--reverse' : ''; ?>">

                        <div class="club-activities-content-item">
                            <div class="club-activities-content-item_profile">
                                <div class="club-activities-content-item_profile--text">
                                    <?php if ($activity['badge']): ?>
                                        <p class="club-activities-content-item_profile--badge"><?php echo esc_html($activity['badge']); ?></p>
                                    <?php endif; ?>
                                    <p class="club-activities-content-item_profile--bracket"><?php echo esc_html($activity['bracket']); ?></p>
                                    <p class="club-activities-content-item_profile--club-name"><?php echo esc_html($activity['club_name']); ?></p>
                                    <div class="club-activities-content-item_profile--name"><?php echo esc_html($activity['captain_name']); ?></div>
                                </div>
                                <figure class="club-activities-content-item_profile--image">
                                    <?php echo picture(
                                        get_theme_file_uri(),
                                        $activity['image'],
                                        'jpg',
                                        '',
                                        'webp',
                                    ); ?>
                                </figure>
                            </div>
                            <p class="club-activities-content-item-comment"><?php echo esc_html($activity['comment']); ?></p>
                        </div>

                        <section class="club-activities-content-item-add-content">
                            <h4 class="club-activities-content-item-add-content_heading4">過去の実績</h4>
                            <ul class="club-activities-content-item-add-content_list">
                                <?php foreach ($activity['achievements'] as $achievement): ?>
                                    <li class="club-activities-content-item-add-content_list--item"><?php echo esc_html($achievement); ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <?php if ($activity['coach_title'] && $activity['coach_description'] && $activity['coach_image']): ?>
                                <div class="club-activities-content-item-add-content_image-text">
                                    <div class="club-activities-content-item-add-content_text">
                                        <h4 class="club-activities-content-item-add-content_heading4"><?php echo esc_html($activity['coach_title']); ?></h4>
                                        <p class="club-activities-content-item-add-content_explain"><?php echo esc_html($activity['coach_description']); ?></p>
                                    </div>
                                    <figure class="club-activities-content-item-add-content_image">
                                        <?php echo picture(
                                            get_theme_file_uri(),
                                            $activity['coach_image'],
                                            'jpg',
                                            '',
                                            'webp',
                                        ); ?>
                                    </figure>
                                </div>
                            <?php endif; ?>
                        </section>

                    </div>
                <?php endforeach; ?>

            </div>
        </section>


    </div>


    <?php echo get_custom_related_posts(); ?>
</div>