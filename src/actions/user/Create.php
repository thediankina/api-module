<?php

namespace app\src\actions\user;

use app\models\forms\UserForm;
use app\src\base\exceptions\UserException;
use app\src\interfaces\services\UserServiceInterface;
use Yii;
use yii\base\Action;
use yii\base\Exception;

class Create extends Action
{
    public UserServiceInterface $userService;

    /**
     * @return array{success: bool, errors?: array<string>}
     * @throws UserException
     * @throws Exception
     */
    public function run(): array
    {
        $form = new UserForm();
        $form->load(Yii::$app->request->post(), '');

        if (!$form->validate()) {
            throw new UserException($form->getErrorSummary(true));
        }

        $this->userService->create($form);

        return [
            'success' => true,
        ];
    }
}
