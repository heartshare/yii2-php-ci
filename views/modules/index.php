<?php

use \yii\web\View;
use yii\helpers\Url;
use yii\widgets\pjax;

/* @var $this \yii\web\View */
/* @var $status string */
/* @var $dataProvider \yii\data\ActiveDataProvider | array */

$asset = \app\assets\ModulesAsset::register($this);
if($status === 'install')
    $this->registerJs("
        yii.modules.moduleSwitch('.JModuleSwitch','#pjax-content');
        yii.modules.moduleUninstall('.JModuleUninstall', '#pjax-content');",
        View::POS_READY,
        'yii.modules.moduleSwitch.moduleSwitch_JModuleUninstall'
    );
Pjax::begin(['options' => ['id' => 'pjax-content', 'enableReplaceState' => true], 'timeout' => 10000]);
?>
<!-- Pjax Content Begin-->
<div id="pjax-content">
    <div class="content-header">
        <h1 id="" class="page-header">
            模块列表
            &nbsp;
            <a class="btn <?= $status == 'install'?'btn-primary':'btn-default'; ?> " href="<?= Url::toRoute(['modules/index','status'=> 'install']) ?>" role="button">已安装</a>
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
<div>
<!-- Pjax Content End -->

<?php Pjax::end();?>
