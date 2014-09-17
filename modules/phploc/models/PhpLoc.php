<?php

namespace app\modules\phploc\models;

use app\models\Setting;
use yii\base\Model;
use yii\helpers\Json;

/**
 * Class PhpLoc
 *
 * @property string names
 * @property string namesExclude
 * @property string exclude
 * @property string logCsv
 * @property string logXml
 * @property string gitRepository
 *
 * @package app\modules\phploc\models
 */
class PhpLoc extends Model
{
    public $names = '*.php';

    public $namesExclude;

    public $exclude = 'vendor,tests';

    public $logCsv = '@runtime/report';

    public $logXml;

    public $gitRepository;

    /**
     * @var \app\models\Setting
     */
    public $setting;

    public function init()
    {
        if ($this->setting = Setting::findOne($this->getSettingKey())) {
            $this->load(Json::decode($this->setting->svalue), '');
        } else {
            $this->setting = new Setting();
        }

    }

    public function rules()
    {
        return [
            [['names', 'namesExclude', 'exclude', 'logCsv', 'logXml', 'gitRepository '], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return ['names', 'namesExclude', 'exclude', 'logCsv', 'logXml', 'gitRepository'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'names' => 'names',
            'namesExclude' => 'names-exclude',
            'exclude' => 'exclude',
            'logCsv' => 'log-csv',
            'logXml' => 'log-xml',
            'gitRepository' => 'git-repository'
        ];
    }

    /**
     * Returns the list of hint messages.
     * The array keys are the attribute names, and the array values are the corresponding hint messages.
     * Hint messages will be displayed to end users when they are filling the form for the generator.
     * @return array the list of hint messages
     */
    public function hints()
    {
        return [
            'names' => 'A comma-separated list of file names to check (default: ["*.php"])',
            'namesExclude' => 'A comma-separated list of file names to exclude',
            'gitRepository' => 'Collect metrics over the history of a Git repository',
            'exclude' => 'Exclude a directory from code analysis (multiple values allowed)',
            'logCsv' => 'Write result in CSV format to file,you should set a path',
            'logXml' => 'Write result in XML format to file'
        ];
    }

    public function hint($attribute)
    {
        $hints = $this->hints();
        return isset($hints[$attribute]) ? $hints[$attribute] : '';
    }

    public function save()
    {
        if (!$this->setting->getIsNewRecord()) {
            $this->setting->svalue = Json::encode($this->getAttributes());
        } else {
            $this->setting->skey = $this->getSettingKey();
            $this->setting->svalue = Json::encode($this->getAttributes());
        }
        return $this->setting->save();
    }


    private function getSettingKey()
    {
        return 'php-loc';
    }
}
