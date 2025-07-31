<!DOCTYPE html>
<html lang="<?php echo $this->siteLang(); ?>">

<head>
    <meta charset="utf-8">
    <title><?php echo htmlEsc($this->title()); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=yes">
    <meta name="description" content="<?php echo htmlEsc($this->description()); ?>">
    <meta name="keywords" content="<?php echo htmlEsc($this->keywords()); ?>">
    <meta property="og:title" content="<?php echo htmlEsc($this->title()); ?>">
    <meta property="og:sitename" content="<?php echo get_bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?php echo htmlEsc($this->description()); ?>">
    <meta property="og:url" content="<?php echo htmlEsc(get_bloginfo('home_url')); ?>">
    <meta property="og:image" content="<?php echo htmlEsc(get_bloginfo('home_url')); ?>ogp.jpg">
    <meta property="fb:app_id" content="528150197920352">
    <link rel="shortcut icon" href="<?php echo htmlEsc(get_bloginfo('home_url')); ?>favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo htmlEsc(get_bloginfo('home_url')); ?>icon.png">
    <link rel="canonical" href="<?php echo htmlEsc(get_bloginfo('home_url')); ?>" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="format-detection" content="telephone=no">
    <meta property="twitter:title" content="<?php echo htmlEsc($this->title()); ?>">
    <meta property="twitter:description" content="<?php echo htmlEsc($this->description()); ?>">
    <meta name="twitter:image" content="<?php echo htmlEsc(get_bloginfo('home_url')); ?>ogp.jpg">

    <!-- 直接読み込む用（Google PageSpeed Insights対策用）-->
    <?php echo $this->cssInline(); ?><!-- /直接読み込む用（Google PageSpeed Insights対策用）-->

    <!-- CSSのpreload（Google PageSpeed Insights対策用）-->
    <?php echo $this->cssPreload(); ?><!-- /CSSのlazyload（Google PageSpeed Insights対策用）-->

    <!-- CSSの通常読み込み用）-->
    <?php echo $this->cssLoad(); ?>
    <!-- CSSの通常読み込み用）-->

    <!-- GTMなどの計測タグ 入れていないので、必要なものを追加してください -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MVJK2X94');</script>
    <!-- End Google Tag Manager -->
</head>

<body class="<?php echo $this->bodyClass(); ?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MVJK2X94" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <noscript>
        <div class="please-js-on">当サイトはJava Scriptをオンにしてご覧ください。｜Please turn on JavaScript to view this page.</div>
    </noscript>
    <?php /* $this->view('components/menu_sp', false); 
<div class="fixed_buttons"><?php $this->view('components/buttons', false, 'cv_fixed_menu'); ?></div> */ ?>
    <?php /* $this->view('components/fixed_menu', false); */ ?>
    <div class="body_inner firstin">