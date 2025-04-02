<?php

namespace app\src\base\controllers\web;

use Throwable;
use Yii;
use yii\base\UserException;

class Controller extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (UserException $e) {
            Yii::$app->response->setStatusCodeByException($e);

            return [
                'success' => false,
                'errors' => [
                    $e->getMessage(),
                ],
            ];
        } catch (Throwable $e) {
            Yii::$app->response->setStatusCodeByException($e);
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return [
                'success' => false,
                'errors' => [
                    'Something went wrong.',
                ]
            ];
        }
    }
}
