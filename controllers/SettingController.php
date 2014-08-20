<?php

namespace app\controllers;

use app\components\web\Controller;

class SettingController extends Controller
{
    public $chanel = 'setting';

    public function actionIndex()
    {
        return $this->render('index');
    }
}