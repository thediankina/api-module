<?php

namespace app\src\services;

use app\models\db\User;
use app\models\forms\UserForm;
use app\src\interfaces\services\UserServiceInterface;
use Throwable;
use Yii;
use yii\base\Exception;

class UserService implements UserServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(UserForm $form): User
    {
        $user = new User();
        $user->setAttributes($form->attributes, false);

        $user->password_hash = Yii::$app->security->generatePasswordHash($form->password);
        $user->auth_key = Yii::$app->security->generateRandomString();

        if (!$user->save()) {
            throw new Exception("The attempt to create user '$user->login' failed.");
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function update(User $user, UserForm $form): User
    {
        $user->setAttributes($form->attributes, false);

        $user->password_hash = Yii::$app->security->generatePasswordHash($form->password);
        $user->auth_key = Yii::$app->security->generateRandomString();

        if (!$user->save()) {
            throw new Exception("The attempt to update user '$user->login' failed.");
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(User $user): bool
    {
        try {
            return (bool)$user->delete();
        } catch (Throwable) {
            throw new Exception("The attempt to delete user '$user->login' failed.");
        }
    }
}
