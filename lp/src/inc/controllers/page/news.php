<?php

/**
 * クラス名はパス基準で命名します。
 * page/singular.php の場合は PageSingularController とします。
 */
class PageNewsController extends Controller
{
    public array $posts;

    protected function title(): string
    {
        return get_the_title() . '｜' . get_bloginfo('name');
    }

    protected function description(): string
    {
        if (exists(get_the_content())) {
            return mb_strimwidth(wp_strip_all_tags(get_the_content(), true), 0, 155, '...');
        } else {
            return get_bloginfo('description');
        }
    }

    /**
     * 固有のクラス名を追加する場合はパス基準で命名します。
     * page/singular.php の場合は page_singular とします。
     */
    protected function bodyClassArray(): array
    {
        return array(
            'page_news'
        );
    }

    /** 
     * cssファイルを指定します。
     * ここで複数のcssファイルを取り込むのではなく、一つのscssファイルに使用するscssをuseで取り込むようにしてください。
     */
    protected function cssArray(): array
    {
        return array(
            'page/news.css',
        );
    }

    /** 
     * minファイル以外で指定します。
     * minではないファイルを適用する場合は mvc.php の Mvcクラス 内にある public const MINIFY を false; にしてください。
     */
    protected function jsArray(): array
    {
        return array(
            'components/typekit.js',
            'components/noie.js',
            'page/news.js'
        );
    }

    /** データを扱う場合はここでモデルを呼び出します。 */
    public function predicate(...$args): void
    {
    }
}