<?php

namespace app\src\actions\user;

use app\models\forms\UserForm;
use app\src\base\exceptions\UserException;
use app\src\interfaces\services\UserServiceInterface;
use OpenApi\Attributes as OA;
use Yii;
use yii\base\Action;
use yii\base\Exception;

#[OA\Post(
    path: "/user/create",
    summary: "Создать пользователя",
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\MediaType(
            mediaType: "multipart/form-data",
            schema: new OA\Schema(ref: "#/components/schemas/UserForm")
        )
    ),
    tags: ["user"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успех",
            content: new OA\JsonContent(ref: "#/components/schemas/Response")
        ),
        new OA\Response(
            response: 422,
            description: "Ошибка валидации данных",
            content: new OA\JsonContent(ref: "#/components/schemas/ErrorsResponse")
        )
    ]
)]
class Create extends Action
{
    public UserServiceInterface $userService;

    /**
     * @return array{
     *     success: bool,
     *     errors?: array
     * }
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
