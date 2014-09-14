<?php

use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $form \yii\bootstrap\ActiveForm */
/* @var $phpLoc \app\modules\phploc\models\PhpLoc */

?>
<div class="content-header">
    <h1 id="" class="page-header">
        PhpLoc模块参数配置
    </h1>
</div>
<div class="content-body">
    <?php if(isset($success) && $success === true): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>操作成功</strong> 配置已保存到数据数据库中
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin([
        'id' => 'phpLoc-config',
        'options' => ['data-pjax' => 1]
    ]); ?>
        <?= $form->field($phpLoc, 'names')->hint($phpLoc->hint('names')); ?>
        <?= $form->field($phpLoc, 'namesExclude')->hint($phpLoc->hint('namesExclude'));?>
        <?= $form->field($phpLoc, 'exclude')->hint($phpLoc->hint('exclude'));?>
        <?= $form->field($phpLoc, 'logCsv')->hint($phpLoc->hint('logCsv'));?>
        <?= $form->field($phpLoc, 'logXml')->hint($phpLoc->hint('logXml'));?>
        <?= $form->field($phpLoc, 'gitRepository')->hint($phpLoc->hint('gitRepository'));?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('保存', ['name' => 'setting', 'class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end();?>
</div>