<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->beginContent('@app/views/layouts/main.php');
?>

<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <?php if($this->params['leftMenu']): ?>
                <?php foreach($this->params['leftMenu'] as $leftMenu): ?>
                    <li class="<?= $leftMenu['chanel']=== $this->params['leftMenuChanel']?'active':''; ?>"><a href="<?= Url::toRoute($leftMenu['url']); ?>"><?= $leftMenu['label']; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?= $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>
