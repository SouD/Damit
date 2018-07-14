<?php
namespace Infrastructure\GraphQL;

use Illuminate\Support\Str;
use Infrastructure\Concern\HasGuard;
use Rebing\GraphQL\Support\Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractQuery extends Query
{
    use HasGuard;

    /**
     * @param array $columns
     *
     * @return array
     */
    public function transformColumnNames(array $columns): array
    {
        return array_map(function ($column) {
            return Str::snake($column);
        }, $columns);
    }
}
