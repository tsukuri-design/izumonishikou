<div class="menu">
    <div class="menu__inner desktop">
        <div class="menu__button menu__button--icon-hamburger">

        </div>
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

    <!-- keep this exactly for mobile -->
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
            <!-- six dropdown triggers (mirrors other site's structure) -->
            <div class="link open_menu_modal" data-target="modal_menu_about"><span class="label">学校案内</span></div>
            <div class="link open_menu_modal" data-target="modal_menu_learning"><span class="label">出雲西の学び</span></div>
            <div class="link open_menu_modal" data-target="modal_menu_admission"><span class="label">入試情報</span></div>
            <div class="link open_menu_modal" data-target="modal_menu_career"><span class="label">進学情報</span></div>
            <div class="link open_menu_modal" data-target="modal_menu_school_life"><span class="label">学校生活</span></div>
            <div class="link open_menu_modal" data-target="modal_menu_contact"><span class="label">お問い合わせ</span></div>
        </div>
    </div>

    <!-- ===== ABOUT (学校案内) ===== -->
    <div class="modal_menu_links" id="modal_menu_about" aria-hidden="true">
        <a class="link_parent" href="<?php echo esc_url(get_home_url()); ?>/about/">
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'menu_about', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            </div>
            <div class="label">
                <span class="en">ABOUT</span>
                <span class="ja">学校案内</span>
            </div>
            <div class="arrow_wrap"><span class="arrow"><?php svg('arrow_circle'); ?></span></div>
        </a>
        <div class="links">
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/about/#header-1">
                <span class="label">教育の理念</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/about/#header-2">
                <span class="label">校訓</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/about/#header-3">
                <span class="label">校長メッセージ</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
        </div>
    </div>

    <!-- ===== LEARNING (出雲西の学び) ===== -->
    <div class="modal_menu_links" id="modal_menu_learning" aria-hidden="true">
        <a class="link_parent" href="<?php echo esc_url(get_home_url()); ?>/learning/">
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'menu_learning', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            </div>
            <div class="label">
                <span class="en">LEARNING</span>
                <span class="ja">出雲西の学び</span>
            </div>
            <div class="arrow_wrap"><span class="arrow"><?php svg('arrow_circle'); ?></span></div>
        </a>
        <div class="links">
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/learning/educational-program/">
                <span class="label">教育プログラム</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/learning/advanced-course/">
                <span class="label">特別進学コース</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/learning/welfare-course/">
                <span class="label">福祉コース</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/learning/business-course/">
                <span class="label">ビジネスコース</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
        </div>
    </div>

    <!-- ===== ADMISSION (入試情報) ===== -->
    <div class="modal_menu_links" id="modal_menu_admission" aria-hidden="true">
        <a class="link_parent" href="<?php echo esc_url(get_home_url()); ?>/admission/">
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'menu_entry', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            </div>
            <div class="label">
                <span class="en">ADMISSION</span>
                <span class="ja">入試情報</span>
            </div>
            <div class="arrow_wrap"><span class="arrow"><?php svg('arrow_circle'); ?></span></div>
        </a>
        <div class="links">
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/admission/exam-guidelines/">
                <span class="label">令和8年選抜試験実施要項</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/admission/events/">
                <span class="label">オープンスクール／<br>入試説明会</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/admission/tuition/">
                <span class="label">納入金・奨学金制度</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/admission/download-forms/">
                <span class="label">中学校の先生方用 <br>入試関連資料</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
        </div>
    </div>

    <!-- ===== CAREER (進学情報) ===== -->
    <div class="modal_menu_links" id="modal_menu_career" aria-hidden="true">
        <a class="link_parent" href="<?php echo esc_url(get_home_url()); ?>/career/">
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'menu_career', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            </div>
            <div class="label">
                <span class="en">CAREER</span>
                <span class="ja">進学情報</span>
            </div>
            <div class="arrow_wrap"><span class="arrow"><?php svg('arrow_circle'); ?></span></div>
        </a>
        <div class="links">
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/career/career-support/">
                <span class="label">進学サポート・キャリア支援</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/career/admission-results/">
                <span class="label">大学合格実績</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/career/career-outcomes/">
                <span class="label">就職実績</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/career/graduates/">
                <span class="label">卒業生の声</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
        </div>
    </div>

    <!-- ===== SCHOOL LIFE (学校生活) ===== -->
    <div class="modal_menu_links" id="modal_menu_school_life" aria-hidden="true">
        <a class="link_parent" href="<?php echo esc_url(get_home_url()); ?>/school-life/">
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'menu_life', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            </div>
            <div class="label">
                <span class="en">SCHOOL LIFE</span>
                <span class="ja">学校生活</span>
            </div>
            <div class="arrow_wrap"><span class="arrow"><?php svg('arrow_circle'); ?></span></div>
        </a>
        <div class="links">
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/school-life/club-activities/">
                <span class="label">部活動・同窓会</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/school-life/school-events/">
                <span class="label">学校行事</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/school-life/school-uniform/">
                <span class="label">制服</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/school-life/facilities/">
                <span class="label">施設・設備</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
        </div>
    </div>

    <!-- ===== CONTACT (お問い合わせ) ===== -->
    <div class="modal_menu_links" id="modal_menu_contact" aria-hidden="true">
        <a class="link_parent" href="<?php echo esc_url(get_home_url()); ?>/contact/">
            <div class="image_wrap">
                <figure class="image"><?php echo picture('', 'menu_contact', 'jpg', '', 'webp', '', '', '', ''); ?></figure>
            </div>
            <div class="label">
                <span class="en">CONTACT</span>
                <span class="ja">お問い合わせ</span>
            </div>
            <div class="arrow_wrap"><span class="arrow"><?php svg('arrow_circle'); ?></span></div>
        </a>
        <div class="links">
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/contact/">
                <span class="label">お問い合わせ</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
            <a class="link_child" href="<?php echo esc_url(get_home_url()); ?>/contact/#header-2">
                <span class="label">お問い合わせフォーム</span><span class="arrow"><?php svg('dropdown_arrow'); ?></span>
            </a>
        </div>
    </div>
</nav>

<div class="opened_menu_desktop">
    <nav class="menu_inner" aria-label="Site">

        <div class="top_wrap">
            <div class="logo">
                <a href="<?php echo esc_html(home_url()); ?>"><?php echo picture('', 'logo_white', 'png', '', '', '', '', '', ''); ?></a>
            </div>
        </div>

        <div class="menu_sub_wrap">
            <div class="menu_link_wrap">

                <!-- 学校案内 -->
                <ul class="menu_section">
                    <li class="title">

                        <a href="<?php echo esc_url(get_home_url()); ?>/about/">
                            <span class="english">ABOUT</span>
                            <span class="japanese">学校案内</span>
                        </a>
                    </li>
                    <ul class="link_list">
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/about/#header-1">教育の理念</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/about/#header-2">校訓</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/about/#header-3">校長メッセージ</a></li>
                    </ul>
                </ul>

                <!-- 出雲西の学び -->
                <ul class="menu_section">
                    <li class="title">

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

                <!-- 入試情報 -->
                <ul class="menu_section">
                    <li class="title">

                        <a href="<?php echo esc_url(get_home_url()); ?>/admission/">
                            <span class="english">ADMISSION</span>
                            <span class="japanese">入試情報</span>
                        </a>
                    </li>
                    <ul class="link_list">
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/exam-guidelines/">令和8年選抜試験実施要項</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/events/">オープンスクール／入試説明会</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/tuition/">納入金・奨学金制度</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/admission/download-forms/">中学校の先生方用 入試関連資料</a></li>
                    </ul>
                </ul>

                <!-- 進学情報 -->
                <ul class="menu_section">
                    <li class="title">

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

                <!-- 学校生活 -->
                <ul class="menu_section">
                    <li class="title">

                        <a href="<?php echo esc_url(get_home_url()); ?>/school-life/">
                            <span class="english">SCHOOL LIFE</span>
                            <span class="japanese">学校生活</span>
                        </a>
                    </li>
                    <ul class="link_list">
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/club-activities/">部活動・同窓会</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/school-events/">学校行事</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/school-uniform/">制服</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/school-life/facilities/">施設・設備</a></li>
                    </ul>
                </ul>

                <!-- お問い合わせ -->
                <ul class="menu_section">
                    <li class="title">
                        <a href="<?php echo esc_url(get_home_url()); ?>/contact/">
                            <span class="english">CONTACT</span>
                            <span class="japanese">お問い合わせ</span>
                        </a>
                    </li>
                    <ul class="link_list">
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/contact/">お問い合わせ</a></li>
                        <li class="item"><a href="<?php echo esc_url(get_home_url()); ?>/contact/#header-2">お問い合わせフォーム</a></li>
                    </ul>
                </ul>

            </div>
            <div class="menu_link_wrap2">
                <ul class="menu_section">
                    <li class="title">
                        <a href="<?php echo esc_url(get_home_url()); ?>/access/">
                            <span class="english">ACCESS</span>
                            <span class="japanese">アクセス</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_section">
                    <li class="title">
                        <a href="<?php echo esc_url(get_home_url()); ?>/access/">
                            <span class="english">STUDENTS PARENTS</span>
                            <span class="japanese">在校生・保護者</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_section">
                    <li class="title">
                        <a href="<?php echo esc_url(get_home_url()); ?>/access/">
                            <span class="english">GRADUATES</span>
                            <span class="japanese">卒業生</span>
                        </a>
                    </li>
                </ul>
                <ul class="menu_section">
                    <li class="title">
                        <a href="<?php echo esc_url(get_home_url()); ?>/access/">
                            <span class="english">TEACHER RECRUITMENT</span>
                            <span class="japanese">教員募集</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</div>