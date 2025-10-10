<?php declare(strict_types=1);

namespace App\Helper;

use Mvc4Wp\Core\Service\App;

class ScriptsHelper
{
    public static function print(array $scripts): void
    {
        if (empty($scripts)) {
            return;
        }

        $config = App::get()->config();
        $jsDir = rtrim((string) $config->get('js.js_directory'), DIRECTORY_SEPARATOR);
        $publicBase = rtrim((string) $config->get('js.public_url_base'), '/');

        foreach ($scripts as $name) {
            if (!is_string($name) || $name === '') {
                continue;
            }

            $rel = ltrim($name, '/');
            if (!preg_match('/^[A-Za-z0-9_\/.\-]+$/', $rel)) {
                continue;
            }

            $base = str_replace('/', DIRECTORY_SEPARATOR, $rel);
            $minPath = $jsDir . DIRECTORY_SEPARATOR . $base . '.min.js';
            $normPath = $jsDir . DIRECTORY_SEPARATOR . $base . '.js';
            $useMin = file_exists($minPath);
            $chosenPath = $useMin ? $minPath : $normPath;
            $href = $publicBase . '/' . $rel . ($useMin ? '.min.js' : '.js');
            $ver = file_exists($chosenPath) ? (string) @filemtime($chosenPath) : '';
            if ($ver !== '') {
                $href .= '?ver=' . rawurlencode($ver);
            }

            // 存在しない場合もそのまま出力（CDN等を想定）。ローカルだけ厳密にするなら file_exists チェックする
            echo '<script src="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" defer></script>';
        }
    }
}


