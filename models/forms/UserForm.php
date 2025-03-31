<?php

namespace app\models\forms;

use yii\base\Model;

class UserForm extends Model
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
