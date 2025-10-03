<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Route\Default;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Mvc4Wp\Core\Library\HttpStatus;
use Mvc4Wp\Core\Exception\ApplicationException;
use Mvc4Wp\Core\Route\RouteHandler;

#[CoversClass(RouteHandler::class)]
class RouterHandlerTest extends TestCase
{
    public function test_construct01(): void
    {
        $obj = new RouteHandler(HttpStatus::OK, 'TestController::index', ['id' => 1]);

        $this->assertNotNull($obj);
        $this->assertEquals(200, $obj->status->value);
        $this->assertEquals('TestController::index', $obj->signature);
        $this->assertCount(1, $obj->args);
        $this->assertArrayHasKey('id', $obj->args);
        $this->assertEquals(1, $obj->args['id']);
    }

    public function test_construct02(): void
    {
        $this->expectException(ApplicationException::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessage('illegal to set signature.');
        new RouteHandler(HttpStatus::OK, 'TestControllerindex', ['id' => 1]);
    }
}
