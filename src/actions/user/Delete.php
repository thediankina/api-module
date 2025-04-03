<?php

namespace app\src\actions\user;

use app\src\interfaces\services\UserServiceInterface;
use OpenApi\Attributes as OA;
use Yii;
use yii\base\Action;
use yii\base\Exception;

#[OA\Get(
    path: "/user/delete",
    summary: "Удалить (текущего) пользователя",
    security: [["bearer" => []]],
    tags: ["user"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успех",
            content: new OA\JsonContent(ref: "#/components/schemas/Response")
        )
    ]
)]
class Delete extends Action
{
    public UserServiceInterface $userService;

    /**
     * @return array{
     *     success: bool,
     *     errors?: array
     * }
     * @throws Exception
     */
    public function run(): array
    {
        $user = Yii::$app->user->identity;
        $this->userService->delete($user);

        return [
            'success' => true,
        ];
    }
}
