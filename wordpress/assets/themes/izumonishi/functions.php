<?php declare(strict_types=1);

use App\Controller\ErrorController;
use Mvc4Wp\Core\Service\Helper;

define('__MVC4WP_ROOT__', __DIR__);
require_once __MVC4WP_ROOT__ . '/vendor/autoload.php';

use App\Controller\LoginController;
use App\Logger\LogEntityLoggerFactory;
use App\Model\CustomCatEntity;
use App\Model\CustomTagEntity;
use App\Model\ExampleEntity;
use App\Model\LogEntity;
use App\Model\LogLevelTagEntity;
use Mvc4Wp\Core\Library\WordPressCustomize;
use Mvc4Wp\Core\Logger\Default\DefaultFileLoggerFactory;
use Mvc4Wp\Core\Service\App;
use Mvc4Wp\Core\Service\Logging;

/*
 * --------------------------------------------------------------------
 * General configuration
 * --------------------------------------------------------------------
 */
App::get()->config()->set('error_handler.handlers.403', ErrorController::class);
App::get()->config()->set('error_handler.handlers.404', ErrorController::class);
App::get()->config()->set('js.use_minify', 'false');
App::get()->config()->set('css.css_directory', __MVC4WP_ROOT__ . '/scss');
App::get()->config()->set('css.use_cache', 'true');
App::get()->config()->set('css.use_minify', 'false');
App::get()->config()->set('logger.loggers.app.log_level', 'debug');
App::get()->config()->set('logger.loggers.core.log_level', 'debug');
App::get()->config()->set('logger.loggers.log_model', [
    'logger_factory' => LogEntityLoggerFactory::class,
    'log_level' => 'info',
]);
App::get()->config()->set('logger.loggers.sql', [
    'logger_factory' => DefaultFileLoggerFactory::class,
    'directory' => __MVC4WP_ROOT__ . '/log/',
    'basefilename' => 'sql',
    'file_date_format' => 'Ymd',
    'datetime_format' => 'Y-m-d H:i:s',
    'timezone' => 'Asia/Tokyo',
    'log_level' => 'debug',
]);
Logging::configure(App::get()->config());

/*
 * --------------------------------------------------------------------
 * Wordpress customization
 * --------------------------------------------------------------------
 */
WordPressCustomize::enableTraceSQL(function ($q) {
    Logging::get('sql')->debug($q);
    return $q;
});
// WordPressCustomize::addCustomPostType(ExampleEntity::class); // ACF使うなら記載しない
// WordPressCustomize::addCustomTaxonomy(CustomCatEntity::class); // ACF使うなら記載しない
// WordPressCustomize::addCustomTaxonomy(CustomTagEntity::class); // ACF使うなら記載しない
// WordPressCustomize::addCustomPostType(LogEntity::class);
// WordPressCustomize::addCustomTaxonomy(LogLevelTagEntity::class);
WordPressCustomize::disableRedirectCanonical();
// WordPressCustomize::changeLoginUrl(LoginController::class, ''); // ここで変更できる index.phpのログインのURLも変更する
// 画面を変更しない場合は、ここに記載する

/*
 * --------------------------------------------------------------------
 * Initialize application
 * --------------------------------------------------------------------
 */
