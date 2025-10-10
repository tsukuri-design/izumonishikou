<?php declare(strict_types=1);

class Svg
{
    private string $content;
    private static array $svgs = [];

    /**
     * コンストラクタは外部から呼び出せないようにする
     */
    private function __construct(string $name)
    {
        $this->content = file_get_contents(
            get_theme_file_path() . '/svgs/' . $name . '.svg'
        );
    }

    /**
     * SVGデータを取得する
     */
    public function get(): string
    {
        return $this->content;
    }

    /**
     * SVGクラスのインスタンスを取得する
     */
    public static function getInstance(string $key): Svg
    {
        if (!array_key_exists($key, self::$svgs)) {
            self::$svgs[$key] = new Svg($key);
        }

        return self::$svgs[$key];
    }
}


if (!function_exists('svg')) {
    /**
     * Output or return an SVG by filename.
     *
     * @param  string    $svg_name  Filename of the SVG (without the .svg extension).
     * @param  bool      $return    If true, returns the SVG content instead of echoing it.
     * @return string|null
     */
    function svg(string $svg_name, bool $return = false): ?string
    {
        // Get (cached) instance of the SVG
        $svg = Svg::getInstance($svg_name);

        // Retrieve the content
        $content = $svg->get();

        // Decide whether to echo or return
        if ($return) {
            return $content;
        }

        echo $content;
        return null;
    }
}
