<?php

namespace app\modules\phploc;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\phploc\controllers';


    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }


    public static function install()
    {
        return true;
    }

    public static function uninstall()
    {
        return true;
    }

    public static function moduleConfig()
    {
        if (is_file(__DIR__.DIRECTORY_SEPARATOR.'config.php'))
            return require(__DIR__.DIRECTORY_SEPARATOR.'config.php');
        return [];
    }
}
