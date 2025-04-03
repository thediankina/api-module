<?php

namespace app\src\docs\schemas\responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ["success", "errors"]
)]
class ErrorsResponse
{
    #[OA\Property(
        property: "success",
        description: "Успешно ли выполнен запрос",
        type: "bool",
        default: false
    )]
    public $success = false;

    #[OA\Property(
        property: "errors",
        description: "Список ошибок",
        type: "array",
        items: new OA\Items(type: "string")
    )]
    public $errors;
}
