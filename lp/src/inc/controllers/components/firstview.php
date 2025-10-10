<?php

/*
 * クラス名はパス基準で命名します。
 * components/firstview.php の場合は ComponentsFirstViewController とします。
 */
class ComponentsFirstViewController extends Controller
{
    /** データを扱う場合はここでモデルを呼び出します。 */
    protected function predicate(...$args): void
    {
    }
}
