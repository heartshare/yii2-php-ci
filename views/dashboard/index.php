<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $projectsSearchModel app\models\search\ProjectsSearch */
/* @var $projectsDataProvider yii\data\ActiveDataProvider */
?>
<h1 class="page-header">
    Dashboard
    &nbsp;
    <a class="btn btn-primary " href="<?= \yii\helpers\Url::toRoute(['projects/create']) ?>" role="button">添加项目</a>
</h1>

<div class="row placeholders">
    <div class="col-xs-24 col-sm-12 placeholder">

    </div>
</div>

