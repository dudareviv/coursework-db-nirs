<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    const STATUS_NEW = 0;
    const STATUS_DURING = 1;
    const STATUS_DONE = 10;

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
            'student_id' => 'Студент',
            'student.fullname' => 'Студент',
            'leader_id' => 'Руководитель',
            'leader.fullname' => 'Руководитель',
            'theme' => 'Тема',
            'justification' => 'Обоснование',
            'status' => 'Статус',
            'statusLabel' => 'Статус',
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

    /**
     * @return array
     */
    public static function fetchList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'theme');
    }

    /**
     * @return array
     */
    public static function statusLabels()
    {
        return [
            self::STATUS_NEW => 'Новая',
            self::STATUS_DURING => 'В работе',
            self::STATUS_DONE => 'Завершена',
        ];
    }

    /**
     * @return mixed
     */
    public function getStatusLabel()
    {
        return ArrayHelper::getValue(self::statusLabels(), $this->status);
    }
}
