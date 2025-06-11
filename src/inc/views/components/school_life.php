<section class="firstview">
    <figure class="main_image">
        <?php echo picture('', 'school_life', 'jpg', 'sp', 'webp', '', '', '', ''); ?>
    </figure>
    <div class="logo"><?php echo picture('', 'logo', 'png', '', '', '', '', '', ''); ?></div>
    <h1 class="heading1">
        <span class="line_text">西高スクールライフ</span>
    </h1>
</section>
<section class="school_life_item inaction shift_down">
    <h2 class="heading2">
        <span class="en" lang="en">School Activity </span>
        <span class="ja" lang="ja">学校行事</span>
    </h2>
    <h3 class="heading3">一体感って、<br class="md">きっとこういうことだ。<br class="md">夢中になった先に<br class="md">成長が待っている。</h3>
    <div class="gallery gallery1">
        <div class="list">
            <?php
            for ($i = 1; $i <= 2; $i++) {
                echo '
                    <div class="loop loop' . $i . '">
                        <div class="item">' . picture('', 'school1', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">入学式</span></div>
                        <div class="item">' . picture('', 'school2', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">総体壮行式</span></div>
                        <div class="item">' . picture('', 'school3', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">球技大会</span></div>
                        <div class="item">' . picture('', 'school4', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">オープンスクール</span></div>
                        <div class="item">' . picture('', 'school5', 'jpg', '', 'webp', '', '', '', '4') . '<span 
                        class="title">学園祭</span></div>
                        <div class="item">' . picture('', 'school6', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">部活動応援</span></div>
                        <div class="item">' . picture('', 'school7', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">ロードレース</span></div>
                        <div class="item">' . picture('', 'school8', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">体育祭</span></div>
                        <div class="item">' . picture('', 'school9', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">「５つの力」アンケート</span></div>
                        <div class="item">' . picture('', 'school10', 'jpg', '', 'webp', '', '', '', '4') . '<span class="title">卒業式</span></div>
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