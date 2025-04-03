<?php

namespace app\controllers;

use app\src\actions\user\Create;
use app\src\actions\user\Delete;
use app\src\actions\user\Index;
use app\src\actions\user\Login;
use app\src\actions\user\Update;
use app\src\base\controllers\web\Controller;
use app\src\interfaces\repositories\UserRepositoryInterface;
use app\src\interfaces\services\UserServiceInterface;
use yii\filters\VerbFilter;

class UserController extends Controller
{
    /**
     * {@inheritdoc}
     * @param UserRepositoryInterface $userRepository
     * @param UserServiceInterface $userService
     */
    public function __construct(
        $id,
        $module,
        public UserRepositoryInterface $userRepository,
        public UserServiceInterface $userService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['optional'] = ['login', 'index', 'create'];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'login' => ['post'],
                'create' => ['post'],
                'update' => ['post'],
                'delete' => ['get'],
                'index' => ['get'],
            ],
        ];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'login' => [
                'class' => Login::class,
                'userRepository' => $this->userRepository,
            ],
            'index' => [
                'class' => Index::class,
            ],
            'create' => [
                'class' => Create::class,
                'userService' => $this->userService,
            ],
            'update' => [
                'class' => Update::class,
                'userService' => $this->userService,
            ],
            'delete' => [
                'class' => Delete::class,
                'userService' => $this->userService,
            ],
        ];
    }
}
