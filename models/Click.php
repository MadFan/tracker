<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "click".
 *
 * @property integer $id
 * @property string $click_id
 * @property string $ua
 * @property integer $ip
 * @property string $ref
 * @property string $param1
 * @property string $param2
 * @property integer $error
 * @property integer $bad_domain
 */
class Click extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'click';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['click_id', 'ua', 'ip', 'param1'], 'required'],
            [['ua', 'ref'], 'string'],
            [['ip', 'error', 'bad_domain'], 'integer'],
            [['click_id'], 'string', 'max' => 64],
            [['param1', 'param2'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'click_id' => 'Click ID',
            'ua' => 'Ua',
            'ip' => 'Ip',
            'ref' => 'Ref',
            'param1' => 'Param1',
            'param2' => 'Param2',
            'error' => 'Error',
            'bad_domain' => 'Bad Domain',
        ];
    }
}
