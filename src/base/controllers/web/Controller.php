<?php

namespace app\src\base\controllers\web;

use app\src\base\exceptions\UserException;
use Throwable;
use Yii;

class Controller extends \yii\web\Controller
{
    /**
     * {@inheritdoc}
     */
    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (UserException $e) {
            return [
                'success' => false,
                'errors' => $e->errors,
            ];
        } catch (Throwable $e) {
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());

            return [
                'success' => false,
                'errors' => 'Something went wrong.'
            ];
        }
    }
}
