<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "leader".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $first_name
 * @property string $parent_name
 * @property string $grade
 *
 * @property Student[] $students
 * @property Work[] $works
 *
 * @property string $fullname
 * @see User::getFullname()
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
            [['last_name', 'first_name', 'parent_name', 'grade'], 'required'],
            [['last_name', 'first_name', 'parent_name', 'grade'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'parent_name' => 'Отчество',
            'grade' => 'Степень',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['leader_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['leader_id' => 'id']);
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
        return ArrayHelper::map(self::find()->all(), 'id', 'fullname');
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        $name = [
            $this->last_name,
            $this->first_name,
            $this->parent_name,
        ];

        $name = array_filter($name);
        return implode(' ', $name);
    }
}
