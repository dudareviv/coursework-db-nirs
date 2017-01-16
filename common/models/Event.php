<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $work_id
 *
 * @property Work $work
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id'], 'required'],
            [['work_id'], 'integer'],
            [['work_id'], 'exist', 'skipOnError' => true, 'targetClass' => Work::className(), 'targetAttribute' => ['work_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_id' => 'Work ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Work::className(), ['id' => 'work_id']);
    }

    /**
     * @inheritdoc
     * @return \common\queries\EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\EventQuery(get_called_class());
    }
}
