<?php

namespace app\src\interfaces\services;

use app\models\db\User;
use app\models\forms\UserForm;
use yii\base\Exception;

interface UserServiceInterface
{
    /**
     * @param UserForm $form
     * @return User
     * @throws Exception
     */
    public function create(UserForm $form): User;

    /**
     * @param User $user
     * @param UserForm $form
     * @return User
     * @throws Exception
     */
    public function update(User $user, UserForm $form): User;

    /**
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function delete(User $user): bool;
}
