<?php

namespace app\controllers;

use app\components\web\Controller;
use app\models\search\ProjectsSearch;

class DashboardController extends Controller
{

    public $chanel = 'dashboard';

    public function actionIndex()
    {
        $projectsSearchModel = new ProjectsSearch();
        $projectsDataProvider = $projectsSearchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'projectsSearchModel' => $projectsSearchModel,
            'projectsDataProvider' => $projectsDataProvider
        ]);
    }
}
