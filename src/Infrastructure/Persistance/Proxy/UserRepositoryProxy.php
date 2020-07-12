<?php


namespace Discord\Infrastructure\Persistance\Proxy;


use Discord\Domain\Repository\UserRepositoryInterface;
use Discord\Infrastructure\Persistance\Api\UserRepository;

class UserRepositoryProxy extends InMemoryRepositoryProxy implements UserRepositoryInterface
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserRepositoryProxy constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function me()
    {
        $key = 'me';
        $cached = $this->getFromStorage($key);

        if (!is_null($cached)) {
            return $cached;
        }

        $user = $this->userRepository->me();
        $this->putInStorage($key, $user);

        return $user;
    }
}