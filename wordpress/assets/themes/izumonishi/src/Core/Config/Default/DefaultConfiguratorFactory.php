<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Config\Default;

use Mvc4Wp\Core\Config\ConfiguratorFactoryInterface;
use Mvc4Wp\Core\Config\ConfiguratorInterface;
use Mvc4Wp\Core\Library\Castable;

class DefaultConfiguratorFactory implements ConfiguratorFactoryInterface
{
    use Castable;

    public static function create(array $args = []): ConfiguratorInterface
    {
        return new DefaultConfigurator();
    }
}