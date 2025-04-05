<?php

namespace app\src\repositories;

use app\models\db\User;
use app\models\filters\UserFilter;
use app\src\interfaces\repositories\UserRepositoryInterface;
use yii\data\ActiveDataProvider;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findOneByLogin(string $login): ?User
    {
        return User::findOne(['login' => $login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getList(UserFilter $filter): ActiveDataProvider
    {
        $query = User::find();

        if (!$filter->validate()) {
            $query->emulateExecution();
        }

        $query->andFilterWhere(['id' => $filter->id]);
        $query->andFilterWhere(['login' => $filter->login]);
        $query->andFilterWhere(['between', 'created_at', $filter->fromCreatedAt, $filter->toCreatedAt]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
    }
}
