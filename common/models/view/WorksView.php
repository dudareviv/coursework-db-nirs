<?php
/**
 * Created with love in Kodelnaya.
 * Author: Dudarev Ilia
 * Email: ilya@kodelnya.ru
 * Phone: +7 906 780 3210
 * Date: 03.04.2017
 * Time: 12:40
 */

namespace common\models\view;


use yii\db\ActiveRecord;

/**
 * Class WorksView
 * @package common\models\view
 *
 * @property integer work_id
 * @property string work_theme
 * @property string work_justification
 * @property integer student_id
 * @property string student_last_name
 * @property string student_first_name
 * @property string student_parent_name
 * @property integer leader_id
 * @property string leader_last_name
 * @property string leader_first_name
 * @property string leader_parent_name
 */
class WorksView extends ActiveRecord
{
    /** @inheritdoc */
    public static function tableName()
    {
        return "{{works_view}}";
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'work_id' => '№ работы',
            'work_theme' => 'Тема работы',
            'work_justification' => 'Обоснование работы',
            'student_id' => '№ студента',
            'student_last_name' => 'Фамилия студента',
            'student_first_name' => 'Имя студента',
            'student_parent_name' => 'Отчество студента',
            'leader_id' => '№ руководителя',
            'leader_last_name' => 'Фамилия руководителя',
            'leader_first_name' => 'Имя руководителя',
            'leader_parent_name' => 'Отчество руководителя',
        ];
    }
}