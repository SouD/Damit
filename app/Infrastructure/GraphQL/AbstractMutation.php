<?php
namespace Infrastructure\GraphQL;

use Infrastructure\Concern\HasGuard;
use Rebing\GraphQL\Support\Mutation;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
abstract class AbstractMutation extends Mutation
{
    use HasGuard;
}
