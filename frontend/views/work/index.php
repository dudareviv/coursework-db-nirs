<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Научные работы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить работу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'student_id',
                'filter' => \common\models\Student::fetchList(),
                'value' => 'student.fullname',
            ],
            [
                'attribute' => 'leader_id',
                'filter' => \common\models\Leader::fetchList(),
                'value' => 'leader.fullname',
            ],
            'theme',
            [
                'attribute' => 'status',
                'filter' => \common\models\Work::statusLabels(),
                'value' => 'statusLabel',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
