<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>
        <?php eh($data['title']); ?>
    </title>
    <meta property="og:title" content="<?php eh($data['title']); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_og_image_url()); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(home_url('/favicon.ico')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(home_url('/icon.png')); ?>">
    <link rel="canonical" href="<?php echo is_front_page() ? esc_url(home_url()) : esc_url(get_the_permalink()); ?>" />
    <meta name="format-detection" content="telephone=no">
    <meta property="og:url" content="<?php echo is_front_page() ? esc_url(home_url()) : esc_url(get_the_permalink()); ?>">
    <?php if (is_singular()): ?>
        <meta name="description" content="<?php echo get_the_excerpt(); ?>">
        <meta property="og:description" content="<?php echo get_the_excerpt(); ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo esc_attr(get_the_title()); ?>">
        <meta name="twitter:description" content="<?php echo esc_attr(get_the_excerpt()); ?>">
        <meta name="twitter:image" content="<?php echo esc_url(get_og_image_url()); ?>">
    <?php else: ?>
        <meta name="description" content="<?php echo bloginfo('description'); ?>">
        <meta property="og:description" content="<?php echo bloginfo('description'); ?>">
    <?php endif; ?>
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=yes">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MVJK2X94');</script>
    <!-- End Google Tag Manager -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700;900&family=Zen+Kurenaido&display=swap" rel="stylesheet">
    <?php \App\Helper\StylesHelper::print($data['styles'] ?? []); ?>
    <?php if (function_exists('wp_head')) {
        wp_head();
    } ?>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MVJK2X94" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="body_inner">
        <?php view('components/menu_pc'); ?>
        <?php view('components/menu_sp'); ?>