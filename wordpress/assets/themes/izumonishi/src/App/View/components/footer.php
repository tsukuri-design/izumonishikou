<?php declare(strict_types=1); ?>
<?php if (!is_front_page()): ?>
    <?php echo get_custom_breadcrumbs('興南中学校・興南高等学校', home_url('/')); ?>
<?php endif; ?>


<footer class="site-footer">
    <a class="site-footer__logo" href="<?php echo get_home_url(); ?>"><?php svg('logo_white'); ?></a>
    <span class="site-footer__address">〒693-0032 島根県出雲市下古志町1163<br>TEL: 0853-21-1183　FAX: 0853-21-1397</span>

    <div class="site-footer__sns">
        <a href="" target="_blank" class="site-footer__sns-link"><?php svg('youtube_white'); ?></a>
        <a href="" target="_blank" class="site-footer__sns-link"><?php svg('facebook_white'); ?></a>
        <a href="" target="_blank" class="site-footer__sns-link"><?php svg('instagram_white'); ?></a>
        <a href="" target="_blank" class="site-footer__sns-link"><?php svg('line_white'); ?></a>
    </div>

    <div class="site-footer__links">
        <a href="<?php echo get_home_url(); ?>/about/" class="site-footer__link">学校案内</a>
        <a href="<?php echo get_home_url(); ?>/learning/" class="site-footer__link">出雲西の学び</a>
        <a href="<?php echo get_home_url(); ?>/entry/" class="site-footer__link">入試情報</a>
        <a href="<?php echo get_home_url(); ?>/results/" class="site-footer__link">進学実績</a>
        <a href="<?php echo get_home_url(); ?>/school-life/" class="site-footer__link">学校生活</a>
        <a href="<?php echo get_home_url(); ?>/faq/" class="site-footer__link">よくある質問</a>
        <a href="<?php echo get_home_url(); ?>/contact/" class="site-footer__link">お問い合わせ</a>
    </div>

    <div class="site-footer__links site-footer__links--small">
        <a href="<?php echo get_home_url(); ?>/access/" class="site-footer__link">アクセス</a>
        <a href="<?php echo get_home_url(); ?>/current-students/" class="site-footer__link">在校生・保護者</a>
        <a href="<?php echo get_home_url(); ?>/graduates/" class="site-footer__link">卒業生</a>
        <a href="<?php echo get_home_url(); ?>/recruit/" class="site-footer__link">教員採用</a>
    </div>

    <span class="site-footer__copy">&copy;<?php echo wp_date('Y'); ?> IZUMO NISHI</span>
</footer>
</div>

<?php
if (!empty($data['scripts']) && is_array($data['scripts'])) {
    foreach ($data['scripts'] as $script) {
        js($script);
    }
}
?>
</body>

</html>