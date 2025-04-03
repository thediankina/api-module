<?php

namespace app\src\services;

use app\models\db\User;
use app\models\forms\UserForm;
use app\src\base\exceptions\UserException;
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
        $user->access_token = Yii::$app->security->generateRandomString();

        if (!$user->save()) {
            throw new Exception(
                message: 'The attempt to create user failed.',
                previous: new UserException($user->getErrorSummary(true))
            );
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
        $user->access_token = Yii::$app->security->generateRandomString();

        if (!$user->save()) {
            throw new Exception(
                message: 'The attempt to update user failed.',
                previous: new UserException($user->getErrorSummary(true))
            );
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
        } catch (Throwable $e) {
            throw new Exception(
                message: 'The attempt to delete user failed.',
                previous: $e
            );
        }
    }
}
