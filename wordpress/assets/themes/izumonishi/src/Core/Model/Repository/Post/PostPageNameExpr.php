<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Model\Repository\Post;

use Mvc4Wp\Core\Model\Repository\Expr;

class PostPageNameExpr implements Expr
{
    public function toQuery(array $contexts, array $query): array
    {
        if (empty($contexts)) {
            return $query;
        }

        $query['pagename'] = $contexts[0];
        return $query;
    }
}