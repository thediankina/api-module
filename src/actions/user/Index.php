<?php

namespace app\src\actions\user;

use app\models\db\User;
use yii\base\Action;
use yii\data\ActiveDataProvider;

class Index extends Action
{
    /**
     * @return array{success: bool, data: array, errors?: array<string>}
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
