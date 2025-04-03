<?php

namespace app\src\actions\user;

use app\src\interfaces\services\UserServiceInterface;
use Yii;
use yii\base\Action;
use yii\base\Exception;

class Delete extends Action
{
    public UserServiceInterface $userService;

    /**
     * @return array{success: bool, errors?: array<string>}
     * @throws Exception
     */
    public function run(): array
    {
        $user = Yii::$app->user->identity;

        if (!Yii::$app->user->logout()) {
            throw new Exception('The attempt to logout failed.');
        }

        $this->userService->delete($user);

        return [
            'success' => true,
        ];
    }
}
