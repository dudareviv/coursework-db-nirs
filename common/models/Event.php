<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $work_id
 * @property string $title
 * @property string $description
 * @property double $money
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
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
            [['work_id', 'title', 'description'], 'required'],
            [['work_id'], 'integer'],
            [['title', 'description'], 'string'],
            [['money'], 'number'],
            [['date', 'created_at', 'updated_at'], 'safe'],
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
            'work_id' => 'Научная работа',
            'title' => 'Наименование',
            'description' => 'Описание',
            'money' => 'Финансы',
            'date' => 'Дата события',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
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
