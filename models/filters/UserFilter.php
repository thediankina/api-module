<?php

namespace app\models\filters;

use yii\base\Model;

class UserFilter extends Model
{
    public $id;
    public $login;
    public $fromCreatedAt;
    public $toCreatedAt;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id'], 'integer', 'min' => 0],
            [['login'], 'string', 'min' => 3, 'max' => 255],
            [['fromCreatedAt', 'toCreatedAt'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [
                [
                    'id',
                    'login',
                    'fromCreatedAt',
                    'toCreatedAt',
                ],
                'safe',
            ],
        ];
    }
}
