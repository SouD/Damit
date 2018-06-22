<?php
namespace Domain\User\Query;

use Domain\User\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Infrastructure\Model\AbstractQuery as Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class UserQuery extends Query
{
    /**
     * @var string
     */
    protected $modelClass = User::class;

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'user',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('user');
    }

    /**
     * @return array
     */
    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param mixed $args
     *
     * @return User|null
     */
    public function resolve($root, $args): ?User
    {
        $email = array_get($args, 'email');

        if ($email) {
            return $this->getRepository()
                ->byEmail($email)
                ->first();
        }
    }
}
