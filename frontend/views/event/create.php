<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Event */

$this->title = 'Добавить событие';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
