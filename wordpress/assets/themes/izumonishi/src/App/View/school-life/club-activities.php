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

                <div class="club-activities-content-item_wrap">

                    <div class="club-activities-content-item">
                        <div class="club-activities-content-item_profile">
                            <p class="club-activities-content-item_profile--badge">かみあり国スポ強化指定校</p>
                            <p class="club-activities-content-item_profile--bracket">目指せ全国大会出場</p>
                            <p class="club-activities-content-item_profile--club-name">女子柔道部</p>
                            <div class="club-activities-content-item_profile--name">主将 國谷 菜々心 さん</div>
                            <figure class="club-activities-content-item-profile--image">
                                <?php echo picture(
                                    get_theme_file_uri(),
                                    'school-life/club-activities/pickup1',
                                    'jpg',
                                    '',
                                    'webp',
                                ); ?>
                            </figure>
                        </div>
                        <p class="club-activities-content-item-comment">３年生４人、２年生２人、１年生７人の計13人で活動しています。みんなで声をかけ、助け合いながら心身ともに成長できるよう日々練習をしています。県大会で優勝する感動など、充実した学校生活を一緒に体験しましょう。</p>
                    </div>

                    <section class="club-activities-content-item-add-content">
                        <h4 class="club-activities-content-item-add-content_heading4">過去の実績</h4>
                        <ul class="club-activities-content-item-add-content_list">
                            <li class="club-activities-content-item-add-content_list--item">令和４年度 インターハイ57kg級第３位</li>
                            <li class="club-activities-content-item-add-content_list--item">・令和５年度 インターハイ48kg,52kg,70kg,78kg,78kg超級出場</li>
                            <li class="club-activities-content-item-add-content_list--item">令和６年度 全国高校選手権個人52kg,57kg,無差別級・団体出場</li>
                        </ul>
                        <div class="club-activities-content-item-add-content_image-text">
                            <div class="club-activities-content-item-add-content_text">
                                <h4 class="club-activities-content-item-add-content_heading4">指導者の横顔　監督 青木 聡美</h4>
                                <p class="club-activities-content-item-add-content-explain">出雲西高校在学中は、インターハイ出場、中国大会団体・個人優勝、金鷲旗（全国大会） ３位などの実績を持つ。あさひ銀行（現・りそな銀行）・日水製薬など実業団でも全国大会で入賞。本校の指導者としても多くの選手をインターハイや国体などに出場させている。</p>
                            </div>
                            <figure class="club-activities-content-item-add-content_image-text--image">
                                <?php echo picture(
                                    get_theme_file_uri(),
                                    'school-life/club-activities/pickup1_add',
                                    'jpg',
                                    '',
                                    'webp',
                                ); ?>
                            </figure>
                        </div>
                    </section>

                </div>

                <div class="club-activities-content-item_wrap club-activities-content-item_wrap--reverse">

                    <div class="club-activities-content-item">
                        <div class="club-activities-content-item_profile">
                            <?php /* <p class="club-activities-content-item_profile--badge">かみあり国スポ強化指定校</p> */ ?>
                            <p class="club-activities-content-item_profile--bracket">目指せ全国大会出場</p>
                            <p class="club-activities-content-item_profile--club-name">女子柔道部</p>
                            <div class="club-activities-content-item_profile--name">主将 國谷 菜々心 さん</div>
                            <figure class="club-activities-content-item-profile--image">
                                <?php echo picture(
                                    get_theme_file_uri(),
                                    'school-life/club-activities/pickup1',
                                    'jpg',
                                    '',
                                    'webp',
                                ); ?>
                            </figure>
                        </div>
                        <p class="club-activities-content-item-comment">３年生４人、２年生２人、１年生７人の計13人で活動しています。みんなで声をかけ、助け合いながら心身ともに成長できるよう日々練習をしています。県大会で優勝する感動など、充実した学校生活を一緒に体験しましょう。</p>
                    </div>

                    <section class="club-activities-content-item-add-content">
                        <h4 class="club-activities-content-item-add-content_heading4">過去の実績</h4>
                        <ul class="club-activities-content-item-add-content_list">
                            <li class="club-activities-content-item-add-content_list--item">令和４年度 インターハイ57kg級第３位</li>
                            <li class="club-activities-content-item-add-content_list--item">・令和５年度 インターハイ48kg,52kg,70kg,78kg,78kg超級出場</li>
                            <li class="club-activities-content-item-add-content_list--item">令和６年度 全国高校選手権個人52kg,57kg,無差別級・団体出場</li>
                        </ul>
                        <div class="club-activities-content-item-add-content_image-text">
                            <div class="club-activities-content-item-add-content_text">
                                <h4 class="club-activities-content-item-add-content_heading4">指導者の横顔　監督 青木 聡美</h4>
                                <p class="club-activities-content-item-add-content-explain">出雲西高校在学中は、インターハイ出場、中国大会団体・個人優勝、金鷲旗（全国大会） ３位などの実績を持つ。あさひ銀行（現・りそな銀行）・日水製薬など実業団でも全国大会で入賞。本校の指導者としても多くの選手をインターハイや国体などに出場させている。</p>
                            </div>
                            <figure class="club-activities-content-item-add-content_image-text--image">
                                <?php echo picture(
                                    get_theme_file_uri(),
                                    'school-life/club-activities/pickup1_add',
                                    'jpg',
                                    '',
                                    'webp',
                                ); ?>
                            </figure>
                        </div>
                    </section>

                </div>

            </div>
        </section>


    </div>


    <?php echo get_custom_related_posts(); ?>
</div>