<?php
namespace Infrastructure\Auth\Mutation;

use GraphQL\Type\Definition\Type;
use Infrastructure\GraphQL\AbstractMutation as Mutation;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class LogoutMutation extends Mutation
{
    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'logout',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return Type::boolean();
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'forever' => [
                'name' => 'forever',
                'type' => Type::boolean(),
            ],
        ];
    }

    /**
     * @param array $args
     *
     * @return bool
     */
    public function authorize(array $args): bool
    {
        return $this->guard()
            ->check();
    }

    /**
     * @param mixed $root
     * @param array $args
     *
     * @return bool
     */
    public function resolve($root, array $args): bool
    {
        $forever = (bool) array_get($args, 'forever', false);

        return $this->guard()
            ->logout($forever);
    }
}
