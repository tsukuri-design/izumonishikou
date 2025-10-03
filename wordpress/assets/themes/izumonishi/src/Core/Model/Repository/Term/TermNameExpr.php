<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Model\Repository\Term;

use Mvc4Wp\Core\Model\Repository\Expr;

class TermNameExpr implements Expr
{
    public function toQuery(array $contexts, array $query): array
    {
        if (empty($contexts)) {
            return $query;
        }

        $query['name'] = strval($contexts[0]);

        return $query;
    }
}