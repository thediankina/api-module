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
        description: "Данные",
        oneOf: [
            new OA\Schema(type: "object"),
            new OA\Schema(type: "array", items: new OA\Items(type: "object"))
        ]
    )]
    public $data;
}
