<?php

namespace app\modules\phploc\controllers;

use app\components\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {

        return $this->renderAjax('index');
    }
}
