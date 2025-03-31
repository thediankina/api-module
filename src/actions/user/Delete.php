<?php

namespace app\src\actions\user;

use app\src\base\exceptions\UserException;
use app\src\interfaces\services\UserServiceInterface;
use Yii;
use yii\base\Action;
use yii\base\Exception;

class Delete extends Action
{
    public UserServiceInterface $userService;

    /**
     * @return array{success: bool, errors?: array<string>}
     * @throws UserException
     * @throws Exception
     */
    public function run(): array
    {
        $user = Yii::$app->user->identity;

        if (!Yii::$app->user->logout()) {
            throw new UserException(["The attempt to logout user '$user->login' failed."]);
        }

        $this->userService->delete($user);

        return [
            'success' => true,
        ];
    }
}
