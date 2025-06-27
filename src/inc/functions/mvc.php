<?php

/**
 * MVC機能を提供する。
 * コントローラは '{テーマディレクトリ}/inc/controllers/' 以下に規定。
 * モデルは '{テーマディレクトリ}/inc/models/' 以下に規定。
 * ビューは '{テーマディレクトリ}/inc/views/' 以下に規定。
 */
final class Mvc
{
    public const MINIFY = true; // TODO

    public static function run(string $name, string $view_name = '', bool $predicate = true, string $directory_level = '', ...$args): void
    {
        require_once $directory_level . 'inc/controllers/' . $name . '.php';
        $controller_name = ucfirst(lcfirst(strtr(ucwords(strtr(preg_replace('/\//', '_', $name), array('_' => ' '))), array(' ' => '')))) . 'Controller';
        $controller = new $controller_name();
        $controller->view($view_name, $predicate, ...$args);
    }

    public static function load_model(string $name): void
    {
        $model = 'inc/models/' . $name . '.php';
        require_once $model;
    }

    public static function _load_controller(string $name): void
    {
        $controller = 'inc/controllers/' . $name . '.php';
        require_once $controller;
    }
}

/**
 * モデル基底クラス
 */
abstract class Model
{
    private bool $_is_loaded = false;

    public function __construct()
    {
        $args = func_num_args();
        $argv = func_get_args();
        if (method_exists($this, $f = '__construct' . $args)) {
            call_user_func_array(array($this, $f), $argv);
        }
    }

    public function isLoaded(): bool
    {
        return $this->_is_loaded;
    }

    // protected static function bind(Model $model, array $fields, object|array|bool|null $data, bool $set_load = true): void
    protected static function bind(Model $model, array $fields, $data, bool $set_load = true): void
    {
        if (!is_null($data)) {
            foreach ($fields as $key => $field) {
                $field = EntityField::cast($field);
                if (property_exists($model, $key)) {
                    if (self::_has_key($data, $key)) {
                        $value = $value = self::_get_value($data, $key);
                        if (is_array($value) && count($value) === 1) {
                            $value = self::_get_value($data, $key)[0];
                        }
                        if ($field->bindable) {
                            switch ($field->type) {
                                case 'bool':
                                    $model->$key = boolval($value);

                                    break;
                                case 'int':
                                    $model->$key = intval($value, 10);

                                    break;
                                case 'float':
                                    $model->$key = floatval($value);

                                    break;
                                case 'array':
                                    $model->$key = (array) $value;

                                    break;
                                case 'DateTime':
                                    $model->$key = new DateTime($value);

                                    break;
                                default:
                                    $model->$key = $value;

                                    break;
                            }
                            $model->_is_loaded = $set_load;
                        }
                    } elseif ($field->set_default) {
                        $model->$key = $field->default_value;
                    }
                }
            }
        }
    }

    // private static function _has_key(object|array|bool $data, $key): bool
    private static function _has_key($data, $key): bool
    {
        if (is_object($data)) {
            return property_exists($data, $key);
        } elseif (is_array($data)) {
            return array_key_exists($key, $data);
        } elseif (is_bool($data)) {
            return false;
        } else {
            return false;
        }
    }

    // private static function _get_value(object|array $data, $key): mixed
    private static function _get_value($data, $key)
    {
        if (is_array($data)) {
            return $data[$key];
        } else {
            return $data->$key;
        }
    }
}

class EntityField
{
    use Cast;

    public string $type;

    public bool $bindable;

    public bool $set_default;

    // public mixed $default_value;
    public $default_value;

    public function __construct($type, $bindable = false, $set_default = false, $default_value = '')
    {
        $this->type = $type;
        $this->bindable = $bindable;
        $this->set_default = $set_default;
        $this->default_value = $default_value;
    }
}

/**
 * コントローラー基底クラス
 */
abstract class BaseController
{
    /** Content-type */
    protected function getContentType(): string
    {
        return 'text/html';
    }

    /**
     * Viewを読み込む
     *
     * @param string $name View名を指定。デフォルトではコントローラーと同名が利用される。
     * @param bool $predicate データ読み込みを実行するかどうか。デフォルトでは実行しない。
     * @param mixed[] $args Viewに渡す変数を指定。
     */
    public function view(string $name = '', bool $predicate = false, ...$args): void
    {
        if ($predicate) {
            $this->predicate(...$args);
        }
    }

