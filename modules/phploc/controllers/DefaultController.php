<?php

namespace app\modules\phploc\controllers;

use app\components\web\Controller;
use app\modules\phploc\models\PhpLoc;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $phpLoc = new PhpLoc();
        if (isset($_POST['PhpLoc'])) {
            $phpLoc->load($_POST);
            if ($phpLoc->save()) {
                return $this->renderAjax('index', ['phpLoc' => $phpLoc, 'success' => true]);
            }
        }
        return $this->renderAjax('index', ['phpLoc' => $phpLoc,]);
    }
}
