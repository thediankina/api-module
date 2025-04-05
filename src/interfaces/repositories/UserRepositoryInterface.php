<?php

namespace app\src\interfaces\repositories;

use app\models\db\User;
use app\models\filters\UserFilter;
use yii\data\DataProviderInterface;

interface UserRepositoryInterface
{
    /**
     * @param string $login
     * @return User|null
     */
    public function findOneByLogin(string $login): ?User;

    /**
     * @param UserFilter $filter
     * @return DataProviderInterface
     */
    public function getList(UserFilter $filter): DataProviderInterface;
}
