<?php

use yii\web\View;

/* @var $this \yii\web\View */
/* @var $status string */
/* @var $dataProvider array */

$this->registerJs("yii.modules.moduleInstall('.module-install')",View::POS_READY,'yii.modules.moduleInstall.module-install');
?>

<div class="table-responsive">
    <table class="table  table-hover">
        <thead>
            <tr>
                <th>模块名</th>
                <th>版本号</th>
                <th>模块描述</th>
                <th>安装</th>
            </tr>
        </thead>
        <tbody>
        <?php if($dataProvider): ?>
            <?php foreach ($dataProvider as $data): ?>
                <tr>
                    <td><?= isset($data['name'])?$data['name']:'' ;?></td>
                    <td><?= isset($data['version'])?$data['version']:'';?></td>
                    <td><?= isset($data['description'])?$data['description']:'';?></td>
                    <td><a class="module-install" data-module="<?= isset($data['module'])?$data['module']:''; ?>" data-action="<?= \yii\helpers\Url::toRoute(['modules/install']); ?>" title="安装" href="javascript:void(0)"><span class="glyphicon glyphicon-download-alt"></span></a></td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
            <tr><td colspan="4"><div class="empty">No results found.</div></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>