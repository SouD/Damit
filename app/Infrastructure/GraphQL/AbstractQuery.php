<?php
namespace Infrastructure\GraphQL;

use Infrastructure\Concern\HasGuard;
use Rebing\GraphQL\Support\Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractQuery extends Query
{
    use HasGuard;
}
