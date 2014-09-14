<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-header">
    <h1 id="" class="page-header">
        <?= Html::encode($this->title); ?>
        &nbsp;
        <?= Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']) ?>
    </h1>

    <div class="content-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table  table-hover'],
            'layout' => "{items}\n{pager}",
            'columns' => [
                'id',
                'project_name',
                'version',
                [
                    'label' => 'Build',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column){
                            return Html::button('Build', ['class' => 'btn btn-primary btn-xs']);
                        }
                ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>