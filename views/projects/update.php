<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = 'Update Projects: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content-header">
    <h1 id="" class="page-header">
        <?= Html::encode($this->title); ?>
    </h1>
</div>
<div class="content-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

