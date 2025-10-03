<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Model\Repository\Author;

use Mvc4Wp\Core\Model\Repository\Author\AuthorExpr;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AuthorExpr::class)]
class AuthorExprTest extends TestCase
{
    public function test_toQuery_noParams(): void
    {
        $obj = new AuthorExpr();

        $actual = $obj->toQuery([], ['hoge' => 'HOGE']);
        $this->assertEquals(['hoge' => 'HOGE'], $actual);
    }

    public function test_toQuery_singleParam(): void
    {
        $obj = new AuthorExpr();

        $actual = $obj->toQuery([1], []);
        $this->assertEquals(['author' => 1], $actual);
    }

    public function test_toQuery_multiParams(): void
    {
        $obj = new AuthorExpr();

        $actual = $obj->toQuery([2, 3, 4], []);
        $this->assertEquals(['author' => 2], $actual);
    }
}