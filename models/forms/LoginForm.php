<?php

namespace app\models\forms;

use OpenApi\Attributes as OA;
use yii\base\Model;

#[OA\Schema(
    required: ["login", "password"]
)]
class LoginForm extends Model
{
    #[OA\Property(
        property: "login",
        description: "Логин",
        type: "string"
    )]
    public $login;

    #[OA\Property(
        property: "password",
        description: "Пароль",
        type: "string"
    )]
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string'],
        ];
    }
}
