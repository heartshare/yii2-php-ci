<?php

use \yii\helpers\Html;
use \yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $status string */
/* @var $dataProvider \yii\data\ActiveDataProvider | array */

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
                        return '<span data-module="'.$module.'" data-action="'.\yii\helpers\Url::toRoute(['modules/switch']).'" data-param="1" data-tr="'.$key.'" title="点击禁用" class="label label-success cursor JModuleSwitch">启用</span>';
                    else
                        return '<span data-module="'.$module.'" data-action="'.\yii\helpers\Url::toRoute(['modules/switch']).'" data-param="0" data-tr="'.$key.'" title="点击启用"  class="label label-default cursor JModuleSwitch">禁用</span>';
                }
        ],
        [
            'class' => 'yii\grid\ActionColumn', // can be omitted, default
            'template' => '{config} {uninstall}',
            'buttons' => [
                'config' => function ($url, $model, $key){
                         $setting = $model->getConfig('setting');
                         if($setting && !empty($setting['route'])){
                             return Html::a('<span class="glyphicon glyphicon-cog"></span>', [$setting['route']], [
                                 'title' => Yii::t('yii', '设置'),
                                 'data-pjax' => '1',
                             ]);
                         }
                    },
                'uninstall' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0)', [
                            'title' => Yii::t('yii', '卸载'),
                            'data-message' => '确定要进行卸载?',
                            'data-pjax' => '0',
                            'data-action' => \yii\helpers\Url::toRoute(['modules/uninstall']),
                            'data-module' => $model->id,
                            'class'=>'JModuleUninstall'
                        ]);
                    },
            ]
        ],
    ]
]);