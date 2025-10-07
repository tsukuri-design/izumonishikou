<div class="menu">
    <div class="menu__inner desktop">
        <a class="menu__item" href="<?php echo get_home_url(); ?>/admission/events/">
            <span class="menu__item-icon menu__item-icon--1"><?php svg('menu1'); ?></span>
            <span class="menu__item-text">イベント・<br>学校説明会</span>
        </a>
        <a class="menu__item" href="<?php echo get_home_url(); ?>/admission/">
            <span class="menu__item-icon menu__item-icon--1"><?php svg('menu2'); ?></span>
            <span class="menu__item-text">2026年度<br>入試情報</span>
        </a>
        <a class="menu__item" href="<?php echo get_home_url(); ?>/pamphlet/admission_information_2026/" target="_blank">
            <span class="menu__item-icon menu__item-icon--1"><?php svg('menu3'); ?></span>
            <span class="menu__item-text">デジタル<br>パンフレット</span>
        </a>
        <a class="menu__item" href="<?php echo get_home_url(); ?>/contact/">
            <span class="menu__item-icon menu__item-icon--1"><?php svg('menu4'); ?></span>
            <span class="menu__item-text">お問い合わせ</span>
        </a>
        <div class="menu__sns">
            <a href="#" target="_blank"><?php svg('instagram'); ?></a>
            <a href="#" target="_blank"><?php svg('facebook'); ?></a>
            <a href="#" target="_blank"><?php svg('line'); ?></a>
        </div>
    </div>
</div>

<nav class="menu_top">
    <div class="logo">
        <a href="<?php echo esc_html(home_url()); ?>"><?php svg('logo'); ?></a>
    </div>
    <div class="links_wrap">
        <div class="links2">
            <ul class="links_small">
                <li><a href="<?php echo get_home_url(); ?>/access/">アクセス</a></li>
                <li><a href="<?php echo get_home_url(); ?>/students-parents/">在校生・保護者</a></li>
                <li><a href="<?php echo get_home_url(); ?>/graduates/">卒業生</a></li>
                <li><a href="<?php echo get_home_url(); ?>/recruit/">教員募集</a></li>
            </ul>
        </div>
        <div class="links1">
            <a class="link" href="<?php echo get_home_url(); ?>/about"><span class="label">学校案内</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/learning"><span class="label">出雲西の学び</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/admission"><span class="label">入試情報</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/results"><span class="label">進学情報</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/school-life"><span class="label">学校生活</span></a>
            <?php /* <a class="link" href="<?php echo get_home_url(); ?>/faq"><span class="label">よくある質問</span></a> */ ?>
            <a class="link" href="<?php echo get_home_url(); ?>/contact"><span class="label">お問い合わせ</span></a>
        </div>
    </div>
</nav>