<?php

namespace app\src\base\exceptions;

class UserException extends \yii\base\UserException
{
    /**
     * @var array<string>
     */
    public array $errors;

    /**
     * @param array<string> $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
        $message = implode(', ', $this->errors);
        parent::__construct($message);
    }
}