    public function setContentType($headers)
    {
        $headers['Content-Type'] = $this->getContentType() . '; charset=utf-8';

        return $headers;
    }

    protected function getViewFile(string $name): string
    {
        $result = $name;
        if (empty($name)) {
            $ref = new ReflectionClass($this);
            // $result = str_replace('controllers', 'views', str_replace(get_theme_file_path(), '', $ref->getFileName()));
            $result = str_replace('controllers', 'views', str_replace(ROOT_PATH, '', $ref->getFileName()));
        } else {
            $result = '/inc/views/' . $name . '.php';
        }

        return $result;
    }

    public function isExistsView(string $name): string
    {
        $viewfile = $this->getViewFile($name);

        // return file_exists(get_theme_file_path() . $viewfile);
        return file_exists(ROOT_PATH . $viewfile);
    }

    /**
     * Viewを呼び出す前にデータを準備する。
     */
    abstract protected function predicate(...$args): void;
}

abstract class Controller extends BaseController
{
    public function view(string $name = '', bool $predicate = false, ...$args): void
    {
        $viewfile = $this->getViewFile($name);

        if ($predicate) {
            $this->predicate(...$args);
        }

        // add_filter('wp_headers', array($this, 'setContentType'));
        // include get_theme_file_path() . $viewfile;
        include ROOT_PATH . $viewfile;
    }

    /** Set html's head lang */
    protected function siteLang(): string
    {
        return 'ja';
    }

    protected function title(): string
    {
        return get_the_title() . '｜' . get_bloginfo('name');
    }

    protected function description(): string
    {
        return get_bloginfo('description');
    }

    /** Keywords */
    protected function keywords(): string
    {
        return '出雲西高等学校,出雲西,izumo nishi';
    }

    /**
     * body classを指定
     * 
     * 固有のクラス名を追加する場合はパス基準で命名します。
     * page/singular.php の場合は page_singular とします。
     * archive/news.php の場合は archive_news とします。
     */
    protected function bodyClassArray(): array
    {
        return array();
    }

    /** Directory level｜階層の深さ */
    protected function directoryLevel(): string
    {
        return '';
    }

    /** Version Setting｜読み込みファイルのバージョン指定 */
    protected function version(): string
    {
        return '?v625v3';
    }

    /**
     * 読み込むcssのpathを設定
     * 
     * cssファイルを指定します。
     * ここで複数のcssファイルを取り込むのではなく、一つのscssファイルに使用するscssをuseで取り込むようにしてください。
     * 
     * @return array CSSファイルのパスの配列
     */
    protected function cssInlineArray(): array
    {
        return array();
    }

    /**
     * 読み込むcssの通常link用のpathを設定
     * 
     * @return array CSSファイルのパスの配列
     */
    protected function cssLoadArray(): array
    {
        return array();
    }

    /**
     * 読み込むcssのpreload用のpathを設定
     * 
     * @return array CSSファイルのパスの配列
     */
    protected function cssPreloadArray(): array
    {
        return array();
    }

    /**
     * 読み込むjsのpathを設定
     * 
     * minファイル以外で指定します。
     * minではないファイルを適用する場合は mvc.php の Mvcクラス 内にある public const MINIFY を false; にしてください。
     */
    protected function jsLoadArray(): array
    {
        return array();
    }

    /**
     * body class出力用
     */
    public function bodyClass()
    {
        $body_class_array = $this->bodyClassArray();
        return implode(' ', $body_class_array);
    }

    /**
     * 指定されたCSSコードをHTMLの<head>内に直接出力します。
     *
     * この関数は、外部のスタイルシートを使用せず、CSSを直接<head>タグ内に埋め込むために使用します。
     * cssInlineArray()に
     *
     * @return void
     */
    public function cssInline()
    {
        $css_array = $this->cssInlineArray();
        $css = '';
        foreach ($css_array as $file_path) {
            if (file_exists($this->directoryLevel() . 'css/' . $file_path . '.css')) {
                $css .= file_get_contents($this->directoryLevel() . 'css/' . $file_path . '.css');
            }
        }
        if ($css !== '') {
            //     $css = str_replace('../', '', $css);
            //     $css = str_replace('img/', ROOT_PATH . '/img/', $css);

            return '<style>' . $css . '</style>' . PHP_EOL;
        }

        return;
    }

