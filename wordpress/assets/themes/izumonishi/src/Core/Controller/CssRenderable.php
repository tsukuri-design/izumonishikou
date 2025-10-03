<?php

declare(strict_types=1);

namespace Mvc4Wp\Core\Controller;

use MatthiasMullie\Minify\CSS;
use Mvc4Wp\Core\Config\ConfiguratorInterface;
use Mvc4Wp\Core\Exception\ApplicationException;
use Mvc4Wp\Core\Service\Logging;

trait CssRenderable
{
    protected bool $with_tag = true;

    public function render(ConfiguratorInterface $config, ResponderInterface $responder, string $view, array $data = []): static
    {
        debug_view_start($view . '.css', $this->with_tag);

        try {
            $attrs = [];
            if (count($data) > 0) {
                $attrs[] = '';
                foreach ($data as $k => $v) {
                    $attrs[] = "{$k}='{$v}'";
                }
            }
            if ($this->with_tag) {
                echo '<style' . (count($attrs) > 0 ? implode(" ", $attrs) : '') . '>';
            }
            if ($config->get('css.use_minify') === 'true') {
                $this->renderMinCss($config, $view);
            } else {
                $this->renderCss($config, $view);
            }
        } finally {
            if ($this->with_tag) {
                echo '</style>';
            }
        }

        debug_view_end($view . '.css', $data, $this->with_tag);

        return $this;
    }

    protected function renderMinCss(ConfiguratorInterface $config, string $view): void
    {
        $mincss_path = $config->get('css.css_directory') . DIRECTORY_SEPARATOR . $view . '.min.css';

        if (!file_exists($mincss_path)) {
            $this->renderCss($config, $view);
        }

        if (!file_exists($mincss_path)) {
            throw new ApplicationException('view not found: ' . $mincss_path);
        }

        echo file_get_contents($mincss_path);
    }

    protected function renderCss(ConfiguratorInterface $config, string $view): void
    {
        $css_path = $config->get('css.css_directory') . DIRECTORY_SEPARATOR . $view . '.css';

        if (!file_exists($css_path)) {
            throw new ApplicationException('view not found: ' . $css_path);
        }

        if ($config->get('css.use_minify') === 'true') {
            $minifier = new CSS($css_path);
            $mincss_path = $config->get('css.css_directory') . DIRECTORY_SEPARATOR . $view . '.min.css';
            $minifier->minify($mincss_path);
            Logging::get('core')->info("css minified: {$css_path} => {$mincss_path}");
        } else {
            echo file_get_contents($css_path);
        }
    }
}
