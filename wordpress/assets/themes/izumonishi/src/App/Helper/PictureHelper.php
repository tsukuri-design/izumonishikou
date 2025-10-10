<?php declare(strict_types=1);

/**
 * picture
 *
 * @param sp sp
 * @param webp webp or ''
 */

 function picture($relative_path='', $file_name='', $extention='jpg', $sp='', $webp='', $width = '', $height='', $alt='', $ver='', $expand = '750')
 {
     /** ファイル名と相対パスがない場合は出力しない */
     if (!isset($file_name) || !isset($relative_path)) {
         return;
     }
 
     /** ver setting */
     if (isset($ver)) {
         $ver = '?ver=' . $ver;
     }
 
     /** 変数宣言 */
     $relative_path = get_theme_file_uri() . '/';
     $output_pc      = '';
     $output_sp      = '';
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
         '<img data-src="' . $relative_path . 'img/' . $file_name . '.' . $extention . $ver . '"class="lazyload" alt="' . $alt . '"' . $width . $height . ' data-expand="' . $expand . '">';
 
     /** 出力設定 */
     $output =
         '<picture>' . $output_webp_sp . $output_sp . $output_webp_pc . $output_pc . '</picture>';
 
     return $output;
 }
 