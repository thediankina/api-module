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
    path: "/user/update",
    summary: "Изменить (текущего) пользователя",
    security: [["bearer" => []]],
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
            content: new OA\JsonContent(ref: "#/components/schemas/DataResponse")
        ),
        new OA\Response(
            response: 422,
            description: "Ошибка валидации данных",
            content: new OA\JsonContent(ref: "#/components/schemas/ErrorsResponse")
        )
    ]
)]
class Update extends Action
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

        $user = Yii::$app->user->identity;
        $new = $this->userService->update($user, $form);

        return [
            'success' => true,
            'data' => array_merge($new->toArray(), ['access_token' => $new->access_token]),
        ];
    }
}
