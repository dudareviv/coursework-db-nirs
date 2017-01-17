<?php
/**
 * Created with love by Kodelnaya.
 * Author: Dudarev Ilia
 * Email: ilya@kodelnya.ru
 * Phone: +7 906 780 3210
 * Date: 16.01.2017
 * Time: 18:15
 */

namespace frontend\models;


use common\models\Work;
use yii\base\Model;

class MainForm extends Model
{
    public $work_status = Work::STATUS_NEW;

    /** @inheritdoc */
    public function rules()
    {
        return [
            ['work_status', 'integer'],
            ['work_status', 'in', 'range' => array_keys(Work::statusLabels())],
        ];
    }


    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'work_status' => 'Статус научной работы'
        ];
    }

    /**
     * @return string
     */
    public static function getWorkListSql()
    {
        return "SELECT
                [work].[id] AS work_id,
                [work].[theme] AS work_theme,
                CONCAT([student].[last_name],' ',[student].[first_name],' ',[student].[parent_name]) AS student_fullname,
                CONCAT([speciality].[name],' (',[speciality].[number],')') AS student_speciality,
                CONCAT([leader].[last_name],' ',[leader].[first_name],' ',[leader].[parent_name]) AS leader_fullname
                FROM [work]
                LEFT JOIN [student]
                ON [student].[id] = [work].[student_id]
                LEFT JOIN [speciality]
                ON [speciality].[id] = [student].[speciality_id]
                LEFT JOIN [leader]
                ON [leader].[id] = [work].[leader_id]

                WHERE [work].[status] = :status";
    }

    /**
     * @return array
     */
    public function getWorksList()
    {
        return \Yii::$app->db->createCommand(self::getWorkListSql(), ['status' => $this->work_status])->queryAll();
    }
}