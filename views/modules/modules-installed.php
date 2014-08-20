<?php

use yii\web\View;
use \yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $status string */
/* @var $dataProvider \yii\data\ActiveDataProvider | array */

$this->registerJs("yii.modules.moduleSwitch('.moduleSwitch')",View::POS_READY,'yii.modules.moduleSwitch.moduleSwitch');
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => ['class' => 'table-responsive'],
    'tableOptions' => ['class' => 'table  table-hover'],
    'layout' => "{items}\n{pager}",
    'columns' => [
        'name',
        'version',
        'description',
        [
            'attribute' => 'disabled',
            'format' => 'raw',
            'value' => function ($model, $key, $index, $column){
                    $status = $model->{$column->attribute};
                    $module = $model->id;
                    if(!$status)
                        return '<span data-module="'.$module.'" data-action="'.\yii\helpers\Url::toRoute(['modules/switch']).'" data-param="1" data-tr="'.$key.'" title="点击禁用" class="label label-success moduleSwitch">启用</span>';
                    else
                        return '<span data-module="'.$module.'" data-action="'.\yii\helpers\Url::toRoute(['modules/switch']).'" data-param="0" data-tr="'.$key.'" title="点击启用"  class="label label-default moduleSwitch">禁用</span>';
                }
        ]
    ]
]);