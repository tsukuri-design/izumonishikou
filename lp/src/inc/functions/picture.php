<?php

/**
 * picture
 *
 * @param sp sp
 * @param webp webp or ''
 */

function picture($relative_path = '', $file_name = '', $extention = 'jpg', $sp = '', $webp = '', $width = '', $height = '', $alt = '', $ver = '', $expand = '750')
{
    /** ファイル名と相対パスがない場合は出力しない */
    if (!isset($file_name) || !isset($relative_path)) {
        return;
    }

    /** ver setting */
    if (exists($ver)) {
        $ver = '?ver=' . $ver;
    }

    /** 変数宣言 */
    $output_pc = '';
    $output_sp = '';
    $output_webp_pc = '';
    $output_webp_sp = '';

    /** webpがある場合 */
    if ($webp === 'webp') {
        /** スマホ版のwebpがある場合 */
        if ($sp === 'sp') {
            $output_webp_sp =
                '<source media="(max-width: 768px)" srcset="' . $relative_path . 'img/' . $file_name . '_sp.webp' . $ver . '" type="image/webp">';
        }
        $output_webp_pc =
            '<source srcset="' . $relative_path . 'img/' . $file_name . '.webp' . $ver . '" type="image/webp">';
    }

    /** スマホ版がある場合 */
    if ($sp === 'sp') {
        $output_sp =
            '<source media="(max-width: 768px)" srcset="' . $relative_path . 'img/' . $file_name . '_sp.' . $extention . $ver . '">';
    }

    /** 通常のimg設定 */
    if ($width === '' || $height === '') {
        $width = '';
        $height = '';
    } else {
        $width = ' width="' . $width . '"';
        $height = ' height="' . $height . '"';
    }
    $output_pc .=
        '<img data-src="' . $relative_path . 'img/' . $file_name . '.' . $extention . $ver . '"class="lazyload" alt="' . $alt . '"' . $width . $height . ' data-expand="' . $expand . '" loading="lazy">';

    /** 出力設定 */
    $output =
        '<picture>' . $output_webp_sp . $output_sp . $output_webp_pc . $output_pc . '</picture>';

    return $output;
}


/**
 * レスポンシブ画像用のpictureタグを生成する
 * 
 * @param array $options 画像オプション
 *   - src: string 画像のベースパス（必須）
 *   - name: string ファイル名（必須）
 *   - ext: string 拡張子（デフォルト: 'jpg'）
 *   - alt: string alt属性（必須）
 *   - width: int|string 幅
 *   - height: int|string 高さ
 *   - version: string バージョン文字列
 *   - expand: int lazyloadのexpand値（デフォルト: 750）
 *   - responsive: bool レスポンシブ対応するか（デフォルト: true）
 *   - webp: bool WebP対応するか（デフォルト: true）
 *   - lazy: bool 遅延読み込みするか（デフォルト: true）
 *   - class: string 追加のCSSクラス
 *   - id: string img要素のID
 * 
 * @return string HTMLのpictureタグ
 * 
 * @example
 * // 基本的な使用例
 * echo picture([
 *     'src' => 'img/',
 *     'name' => 'hero',
 *     'alt' => 'ヒーロー画像'
 * ]);
 * 
 * @example
 * // サイズ指定とカスタムクラス
 * echo picture([
 *     'src' => 'img/',
 *     'name' => 'product',
 *     'alt' => '商品画像',
 *     'width' => 800,
 *     'height' => 600,
 *     'class' => 'product-image',
 *     'version' => '1.2.3'
 * ]);
 * 
 * @example
 * // レスポンシブ無効、WebP無効
 * echo picture([
 *     'src' => 'img/',
 *     'name' => 'logo',
 *     'alt' => 'ロゴ',
 *     'responsive' => false,
 *     'webp' => false,
 *     'lazy' => false
 * ]);
 * 
 * @example
 * // PNG画像で遅延読み込み無効
 * echo picture([
 *     'src' => 'img/',
 *     'name' => 'icon',
 *     'ext' => 'png',
 *     'alt' => 'アイコン',
 *     'lazy' => false,
 *     'id' => 'main-icon'
 * ]);
 */
function picture_array(array $options = []): string
{
    // 必須パラメータのチェック
    if (empty($options['src']) || empty($options['name']) || empty($options['alt'])) {
        return '';
    }

    // デフォルト値の設定
    $defaults = [
        'ext' => 'jpg',
        'width' => '',
        'height' => '',
        'version' => '',
        'expand' => 750,
        'responsive' => true,
        'webp' => true,
        'lazy' => true,
        'class' => '',
        'id' => ''
    ];

    $options = array_merge($defaults, $options);

    // バージョン文字列の処理
    $version = $options['version'] ? '?ver=' . $options['version'] : '';

    // パスの正規化
    $basePath = rtrim($options['src'], '/') . '/';

    // サイズ属性の処理
    $sizeAttrs = '';
    if ($options['width'] || $options['height']) {
        $sizeAttrs = sprintf(
            ' width="%s" height="%s"',
            $options['width'],
            $options['height']
        );
    }

    // CSSクラスの処理
    $classes = ['lazyload'];
    if ($options['class']) {
        $classes[] = $options['class'];
    }
    $classAttr = ' class="' . implode(' ', $classes) . '"';

    // ID属性の処理
    $idAttr = $options['id'] ? ' id="' . $options['id'] . '"' : '';

    // 遅延読み込み属性の処理
    $lazyAttr = $options['lazy'] ? ' data-expand="' . $options['expand'] . '"' : '';
    $srcAttr = $options['lazy'] ? 'data-src' : 'src';

    $sources = [];

    // WebP対応
    if ($options['webp']) {
        // スマホ版WebP
        if ($options['responsive']) {
            $sources[] = sprintf(
                '<source media="(max-width: 768px)" srcset="%s%s_sp.webp%s" type="image/webp">',
                $basePath,
                $options['name'],
                $version
            );
        }
        // PC版WebP
        $sources[] = sprintf(
            '<source srcset="%s%s.webp%s" type="image/webp">',
            $basePath,
            $options['name'],
            $version
        );
    }

    // 通常画像のsource
    if ($options['responsive']) {
        $sources[] = sprintf(
            '<source media="(max-width: 768px)" srcset="%s%s_sp.%s%s">',
            $basePath,
            $options['name'],
            $options['ext'],
            $version
        );
    }

    // メインのimg要素
    $img = sprintf(
        '<img %s="%s%s.%s%s"%s alt="%s"%s%s%s>',
        $srcAttr,
        $basePath,
        $options['name'],
        $options['ext'],
        $version,
        $classAttr,
        htmlspecialchars($options['alt'], ENT_QUOTES, 'UTF-8'),
        $sizeAttrs,
        $idAttr,
        $lazyAttr
    );

    return '<picture>' . implode('', $sources) . $img . '</picture>';
}