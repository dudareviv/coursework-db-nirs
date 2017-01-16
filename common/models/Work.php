<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $leader_id
 * @property string $theme
 * @property string $justification
 * @property integer $status
 *
 * @property Event[] $events
 * @property Leader $leader
 * @property Student $student
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'leader_id', 'theme', 'justification'], 'required'],
            [['student_id', 'leader_id', 'status'], 'integer'],
            [['theme', 'justification'], 'string'],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leader::className(), 'targetAttribute' => ['leader_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'leader_id' => 'Leader ID',
            'theme' => 'Theme',
            'justification' => 'Justification',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['work_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Leader::className(), ['id' => 'leader_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @inheritdoc
     * @return \common\queries\WorkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\WorkQuery(get_called_class());
    }
}
