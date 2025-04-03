<?php

namespace app\commands;

use OpenApi\Generator;
use Yii;
use yii\console\Controller;
use yii\helpers\BaseConsole;

class SwaggerController extends Controller
{
    public function actionRun()
    {
        $sources = [
            Yii::getAlias('@app/models/forms'),
            Yii::getAlias('@app/src'),
        ];

        $openApi = Generator::scan($sources);

        if ($openApi === null) {
            $this->stderr("Error while scanning sources.\n", BaseConsole::FG_RED);
        }

        $file = Yii::getAlias('@app/web/docs/swagger/openapi.yaml');

        $handler = fopen($file, 'wb');
        fwrite($handler, $openApi->toYaml());
        fclose($handler);

        $this->stdout("Docs successfully updated.\n", BaseConsole::FG_GREEN);
    }
}
