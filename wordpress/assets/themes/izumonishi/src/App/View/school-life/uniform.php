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
    <div class="uniform">
        <div class="uniform-first-view">
            <figure class="uniform-first-view-image"><?php echo picture(
                get_theme_file_uri(),
                'school-life/uniform/firstview',
                'jpg',
                '',
                'webp',
                '',
                '',
                '',
                ''
            ); ?></figure>
            <div class="uniform-first-view-text">
                <h2 class="uniform-first-view-heading2">毎日の学びを彩る制服</h2>
                <p class="uniform-first-view-explain">季節に合わせたデザインで生徒の<br class="md">学校生活を彩ります。<br>伝統と清潔感を大切にしながら、<br class="md">快適さと機能性を兼ね備えた制服です。</p>
                <div class="uniform-first-view-en">
                    <?php svg('our_uniform'); ?>
                </div>
            </div>
        </div>
        <div class="uniform-wrap uniform-wrap1">
            <p class="wrap1-text wrap1-text-1">毎朝袖を通すたび、<br>学校生活がもっと特別になる</p>
            <p class="wrap1-text wrap1-text-2">季節ごとに楽しめる、<br>バリエーション豊かな制服スタイル</p>
            <figure class="uniform-image1"><?php echo picture('', 'school-life/uniform/uniform1', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image2"><?php echo picture('', 'school-life/uniform/uniform2', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
        </div>
        <div class="uniform-wrap uniform-wrap2">
            <figure class="uniform-image3"><span class="image-title image-title-summer"><?php svg('summer'); ?></span><?php echo picture('', 'school-life/uniform/uniform3', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image4"><span class="image-title image-title-spring"><?php svg('spring'); ?></span><?php echo picture('', 'school-life/uniform/uniform4', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image5"><span class="image-title image-title-winter"><?php svg('winter'); ?></span><?php echo picture('', 'school-life/uniform/uniform5', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
        </div>
        <div class="uniform-wrap uniform-wrap3">
            <figure class="uniform-image6"><?php echo picture('', 'school-life/uniform/uniform6', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image7"><?php echo picture('', 'school-life/uniform/uniform7', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image8"><?php echo picture('', 'school-life/uniform/uniform8', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image9"><?php echo picture('', 'school-life/uniform/uniform9', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image10"><?php echo picture('', 'school-life/uniform/uniform10', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
        </div>
        <div class="uniform-wrap uniform-wrap4">
            <figure class="uniform-image11"><?php echo picture('', 'school-life/uniform/uniform11', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image12"><?php echo picture('', 'school-life/uniform/uniform12', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
        </div>
        <div class="uniform-wrap uniform-wrap5">
            <figure class="uniform-image13"><?php echo picture('', 'school-life/uniform/uniform13', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <figure class="uniform-image14"><?php echo picture('', 'school-life/uniform/uniform14', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
        </div>
    </div>
    <?php echo get_custom_related_posts(); ?>
</div>