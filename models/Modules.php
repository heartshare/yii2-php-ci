<?php

namespace app\models;

use app\models\query\ModulesQuery;
use Yii;
use yii\base\InvalidParamException;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

/**
 * This is the model class for table "phpci_modules".
 *
 * @property integer $id
 * @property string $module
 * @property string $name
 * @property string $url
 * @property string $version
 * @property integer $icon
 * @property string $category
 * @property string $description
 * @property string $config
 * @property integer $sort
 * @property integer $disabled
 * @property string $created_at
 * @property string $updated_at
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%modules}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'name', 'description'], 'required'],
            [['icon', 'sort', 'disabled', 'created_at', 'updated_at'], 'integer'],
            [['module', 'category'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 100],
            [['version'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['config'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => '模块',
            'name' => '模块名',
            'url' => '链接地址',
            'version' => '版本号',
            'icon' => '图标文件存在与否',
            'category' => '模块所属分类',
            'description' => '模块描述',
            'config' => '模块配置',
            'sort' => '排序 ',
            'disabled' => '状态',
            'created_at' => '安装日期',
            'updated_at' => '更新日期',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function find()
    {
        return new ModulesQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if(is_array($this->config) || !$this->config )
                $this->config = $this->config?Json::encode($this->config):Json::encode([]);

            if($insert)
                $this->disabled = 1;
            return true;
        }
        return false;
    }

    public function install()
    {
        $transaction = self::getDb()->beginTransaction();
        try{
            if ($this->save(false) && Yii::$app->moduleLoader->installModule($this->module)){
                Yii::trace($this->module.'安装成功', 'application.ModuleInstall');
                $transaction->commit();
                return true;
            }else{
                $transaction->rollBack();
                return '安装失败()';
            }
        }catch (InvalidParamException $e){
            $transaction->rollBack();
            Yii::error($e->getMessage(),'application.ModuleInstall');
            return $e->getMessage();
        }catch(\Exception $e){
            $transaction->rollBack();
            Yii::error($e->getMessage(),'application.ModuleInstall');
            return $e->getMessage();
        }
    }
}
