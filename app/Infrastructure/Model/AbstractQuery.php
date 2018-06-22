<?php
namespace Infrastructure\Model;

use Infrastructure\Concern\HasGuard;
use Infrastructure\Concern\HasModelRepository;
use Rebing\GraphQL\Support\Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractQuery extends Query
{
    use HasModelRepository, HasGuard;
}
