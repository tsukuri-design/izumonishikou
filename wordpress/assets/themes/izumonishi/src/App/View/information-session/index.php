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
    <h1 class="heading1">
        <?php if (!empty($data['en_title'])): ?><span class="en"><?php echo esc_html($data['en_title']); ?></span><?php endif; ?>
        <span class="ja"><?php echo esc_html(get_the_title()); ?></span>
    </h1>
    <div class="singular <?php echo get_current_page_hierarchy() ? '' : 'wide_layout'; ?>">
        <div class="content_wrap">
            <?php if (!empty($data['content'])): ?>
                <div class="block_editor_content"><?php echo $data['content']; ?></div>
            <?php endif; ?>
            <?php if (!empty($data['sessions'])): ?>
                <?php foreach ($data['sessions'] as $session): ?>
                    <?php $cta_cat_slug = !empty($session['audiences'][0]['slug']) ? $session['audiences'][0]['slug'] : 'general'; ?>
                    <div class="session">
                        <div class="session__left">
                            <?php if (!empty($session['event_number'])): ?>
                                <div class="event_number"><?php echo esc_html($session['event_number']); ?></div>
                            <?php endif; ?>
                            <div class="year"><?php echo esc_html($session['year']); ?></div>
                            <div class="date">
                                <span class="month"><?php echo esc_html($session['month']); ?></span><span class="date_type">月</span>
                                <span class="day"><?php echo esc_html($session['day']); ?></span><span class="date_type">日</span>
                                <span class="date_day">（<?php echo esc_html($session['weekday']); ?>）</span>
                            </div>
                            <div class="time"><?php echo esc_html($session['time_display']); ?></div>
                        </div>
                        <div class="session__right">
                            <?php if (!empty($session['title'])): ?>
                                <div class="title"><?php echo esc_html($session['title']); ?></div>
                            <?php endif; ?>

                            <div class="badge_wrap">
                                <?php if (!empty($session['audiences'])): ?>
                                    <div class="session__audiences">
                                        <?php foreach ($session['audiences'] as $a): ?>
                                            <span class="session__audience <?php echo !empty($a['slug']) ? 'session__audience--' . esc_attr($a['slug']) : ''; ?>">
                                                                                                                                    <?php echo esc_html($a['name']); ?>
                                                                                                                                </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($session['location'])): ?>
                                    <div class="place"><span>場所：</span><?php echo esc_html($session['location']); ?></div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($session['text'])): ?>
                                <div class="text"><?php echo $session['text']; ?></div>
                            <?php endif; ?>

                            <?php if (!empty($session['link'])): ?>
                                <a href="<?php echo esc_url($session['link']); ?>" class="view_more <?php echo 'cv_hp_' . esc_attr($cta_cat_slug); ?>" target="_blank">
                                    <span class="link_text">予約はこちら</span>
                                    <span class="arrow"><?php svg('arrow_circle'); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php /*
              * <div class="block-button"><a href="<?php echo get_home_url(); ?>/contact/admissions-contact/">メールでのお申し込みはこちら</a></div>
              */ ?>
        </div>
    </div>
    <?php echo get_custom_related_posts(); ?>
</div>