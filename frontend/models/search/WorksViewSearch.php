<?php
/**
 * Created with love in Kodelnaya.
 * Author: Dudarev Ilia
 * Email: ilya@kodelnya.ru
 * Phone: +7 906 780 3210
 * Date: 03.04.2017
 * Time: 12:45
 */

namespace frontend\models\search;


use common\models\view\WorksView;
use yii\data\ActiveDataProvider;

class WorksViewSearch extends WorksView
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id', 'student_id', 'leader_id'], 'integer'],
            [['work_theme', 'work_justification', 'student_last_name', 'student_first_name', 'student_parent_name', 'leader_last_name', 'leader_first_name', 'leader_parent_name'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WorksView::find();

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
            'work_id' => $this->work_id,
            'student_id' => $this->student_id,
            'leader_id' => $this->leader_id,
        ]);

        $query->andFilterWhere(['like', 'work_theme', $this->work_theme])
            ->andFilterWhere(['like', 'work_justification', $this->work_justification])
            ->andFilterWhere(['like', 'student_last_name', $this->student_last_name])
            ->andFilterWhere(['like', 'student_first_name', $this->student_first_name])
            ->andFilterWhere(['like', 'student_parent_name', $this->student_parent_name])
            ->andFilterWhere(['like', 'leader_last_name', $this->leader_last_name])
            ->andFilterWhere(['like', 'leader_first_name', $this->leader_first_name])
            ->andFilterWhere(['like', 'leader_parent_name', $this->leader_parent_name]);

        return $dataProvider;
    }
}