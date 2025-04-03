<?php

namespace app\src\docs;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "0.1",
    title: "API module"
)]
#[OA\SecurityScheme(
    securityScheme: "bearer",
    type: "http",
    name: "bearer",
    in: "header",
    scheme: "bearer"
)]
#[OA\Tag(
    name: "user",
    description: "Операции над пользователями"
)]
class OpenApi
{
}
