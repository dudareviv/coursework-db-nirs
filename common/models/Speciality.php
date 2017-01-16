<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "speciality".
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 *
 * @property string $fullname
 * @see User::getFullname()
 */
class Speciality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'speciality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            [['name', 'number'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'number' => 'Номер',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\queries\SpecialityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\queries\SpecialityQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return "{$this->name} ({$this->number})";
    }

    /**
     * @return array
     */
    public static function fetchList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'fullname');
    }
}
