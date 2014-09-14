<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phpci_setting".
 *
 * @property string $skey
 * @property string $svalue
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skey'], 'required'],
            [['svalue'], 'string'],
            [['skey'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'skey' => 'Skey',
            'svalue' => 'Svalue',
        ];
    }
}
