<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Controller;

use Mvc4Wp\Core\Library\Castable;

class JsRenderer implements RenderInterface
{
    use Castable, JsRenderable;

    public function __construct(bool $with_tag = true)
    {
        $this->with_tag = $with_tag;
    }
}