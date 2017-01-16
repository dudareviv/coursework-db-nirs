<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\LeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leaders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Leader', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'last_name',
            'first_name',
            'parent_name',
            'grade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
