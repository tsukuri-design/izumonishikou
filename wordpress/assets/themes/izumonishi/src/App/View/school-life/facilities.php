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
    <div class="block_editor_content">
        <?php echo get_the_content(); ?>
    </div>
    <div class="facility-gallery">
        <div class="facility-slide-wrap facility-slide-wrap-1">
            <div class="slider-title">保育実習室</div>
            <div class="facility-slide facility-slide-1">
                <?php echo picture('', 'school-life/facility/facility1-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility1-2', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility1-3', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility1-4', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-2">
            <div class="slider-title">介護実習室</div>
            <div class="facility-slide facility-slide-2">
                <?php echo picture('', 'school-life/facility/facility2-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility2-2', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility2-3', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-3">
            <div class="slider-title">情報処理室</div>
            <div class="facility-slide facility-slide-3">
                <?php echo picture('', 'school-life/facility/facility3-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility3-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-4">
            <div class="slider-title">図書館</div>
            <div class="facility-slide facility-slide-4">
                <?php echo picture('', 'school-life/facility/facility4-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility4-2', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility4-3', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility4-4', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility4-5', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-5">
            <div class="slider-title">体育館</div>
            <div class="facility-slide facility-slide-5">
                <?php echo picture('', 'school-life/facility/facility5-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility5-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-6">
            <div class="slider-title">武道場</div>
            <div class="facility-slide facility-slide-6">
                <?php echo picture('', 'school-life/facility/facility6-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility6-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
    </div>
    <div class="facility-gallery facility-gallery-large">
        <div class="facility-slide-wrap facility-slide-wrap-7 facility-slide-wrap-large">
            <div class="slider-title">グラウンド・第２グラウンド</div>
            <div class="facility-slide facility-slide-7">
                <?php echo picture('', 'school-life/facility/facility7-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility7-2', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility7-3', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
    </div>
    <div class="facility-gallery">
        <div class="facility-slide-wrap facility-slide-wrap-8">
            <div class="slider-title">ゲートボール場</div>
            <div class="facility-slide facility-slide-8">
                <?php echo picture('', 'school-life/facility/facility8-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility8-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-9">
            <div class="slider-title">学食（高見食堂）</div>
            <div class="facility-slide facility-slide-9">
                <?php echo picture('', 'school-life/facility/facility9-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility9-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-10">
            <div class="slider-title">トイレ</div>
            <div class="facility-slide facility-slide-10">
                <?php echo picture('', 'school-life/facility/facility10-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility10-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-11">
            <div class="slider-title">第一多目的室</div>
            <div class="facility-slide facility-slide-11">
                <?php echo picture('', 'school-life/facility/facility11-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility11-2', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-13">
            <div class="slider-title">第二多目的室</div>
            <div class="facility-slide facility-slide-13">
                <?php echo picture('', 'school-life/facility/facility12', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
        <div class="facility-slide-wrap facility-slide-wrap-13">
            <div class="slider-title">キャリア形成支援室</div>
            <div class="facility-slide facility-slide-13">
                <?php echo picture('', 'school-life/facility/facility12-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility12-2', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility12-3', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
    </div>
    <div class="facility-gallery facility-gallery-large">
        <div class="facility-slide-wrap facility-slide-wrap-13 facility-slide-wrap-large">
            <div class="slider-title">誠風庵（茶室）</div>
            <div class="facility-slide facility-slide-13">
                <?php echo picture('', 'school-life/facility/facility13-1', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility13-2', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility13-3', 'jpg', '', 'webp', '', '', '', ''); ?>
                <?php echo picture('', 'school-life/facility/facility13-4', 'jpg', '', 'webp', '', '', '', ''); ?>
            </div>
            <div class="arrow"><?php svg('slider_arrow'); ?></div>
        </div>
    </div>
</div>