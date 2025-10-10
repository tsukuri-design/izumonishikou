<?php

declare(strict_types=1);

namespace Mvc4Wp\Core\Controller;

use Mvc4Wp\Core\Config\ConfiguratorInterface;

trait JsonRenderable
{
    public function render(ConfiguratorInterface $config, ResponderInterface $responder, string $view, array $data = []): static
    {
        global $output_debug;
        $output_debug = false;

        $responder->header('Content-Type: text/json; charset=utf-8');
        echo $view;
        return $this;
    }
}