// Helper::load('Debug'); // Debugしない場合はコメントアウト
Helper::load('View'); // CoreとAppのHelperを読み込む function名が同じだと、Appが優先される
Helper::load('ThemeSupport');
Helper::load('Svg');
Helper::load('Acf');
Helper::load('Picture');
Helper::load('Ogp');
Helper::load('PostSlug');
// Helper::load('BlockEditorComment');
Helper::load('JapaneseFileName');
Helper::load('Redirect404');
Helper::load('RemoveHeaderTags');
Helper::load('RemoveBlockLibraryCss');
Helper::load('MediaNoIndex');
Helper::load('RemoveProtected');
Helper::load('PasswordFormResponse');
Helper::load('DisableAuthorArchive');
Helper::load('DisableRestApi');
Helper::load('RetrievePasswordMessage');
Helper::load('EditorAdminDisplay');
Helper::load('AdminCssStyle');
Helper::load('EscapeHtmlCharacters');
Helper::load('JavascriptEscape');
Helper::load('Exists');
Helper::load('ShowOrderAdmin');
Helper::load('DisableAutoUpdate');
Helper::load('ChangeLoginUrl');
Helper::load('addCssVariable');
Helper::load('Breadcrumb');
Helper::load('RelatedPosts');
Helper::load('TopicsCategory');
Helper::load('RobustBlockEditorComment');
Helper::load('PageSequenceHelper');
Helper::load('PageEnglishTitleHelper');

// 通し番号機能を初期化
\App\Helper\PageSequenceHelper::init();

// 英語タイトル機能を初期化
\App\Helper\PageEnglishTitleHelper::init();

/**
 * Side menu
 */
function get_current_page_hierarchy(): string
{
    if (!is_page())
        return '';

    $current = get_post(get_queried_object_id());
    if (!$current instanceof WP_Post)
        return '';

    $ancestors = get_post_ancestors($current->ID);
    $lineage = array_reverse($ancestors);
    $lineage[] = $current->ID;

    $depth = count($lineage);
    $header_index = ($depth >= 3) ? 1 : 0;
    $section_parent_id = (int) $lineage[$header_index];

    $resolve_link = static function (int $post_id): array {
        $acf = get_field('link', $post_id);
        $has = is_array($acf) && !empty($acf['url']);
        $url = $has ? (string) $acf['url'] : get_permalink($post_id);
        $target = ($has && !empty($acf['target'])) ? (string) $acf['target'] : '_self';
        $rel = ($target === '_blank') ? ' rel="noopener noreferrer"' : '';
        return ['url' => $url, 'target' => $target, 'rel' => $rel];
    };

    $children = get_children([
        'post_parent' => $section_parent_id,
        'post_type' => 'page',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'ASC',
        'numberposts' => -1,
    ]);

    // NOTE: removed the early `if (empty($children)) return '';`

    $arrow_svg = '<span class="arrow"><svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.7861 5.85645V6.85645H0.5V5.85645H12.7861Z" fill="#07376C"/><path d="M13.7131 6.35742L7.64868 12.4219L6.94165 11.7148L12.2991 6.35742L6.94165 1L7.64868 0.292969L13.7131 6.35742Z" fill="#07376C"/></svg></span>';

    $items_html = '';

    // Parent (unless no_link)
    if (!get_field('no_link', $section_parent_id)) {
        $parent_title = get_the_title($section_parent_id);
        $parent_link = $resolve_link($section_parent_id);
        $items_html .= '<li><a href="' . esc_url($parent_link['url']) . '" target="' . esc_attr($parent_link['target']) . '"' . $parent_link['rel'] . ' class="link">'
            . '<span class="link_text">' . esc_html($parent_title) . '</span>'
            . $arrow_svg . '</a></li>';
    }

    // Children
    if (!empty($children)) {
        foreach ($children as $child) {
            $child_id = (int) $child->ID;
            if (get_field('no_link', $child_id))
                continue;

            $link = $resolve_link($child_id);
            $is_current = ($child_id === (int) $current->ID) ? ' is-current' : '';

            $items_html .= '<li><a href="' . esc_url($link['url']) . '" target="' . esc_attr($link['target']) . '"' . $link['rel'] . ' class="link' . $is_current . '">'
                . '<span class="link_text">' . esc_html(get_the_title($child_id)) . '</span>'
                . $arrow_svg . '</a></li>';
        }
    }

    if ($items_html === '')
        return '';
    return '<div class="side_menu inaction inaction_opacity"><ul>' . $items_html . '</ul></div>';
}

