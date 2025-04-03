<?php

namespace app\src\actions\user;

use app\models\db\User;
use OpenApi\Attributes as OA;
use yii\base\Action;
use yii\data\ActiveDataProvider;

#[OA\Get(
    path: "/user/index",
    summary: "Получить список пользователей",
    tags: ["user"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Успех",
            content: new OA\JsonContent(ref: "#/components/schemas/DataResponse")
        )
    ]
)]
class Index extends Action
{
    /**
     * @return array{
     *     success: bool,
     *     data: array
     * }
     */
    public function run(): array
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return [
            'success' => true,
            'data' => $dataProvider->getModels(),
        ];
    }
}
