<?php declare(strict_types=1);

/**
 * Change file name into alphanumeric when uploading file if file name is japanese.
 * ファイルをアップロードする際に日本語の場合はファイル名を英数字に変更する
 */
function renameJapaneseFileName($fileName)
{
    // ファイル名から拡張子を取得
    $path_info = pathinfo($fileName);
    $exts = isset($path_info['extension']) ? '.' . $path_info['extension'] : '';

    // 日本語文字が含まれている場合
    if (preg_match('/[^\x20-\x7E]/', $fileName)) {
        // ランダムな文字列の生成
        $random_string = wp_generate_uuid4();

        // 新しいファイル名の組み立て
        $newFileName = $random_string . $exts;

        return strtolower($newFileName);
    } else {
        return strtolower($fileName);
    }
}

add_filter('sanitize_file_name', 'renameJapaneseFileName', 10);
