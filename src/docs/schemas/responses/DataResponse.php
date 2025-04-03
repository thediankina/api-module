<?php

namespace app\src\docs\schemas\responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ["success", "data"]
)]
class DataResponse
{
    #[OA\Property(
        property: "success",
        description: "Успешно ли выполнен запрос",
        type: "bool",
        default: true
    )]
    public $success = true;

    #[OA\Property(
        property: "data",
        description: "Список данных",
        type: "array",
        items: new OA\Items(type: "object")
    )]
    public $data;
}
