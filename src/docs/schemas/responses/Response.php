<?php

namespace app\src\docs\schemas\responses;

use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ["success"]
)]
class Response
{
    #[OA\Property(
        property: "success",
        description: "Успешно ли выполнен запрос",
        type: "bool"
    )]
    public $success;
}
