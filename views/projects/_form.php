<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_name')->textInput(['maxlength' => 100]) ?>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">已安装模块</h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'associateModules', ['template' => "{input}\n{hint}\n{error}"])->checkboxList(\yii\helpers\ArrayHelper::map(Yii::$app->moduleLoader->installedModules(), 'id', 'module'));?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
