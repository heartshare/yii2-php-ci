<?php

namespace app\components\base;

use app\models\Modules;
use yii\base\component;
use yii\base\BootstrapInterface;

class ModuleLoader extends Component implements BootstrapInterface
{
    private $_enabledModules = [];

    public function bootstrap($application)
    {
        //Load Enabled Modules Form storage
        $this->_enabledModules = Modules::find()->enabled()->asArray()->indexBy('module')->all();
        foreach ($this->_enabledModules as $module){
            //TODO Add config for each modules from DB
            \Yii::trace('Load Module:'.$module['module'],'application.ModuleLoader');
            $application->setModule($module['module'],json_decode($module['config'],true));
        }
    }


    public function getEnabledModules()
    {
        return $this->_enabledModules;
    }

    /**
     * Load Modules Dir Name From Modules Path(@app/modules)
     *
     * @return array
     */
    public function getModuleDirs() {
        $modulePath = $this->getModulePath();
        $dirs = (array) glob( $modulePath . '*' );
        $moduleDirs = array();
        foreach ( $dirs as $dir ) {
            if ( is_dir( $dir ) ) {
                $d = basename( $dir );
                $moduleDirs[] = $d;
            }
        }
        return $moduleDirs;
    }

    /**
     * Get the Modules List which in modules Dir that not in db
     *
     * @return array
     */
    public function unInstallModules()
    {
        $unInstall = [];
        $install = $this->installedModules();
        $allModules = $this->getModuleDirs();

        if(!$install)
            return $this->loadModuleConfig($allModules);

        foreach ($allModules as $module){
            if(!isset($install[$module])){
                $unInstall[] = $module;
            }
        }
        return $this->loadModuleConfig($unInstall);
    }

    /**
     * Get All Modules From DB
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public function installedModules()
    {
        return Modules::find()->asArray()->indexBy('module')->all();
    }

    private  function loadModuleConfig($modules)
    {
        $return = [];
        if(!$modules)
            return [];
        foreach ($modules as $module){
            $return[$module] = $this->getModuleConfig($module);
        }
        return $return;
    }

    public function getModulePath()
    {
        return \Yii::getAlias('@app/modules').DIRECTORY_SEPARATOR;
    }

    public function getModuleClass($module)
    {
        $class =  "\\app\\modules\\".$module."\\Module";
        if(class_exists($class))
            return $class;
        \Yii::trace('Load Module Config : The module class not exist:'.$module['module'] .'','application.ModuleLoader');
        return false;
    }

    public function getModuleConfig($module)
    {
        if(!$module)
            return [];
        $class = $this->getModuleClass($module);
        if ($class && method_exists($class,'moduleConfig'))
            return $class::moduleConfig();
        return [];
    }

}