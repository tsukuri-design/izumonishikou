<?php
$add_class = $args[0];
?>

<div class="links inaction show">
    <div class="buttons">
        <div class="button">
            <a href="<?php echo high_school(); ?>" target="_blank" rel="noopener noreferrer" class="cv_seminar_hs <?php echo $add_class; ?>">
                <span class="button_text">説明会・体験イベント</span>
                <span class="text_link">今すぐ予約</span>
            </a>
        </div>
        <div class="line_button">
            <a href="<?php echo line_link(); ?>" target="_blank" rel="noopener noreferrer" class="cv_line <?php echo $add_class; ?>">
                <span class="line_logo"><?php echo Svg::LINE()->get(); ?></span>
                <span class="line_text_wrap">
                    <span class="button_text">受験生向けLINE公式アカウント</span>
                <span class="btn">友だち登録はこちら<span class="arrow"><?php echo Svg::ARROW()->get(); ?></span></span>
                </span>
            </a>
        </div>
    </div>
</div>