<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Config;

interface ConfiguratorFactoryInterface
{
    public static function create(array $args = []): ConfiguratorInterface;
}