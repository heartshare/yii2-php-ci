<?php

namespace app\controllers;

use app\components\web\Controller;
use app\models\Modules;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class ModulesController extends Controller{

    public $chanel = 'setting.modules';

    public function actionIndex()
    {
        $status = \Yii::$app->request->getQueryParam('status','install');

        if($status == 'install'){
            $dataProvider = new ActiveDataProvider([
                'query' => Modules::find(),
                'pagination' => [
                    'pageSize' => 20
                ]
            ]);
        }else{//装载未安装的模块
            $dataProvider = \Yii::$app->moduleLoader->unInstallModules();
        }

        return $this->render('index',[
            'status' => $status,
            'dataProvider' => $dataProvider
        ]);
    }


    public function actionInstall()
    {
        //TODO 增加返回值及错误返回
        $module = \Yii::$app->request->post('module',null);
        $moduleConfig = \Yii::$app->moduleLoader->getModuleConfig($module);
        $moduleModel = new Modules();
        if($moduleModel->load($moduleConfig,'') && $moduleModel->validate()){
           echo  $moduleModel->install();
        }

    }

    public function actionSwitch($module,$disabled = 1)
    {
        //TODO 增加返回值及错误返回
        $moduleModel = Modules::findOne($module);
        if($moduleModel && (int)$moduleModel->disabled !== $disabled){
            $moduleModel->disabled = (int) $disabled;
            $moduleModel->update(false,['disabled']);
        }
    }

    public function actionUninstall()
    {
        //TODO 增加返回值及错误返回
        $moduleId = \Yii::$app->request->get('moduleId',null);
        if(Modules::findOne((int)$moduleId)->delete())
            return true;
    }
} 