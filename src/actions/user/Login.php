<?php

namespace app\src\actions\user;

use app\models\forms\LoginForm;
use app\src\base\exceptions\UserException;
use app\src\interfaces\repositories\UserRepositoryInterface;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class Login extends Action
{
    public UserRepositoryInterface $userRepository;

    /**
     * @return array{success: bool, errors?: array<string>}
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function run(): array
    {
        $form = new LoginForm();
        $form->load(Yii::$app->request->post(), '');

        if (!$form->validate()) {
            throw new UserException($form->getErrorSummary(true));
        }

        $user = $this->userRepository->findOneByLogin($form->login);

        if ($user === null) {
            throw new NotFoundHttpException("User '$form->login' not found.");
        }

        if (!Yii::$app->security->validatePassword($form->password, $user->password_hash)) {
            throw new UserException(['Invalid password.']);
        }

        if (!Yii::$app->user->login($user)) {
            throw new UserException(["The attempt to login user '$user->login' failed."]);
        }

        return [
            'success' => true,
        ];
    }
}
