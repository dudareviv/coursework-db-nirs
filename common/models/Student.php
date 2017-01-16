<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $user_id
 * @property integer $leader_id
 * @property integer $speciality_id
 *
 * @property Leader $leader
 * @property User $user
 * @property Work[] $works
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'leader_id', 'speciality_id'], 'integer'],
            [['speciality_id'], 'required'],
            [['user_id'], 'unique'],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leader::className(), 'targetAttribute' => ['leader_id' => 'user_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'leader_id' => 'Leader ID',
            'speciality_id' => 'Speciality ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Leader::className(), ['user_id' => 'leader_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['student_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \common\queries\StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\StudentQuery(get_called_class());
    }
}
