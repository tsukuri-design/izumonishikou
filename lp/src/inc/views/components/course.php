<section class="firstview">
    <figure class="main_image">
        <?php echo picture($this->directoryLevel(), 'course', 'jpg', 'sp', 'webp', '', '', '', ''); ?>
    </figure>
    <div class="logo"><a href="https://www.izumonishikou.jp/"><?php echo picture($this->directoryLevel(), 'logo', 'png', '', '', '', '', '', ''); ?></a></div>
    <h1 class="heading1">
        <span class="line_text">幅広いコースと進路実績</span>
    </h1>
</section>
<section class="course_main">
    <h2 class="heading2 inaction shift_down">
        <span class="en">Course & Career  </span><span class="ja">西高のコースと進路</span>
    </h2>
    <h4 class="heading4 inaction shift_down">大学進学から就職まで<br class="md">幅広い進路に対応したコース編成</h4>
    <div class="course_links inaction shift_down">
        <a href="https://www.izumonishikou.jp/learning/advanced-course/" class="link_item" target="_blank">
            <figure class="image"><?php echo picture($this->directoryLevel(), 'course1', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <h3 class="heading3">特別進学コース</h3>
            <p class="text">質の高い授業と補習と個別指導で学力を<Br>伸ばし志望大学への進学をサポート!</p>
            <span class="button">特別進学コースについて詳しく見る <span class="arrow"><?php echo Svg::ARROW2()->get(); ?></span></span>
        </a>
        <a href="https://www.izumonishikou.jp/learning/welfare-course" class="link_item" target="_blank">
            <figure class="image"><?php echo picture($this->directoryLevel(), 'course2', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <h3 class="heading3">福祉コース</h3>
            <p class="text">介護・保育・環境の３分野で人を支える<br>力を培い、持続可能な社会に貢献する。</p>
            <span class="button">福祉コースについて詳しく見る <span class="arrow"><?php echo Svg::ARROW2()->get(); ?></span></span>
        </a>
        <a href="https://www.izumonishikou.jp/learning/business-course" class="link_item" target="_blank">
            <figure class="image"><?php echo picture($this->directoryLevel(), 'course3', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            <h3 class="heading3">ビジネスコース</h3>
            <p class="text">実社会で役立つスキルを段階的に習得。<br>資格取得で進学・就職どちらにも強くなる。</p>
            <span class="button">ビジネスコースについて詳しく見る <span class="arrow"><?php echo Svg::ARROW2()->get(); ?></span></span>
        </a>
    </div>
    <div class="edu_links inaction shift_down">
        <a href="https://www.izumonishikou.jp/career/admission-results/" class="edu_item" target="_blank">
            <?php echo picture($this->directoryLevel(), 'course4', 'jpg', '', 'webp', '', '', '', ''); ?>
            <div class="button"><span class="hand"><?php echo Svg::HAND()->get(); ?></span><span class="underline">主な進学先はこちら</span></div>
        </a>
        <a href="https://www.izumonishikou.jp/career/career-outcomes/" class="edu_item" target="_blank">
            <?php echo picture($this->directoryLevel(), 'course5', 'jpg', '', 'webp', '', '', '', ''); ?>
            <div class="button"><span class="hand"><?php echo Svg::HAND()->get(); ?></span><span class="underline">主な就職先はこちら</span></div>
        </a>
    </div>
</section>
<div class="topic inaction shift_down">
    <h2 class="heading2">進路TOPIC</h2>
    <figure class="image"><?php echo picture($this->directoryLevel(), 'topic_course', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
    <div class="text_wrap">
        <h3 class="heading3"><span class="underline">公務員志望者の合格率<span class="large">76<span class="per">%</span></span></span></h3>
        <p class="text margin">公務員を目指す生徒には、本校教員によるサポートに加え、外部から公務員試験対策の専門家を招いた講座も用意しています。また、希望者は月に2回程度、公務員模試を受けることができ、自分の現在の実力を把握することが可能です。</p>
    </div>
    <div class="results">
        <h4 class="heading4">主な合格実績</h4>
        <p class="result_text">航空自衛隊 / 島根県警察事務 <span class="slash">/</span> <br class="md">島根県警察官 / 大阪府警察<br>雲南消防 / 自衛隊 一般曹候補生 <span class="slash">/</span> <br class="md">陸上自衛隊 一般曹候補生</p>
        <span class="warn">※過去4年の公務員試験合格実績より</span>
    </div>
</div>
<?php $this->view('components/more', false, 'course'); ?>