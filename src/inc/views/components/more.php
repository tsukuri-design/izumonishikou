<?php
$this_page_item = $args[0];
?>
<section class="more inaction">
    <h2 class="heading2 shift_down">もっと知りたい！ 出雲西高校</h2>
    <div class="more_wrap">
        <a class="item shift_down <?php echo $this_page_item === 'learning' ? ' hide' : ''; ?>" href="/lp/learning">
            <span class="title"><?php echo Svg::MORE1()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture($this->directoryLevel(), 'more1', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">成長を“見える化”する</span>
                    <span class="text_line">西高の学び</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
        <a class="item shift_down <?php echo $this_page_item === 'voice' ? ' hide' : ''; ?>" href="/lp/voice/">
            <span class="title"><?php echo Svg::MORE2()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture($this->directoryLevel(), 'more2', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">在校生・卒業生・先生に</span>
                    <span class="text_line">聞いてみた</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
        <a class="item shift_down <?php echo $this_page_item === 'school_life' ? ' hide' : ''; ?>" href="/lp/school_life/">
            <span class="title"><?php echo Svg::MORE3()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture($this->directoryLevel(), 'more3', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">西高スクールライフ</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
        <a class="item shift_down <?php echo $this_page_item === 'course' ? ' hide' : ''; ?>" href="/lp/course/">
            <span class="title"><?php echo Svg::MORE4()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture($this->directoryLevel(), 'more4', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">幅広いコースと</span>
                    <span class="text_line">進路実績</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
    </div>
</section>