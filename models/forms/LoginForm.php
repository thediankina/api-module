<?php

namespace app\models\forms;

use yii\base\Model;

class LoginForm extends Model
{
    public $login;
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
