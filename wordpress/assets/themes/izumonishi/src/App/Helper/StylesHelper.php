<?php declare(strict_types=1);

namespace App\Helper;

use Mvc4Wp\Core\Service\App;

class StylesHelper
{
    public static function print(array $styles): void
    {
        if (empty($styles)) {
            return;
        }

        $config = App::get()->config();
        $scssDir = rtrim((string) $config->get('css.scss_directory'), DIRECTORY_SEPARATOR);
        $cssDir = rtrim((string) $config->get('css.css_directory'), DIRECTORY_SEPARATOR);
        $publicBase = rtrim((string) $config->get('css.public_url_base'), '/');
        $useCache = (string) $config->get('css.use_cache') === 'true';
        $sassPath = (string) $config->get('css.sass_path');
        $sassArgs = (string) $config->get('css.sass_args');

        if (!is_dir($cssDir)) {
            @mkdir($cssDir, 0775, true);
        }

        foreach ($styles as $name) {
            if (!is_string($name) || $name === '') {
                continue;
            }

            // allow nested paths like "components/global"; sanitize
            $rel = ltrim($name, '/');
            if (!preg_match('/^[A-Za-z0-9_\/-]+$/', $rel)) {
                continue;
            }

            $scssPath = $scssDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel) . '.scss';
            $cssPath = $cssDir . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel) . '.css';

            if (!file_exists($scssPath)) {
                continue; // サイレントスキップ
            }

            $needsBuild = !$useCache || !file_exists($cssPath) || filemtime($scssPath) > @filemtime($cssPath);
            if ($needsBuild) {
                // sass 実行でビルド
                $cmd = [];
                $cmd[] = escapeshellcmd($sassPath);
                if ((string) $config->get('css.use_minify') === 'true') {
                    $cmd[] = '--style=compressed';
                }
                if ($sassArgs !== '') {
                    $cmd[] = $sassArgs;
                }
                // ensure nested output directories exist
                $targetDir = dirname($cssPath);
                if (!is_dir($targetDir)) {
                    @mkdir($targetDir, 0775, true);
                }
                $cmd[] = escapeshellarg($scssPath);
                $cmd[] = escapeshellarg($cssPath);
                $cmd[] = '2>&1';
                $command = implode(' ', $cmd);
                @exec($command, $out, $code);
            }

            // preserve slashes in href and append cache-busting version
            $href = $publicBase . '/' . $rel . '.css';
            $ver = file_exists($cssPath) ? (string) @filemtime($cssPath) : '';
            if ($ver !== '') {
                $href .= '?ver=' . rawurlencode($ver);
            }
            echo '<link rel="stylesheet" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '">';
        }
    }
}


