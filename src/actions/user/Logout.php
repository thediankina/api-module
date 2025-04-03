<?php

namespace app\src\actions\user;

use Yii;
use yii\base\Action;
use yii\base\Exception;

class Logout extends Action
{
    /**
     * @return array{success: bool, errors?: array<string>}
     * @throws Exception
     */
    public function run(): array
    {
        if (!Yii::$app->user->logout()) {
            throw new Exception('The attempt to logout failed.');
        }

        return [
            'success' => true,
        ];
    }
}
