<?php declare(strict_types=1);

/* Admin CSS｜管理画面用のCSSを適用する */

function loadAdminStyle($kitId = '')
{
    if (is_admin()) {
        $current_screen = get_current_screen();

        $theme_path = get_theme_file_path();
        $admin_css_path = "{$theme_path}/css/admin/style.css";
        $admin_block_css_path = "{$theme_path}/css/admin/admin_block.css";

        $admin_css_content = '';
        if (file_exists($admin_css_path)) {
            $admin_css_content .= file_get_contents($admin_css_path);
        }
        if ($current_screen->is_block_editor && file_exists($admin_block_css_path)) {
            $admin_css_content .= file_get_contents($admin_block_css_path);
        }

        if (!empty($admin_css_content)) {
            echo '<style>' . $admin_css_content . '</style>' . "\n";
        }

        if ($current_screen->is_block_editor && !empty($kitId)) {
            echo "<script>(function(d){var config={kitId:'{$kitId}',scriptTimeout:3000,async:true},h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,'')+' wf-inactive';},config.scriptTimeout),tk=d.createElement('script'),f=false,s=d.getElementsByTagName('script')[0],a;h.className+=' wf-loading';tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!='complete'&&a!='loaded')return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s);})(document);</script>\n";
        }
    }
}
add_action('admin_enqueue_scripts', 'loadAdminStyle');
