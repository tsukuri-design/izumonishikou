<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Library\Default;

use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DefaultClock::class)]
final class DefaultClockTest extends TestCase
{
    public function test_get_now(): void
    {
        $actual = DefaultClock::get();
        $this->assertInstanceOf('DateTime', $actual);
    }

    public function test_get_format(): void
    {
        $actual = DefaultClock::get('2024-01-01 12:34:56');
        $this->assertEquals('2024/01/01 12:34:56', $actual->format('Y/m/d H:i:s'));
    }

    public function test_get_defaultTimezone(): void
    {
        $default = ini_get('date.timezone');

        ini_set('date.timezone', 'Asia/Tokyo');
        $actual = DefaultClock::get('2024-01-01 12:34:56');
        $this->assertEquals('2024-01-01T12:34:56+09:00', $actual->format('c'));

        ini_set('date.timezone', 'UTC');
        $actual = DefaultClock::get('2024-01-01 12:34:56');
        $this->assertEquals('2024-01-01T12:34:56+00:00', $actual->format('c'));

        ini_set('date.timezone', $default);
    }

    public function test_get_withTimezone(): void
    {
        $actual = DefaultClock::get('2024-01-01 12:34:56', new DateTimeZone('UTC'));
        $this->assertEquals('2024-01-01T12:34:56+00:00', $actual->format('c'));
    }

    public function test_get_withoutTimezone(): void
    {
        $actual = DefaultClock::get('2024-01-01 12:34:56');
        $this->assertEquals('2024-01-01T12:34:56+09:00', $actual->format('c'));
    }
}