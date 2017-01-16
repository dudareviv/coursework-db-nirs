<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $first_name
 * @property string $parent_name
 * @property integer $leader_id
 * @property integer $speciality_id
 *
 * @property Leader $leader
 * @property Speciality $speciality
 * @property Work[] $works
 *
 * @property string $fullname
 * @see User::getFullname()
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
            [['last_name', 'first_name', 'parent_name', 'speciality_id'], 'required'],
            [['last_name', 'first_name', 'parent_name'], 'string'],
            [['leader_id', 'speciality_id'], 'integer'],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leader::className(), 'targetAttribute' => ['leader_id' => 'id']],
            [['speciality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speciality::className(), 'targetAttribute' => ['speciality_id' => 'id']],
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
            'leader_id' => 'Руководитель',
            'leader.fullname' => 'Руководитель',
            'speciality_id' => 'Специальность',
            'speciality.fullname' => 'Специальность',
        ];
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
    public function getSpeciality()
    {
        return $this->hasOne(Speciality::className(), ['id' => 'speciality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['student_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\queries\StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\StudentQuery(get_called_class());
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

    /**
     * @return array
     */
    public static function fetchList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'fullname');
    }
}
