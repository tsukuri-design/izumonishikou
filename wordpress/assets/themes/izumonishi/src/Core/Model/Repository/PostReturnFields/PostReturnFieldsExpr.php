<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Model\Repository\PostReturnFields;

use Mvc4Wp\Core\Model\Repository\Expr;

class PostReturnFieldsExpr implements Expr
{
    public function toQuery(array $contexts, array $query): array
    {
        if (empty($contexts)) {
            return $query;
        }

        $query['fields'] = $contexts[0];
        return $query;
    }
}