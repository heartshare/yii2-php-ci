<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "phpci_projects".
 *
 * @property integer $id
 * @property string $project_name
 * @property string $version
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ModulesProjects[] $modulesProjects
 * @property Modules[] $modules
 */
class Projects extends \yii\db\ActiveRecord
{

    public $associateModules = [];
    public $oldAssociateModules = [];


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['project_name', 'version'], 'string', 'max' => 100],
            [['associateModules'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_name' => '项目名称',
            'version' => '最新版本',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulesProjects()
    {
        return $this->hasMany(ModulesProjects::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(Modules::className(), ['id' => 'module_id'])->viaTable(
            'phpci_modules_projects',
            ['project_id' => 'id']
        );
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function transactions()
    {
        return [
            'CreateOrUpdate' => self::OP_INSERT | self::OP_UPDATE,
        ];
    }

    public function afterFind()
    {
        $this->associateModules = array_keys($this->findAssociateModules('id'));
        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        $insert ? $this->insertModules($changedAttributes) : $this->updateModules($changedAttributes);
        parent::afterSave($insert, $changedAttributes);
    }

    private function insertModules($changedAttributes)
    {

        if ($this->associateModules) {
            $this->modulesProjectsBatchInsert($this->id, $this->associateModules);
        }
    }

    private function updateModules($changedAttributes)
    {
        if (!$this->oldAssociateModules && !$this->associateModules) {
            return;
        }
        $this->associateModules = $this->associateModules ? $this->associateModules : [];
        $this->oldAssociateModules = $this->oldAssociateModules ? $this->oldAssociateModules : [];

        $delete = array_diff($this->oldAssociateModules, $this->associateModules);
        $add = array_diff($this->associateModules, $this->oldAssociateModules);
        if ($delete) {
            ModulesProjects::deleteAll('project_id = ' . $this->id);
        }

        if ($add) {
            $this->modulesProjectsBatchInsert($this->id, $this->associateModules);
        }
    }

    private function modulesProjectsBatchInsert($projectId, $modulesId = [])
    {
        $associateModules = [];
        foreach ($modulesId as $associateModule) {
            $associateModules [] = [$projectId, $associateModule];
        }

        ModulesProjects::getDb()->createCommand()->batchInsert(
            ModulesProjects::tableName(),
            ['project_id', 'module_id'],
            $associateModules
        )->execute();
    }

    public function findAssociateModules($key = 'id')
    {
        $modules = [];
        if ($this->modules) {
            foreach ($this->modules as $module) /*@var $module app\models\Modules */ {
                $modules [$module->$key] = $module->toArray();
            }
        }
        return $modules;
    }
}
