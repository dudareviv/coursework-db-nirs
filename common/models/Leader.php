<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "leader".
 *
 * @property integer $user_id
 * @property string $grade
 *
 * @property User $user
 * @property Student[] $students
 * @property Work[] $works
 */
class Leader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'leader';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['grade'], 'required'],
            [['grade'], 'string'],
            [['user_id'], 'unique'],
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
            'grade' => 'Grade',
        ];
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
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['leader_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['leader_id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return \common\queries\LeaderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\LeaderQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function fetchList()
    {
        return ArrayHelper::map(self::find()->with('user')->all(), 'user_id', 'user.fullname');
    }
}
