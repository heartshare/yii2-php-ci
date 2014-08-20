<?php

namespace app\assets;

use yii\web\AssetBundle;

class ModulesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/modules.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
