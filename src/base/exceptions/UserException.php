<?php

namespace app\src\base\exceptions;

class UserException extends \yii\base\UserException
{
    public array $errors;

    /**
     * {@inheritdoc}
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
        $message = implode(', ', $this->errors);
        parent::__construct($message);
    }
}
