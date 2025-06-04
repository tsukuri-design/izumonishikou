<?php

/*
 * クラス名はパス基準で命名します。
 * components/news_list.php の場合は ComponentsNewsListController とします。
 */
class ComponentsNewsListController extends Controller
{
    /** 出力用の */
    public array $news_list;

    /** データを扱う場合はここでモデルを呼び出します。 */
    protected function predicate(...$args): void
    {
        Mvc::load_model('news');
        $this->news_list = NewsModel::findPosts();
    }
}
