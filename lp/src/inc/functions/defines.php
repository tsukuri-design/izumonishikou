<?php

/** Wordpressで定義されている関数を改めて定義 */

function get_bloginfo($show = '')
{
    switch ($show) {
        case 'home_url':
            $output = 'https://www.izumonishikou.jp/lp/';

            break;
        case 'description':
            $output = '未来は複雑で、どう変わるか、誰にもわからない。だからこそ、今、君に必要なのは、自分で考え、自分らしく進む力。“学力だけでなく、生きる力を身につける”をテーマに、本校は、答えのない時代を生き抜く「主体性」を育みます。';

            break;
        case 'name':
        default:
            $output = '出雲西高等学校｜未知なる未来に、準備する';

            break;
    }

    return $output;
}

/**
 * ユーザー種別を定義するクラス
 */
final class Role
{
    private static array $roles = array();

    private static function getInstance($key, $name): Role
    {
        if (!array_key_exists($key, self::$roles)) {
            self::$roles[$key] = new Role($key, $name);
        }

        return self::$roles[$key];
    }

    /**
     * 購読者
     * @deprecated Wordpress標準のため不使用
     */
    public static function SUBSCRIBER(): Role
    {
        return self::getInstance('subscriber', '購読者');
    }

    /**
     * 寄稿者
     * @deprecated Wordpress標準のため不使用
     */
    public static function CONTRIBUTER(): Role
    {
        return self::getInstance('contributer', '寄稿者');
    }

    /** 投稿者
     * @deprecated Wordpress標準のため不使用
     */
    public static function AUTHOR(): Role
    {
        return self::getInstance('author', '投稿者');
    }

    /** 編集者
     * @deprecated Wordpress標準のため不使用
     */
    public static function EDITOR(): Role
    {
        return self::getInstance('editor', '編集者');
    }

    /**
     * 管理者
     */
    public static function ADMINISTRATOR(): Role
    {
        return self::getInstance('administrator', '管理者');
    }

    /** 英名 */
    private string $key;

    /** 和名 */
    private string $name;

    private function __construct(string $key, string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * 英名を取得する
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * 和名を取得する
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}