<?php

namespace app\src\actions\user;

use OpenApi\Attributes as OA;
use Yii;
use yii\base\Action;
use yii\base\Exception;

#[OA\Get(
    path: "/user/logout",
    summary: "Выйти из под (текущего) пользователя",
    tags: ["user"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успех",
            content: new OA\JsonContent(ref: "#/components/schemas/Response")
        )
    ]
)]
class Logout extends Action
{
    /**
     * @return array{
     *     success: bool,
     *     errors?: array
     * }
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
