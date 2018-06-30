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
class CurrentUserQuery extends Query
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
            'name' => 'CurrentUser',
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
     * @param mixed $root
     * @param array $args
     *
     * @return User|null
     */
    public function resolve($root, array $args): ?User
    {
        return $this->guard()
            ->user();
    }
}
