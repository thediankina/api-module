<?php

namespace app\src\actions\user;

use app\src\base\exceptions\UserException;
use Yii;
use yii\base\Action;

class Logout extends Action
{
    /**
     * @return array{success: bool, errors?: array<string>}
     * @throws UserException
     */
    public function run(): array
    {
        $user = Yii::$app->user->identity;

        if (!Yii::$app->user->logout()) {
            throw new UserException(["The attempt to logout user '$user->login' failed."]);
        }

        return [
            'success' => true,
        ];
    }
}
