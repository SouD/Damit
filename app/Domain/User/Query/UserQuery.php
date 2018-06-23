<?php
namespace Domain\User\Query;

use Domain\User\User;
use Domain\User\UserRepository;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Infrastructure\GraphQL\AbstractQuery as Query;

/**
 * @author Linus Sörensen <linus@soud.se>
 */
class UserQuery extends Query
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'User',
        ];
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return GraphQL::type('User');
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
     * @param array $args
     *
     * @return User|null
     */
    public function resolve($root, array $args): ?User
    {
        $email = array_get($args, 'email');

        if ($email) {
            return $this->users->byEmail($email)
                ->first();
        }
    }
}
