<?php

namespace app\src\interfaces\repositories;

use app\models\db\User;

interface UserRepositoryInterface
{
    /**
     * @param string $login
     * @return User|null
     */
    public function findOneByLogin(string $login): ?User;
}
