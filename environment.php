<?php

$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter('Dotenv\Repository\Adapter\EnvConstAdapter')
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($repository, __DIR__);
$dotenv->load();
