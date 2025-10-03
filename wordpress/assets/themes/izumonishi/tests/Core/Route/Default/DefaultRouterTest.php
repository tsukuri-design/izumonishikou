<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Route\Default;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Mvc4Wp\Core\Config\ConfiguratorInterface;
use Mvc4Wp\Core\Route\RouteHandler;
use Mvc4Wp\Core\Route\RouterInterface;

#[CoversClass(RouteHandler::class)]
#[CoversClass(DefaultRouter::class)]
class DefaultRouterTest extends TestCase
{
    public function setUp(): void
    {
        require_once __DIR__ . '/../../../../src/Core/Helper/NoDebugHelper.php';
    }

    private function getRouter(): RouterInterface
    {
        return new DefaultRouter();
    }

    private function getConfig(): ConfiguratorInterface
    {
        return new ConfigMock();
    }

    public function test_getOkCase01(): void
    {
        $router = $this->getRouter();
        $router->GET('/', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'GET', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::index', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_getOkCase02(): void
    {
        $router = $this->getRouter();
        $router->GET('/', ['HomeController']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'get', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::index', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_getOkCase03(): void
    {
        $router = $this->getRouter();
        $router->GET('/home/index', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'GET', '/home/index');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::index', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_getOkCase04(): void
    {
        $router = $this->getRouter();
        $router->GET('/home/{id:\d+}', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'GET', '/home/123');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::index', $handler->signature);
        $this->assertEquals(1, count($handler->args));
        $this->assertArrayHasKey('id', $handler->args);
        $this->assertEquals(123, $handler->args['id']);
    }

    public function test_getOkCase05(): void
    {
        $router = $this->getRouter();
        $router->GET('/home/{name}', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'GET', '/home/abc');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::index', $handler->signature);
        $this->assertEquals(1, count($handler->args));
        $this->assertArrayHasKey('name', $handler->args);
        $this->assertEquals('abc', $handler->args['name']);
    }

    public function test_getOkCase06(): void
    {
        $router = $this->getRouter();
        $router->GET('/home/{name}/{id:\d+}', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'GET', '/home/abc/123');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::index', $handler->signature);
        $this->assertEquals(2, count($handler->args));
        $this->assertArrayHasKey('name', $handler->args);
        $this->assertEquals('abc', $handler->args['name']);
        $this->assertArrayHasKey('id', $handler->args);
        $this->assertEquals(123, $handler->args['id']);
    }

    public function test_getNgCase01(): void
    {
        $router = $this->getRouter();
        $router->GET('/', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'GET', '/nothing');

        $this->assertNotNull($handler);
        $this->assertEquals(404, $handler->status->value);
        $this->assertEmpty($handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_getNgCase02(): void
    {
        $router = $this->getRouter();
        $router->GET('/', ['HomeController', 'index']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'HOGE', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(405, $handler->status->value);
        $this->assertEmpty($handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_postOkCase01(): void
    {
        $router = $this->getRouter();
        $router->POST('/', ['HomeController', 'register']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'POST', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::register', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_postOkCase02(): void
    {
        $router = $this->getRouter();
        $router->POST('/', ['HomeController', 'register']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'post', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::register', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_putOkCase01(): void
    {
        $router = $this->getRouter();
        $router->PUT('/', ['HomeController', 'update']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'PUT', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::update', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_putOkCase02(): void
    {
        $router = $this->getRouter();
        $router->PUT('/', ['HomeController', 'update']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'put', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::update', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_deleteOkCase01(): void
    {
        $router = $this->getRouter();
        $router->DELETE('/', ['HomeController', 'delete']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'DELETE', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::delete', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }

    public function test_deleteOkCase02(): void
    {
        $router = $this->getRouter();
        $router->DELETE('/', ['HomeController', 'delete']);
        $config = $this->getConfig();
        $handler = $router->dispatch($config, 'delete', '/');

        $this->assertNotNull($handler);
        $this->assertEquals(200, $handler->status->value);
        $this->assertEquals('HomeController::delete', $handler->signature);
        $this->assertEquals(0, count($handler->args));
    }
}

class ConfigMock implements ConfiguratorInterface
{
    public function add(string $key, string|array $value): void
    {
        return;
    }

    public function get(string $key): string|array
    {
        return '';
    }

    public function getAll(): array
    {
        return [];
    }

    public function set(string $key, string|array $value): void
    {
        return;
    }
}