<?php declare(strict_types=1); ?>
<?php if (!is_front_page()): ?>
    <?php echo get_custom_breadcrumbs('出雲西高等学校', home_url('/')); ?>
<?php endif; ?>


<footer class="site-footer">
    <a class="site-footer__logo" href="<?php echo get_home_url(); ?>"><?php svg('logo_white'); ?></a>
    <span class="site-footer__address">〒<span class="en">693-0032</span> 島根県出雲市下古志町<span class="en">1163</span><br><span class="en">TEL: 0853-21-1183</span>　<span class="en">FAX: 0853-21-1397</span></span>

    <div class="site-footer__sns">
        <a href="https://www.youtube.com/@%E5%87%BA%E9%9B%B2%E8%A5%BF%E9%AB%98%E7%AD%89%E5%AD%A6%E6%A0%A1" target="_blank" class="site-footer__sns-link"><?php svg('youtube_white'); ?></a>
        <a href="https://www.facebook.com/izumonishi.education?ref=embed_page" target="_blank" class="site-footer__sns-link"><?php svg('facebook_white'); ?></a>
        <a href="https://www.instagram.com/izumo_nishi.education/" target="_blank" class="site-footer__sns-link"><?php svg('instagram_white'); ?></a>
        <a href="" target="_blank" class="site-footer__sns-link"><?php svg('line_white'); ?></a>
    </div>

    <div class="site-footer__links">
        <a href="<?php echo get_home_url(); ?>/about/" class="site-footer__link">学校案内</a>
        <a href="<?php echo get_home_url(); ?>/learning/" class="site-footer__link">出雲西の学び</a>
        <a href="<?php echo get_home_url(); ?>/entry/" class="site-footer__link">入試情報</a>
        <a href="<?php echo get_home_url(); ?>/results/" class="site-footer__link">進学実績</a>
        <a href="<?php echo get_home_url(); ?>/school-life/" class="site-footer__link">学校生活</a>
        <?php /* <a href="<?php echo get_home_url(); ?>/faq/" class="site-footer__link">よくある質問</a> */ ?>
        <a href="<?php echo get_home_url(); ?>/contact/" class="site-footer__link">お問い合わせ</a>
    </div>

    <div class="site-footer__links site-footer__links--small">
        <a href="<?php echo get_home_url(); ?>/access/" class="site-footer__link">アクセス</a>
        <a href="<?php echo get_home_url(); ?>/students-parents/" class="site-footer__link">在校生・保護者</a>
        <a href="<?php echo get_home_url(); ?>/graduates/" class="site-footer__link">卒業生</a>
        <a href="<?php echo get_home_url(); ?>/recruit/" class="site-footer__link">教員採用</a>
    </div>

    <span class="site-footer__copy en">&copy;<?php echo wp_date('Y'); ?> IZUMO NISHI</span>
</footer>
</div>

<?php \App\Helper\ScriptsHelper::print($data['scripts'] ?? []); ?>
</body>

</html>