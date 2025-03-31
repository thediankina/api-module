<?php

namespace app\src\repositories;

use app\models\db\User;
use app\src\interfaces\repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findOneByLogin(string $login): ?User
    {
        return User::findOne(['login' => $login]);
    }
}
