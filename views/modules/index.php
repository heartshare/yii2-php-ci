<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $status string */
/* @var $dataProvider \yii\data\ActiveDataProvider | array */

$asset = \app\assets\ModulesAsset::register($this);
?>

<div class="content-header">
    <h1 id="" class="page-header">
        模块列表
        &nbsp;
        <a class="btn <?= $status == 'install'?'btn-primary':'btn-default'; ?>" href="<?= Url::toRoute(['modules/index','status'=> 'install']) ?>" role="button">已安装</a>
        <a class="btn <?= $status == 'uninstall'?'btn-primary':'btn-default'; ?>" href="<?= Url::toRoute(['modules/index','status'=> 'uninstall']) ?>" role="button">未安装</a>
    </h1>
</div>

<div class="content-body">
    <?php if($status == 'install'):  ?>
        <?= $this->render('modules-installed', ['dataProvider' => $dataProvider]); ?>
    <?php else: ?>
        <?= $this->render('modules-uninstalled', ['dataProvider' => $dataProvider]);?>
    <?php endif; ?>
</div>
