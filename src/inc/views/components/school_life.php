<section class="firstview">
    <figure class="main_image">
        <?php echo picture('', 'school_life', 'jpg', 'sp', 'webp', '', '', '', ''); ?>
    </figure>
    <div class="logo"><a href="https://www.izumonishikou.jp/"><?php echo picture('', 'logo', 'png', '', '', '', '', '', ''); ?></a></div>
    <h1 class="heading1">
        <span class="line_text">西高スクールライフ</span>
    </h1>
</section>
<section class="school_life_item inaction shift_down">
    <h2 class="heading2">
        <span class="en" lang="en">School Activity </span>
        <span class="ja" lang="ja">学校活動</span>
    </h2>
    <h3 class="heading3">一体感って、<br class="md">きっとこういうことだ。<br class="md">夢中になった先に<br class="md">成長が待っている。</h3>
    <div class="gallery gallery1">
        <div class="list">
            <?php
            for ($i = 1; $i <= 2; $i++) {
                /**<div class="item">' . picture('', 'school6', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">部活動応援</span></div>
                 * <div class="item">' . picture('', 'school9', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">「５つの力」アンケート</span></div>
                 */
                echo '
                    <div class="loop loop' . $i . '">
                        <div class="item">' . picture('', 'school1', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">入学式</span></div>
                        <div class="item">' . picture('', 'school2', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">総体壮行式</span></div>
                        <div class="item">' . picture('', 'school3', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">球技大会</span></div>
                        <div class="item">' . picture('', 'school4', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">オープンスクール</span></div>
                        <div class="item">' . picture('', 'school5', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">文化発表会</span></div>
                        <div class="item">' . picture('', 'school7', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">ロードレース</span></div>
                        <div class="item">' . picture('', 'school8', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">体育大会</span></div>
                        <div class="item">' . picture('', 'school10', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">卒業式</span></div>
                        <div class="item">' . picture('', 'school11', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">キャリア研修</span></div>
                        <div class="item">' . picture('', 'school12', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">委員会活動</span></div>
                        <div class="item">' . picture('', 'school13', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">新入生オリエンテーション</span></div>
                    </div>';
            }
            ?>
        </div>
    </div>
</section>
<section class="school_life_item inaction shift_down">
    <h2 class="heading2">
        <span class="en" lang="en">Club Activity </span>
        <span class="ja" lang="ja">部活動</span>
    </h2>
    <h3 class="heading3"><span class="block">運動部</span>全力の毎日が、<br class="md">未来の自信をつくっていく。</h3>
    <div class="static_images">
        <?php
        echo '<div class="item">' . picture('', 'club1', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">野球部</span></div>
                        <div class="item">' . picture('', 'club2', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">女子柔道部</span></div>
                        <div class="item">' . picture('', 'club3', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">ボクシング部</span></div>'; ?>
    </div>
    <div class="gallery gallery2">
        <div class="list">
            <?php
            for ($i = 1; $i <= 2; $i++) {
                echo '
                    <div class="loop loop' . $i . '">
                        <div class="item">' . picture('', 'club4', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">男子ソフトテニス部</span></div>
                        <div class="item">' . picture('', 'club5', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">剣道部</span></div>
                        <div class="item">' . picture('', 'club6', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">男子柔道部</span></div>
                        <div class="item">' . picture('', 'club7', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">陸上部</span></div>
                        <div class="item">' . picture('', 'club8', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">サッカー部</span></div>
                        <div class="item">' . picture('', 'club9', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">女子テニス部</span></div>
                        <div class="item">' . picture('', 'club10', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">男子テニス部</span></div>
                        <div class="item">' . picture('', 'club11', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">女子バレーボール部</span></div>
                        <div class="item">' . picture('', 'club12', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">男子バスケットボール部</span></div>
                        <div class="item">' . picture('', 'club13', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">女子バスケットボール部</span></div>
                        <div class="item">' . picture('', 'club14', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">ゲートボール部</span></div>

                    </div>';
            }
            ?>
        </div>
    </div>
    <h3 class="heading3"><span class="block">文化部・同窓会</span>放課後に、<br class="md">もうひとつの青春が始まる。</h3>
    <div class="static_images">
        <?php
        echo '<div class="item">' . picture('', 'culture1', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">吹奏楽部</span></div>
                        <div class="item">' . picture('', 'culture2', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">インターアクトクラブ</span></div>
                        <div class="item">' . picture('', 'culture3', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">茶道部</span></div>'; ?>
    </div>
    <div class="gallery gallery3">
        <div class="list">
            <?php
            for ($i = 1; $i <= 2; $i++) {
                echo '
                    <div class="loop loop' . $i . '">
                        <div class="item">' . picture('', 'culture4', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">写真部</span></div>
                        <div class="item">' . picture('', 'culture5', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">放送部</span></div>
                        <div class="item">' . picture('', 'culture6', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">図書部</span></div>
                        <div class="item">' . picture('', 'culture7', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">合唱部</span></div>
                        <div class="item">' . picture('', 'culture8', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">美術部</span></div>
                        <div class="item">' . picture('', 'culture9', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">水泳同好会</span></div>
                        <div class="item">' . picture('', 'culture10', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">ダンス同好会</span></div>

                    </div>';
            }
            ?>
        </div>
    </div>
</section>
<section class="more inaction">
    <h2 class="heading2 shift_down">もっと知りたい！ 出雲西高校</h2>
    <div class="more_wrap">
        <a class="item shift_down" href="/lp/learning">
            <span class="title"><?php echo Svg::MORE1()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'more1', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">成長を“見える化”する</span>
                    <span class="text_line">西高の学び</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
        <a class="item shift_down" href="/lp/voice/">
            <span class="title"><?php echo Svg::MORE2()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'more2', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">在校生・卒業生・先生に</span>
                    <span class="text_line">聞いてみた</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
        <a class="item shift_down" href="/lp/course/">
            <span class="title"><?php echo Svg::MORE4()->get(); ?></span>
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'more4', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
                <div class="text_wrap">
                    <span class="text_line">幅広いコースと</span>
                    <span class="text_line">進路実績</span>
                </div>
                <div class="button">詳しくはこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></div>
            </div>
        </a>
    </div>
</section>