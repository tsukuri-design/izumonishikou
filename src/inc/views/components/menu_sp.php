<nav class="header_nav">
    <div class="logo">
        <picture>
            <source srcset="img/logo.webp" type="image/webp"><img alt="" data-expand="750" loading="eager" src="img/logo.png" width="150" height="25">
        </picture>
    </div>
    <div class="menu_btn">
        <div class="btn_inner">
            <div class="bd_wrap">
                <span class="bd"></span>
                <span class="bd bd2"></span>
                <span class="bd bd3"></span>
            </div>
        </div>
    </div>
</nav>
<div class="opened_menu">
    <div class="menu_inner">
        <div class="close_btn"><span class="bds"><span class="bd"></span><span class="bd"></span></span></div>
        <div class="logo"><?php echo picture('', 'logo', 'png', '', 'webp', '', '', '', ''); ?></div>
        <div class="inner_list list">
            <div class="inner_wrap">
                <?php $this->view('components/menu_links', false); ?>
            </div>
        </div>
        <?php $this->view('components/buttons', false, 'cv_sp_menu'); ?>
    </div>
</div>