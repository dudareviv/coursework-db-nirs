<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Work */

$this->title = 'Update Work: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Научные работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
