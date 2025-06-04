<?php

Mvc::load_model('post');

/**
 * News モデル
 * クラス名は{ファイル名}Model として下さい。例）news.php → NewsModel
 */
class NewsModel extends PostModel
{
    use Cast;

    // ---- fields

    // -- definitions

    /**
     * 使用するカスタムフィールドを指定します。
     * メソッド名は get{ファイル名}Fields でキャメルケースで作成下さい。
     * EntityFieldに指定する名前はacfのslugと同名を記載してください。
     * また、EntityFieldsで型指定とデフォルト値ｗ指定してください。
     */
    private static function getNewsFields(): array
    {
        return array(
            'no_link'       => new EntityField('bool', true),
            'external_link' => new EntityField('bool', true),
            'link'          => new EntityField('string', true),
            'image'         => new EntityField('string', true),
        );
    }

    // -- entity fields

    /**
     * 上記のgetXXXFieldsで指定した名前と同じプロパティを宣言して下さい
     */

    public bool $no_link;
    public bool $external_link;
    public string $link;
    public array $link_array;
    public string $image;
    public array $image_array;

    /**
     * 上記のgetXXXFieldsで指定した名前と同じメソッド名でバインドして下さい
     */
    public function __construct1(int $id): void
    {
        parent::__construct1($id);

        $custom = get_post_custom($id);
        self::bind($this, self::getNewsFields(), $custom);
        $this->image_array = get_field('image', $this->ID);
        $this->link_array  = unserialize($this->link);
    }

    // ---- implements abstract

    /**
     * 使用するポストタイプのスラッグを指定してください。
     */
    public function getPostType(): string
    {
        return 'news';
    }

    /** URLを設定 */
    public function link()
    {
        $tag    = 'a';
        $url    = '';
        $target = '';
        $title  = '';

        // リンクにしないがチェックされていたら span
        if ($this->no_link === 1) {
            $tag = 'span';
        }

        // 外部リンクにするにチェックが入っていたら
        if ($this->external_link === 0 ) {
            $url = $this->link['url'];
        } else {
            $url    = $this->link['url'];
            $target = $this->link['target'] === '_blank' ? ' target="_blank"' : '';
            $title  = $this->link_array['title'] ? $this->link_array['title'] : '';
        }

        return array(
            'url'    => $url,
            'target' => $target,
            'title'  => $title
        );
    }

    public static function findPosts(): array
    {
        return self::find(NewsModel::class, array(
            'post_type'      => 'news',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ));
    }
}
