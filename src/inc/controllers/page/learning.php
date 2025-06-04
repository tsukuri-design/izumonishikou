<?php

/*
 * クラス名はパス基準で命名します。
 * page/front.php の場合は PageFrontController とします。
 */
class PageLearningController extends Controller
{
    protected function title(): string
    {
        return get_bloginfo('name');
    }

    /**
     * 固有のクラス名を追加する場合はパス基準で命名します。
     * page/front.php の場合は page_front とします。
     */
    protected function bodyClassArray(): array
    {
        return array(
            'page_front'
        );
    }

    /** 
     * cssファイルを指定します。
     * ここで複数のcssファイルを取り込むのではなく、一つのscssファイルに使用するscssをuseで取り込むようにしてください。
     */
    protected function cssInlineArray(): array
    {
        return array(
            'page/front_preload',
        );
    }

    /**
     * 読み込むcssのpreload用のpathを設定
     */
    protected function cssPreloadArray(): array
    {
        return array(
            // 'page/front_preload',
        );
    }

    /**
     * 読み込むcssの通常link用のpathを設定
     * 
     * @return array CSSファイルのパスの配列
     */
    protected function cssLoadArray(): array
    {
        return array(
            // 'components/global',
            'page/learning',
        );
    }

    /** 
     * minファイル以外で指定します。
     * minではないファイルを適用する場合は mvc.php の Mvcクラス 内にある public const MINIFY を false; にしてください。
     */
    protected function jsLoadArray(): array
    {
        return array(
            // 'components/check_gtag.js',
            'components/typekit.js',
            'components/noie.js',
            'components/jquery.min.js',
            'components/smooth-scroll.polyfills.min.js',
            'components/inview.js',
            'components/lazysizes.js',
            // 'components/menu.js',
        );
    }

    /** データを扱う場合はここでモデルを呼び出します。 */
    public function predicate(...$args): void
    {
    }
}
