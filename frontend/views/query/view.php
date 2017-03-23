<?php
/**
 * Created with love in Kodelnaya.
 * Author: Dudarev Ilia
 * Email: ilya@kodelnya.ru
 * Phone: +7 906 780 3210
 * Date: 23.03.2017
 * Time: 15:10
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\view\StudentView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Представление студентов и их руководителей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speciality-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'student_id',
            'student_full_name',
            'leader_full_name',
        ],
    ]); ?>
</div>