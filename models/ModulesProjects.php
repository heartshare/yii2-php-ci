<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "phpci_modules_projects".
 *
 * @property integer $project_id
 * @property integer $module_id
 * @property string $config
 *
 * @property Modules $module
 * @property Projects $project
 */
class ModulesProjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phpci_modules_projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'module_id'], 'required'],
            [['project_id', 'module_id'], 'integer'],
            [['config'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'module_id' => 'Module ID',
            'config' => 'Config',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
}
