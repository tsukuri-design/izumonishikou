<?php

require_once 'functions.php';
$project_name = basename(dirname(__DIR__));
/** ROOT PATHを定義 */
define('ROOT_PATH', dirname(__FILE__, 1));

/** html書き出し用 */
ob_start();

Mvc::run('page/school_life');

$html_output = ob_get_contents();
ob_end_clean();

/** デバッグ用にHTML出力を表示 */
echo $html_output;

/** パーミッションエラーが発生する場合は、該当ディレクトリの書き込み権限を確認してください。 */

/** .php を .html に置換 */
$html_output = str_replace('.php', '.html', $html_output);

/** html書き出し用 */
$output_folder = dirname(ROOT_PATH) . '/public/' . $project_name . '/school_life/';

/** index.html ファイルのパス */
$output_file = $output_folder . 'index.html';

// var_dump($output_file);

/** htmlファイルを書き出し */
$result = file_put_contents($output_file, $html_output);

/** 再帰的にフォルダをコピーする関数 */
function copyFolder($src, $dst)
{
    $dir = opendir($src);
    if (!is_dir($dst)) {
        mkdir($dst, 0755, true); // 目的フォルダがない場合は作成
    }

    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            $srcPath = $src . '/' . $file;
            $dstPath = $dst . '/' . $file;

            if (is_dir($srcPath)) {
                // フォルダなら再帰的にコピー
                copyFolder($srcPath, $dstPath);
            } else {
                // ファイルなら直接コピー
                copy($srcPath, $dstPath);
            }
        }
    }
    closedir($dir);
}


/** img, css, js フォルダを再帰的にコピー */
$folders_to_copy = ['img', 'css', 'js'];

foreach ($folders_to_copy as $folder_name) {
    $source_folder = __DIR__ . '/' . $folder_name;
    $destination_folder = __DIR__ . '/../public/' . $project_name . '/school_life/' . $folder_name;
    copyFolder($source_folder, $destination_folder);
}
