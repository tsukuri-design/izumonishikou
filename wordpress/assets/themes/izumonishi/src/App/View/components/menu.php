<div class="menu">
    <div class="menu__inner desktop">
        <a class="menu__item" href="<?php echo get_home_url(); ?>/admission/events/">
            <span class="menu__item-icon menu__item-icon--1"><?php svg('menu1'); ?></span>
            <span class="menu__item-text">イベント・<br>学校説明会</span>
        </a>
        <a class="menu__item" href="<?php echo get_home_url(); ?>/admission/">
            <span class="menu__item-icon menu__item-icon--1"><?php svg('menu2'); ?></span>
            <span class="menu__item-text"><span class="en">2026</span>年度<br>入試情報</span>
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
            <a href="https://www.instagram.com/izumo_nishi.education/#" target="_blank"><?php svg('instagram'); ?></a>
            <a href="https://www.facebook.com/izumonishi.education?ref=embed_page" target="_blank"><?php svg('facebook'); ?></a>
            <a href="https://lin.ee/adnQk1nk" target="_blank"><?php svg('line'); ?></a>
        </div>
    </div>
</div>

<nav class="menu_top">
    <div class="logo">
        <a href="<?php echo esc_html(home_url()); ?>"><?php svg('logo'); ?></a>
    </div>
    <div class="md menu_button"><?php svg('menu_button'); ?></div>
    <div class="links_wrap">
        <div class="links2">
            <ul class="links_small">
                <li><a href="<?php echo get_home_url(); ?>/access/">アクセス</a></li>
                <li><a href="<?php echo get_home_url(); ?>/students-parents/">在校生・保護者</a></li>
                <li><a href="<?php echo get_home_url(); ?>/graduate/">卒業生</a></li>
                <li><a href="<?php echo get_home_url(); ?>/teacher-recruitment/">教員募集</a></li>
                <?php /*<li><a href="<?php echo get_home_url(); ?>/privacy-policy/">プライバシーポリシー</a></li> */ ?>
            </ul>
        </div>
        <div class="links1">
            <a class="link" href="<?php echo get_home_url(); ?>/about/"><span class="label">学校案内</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/learning/"><span class="label">出雲西の学び</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/admission/"><span class="label">入試情報</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/career/"><span class="label">進学情報</span></a>
            <a class="link" href="<?php echo get_home_url(); ?>/school-life/"><span class="label">学校生活</span></a>
            <?php /* <a class="link" href="<?php echo get_home_url(); ?>/faq"><span class="label">よくある質問</span></a> */ ?>
            <a class="link" href="<?php echo get_home_url(); ?>/contact"><span class="label">お問い合わせ</span></a>
        </div>
    </div>
</nav>
<div class="opened_menu">
    <a href="<?php echo get_home_url(); ?>" class="logo"><?php svg('logo_white'); ?></a>
    <div class="close"><?php svg('close'); ?></div>
    <div class="buttons">
        <a href="<?php echo get_home_url(); ?>/admission/events/" class="menu-button has-border"><?php svg('button1'); ?></a>
        <a href="<?php echo get_home_url(); ?>/admission/" class="menu-button"><?php svg('button2'); ?></a>
        <div class="divider"></div>
        <a href="<?php echo get_home_url(); ?>/pamphlet/admission_information_2026/" target="_blank" class="menu-button has-border"><?php svg('button3'); ?></a>
        <a href="<?php echo get_home_url(); ?>/contact/" class="menu-button"><?php svg('button4'); ?></a>
    </div>
    <div class="menu_link_wrap">
        <ul class="menu_section">
            <li class="title">
                <a href="<?php echo esc_url(get_home_url()); ?>/about/">
                    <span class="english">ABOUT</span>
                    <span class="japanese">学校案内</span>
                </a>
            </li>
        </ul>
        <ul class="menu_section">
            <li class="title">
                <span class="title_button md"><span class="plus"><?php svg('plus'); ?></span></span>
                <a href="<?php echo esc_url(get_home_url()); ?>/learning/">
                    <span class="english">LEARNING</span>
                    <span class="japanese">出雲西の学び</span>
                </a>
            </li>
            <ul class="link_list">
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/learning/educational-program/">教育プログラム</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/learning/advanced-course/">特別進学コース</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/learning/welfare-course/">福祉コース</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/learning/business-course/">ビジネスコース</a></li>
            </ul>
        </ul>
        <ul class="menu_section">
            <li class="title">
                <span class="title_button md"><span class="plus"><?php svg('plus'); ?></span></span>
                <a href="<?php echo esc_url(get_home_url()); ?>/admission/">
                    <span class="english">ADMISSION</span>
                    <span class="japanese">入試情報</span>
                </a>
            </li>
            <ul class="link_list">
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/exam-guidelines/">令和8年選抜試験実施要項</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/events/">オープンスクール／入試説明会</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/tuition">学費/就学支援金・奨学金制度</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/download-forms/">入試関連書類 ダウンロード</a></li>
            </ul>
        </ul>
        <ul class="menu_section">
            <li class="title">
                <span class="title_button md"><span class="plus"><?php svg('plus'); ?></span></span>
                <a href="<?php echo esc_url(get_home_url()); ?>/career/">
                    <span class="english">CAREER</span>
                    <span class="japanese">進学情報</span>
                </a>
            </li>
            <ul class="link_list">
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/career/career-support/">進学サポート・キャリア支援</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/career/admission-results/">大学合格実績</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/career/career-outcomes/">就職実績</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/career/graduates/">卒業生の声</a></li>
            </ul>
        </ul>
        <ul class="menu_section">
            <li class="title">
                <span class="title_button md"><span class="plus"><?php svg('plus'); ?></span></span>
                <a href="<?php echo esc_url(get_home_url()); ?>/school-life/">
                    <span class="english">SCHOOL LIFE</span>
                    <span class="japanese">学校生活</span>
                </a>
            </li>
            <ul class="link_list">
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/club-activities/">部活動・同好会</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/school-events/">学校行事</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/school-uniform/">制服</a></li>
                <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/facilities/">施設・設備</a></li>
            </ul>
        </ul>
        <ul class="menu_section md">
            <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/access/">アクセス</a></li>
            <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/students-parents/">在校生・保護者</a></li>
            <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/graduate/">卒業生</a></li>
            <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/teacher-recruitment/">教員採用</a></li>
            <?php /* <li class="item"><a href="<?php echo get_home_url(); ?>/privacy-policy/">プライバシーポリシー</a></li>*/ ?>
        </ul>

        <div class="sns">
            <a href="https://www.youtube.com/@%E5%87%BA%E9%9B%B2%E8%A5%BF%E9%AB%98%E7%AD%89%E5%AD%A6%E6%A0%A1" target="_blank" class="sns-link"><?php svg('youtube_white'); ?></a>
            <a href="https://www.facebook.com/izumonishi.education?ref=embed_page" target="_blank" class="sns-link"><?php svg('facebook_white'); ?></a>
            <a href="https://www.instagram.com/izumo_nishi.education/" target="_blank" class="sns-link"><?php svg('instagram_white'); ?></a>
            <a href="https://lin.ee/adnQk1nk" target="_blank" class="sns-link"><?php svg('line_white_alt'); ?></a>
        </div>
    </div>
</div>