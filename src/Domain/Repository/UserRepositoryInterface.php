<?php


namespace Discord\Domain\Repository;


use Discord\Domain\Model\User;

interface UserRepositoryInterface
{
    /**
     * Get current logged user
     *
     * @return User|null
     */
    public function me();
}