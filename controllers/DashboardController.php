<?php

namespace app\controllers;

use app\components\web\Controller;

class DashboardController extends Controller
{

    public $chanel = 'dashboard';

    public function actionIndex()
    {
        return $this->render('index');
    }
}