<?php

namespace app\src\docs;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "0.1",
    title: "API module"
)]
#[OA\Tag(
    name: "user",
    description: "Операции над пользователями"
)]
class OpenApi
{
}