    /**
     * css preload読み込み用
     */
    public function cssPreload()
    {

        $css_array = $this->cssPreloadArray();
        $css_links = [];

        foreach ($css_array as $file_path) {
            // ファイルが存在するかを確認
            if (file_exists($this->directoryLevel() . 'css/' . $file_path . '.css')) {
                $css_links[] = '<link rel="preload" href="' . $this->directoryLevel() . 'css/' . $file_path . '.css' . $this->version() . '" as="style" onload="this.rel=\'stylesheet\'">';
            }
        }

        // 生成したCSSリンクが存在する場合は返す
        if (!empty($css_links)) {
            // 各リンクタグを1行目はインデントなし、2行目以降にインデントをつけて結合
            return $css_links[0] . PHP_EOL . '    ' . implode(PHP_EOL . '    ', array_slice($css_links, 1)) . PHP_EOL;
        }

        return;
    }

    /**
     * 外部のCSSファイルを読み込むための<link>タグをHTMLの<head>内に出力します。
     *
     * この関数は、指定された外部スタイルシートをウェブページに読み込むために使用します。
     *
     * @param string $href 読み込むCSSファイルのURLまたはパス。
     * @param string $media (オプション) スタイルシートのメディアタイプ。デフォルトは 'all'。
     * @return void
     */
    public function cssLoad(): ?string
    {
        $css_array = $this->cssLoadArray();
        $css_links = [];

        foreach ($css_array as $file_path) {
            if (file_exists($this->directoryLevel() . 'css/' . $file_path . '.css')) {
                $css_links[] = '<link rel="stylesheet" href="' . $this->directoryLevel() . 'css/' . $file_path . '.css' . $this->version() . '">';
            }
        }

        if (!empty($css_links)) {
            return $css_links[0] . PHP_EOL . '    ' . implode(PHP_EOL . '    ', array_slice($css_links, 1)) . PHP_EOL;
        }

        return null;
    }

    /**
     * js直出力用
     *
     * 指定されたJSファイルを直出力します。
     */
    public function jsLoad()
    {
        $js_array = $this->jsLoadArray();
        $js = '';

        foreach ($js_array as $file_path) {
            // ファイルの存在をチェック
            if (!file_exists($this->directoryLevel() . 'js/' . $file_path)) {
                continue;
            }

            $js_path = $file_path;

            // MINIFYが有効ならばminifiedファイルが存在するかチェック
            if (Mvc::MINIFY) {
                $min_name = preg_replace('/.js$/', '.min.js', $file_path);
                if (file_exists($this->directoryLevel() . 'js/' . $min_name)) {
                    $js_path = $min_name;
                }
            }

            // JSファイルの内容を読み込み
            $js .= '<script src="' . $this->directoryLevel() . 'js/' . $js_path . $this->version() . '"></script>' . PHP_EOL;
        }

        // JSが生成されていれば返す
        if ($js !== '') {
            return $js;
        }

        return;
    }

}


abstract class JsonController extends BaseController
{
    public function getContentType(): string
    {
        return 'text/json';
    }

    protected function bodyClassArray(): array
    {
        return array();
    }

    protected function cssArray(): array
    {
        return array();
    }

    protected function jsArray(): array
    {
        return array();
    }

    public function predicate(...$args): void
    {
    }

    abstract protected function put(...$args): string;

    abstract protected function get(...$args): string;

    abstract protected function post(...$args): string;

    abstract protected function delete(...$args): string;

    public function view(string $name = '', bool $predicate = true, ...$args): void
    {
        add_filter('wp_headers', array($this, 'setContentType'));
        switch (strtolower($_SERVER['REQUEST_METHOD'])) {
            case 'put':
                print_r($this->put(...$args));

                break;
            case 'get':
                print_r($this->get(...$args));

                break;
            case 'post':
                print_r($this->post(...$args));

                break;
            case 'delete':
                print_r($this->delete(...$args));

                break;
            default:
                // HTTP::Response(405);
                break;
        }
    }

    protected function returnJson(mixed $context): string
    {
        $json = json_encode($context, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if ($json) {
            return $json;
        } else {
            return json_last_error_msg();
        }
    }
}

trait Cast
{
    public static function is($obj): bool
    {
        return $obj instanceof self;
    }

    public static function cast($obj): self
    {
        if (!self::is($obj)) {
            throw new InvalidArgumentException();
        }

        return $obj;
    }

    public static function cast_null($obj): ?self
    {
        if (is_null($obj)) {
            return null;
        } elseif (!self::is($obj)) {
            throw new InvalidArgumentException();
        }

        return $obj;
    }
}
