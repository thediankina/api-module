<?php

namespace app\src\actions\user;

use app\models\forms\LoginForm;
use app\src\base\exceptions\UserException;
use app\src\interfaces\repositories\UserRepositoryInterface;
use OpenApi\Attributes as OA;
use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

#[OA\Post(
    path: "/user/login",
    summary: "Войти как пользователь",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(ref: "#/components/schemas/LoginForm")
        )
    ),
    tags: ["user"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успех",
            content: new OA\JsonContent(ref: "#/components/schemas/DataResponse")
        ),
        new OA\Response(
            response: 404,
            description: "Пользователь не найден",
            content: new OA\JsonContent(ref: "#/components/schemas/ErrorsResponse")
        ),
        new OA\Response(
            response: 422,
            description: "Ошибка валидации данных",
            content: new OA\JsonContent(ref: "#/components/schemas/ErrorsResponse")
        )
    ]
)]
class Login extends Action
{
    public UserRepositoryInterface $userRepository;

    /**
     * @return array{
     *     success: bool,
     *     errors?: array
     * }
     * @throws UserException
     * @throws NotFoundHttpException
     * @throws Exception
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
            throw new NotFoundHttpException('User not found.');
        }

        if (!Yii::$app->security->validatePassword($form->password, $user->password_hash)) {
            throw new UserException(['Invalid password.']);
        }

        return [
            'success' => true,
            'data' => [
                'access_token' => $user->access_token,
            ],
        ];
    }
}
