<?php

namespace app\src\base\controllers;

use app\src\base\exceptions\UserException;
use app\src\base\helpers\LogHelper;
use Throwable;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\HttpException;

class WebController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'authenticator' => [
                'class' => HttpBearerAuth::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (UserException $e) {
            Yii::$app->response->setStatusCode(422);

            return [
                'success' => false,
                'errors' => $e->errors,
            ];
        } catch (HttpException $e) {
            Yii::$app->response->setStatusCodeByException($e);

            return [
                'success' => false,
                'errors' => [
                    $e->getMessage(),
                ],
            ];
        } catch (Throwable $e) {
            Yii::$app->response->setStatusCode(500);
            LogHelper::exception($e);

            return [
                'success' => false,
                'errors' => [
                    'Something went wrong.',
                ]
            ];
        }
    }
}
