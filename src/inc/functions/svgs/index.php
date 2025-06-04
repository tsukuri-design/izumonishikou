<?php

class Svg
{
    private string $content;

    private function __construct($name)
    {
        $this->content = file_get_contents(ROOT_PATH . '/inc/functions/svgs/' . $name . '.svg');
    }

    /**
     * SVGデータを取得する
     */
    public function get(): string
    {
        return $this->content;
    }

    private static array $svgs = array();

    private static function getInstance($key): Svg
    {
        if (!array_key_exists($key, self::$svgs)) {
            self::$svgs[$key] = new Svg($key);
        }

        return self::$svgs[$key];
    }

    /**
     * Twitter icon
     */
    public static function TWITTER(): Svg
    {
        return self::getInstance('twitter');
    }

    /**
     * Instagram icon
     */
    public static function INSTAGRAM(): Svg
    {
        return self::getInstance('instagram');
    }

    /**
     * Facebook icon
     */
    public static function FACEBOOK(): Svg
    {
        return self::getInstance('facebook');
    }

    /**
     * YouTube icon
     */
    public static function YOUTUBE(): Svg
    {
        return self::getInstance('youtube');
    }

    /**
     * LINE icon
     */
    public static function LINE(): Svg
    {
        return self::getInstance('line');
    }

    /**
     * ARROW icon
     */
    public static function ARROW(): Svg
    {
        return self::getInstance('arrow');
    }

    public static function PHONE(): Svg
    {
        return self::getInstance('phone');
    }
    public static function TOP_TEXT(): Svg
    {
        return self::getInstance('top_text');
    }

    public static function MORE1(): Svg
    {
        return self::getInstance('more1');
    }
    public static function MORE2(): Svg
    {
        return self::getInstance('more2');
    }
    public static function MORE3(): Svg
    {
        return self::getInstance('more3');
    }
    public static function MORE4(): Svg
    {
        return self::getInstance('more4');
    }
    public static function LEARNING_QUOTES(): Svg
    {
        return self::getInstance('learning_quotes');
    }
    public static function LEARNING_QUOTES_SP(): Svg
    {
        return self::getInstance('learning_quotes_sp');
    }
    public static function LEARNING_INFO(): Svg
    {
        return self::getInstance('learning_info');
    }

}
