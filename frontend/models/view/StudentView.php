<?php
/**
 * Created with love in Kodelnaya.
 * Author: Dudarev Ilia
 * Email: ilya@kodelnya.ru
 * Phone: +7 906 780 3210
 * Date: 23.03.2017
 * Time: 15:10
 */

namespace frontend\models\view;


use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for view "view_student".
 *
 * @property integer $student_id
 * @property string $student_full_name
 * @property string $leader_full_name
 */
class StudentView extends ActiveRecord
{
    /** @inheritdoc */
    public static function tableName()
    {
        return 'view_student';
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'student_id' => 'ID',
            'student_full_name' => 'ФИО студента',
            'leader_full_name' => 'ФИО руководителя',
        ];
    }

    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'leader_id' => $this->leader_id,
            'speciality_id' => $this->speciality_id,
        ]);

        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'parent_name', $this->parent_name]);

        return $dataProvider;
    }
}