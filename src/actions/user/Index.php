<?php

namespace app\src\actions\user;

use app\models\filters\UserFilter;
use app\src\interfaces\repositories\UserRepositoryInterface;
use OpenApi\Attributes as OA;
use Yii;
use yii\base\Action;

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
    public UserRepositoryInterface $userRepository;

    /**
     * @return array{
     *     success: bool,
     *     data: array
     * }
     */
    public function run(): array
    {
        $filter = new UserFilter();
        $filter->load(Yii::$app->request->get(), '');
        $dataProvider = $this->userRepository->getList($filter);

        return [
            'success' => true,
            'data' => $dataProvider->getModels(),
        ];
    }
}
